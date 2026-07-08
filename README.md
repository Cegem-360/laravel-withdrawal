# Laravel Elállás

Online elállási/felmondási nyilatkozat (45/2014. (II. 26.) Korm. rendelet) Laravel csomag: űrlap a fogyasztóknak, a nyilatkozat tárolása, és tartós adathordozós e-mail visszaigazolás mind a fogyasztónak, mind a kereskedőnek.

## Telepítés

```bash
composer require cegem360/laravel-withdrawal
```

A csomag migrációja automatikusan betöltődik, tehát `php artisan migrate` futtatásával a `withdrawal_declarations` tábla publikálás nélkül is létrejön. Publikáld a konfigurációt:

```bash
php artisan vendor:publish --tag=withdrawal-config
php artisan migrate
```

A migráció publikálása (`php artisan vendor:publish --tag=withdrawal-migrations`) OPCIONÁLIS, csak akkor szükséges, ha testre szeretnéd szabni a migrációt (pl. további oszlopok hozzáadása).

Opcionálisan publikálhatók a nézetek és a nyelvi fájlok is:

```bash
php artisan vendor:publish --tag=withdrawal-views
php artisan vendor:publish --tag=withdrawal-lang
```

## Konfiguráció (.env)

| Kulcs | Leírás |
| --- | --- |
| `WITHDRAWAL_SELLER_NAME` | A kereskedő neve (megjelenik a visszaigazoló e-mailben). |
| `WITHDRAWAL_SELLER_ADDRESS` | A kereskedő székhelye/címe. |
| `WITHDRAWAL_SELLER_EMAIL` | A kereskedő e-mail címe. |
| `WITHDRAWAL_NOTIFY_EMAIL` | Az az e-mail cím, ahova az új beadványokról értesítés érkezik. |
| `WITHDRAWAL_ROUTE_PREFIX` | Az űrlap route-jainak URL-előtagja (alapértelmezett: `elallasi-nyilatkozat`). |

## Route-ok

A csomag a következő elnevezett route-okat regisztrálja (a `config('withdrawal.route.prefix')` előtag alatt, `web` middleware csoporttal):

- `withdrawal.form` — GET, az elállási/felmondási nyilatkozat űrlapja.
- `withdrawal.submit` — POST, a nyilatkozat beküldése.
- `withdrawal.success` — GET, köszönő oldal a sikeres beküldés után.

Az URL-előtag az `WITHDRAWAL_ROUTE_PREFIX` környezeti változóval konfigurálható (alapértelmezett: `elallasi-nyilatkozat`). Ha a fogadó alkalmazásban már foglalt ez az útvonal-előtag, állítsd át más értékre az ütközés elkerülése érdekében.

## Esemény

Sikeres beküldéskor a csomag kibocsátja a `Cegem360\Withdrawal\Events\WithdrawalDeclarationSubmitted` eseményt, amely a létrehozott `WithdrawalDeclaration` modellt hordozza (`$event->declaration`). Ezt saját listenerekben feliratkozva bővítheted (pl. CRM-szinkron, egyéb értesítések).

A csomag emellett automatikusan elküld két e-mailt:

- **Fogyasztói visszaigazolás** — tartós adathordozós visszaigazolás a nyilatkozatot beküldő fogyasztónak.
- **Kereskedői értesítés** — az `WITHDRAWAL_NOTIFY_EMAIL` címre.

## Opcionális Filament admin felület

A csomag tartalmaz egy opcionális, csak olvasható Filament v5 admin nézetet a beérkezett nyilatkozatokhoz. Ehhez telepítened kell a `filament/filament` csomagot a saját alkalmazásodban, majd regisztrálnod kell a plugint a panel providerben:

```php
use Cegem360\Withdrawal\Filament\WithdrawalPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(WithdrawalPlugin::make());
}
```

A Filament réteg (`WithdrawalPlugin` és `WithdrawalDeclarationResource`) csak akkor töltődik be, ha a fogadó alkalmazás explicit regisztrálja a plugint — a csomag magja Filament nélkül is teljes értékűen működik.

## Jogi megjegyzés

Ez a csomag technikai eszközt biztosít a 45/2014. (II. 26.) Korm. rendelet szerinti elállási/felmondási nyilatkozat fogadásához és visszaigazolásához. Nem minősül jogi tanácsadásnak; a konkrét szerződési feltételek és tájékoztatási kötelezettségek betartásáért a csomagot használó kereskedő felel.

## Licenc

MIT.
