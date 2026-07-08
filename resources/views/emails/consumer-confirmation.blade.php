@php($locale = str_replace('_', '-', app()->getLocale()))
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light">
    <title>{{ __('withdrawal::withdrawal.confirmation_subject') }}</title>
</head>
<body style="margin:0;padding:0;background:#eef2f6;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#eef2f6;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="width:600px;max-width:100%;background:#ffffff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#0f172a;">

                    {{-- Header --}}
                    <tr>
                        <td style="background:#0f172a;padding:22px 30px;">
                            <div style="color:#ffffff;font-size:17px;font-weight:600;line-height:1.3;">{{ $seller['name'] }}</div>
                            <div style="color:#94a3b8;font-size:12px;font-weight:500;letter-spacing:.02em;margin-top:4px;text-transform:uppercase;">{{ __('withdrawal::withdrawal.confirmation_subject') }}</div>
                        </td>
                    </tr>

                    {{-- Intro --}}
                    <tr>
                        <td style="padding:26px 30px 6px;">
                            <p style="margin:0;font-size:15px;line-height:1.65;color:#334155;">{{ __('withdrawal::withdrawal.confirmation_intro') }}</p>
                        </td>
                    </tr>

                    {{-- Addressee --}}
                    <tr>
                        <td style="padding:18px 30px 4px;">
                            <div style="font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:#64748b;margin-bottom:6px;">{{ __('withdrawal::withdrawal.addressee') }}</div>
                            <div style="font-size:14px;line-height:1.6;color:#0f172a;">
                                <strong>{{ $seller['name'] }}</strong><br>
                                {{ $seller['address'] }}<br>
                                <a href="mailto:{{ $seller['email'] }}" style="color:#2563eb;text-decoration:none;">{{ $seller['email'] }}</a>
                            </div>
                        </td>
                    </tr>

                    {{-- Statutory statement (verbatim, legally binding) --}}
                    <tr>
                        <td style="padding:18px 30px 6px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-left:4px solid #0f172a;border-radius:0 8px 8px 0;">
                                <tr>
                                    <td style="padding:14px 18px;font-size:14px;line-height:1.65;color:#1e293b;">
                                        {{ __('withdrawal::withdrawal.statement') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Declaration data --}}
                    <tr>
                        <td style="padding:14px 30px 6px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e2e8f0;border-radius:10px;border-collapse:separate;overflow:hidden;">
                                @php($rows = [
                                    [__('withdrawal::withdrawal.fields.type'), $declaration->type->label()],
                                    [__('withdrawal::withdrawal.fields.subject'), $declaration->subject],
                                    [__('withdrawal::withdrawal.fields.contract_date'), $declaration->contract_date->format('Y-m-d')],
                                    [__('withdrawal::withdrawal.fields.consumer_name'), $declaration->consumer_name],
                                    [__('withdrawal::withdrawal.fields.consumer_address'), $declaration->consumer_address],
                                ])
                                @if ($declaration->order_reference)
                                    @php($rows[] = [__('withdrawal::withdrawal.fields.order_reference'), $declaration->order_reference])
                                @endif
                                @foreach ($rows as $i => $row)
                                    <tr>
                                        <td style="width:44%;padding:11px 16px;font-size:12px;font-weight:600;color:#475569;background:#f8fafc;{{ $i > 0 ? 'border-top:1px solid #e2e8f0;' : '' }}vertical-align:top;">{{ $row[0] }}</td>
                                        <td style="padding:11px 16px;font-size:14px;color:#0f172a;{{ $i > 0 ? 'border-top:1px solid #e2e8f0;' : '' }}vertical-align:top;">{{ $row[1] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    {{-- Dated --}}
                    <tr>
                        <td style="padding:16px 30px 4px;">
                            <span style="font-size:12px;font-weight:600;color:#64748b;">{{ __('withdrawal::withdrawal.fields.dated') }}:</span>
                            <span style="font-size:14px;color:#0f172a;">&nbsp;{{ $declaration->submitted_at->format('Y-m-d H:i') }}</span>
                        </td>
                    </tr>

                    {{-- Legal footer --}}
                    <tr>
                        <td style="padding:22px 30px 26px;">
                            <div style="border-top:1px solid #e2e8f0;padding-top:16px;font-size:11px;line-height:1.6;color:#94a3b8;">
                                {{ __('withdrawal::withdrawal.email_footer') }}
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
