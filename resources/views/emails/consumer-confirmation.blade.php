<p>{{ __('elallas::elallas.confirmation_intro') }}</p>

<hr>
<p><strong>{{ __('elallas::elallas.addressee') }}:</strong><br>
{{ $seller['name'] }}<br>{{ $seller['address'] }}<br>{{ $seller['email'] }}</p>

<p>{{ __('elallas::elallas.statement') }}</p>

<ul>
    <li><strong>{{ __('elallas::elallas.fields.type') }}:</strong> {{ $declaration->type->label() }}</li>
    <li><strong>{{ __('elallas::elallas.fields.subject') }}:</strong> {{ $declaration->subject }}</li>
    <li><strong>{{ __('elallas::elallas.fields.contract_date') }}:</strong> {{ $declaration->contract_date->format('Y-m-d') }}</li>
    <li><strong>{{ __('elallas::elallas.fields.consumer_name') }}:</strong> {{ $declaration->consumer_name }}</li>
    <li><strong>{{ __('elallas::elallas.fields.consumer_address') }}:</strong> {{ $declaration->consumer_address }}</li>
    @if ($declaration->order_reference)
        <li><strong>{{ __('elallas::elallas.fields.order_reference') }}:</strong> {{ $declaration->order_reference }}</li>
    @endif
</ul>

<p><strong>{{ __('elallas::elallas.fields.dated') }}:</strong> {{ $declaration->submitted_at->format('Y-m-d H:i') }}</p>
