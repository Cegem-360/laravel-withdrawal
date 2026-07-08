# AGENTS.md — cegem360/laravel-withdrawal

> Instructions for an AI coding agent installing this package into a **host Laravel application**.
> Follow the steps in order. Everything here is deterministic; do not improvise package names, keys, or class names.

## What this package is

A Laravel package that provides an online **withdrawal / cancellation declaration** ("elállási/felmondási nyilatkozat") flow required by Hungarian Government Decree **45/2014. (II. 26.)**: a public form, storage of the declaration, and **durable-medium email confirmation** to both the consumer and the merchant.

- Composer package name: `cegem360/laravel-withdrawal`
- PHP namespace root: `Cegem360\Withdrawal\`
- Published on Packagist — a plain `composer require` works, **no `repositories` VCS entry is needed**.

## Requirements

- PHP `^8.2`
- Laravel 11, 12, or 13 (`illuminate/*` `^11 | ^12 | ^13`)
- A configured mailer (`MAIL_*`) — the package sends email; without it, confirmation emails silently fail (the controller logs a warning and still stores + redirects).
- Optional: `filament/filament` `^5.0` (only if you want the read-only admin view).

## Install (run in the host app root)

```bash
composer require cegem360/laravel-withdrawal
php artisan vendor:publish --tag=withdrawal-config
php artisan migrate
```

- The migration auto-loads (creates the `withdrawal_declarations` table) — `php artisan migrate` is enough; publishing the migration is **optional** (`--tag=withdrawal-migrations`, only to customize columns).
- Views and translations are optional to publish: `--tag=withdrawal-views`, `--tag=withdrawal-lang`.
- The service provider auto-registers via package discovery. Do **not** manually add it to `config/app.php`.

## Required configuration — add to the host app `.env`

```env
WITHDRAWAL_SELLER_NAME="Example Shop Ltd."
WITHDRAWAL_SELLER_ADDRESS="1011 Budapest, Fő utca 1."
WITHDRAWAL_SELLER_EMAIL="shop@example.com"
WITHDRAWAL_NOTIFY_EMAIL="orders@example.com"
# Optional — public URL prefix for the form (default: elallasi-nyilatkozat)
WITHDRAWAL_ROUTE_PREFIX="elallasi-nyilatkozat"
```

| Key | Purpose |
| --- | --- |
| `WITHDRAWAL_SELLER_NAME` | Merchant name shown as the addressee in the confirmation email. |
| `WITHDRAWAL_SELLER_ADDRESS` | Merchant registered address. |
| `WITHDRAWAL_SELLER_EMAIL` | Merchant email (fallback notify target). |
| `WITHDRAWAL_NOTIFY_EMAIL` | Where new-submission notifications go. Falls back to `WITHDRAWAL_SELLER_EMAIL` if empty. |
| `WITHDRAWAL_ROUTE_PREFIX` | URL prefix for the form routes. Change it if `elallasi-nyilatkozat` is already taken in the host app. |

Also confirm the host app has working `MAIL_*` settings (Mailtrap/SMTP/log driver) or the emails will not be delivered.

## Routes exposed (registered automatically, `web` middleware, under the prefix above)

- `withdrawal.form` — GET, the declaration form.
- `withdrawal.submit` — POST, submit the declaration.
- `withdrawal.success` — GET, thank-you page.

No route wiring is required in the host app. To link to the form: `route('withdrawal.form')`.

## Localization

- Supported locales: `hu` (default), `en`, `es`, `de`. The UI renders in the host app's active locale.
- **Legal invariant — do NOT translate:** the statutory declaration template text (keys `template_heading`, `template_note`, `statement`) is kept in **Hungarian in every locale** because it is the legally binding wording. Only the surrounding UI is localized. Do not "fix" these to English/other languages.

## Optional: Filament v5 admin (read-only)

Only if `filament/filament` is installed. Register the plugin in the panel provider:

```php
use Cegem360\Withdrawal\Filament\WithdrawalPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(WithdrawalPlugin::make());
}
```

The Filament layer loads only when the host app explicitly registers the plugin; the core works without Filament.

## Extending

On successful submission the package dispatches `Cegem360\Withdrawal\Events\WithdrawalDeclarationSubmitted` carrying the created model (`$event->declaration`). Subscribe a listener in the host app for CRM sync, extra notifications, etc. Do not modify the package to add host-specific behavior — use the event.

## Verify the installation works

1. `php artisan route:list --path=elallasi-nyilatkozat` → the three `withdrawal.*` routes appear.
2. Visit `route('withdrawal.form')` in a browser → the form renders with the seller data.
3. Submit a valid declaration → redirects to the success page.
4. Check the DB: `withdrawal_declarations` has 1 new row.
5. Check the mailer (Mailtrap/`log` driver) → the consumer confirmation and the merchant notification were sent.

## Do / Don't for the agent

- ✅ Use `composer require cegem360/laravel-withdrawal` (Packagist). No VCS `repositories` entry.
- ✅ Publish config + migrate; set the five `.env` keys; ensure `MAIL_*` is configured.
- ❌ Do not add a `repositories` entry pointing to any GitHub fork (e.g. old `MadBox-99/*` or `*-elallas` names). The canonical source is `Cegem-360/laravel-withdrawal`, resolved via Packagist.
- ❌ Do not rename the namespace, translate the statutory Hungarian text, or hand-edit the package's vendor files. Extend via the event and config only.
- ❌ Do not register the service provider manually — package discovery handles it.
