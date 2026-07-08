<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal\Http\Controllers;

use Cegem360\Withdrawal\Events\WithdrawalDeclarationSubmitted;
use Cegem360\Withdrawal\Http\Requests\SubmitDeclarationRequest;
use Cegem360\Withdrawal\Mail\DeclarationReceivedConfirmation;
use Cegem360\Withdrawal\Mail\DeclarationSubmittedNotification;
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
        return view('withdrawal::form', [
            'seller' => config('withdrawal.seller'),
        ]);
    }

    public function store(SubmitDeclarationRequest $request): RedirectResponse
    {
        /** @var class-string<Model> $model */
        $model = config('withdrawal.model');

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

            $notify = config('withdrawal.notify_email') ?: config('withdrawal.seller.email');
            if (! empty($notify)) {
                Mail::to($notify)->send(new DeclarationSubmittedNotification($record));
            } else {
                Log::warning('withdrawal: no merchant notify address configured; merchant notification skipped for declaration '.$record->getKey());
            }
        } catch (\Throwable $e) {
            Log::error('withdrawal: confirmation email failed for declaration '.$record->getKey().': '.$e->getMessage());
        }

        $redirect = config('withdrawal.redirect_after');

        return $redirect !== null
            ? redirect()->route($redirect)->with('withdrawal_success', true)
            : redirect()->route('withdrawal.success');
    }

    public function success(): Renderable
    {
        return view('withdrawal::success');
    }
}
