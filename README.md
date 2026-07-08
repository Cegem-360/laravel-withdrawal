# Laravel Elállás

Online elállási/felmondási nyilatkozat (45/2014. (II. 26.) Korm. rendelet) Laravel csomag: űrlap a fogyasztóknak, a nyilatkozat tárolása, és tartós adathordozós e-mail visszaigazolás mind a fogyasztónak, mind a kereskedőnek.

## Telepítés

```bash
composer require cegem360/laravel-elallas
```

Publikáld a konfigurációt és a migrációkat, majd futtasd a migrációt:

```bash
php artisan vendor:publish --tag=elallas-config
php artisan vendor:publish --tag=elallas-migrations
php artisan migrate
```

Opcionálisan publikálhatók a nézetek és a nyelvi fájlok is:

```bash
php artisan vendor:publish --tag=elallas-views
php artisan vendor:publish --tag=elallas-lang
```

## Konfiguráció (.env)

| Kulcs | Leírás |
| --- | --- |
| `ELALLAS_SELLER_NAME` | A kereskedő neve (megjelenik a visszaigazoló e-mailben). |
| `ELALLAS_SELLER_ADDRESS` | A kereskedő székhelye/címe. |
| `ELALLAS_SELLER_EMAIL` | A kereskedő e-mail címe. |
| `ELALLAS_NOTIFY_EMAIL` | Az az e-mail cím, ahova az új beadványokról értesítés érkezik. |
| `ELALLAS_ROUTE_PREFIX` | Az űrlap route-jainak URL-előtagja (alapértelmezett: `elallasi-nyilatkozat`). |

## Route-ok

A csomag a következő elnevezett route-okat regisztrálja (a `config('elallas.route.prefix')` előtag alatt, `web` middleware csoporttal):

- `elallas.form` — GET, az elállási/felmondási nyilatkozat űrlapja.
- `elallas.submit` — POST, a nyilatkozat beküldése.
- `elallas.success` — GET, köszönő oldal a sikeres beküldés után.

## Esemény

Sikeres beküldéskor a csomag kibocsátja a `Cegem360\Elallas\Events\WithdrawalDeclarationSubmitted` eseményt, amely a létrehozott `WithdrawalDeclaration` modellt hordozza (`$event->declaration`). Ezt saját listenerekben feliratkozva bővítheted (pl. CRM-szinkron, egyéb értesítések).

A csomag emellett automatikusan elküld két e-mailt:

- **Fogyasztói visszaigazolás** — tartós adathordozós visszaigazolás a nyilatkozatot beküldő fogyasztónak.
- **Kereskedői értesítés** — az `ELALLAS_NOTIFY_EMAIL` címre.

## Opcionális Filament admin felület

A csomag tartalmaz egy opcionális, csak olvasható Filament v5 admin nézetet a beérkezett nyilatkozatokhoz. Ehhez telepítened kell a `filament/filament` csomagot a saját alkalmazásodban, majd regisztrálnod kell a plugint a panel providerben:

```php
use Cegem360\Elallas\Filament\ElallasPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(ElallasPlugin::make());
}
```

A Filament réteg (`ElallasPlugin` és `WithdrawalDeclarationResource`) csak akkor töltődik be, ha a fogadó alkalmazás explicit regisztrálja a plugint — a csomag magja Filament nélkül is teljes értékűen működik.

## Jogi megjegyzés

Ez a csomag technikai eszközt biztosít a 45/2014. (II. 26.) Korm. rendelet szerinti elállási/felmondási nyilatkozat fogadásához és visszaigazolásához. Nem minősül jogi tanácsadásnak; a konkrét szerződési feltételek és tájékoztatási kötelezettségek betartásáért a csomagot használó kereskedő felel.

## Licenc

MIT.
