# Informe: instalación y despliegue — Kanban SENA

Documento de referencia para instalar la aplicación en **desarrollo**, **staging** y **producción**, incluyendo dependencias, variables de entorno, activos frontend, tiempo real (Reverb), base de datos y buenas prácticas operativas.

---

## 1. Resumen del stack

| Componente | Versión / notas |
|------------|------------------|
| PHP | **^8.2** (obligatorio) |
| Framework | **Laravel 12** |
| Base de datos | SQLite (por defecto en `.env.example`) o MySQL/MariaDB/PostgreSQL en producción |
| Frontend | **Vite 7**, **Tailwind CSS 3**, **Alpine.js**, **SweetAlert2**, **Laravel Echo** + **Pusher JS** (cliente Reverb) |
| Tiempo real | **Laravel Reverb** (WebSockets); opcional si `BROADCAST_CONNECTION=null` |
| Autenticación | **Laravel Breeze** (Blade) |

---

## 2. Requisitos previos

### 2.1 Software

- **PHP 8.2 o superior** con extensiones habituales de Laravel: `ctype`, `curl`, `dom`, `fileinfo`, `json`, `mbstring`, `openssl`, `pcre`, `pdo`, `tokenizer`, `xml` (y el driver PDO de su motor SQL si no usa SQLite).
- **Composer 2.x**.
- **Node.js 20+** y **npm** (para compilar assets con Vite).
- En producción con tiempo real: proceso **Reverb** accesible (puerto/host definidos en `.env`).

### 2.2 Servidor web (producción)

- Raíz del sitio debe apuntar al directorio **`public/`** (no al raíz del repositorio).
- HTTPS recomendado; configurar `APP_URL` con el esquema correcto (`https://`).

### 2.3 Permisos (Linux/macOS)

El usuario del servidor web debe poder escribir en:

- `storage/` (logs, caché, sesiones si usa `file` o `database` con almacenamiento local).
- `bootstrap/cache/`.

Tras clonar:

```bash
php artisan storage:link
```

(Crea el enlace simbólico `public/storage` → `storage/app/public` para archivos públicos, p. ej. avatares.)

---

## 3. Instalación desde cero (orden recomendado)

### 3.1 Código y dependencias PHP

```bash
cd kanban-sena
composer install --no-dev --optimize-autoloader   # producción
# o, con herramientas de desarrollo:
composer install
```

En **producción** suele usarse `--no-dev`; asegúrese de que el entorno tenga las extensiones necesarias antes de desplegar.

### 3.2 Entorno (`.env`)

1. Copie el ejemplo:  
   - Linux/macOS: `cp .env.example .env`  
   - Windows (PowerShell): `Copy-Item .env.example .env`
2. Genere la clave de aplicación:  
   `php artisan key:generate`  
   (En producción puede usar `php artisan key:generate --show` y pegar el valor en el gestor de secretos.)

**No suba `.env` al control de versiones** (está en `.gitignore`).

### 3.3 Base de datos

**SQLite (desarrollo rápido)**

- En `.env`: `DB_CONNECTION=sqlite` y `DB_DATABASE=database/database.sqlite`.
- Cree el archivo si no existe:  
  `New-Item database\database.sqlite -ItemType File` (PowerShell) o `touch database/database.sqlite`.
- Ejecute migraciones:  
  `php artisan migrate --force`  
  (`--force` evita el aviso cuando `APP_ENV=production`.)

**MySQL / MariaDB / PostgreSQL (recomendado en producción)**

- Ajuste `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
- Cree la base de datos vacía con el usuario mínimo necesario (solo permisos sobre esa BD).
- `php artisan migrate --force`

**Sembrado (datos demo)**

- Solo en **desarrollo** o entornos de prueba:  
  `php artisan db:seed --force`  
- El seeder inserta usuarios y datos de ejemplo con contraseña documentada en `DatabaseSeeder.php` (**no use esas credenciales en producción**).
- Para reiniciar todo y volver a sembrar:  
  `php artisan migrate:fresh --seed --force`  
  (**destruye todos los datos** de las tablas migradas.)

### 3.4 Frontend (Vite)

Las vistas principales usan **`@vite`**. Sin compilación, faltará `public/build/manifest.json` y la interfaz fallará o quedará sin estilos/scripts.

```bash
npm ci          # o npm install
npm run build   # genera public/build/
```

En **desarrollo** puede usar en paralelo:

```bash
npm run dev
```

y dejar `public/hot` para HMR (según configuración de Vite).

**Producción:** siempre ejecute **`npm run build`** en el pipeline de despliegue o en el servidor de build; despliegue la carpeta **`public/build`** (y el `manifest.json`) junto con el código.

### 3.5 Caché y configuración (producción)

Tras configurar `.env` en el servidor:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Para depurar problemas de configuración:

```bash
php artisan config:clear
```

### 3.6 Script Composer `setup` (referencia)

El proyecto incluye en `composer.json` el script **`setup`**, que encadena (en máquinas con Node y Composer):

- `composer install`
- Copia `.env` si no existe
- `php artisan key:generate`
- `php artisan migrate --force`
- `npm install`
- `npm run build`

Puede usarlo como checklist automatizado en entornos nuevos:  
`composer run setup`

---

## 4. Variables de entorno relevantes

### 4.1 Aplicación

| Variable | Descripción |
|----------|-------------|
| `APP_NAME` | Nombre mostrado |
| `APP_ENV` | `local`, `staging`, `production` |
| `APP_KEY` | Base64; obligatorio; generar con `key:generate` |
| `APP_DEBUG` | **`false` en producción** |
| `APP_URL` | URL pública exacta (incluye `https://` en producción) |

### 4.2 Base de datos

Ver sección 3.3. Coherencia entre `DB_*` y el motor instalado en el servidor.

### 4.3 Sesiones y colas

En `.env.example` se proponen valores simples para local:

- `SESSION_DRIVER=file` — válido en un solo servidor; en **varios nodos** use `database` o `redis` y la infraestructura correspondiente.
- `QUEUE_CONNECTION=sync` — adecuado para pruebas; en producción con trabajos en segundo plano use `database` o `redis` y un **worker** (`php artisan queue:work`) gestionado por Supervisor/systemd.

El script **`composer run dev`** levanta `queue:listen` junto al servidor y Vite; en producción replique ese patrón con un supervisor de procesos.

### 4.4 Correo

`MAIL_MAILER=log` es solo para desarrollo. En producción configure SMTP u otro transporte (`MAIL_*`) para recuperación de contraseña, verificación de correo, etc.

### 4.5 Broadcasting y Reverb (chat en tiempo real)

| Variable | Uso |
|----------|-----|
| `BROADCAST_CONNECTION` | `reverb` para activar emisión; `null` desactiva WebSockets (el chat puede seguir guardando mensajes por HTTP). |
| `REVERB_APP_ID`, `REVERB_APP_KEY`, `REVERB_APP_SECRET` | Credenciales de la app Reverb |
| `REVERB_HOST`, `REVERB_PORT`, `REVERB_SCHEME` | Cómo el **servidor Laravel** y el **cliente** alcanzan Reverb |
| `VITE_REVERB_*` | Mismos valores lógicos para que **Vite** inyecte en el bundle de Echo en el navegador |

Si `VITE_REVERB_APP_KEY` está vacío, el frontend **no inicializa Echo**; no falla la app, pero no habrá actualizaciones en vivo.

**Despliegue Reverb:** ejecute `php artisan reverb:start` (o el binario/servicio recomendado por Laravel) detrás de proxy TLS si expone a Internet. Ajuste firewall y `REVERB_ALLOWED_ORIGINS` si aplica (consulte la documentación de Laravel Reverb).

---

## 5. Despliegue en producción: checklist

1. [ ] Código desplegado (sin `.env` del repositorio).
2. [ ] `.env` creado en el servidor con valores definitivos.
3. [ ] `APP_DEBUG=false`, `APP_ENV=production`, `APP_URL` correcto.
4. [ ] `php artisan key:generate` (una vez) o secretos inyectados por la plataforma.
5. [ ] Migraciones: `php artisan migrate --force`.
6. [ ] **No** ejecutar `db:seed` con usuarios demo en producción, o sustituir el seeder por datos controlados.
7. [ ] `npm ci && npm run build` en pipeline o artefacto precompilado.
8. [ ] `php artisan storage:link`.
9. [ ] Permisos en `storage` y `bootstrap/cache`.
10. [ ] `php artisan config:cache`, `route:cache`, `view:cache`.
11. [ ] Servidor web → `public/` como document root.
12. [ ] HTTPS y cabeceras de seguridad según política institucional.
13. [ ] Colas y Reverb como servicios supervisados si se usan.
14. [ ] Copias de seguridad de la base de datos y de `storage/app`.

---

## 6. Pruebas automatizadas (CI)

```bash
npm run build
php artisan test
```

`npm run build` evita errores al resolver `@vite` en tests que rendericen vistas completas. En `phpunit.xml` puede definirse `APP_KEY` para entornos sin `.env`.

---

## 7. Credenciales de demostración (solo desarrollo)

Tras `php artisan db:seed`, consulte **`database/seeders/DatabaseSeeder.php`**: allí están correos, roles y la contraseña común de prueba documentada en el propio seeder.

**Debe cambiar o eliminar** estos usuarios antes de exponer la aplicación a usuarios reales.

---

## 8. Problemas frecuentes

| Síntoma | Posible causa | Acción |
|---------|----------------|--------|
| Página en blanco / sin estilos | Falta `public/build` | `npm run build` o `npm run dev` |
| `No application encryption key` | Sin `APP_KEY` | `php artisan key:generate` |
| `SQLSTATE` al migrar | BD inaccesible o `.env` incorrecto | Verificar credenciales y que exista la BD |
| `migrate` cancelado en producción | Laravel pide confirmación | `php artisan migrate --force` |
| Chat sin tiempo real | `BROADCAST_CONNECTION=null` o Reverb caído | Activar Reverb y variables `VITE_REVERB_*` |
| Errores 500 sin detalle | `APP_DEBUG=false` | Revisar `storage/logs/laravel.log` |

---

## 9. Documentación adicional

- README del repositorio: `README.md` (resumen y comandos rápidos).
- Laravel: [https://laravel.com/docs](https://laravel.com/docs)
- Reverb: [https://laravel.com/docs/reverb](https://laravel.com/docs/reverb)
- Vite: [https://vitejs.dev](https://vitejs.dev)

---

## 10. Mantenimiento del informe

Al cambiar dependencias mayores (PHP, Node, Laravel), rutas de build o flujo de despliegue institucional, actualice este archivo y el `README.md` para que sigan alineados con la realidad del proyecto.

---

*Documento generado para el proyecto **Kanban SENA** (Laravel).*
