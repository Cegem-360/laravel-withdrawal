<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Http\Controllers;

use Cegem360\Elallas\Http\Requests\SubmitDeclarationRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

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
