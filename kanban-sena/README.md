# Kanban SENA

Aplicación web de gestión de tareas tipo **Kanban** para entornos institucionales (Laravel 12, Blade, Alpine.js, Tailwind CSS, Laravel Reverb para chat en tiempo real).

## Requisitos

- PHP 8.2+
- [Composer](https://getcomposer.org/)
- Node.js 20+ y npm
- Extensiones PHP habituales de Laravel (pdo, openssl, mbstring, tokenizer, xml, ctype, json, etc.)

## Instalación rápida

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure la base de datos en `.env` (`DB_*`), luego:

```bash
php artisan migrate --force
php artisan db:seed   # opcional: usuarios y datos demo
npm install
npm run build
```

En desarrollo, en **tres terminales** (o use `composer run dev` si tiene `concurrently`):

```bash
php artisan serve
npm run dev
php artisan reverb:start
```

Sin `npm run dev` / sin build, las vistas que usan `@vite` necesitan al menos **`npm run build`** para generar `public/build/manifest.json`.

## Variables de entorno destacadas

| Variable | Uso |
|----------|-----|
| `APP_NAME`, `APP_URL`, `APP_KEY` | Aplicación |
| `DB_*` | Base de datos |
| `BROADCAST_CONNECTION` | `reverb` para WebSockets del chat; `null` desactiva emisión |
| `REVERB_APP_ID`, `REVERB_APP_KEY`, `REVERB_APP_SECRET`, `REVERB_HOST`, `REVERB_PORT`, `REVERB_SCHEME` | Servidor Reverb (Laravel) |
| `VITE_REVERB_APP_KEY`, `VITE_REVERB_HOST`, `VITE_REVERB_PORT`, `VITE_REVERB_SCHEME` | Mismo criterio que Reverb, expuesto a Vite para **Echo** en el navegador |

Si no define las variables `VITE_REVERB_*`, el cliente no inicializa Echo y el chat sigue funcionando por HTTP (sin tiempo real).

## Usuarios demo (tras `db:seed`)

Contraseña común documentada en el seeder (por defecto `password`). Revise `database/seeders/DatabaseSeeder.php` para correos y roles (`admin`, `coordinador`, `funcionario`, `instructor`).

## Pruebas

```bash
npm run build
php artisan test
```

`npm run build` evita errores de Vite al renderizar vistas con `@vite` en los tests de integración.

## Scripts Composer útiles

- `composer run dev` — servidor, cola, logs y Vite en paralelo (ver `composer.json`).
- `composer run test` — limpia config y ejecuta PHPUnit.

## Licencia

MIT (framework Laravel y paquetes asociados; adapte la licencia del producto según su institución).
