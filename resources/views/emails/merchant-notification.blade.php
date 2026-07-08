<p>{{ __('elallas::elallas.merchant_intro') }}</p>
<ul>
    <li><strong>{{ __('elallas::elallas.fields.type') }}:</strong> {{ $declaration->type->label() }}</li>
    <li><strong>{{ __('elallas::elallas.fields.subject') }}:</strong> {{ $declaration->subject }}</li>
    <li><strong>{{ __('elallas::elallas.fields.contract_date') }}:</strong> {{ $declaration->contract_date->format('Y-m-d') }}</li>
    <li><strong>{{ __('elallas::elallas.fields.consumer_name') }}:</strong> {{ $declaration->consumer_name }}</li>
    <li><strong>{{ __('elallas::elallas.fields.consumer_address') }}:</strong> {{ $declaration->consumer_address }}</li>
    <li><strong>{{ __('elallas::elallas.fields.consumer_email') }}:</strong> {{ $declaration->consumer_email }}</li>
    @if ($declaration->order_reference)
        <li><strong>{{ __('elallas::elallas.fields.order_reference') }}:</strong> {{ $declaration->order_reference }}</li>
    @endif
    @if ($declaration->message)
        <li><strong>{{ __('elallas::elallas.fields.message') }}:</strong> {{ $declaration->message }}</li>
    @endif
</ul>
