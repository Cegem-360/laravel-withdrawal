<?php

declare(strict_types=1);

namespace Cegem360\Elallas\Http\Requests;

use Cegem360\Elallas\Enums\DeclarationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitDeclarationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::enum(DeclarationType::class)],
            'consumer_name' => ['required', 'string', 'max:255'],
            'consumer_address' => ['required', 'string', 'max:1000'],
            'consumer_email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:2000'],
            'contract_date' => ['required', 'date'],
            'order_reference' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
            'website' => ['nullable', 'size:0'],
        ];
    }
}
