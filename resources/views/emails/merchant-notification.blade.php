<p>{{ __('withdrawal::withdrawal.merchant_intro') }}</p>
<ul>
    <li><strong>{{ __('withdrawal::withdrawal.fields.type') }}:</strong> {{ $declaration->type->label() }}</li>
    <li><strong>{{ __('withdrawal::withdrawal.fields.subject') }}:</strong> {{ $declaration->subject }}</li>
    <li><strong>{{ __('withdrawal::withdrawal.fields.contract_date') }}:</strong> {{ $declaration->contract_date->format('Y-m-d') }}</li>
    <li><strong>{{ __('withdrawal::withdrawal.fields.consumer_name') }}:</strong> {{ $declaration->consumer_name }}</li>
    <li><strong>{{ __('withdrawal::withdrawal.fields.consumer_address') }}:</strong> {{ $declaration->consumer_address }}</li>
    <li><strong>{{ __('withdrawal::withdrawal.fields.consumer_email') }}:</strong> {{ $declaration->consumer_email }}</li>
    @if ($declaration->order_reference)
        <li><strong>{{ __('withdrawal::withdrawal.fields.order_reference') }}:</strong> {{ $declaration->order_reference }}</li>
    @endif
    @if ($declaration->message)
        <li><strong>{{ __('withdrawal::withdrawal.fields.message') }}:</strong> {{ $declaration->message }}</li>
    @endif
</ul>
