<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('withdrawal::withdrawal.page_title') }}</title>
</head>
<body style="font-family:system-ui,sans-serif;max-width:640px;margin:2rem auto;padding:0 1rem;line-height:1.6;color:#1a2433">
    <h1>{{ __('withdrawal::withdrawal.template_heading') }}</h1>
    <p style="color:#556">{{ __('withdrawal::withdrawal.template_note') }}</p>
    <p>{{ __('withdrawal::withdrawal.intro') }}</p>

    <p><strong>{{ __('withdrawal::withdrawal.addressee') }}:</strong><br>
        {{ $seller['name'] }}<br>
        {{ $seller['address'] }}<br>
        {{ $seller['email'] }}</p>

    <p>{{ __('withdrawal::withdrawal.statement') }}</p>

    @if ($errors->any())
        <div style="background:#fde;border:1px solid #c33;padding:.75rem 1rem;border-radius:8px">
            <ul style="margin:0;padding-left:1.2rem">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('withdrawal.submit') }}">
        @csrf
        <p style="position:absolute;left:-9999px" aria-hidden="true">
            <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
        </p>

        <p><label>{{ __('withdrawal::withdrawal.fields.type') }}<br>
            <select name="type" required>
                @foreach (\Cegem360\Withdrawal\Enums\DeclarationType::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.subject') }} *<br>
            <textarea name="subject" rows="2" required style="width:100%">{{ old('subject') }}</textarea></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.contract_date') }} *<br>
            <input type="date" name="contract_date" value="{{ old('contract_date') }}" required></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.consumer_name') }} *<br>
            <input type="text" name="consumer_name" value="{{ old('consumer_name') }}" required style="width:100%"></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.consumer_address') }} *<br>
            <textarea name="consumer_address" rows="2" required style="width:100%">{{ old('consumer_address') }}</textarea></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.consumer_email') }} *<br>
            <input type="email" name="consumer_email" value="{{ old('consumer_email') }}" required style="width:100%"></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.order_reference') }}<br>
            <input type="text" name="order_reference" value="{{ old('order_reference') }}" style="width:100%"></label></p>

        <p><label>{{ __('withdrawal::withdrawal.fields.message') }}<br>
            <textarea name="message" rows="3" style="width:100%">{{ old('message') }}</textarea></label></p>

        <p style="color:#556;font-size:.9em">{{ __('withdrawal::withdrawal.signature_note') }}</p>

        <button type="submit" style="padding:.7rem 1.4rem;font-weight:600">{{ __('withdrawal::withdrawal.submit') }}</button>
    </form>
</body>
</html>
