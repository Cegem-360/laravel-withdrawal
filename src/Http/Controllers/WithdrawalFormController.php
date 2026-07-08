<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Http\Controllers;

use Cegem360\Elallas\Events\WithdrawalDeclarationSubmitted;
use Cegem360\Elallas\Http\Requests\SubmitDeclarationRequest;
use Cegem360\Elallas\Mail\DeclarationReceivedConfirmation;
use Cegem360\Elallas\Mail\DeclarationSubmittedNotification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WithdrawalFormController extends Controller
{
    public function show(): Renderable
    {
        return view('elallas::form', [
            'seller' => config('elallas.seller'),
        ]);
    }

    public function store(SubmitDeclarationRequest $request): RedirectResponse
    {
        /** @var class-string<Model> $model */
        $model = config('elallas.model');

        $data = $request->validated();

        $record = $model::create([
            'type' => $data['type'],
            'consumer_name' => $data['consumer_name'],
            'consumer_address' => $data['consumer_address'],
            'consumer_email' => $data['consumer_email'],
            'subject' => $data['subject'],
            'contract_date' => $data['contract_date'],
            'order_reference' => $data['order_reference'] ?? null,
            'message' => $data['message'] ?? null,
            'submitted_at' => now(),
            'ip' => $request->ip(),
        ]);

        WithdrawalDeclarationSubmitted::dispatch($record);

        try {
            Mail::to($record->consumer_email)->send(new DeclarationReceivedConfirmation($record));

            $notify = config('elallas.notify_email') ?: config('elallas.seller.email');
            if (! empty($notify)) {
                Mail::to($notify)->send(new DeclarationSubmittedNotification($record));
            } else {
                Log::warning('elallas: no merchant notify address configured; merchant notification skipped for declaration '.$record->getKey());
            }
        } catch (\Throwable $e) {
            Log::error('elallas: confirmation email failed for declaration '.$record->getKey().': '.$e->getMessage());
        }

        $redirect = config('elallas.redirect_after');

        return $redirect !== null
            ? redirect()->route($redirect)->with('elallas_success', true)
            : redirect()->route('elallas.success');
    }

    public function success(): Renderable
    {
        return view('elallas::success');
    }
}
