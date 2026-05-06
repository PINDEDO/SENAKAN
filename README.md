# SenaKan

Sistema web de **gestión de tareas tipo Kanban** para el entorno del **SENA** (Servicio Nacional de Aprendizaje, Colombia). Permite organizar el trabajo formativo mediante proyectos asociados a **fichas**, tableros visuales por estados, asignación por roles y seguimiento de actividades.

La aplicación ejecutable reside en el directorio **`kanban-sena/`** (monolito Laravel). Este documento describe únicamente ese stack y ese código.

---

## 🏗️ Stack tecnológico real

| Capa | Tecnología |
|------|------------|
| **Backend** | PHP **8.2+**, **Laravel 12**, Laravel Breeze (autenticación por sesión), Eloquent ORM, políticas de autorización, Laravel Reverb (WebSockets opcional). |
| **Frontend** | **Blade**, **Vite 7**, **Tailwind CSS 3**, **Alpine.js**, SweetAlert2, Laravel Echo + protocolo compatible Pusher (cliente para Reverb). |
| **Tablero Kanban** | **SortableJS** cargado por CDN en la vista del tablero (arrastrar y soltar entre columnas de estado). |
| **Base de datos** | **MySQL/MariaDB** o **PostgreSQL** según `.env`; **SQLite** habitual en desarrollo local. Esquema SQL de referencia: `kanban-sena/database/sql/mysql/`. |
| **Herramientas** | Composer, npm, PHPUnit, Laravel Pint (calidad PHP). |

Archivos de versión y dependencias: [`kanban-sena/composer.json`](kanban-sena/composer.json), [`kanban-sena/package.json`](kanban-sena/package.json).

---

## 📁 Estructura del repositorio

```text
.
├── README.md                    ← Este archivo (visión y uso del repo)
├── diagramas_clases_kanban.html ← Diagramas de referencia (RF conceptuales)
├── kanban-sena/                 ← ⭐ APLICACIÓN PRINCIPAL (Laravel)
│   ├── app/                     ← Controladores, modelos, políticas, eventos
│   ├── bootstrap/
│   ├── config/
│   ├── database/                ← Migraciones, seeders, SQL MySQL de referencia
│   ├── docs/                    ← Guías (p. ej. instalación y despliegue)
│   ├── public/                  ← Punto de entrada web (index.php)
│   ├── resources/
│   │   ├── css/
│   │   ├── js/                  ← Vite: app.js, guest.js, echo, bootstrap
│   │   └── views/               ← Blade: tablero, proyectos, informes, chat…
│   ├── routes/
│   │   ├── web.php              ← Rutas HTTP principales
│   │   └── auth.php
│   ├── tests/                   ← PHPUnit (Feature / Unit)
│   ├── composer.json
│   ├── package.json
│   ├── vite.config.js
│   └── tailwind.config.js
└── (otros archivos en la raíz si los hay)
```

Rutas y UI relevantes definidas en [`kanban-sena/routes/web.php`](kanban-sena/routes/web.php). Estilos y tokens de color en [`kanban-sena/tailwind.config.js`](kanban-sena/tailwind.config.js).

---

## 🚀 Instalación y ejecución local

### Requisitos

- PHP **8.2+** con extensiones habituales de Laravel (`pdo`, `openssl`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, etc.).
- [Composer](https://getcomposer.org/)
- **Node.js 20+** y npm
- Motor SQL (SQLite, MySQL/MariaDB o PostgreSQL) según prefiera.

### XAMPP / entorno Windows

1. Active **Apache** solo si servirá la carpeta `public/` de Laravel; muchos equipos usan `php artisan serve` y no requieren virtual host.
2. Asegúrese de que la línea de comandos use el mismo PHP que Composer (`php -v`).

### Pasos

```bash
cd kanban-sena
composer install
copy .env.example .env    # Windows (PowerShell/cmd)
php artisan key:generate
```

Configure la base de datos en `.env` (`DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`). Para SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Cree el archivo si no existe y ejecute:

```bash
php artisan migrate
php artisan db:seed
```

Instale dependencias front y compile (o use modo desarrollo):

```bash
npm install
npm run build
```

Arranque típico en desarrollo (consulte también [`kanban-sena/README.md`](kanban-sena/README.md) y [`kanban-sena/docs/INSTALACION_Y_DESPLIEGUE.md`](kanban-sena/docs/INSTALACION_Y_DESPLIEGUE.md)):

```bash
php artisan serve
npm run dev
# Opcional — tiempo real (chat): en otra terminal
php artisan reverb:start
```

Variables útiles: `APP_URL`, `APP_KEY`, `DB_*`; para WebSockets, `BROADCAST_CONNECTION=reverb` y las variables `REVERB_*` / `VITE_REVERB_*` descritas en la documentación interna del proyecto.

---

## ✅ Estado de implementación respecto al SRS (RF-001 a RF-011)

Los títulos de cada RF coinciden con la nomenclatura usada en `diagramas_clases_kanban.html`. La columna **Evidencia / extensión** indica archivos reales o dónde implementar lo pendiente.

| RF | Título (SRS / diagrama) | Estado | Evidencia / extensión |
|----|-------------------------|--------|------------------------|
| **RF-001** | Autenticación de usuarios | ✅ Implementado | Sesión Laravel Breeze: [`kanban-sena/routes/auth.php`](kanban-sena/routes/auth.php), [`kanban-sena/app/Http/Controllers/Auth/`](kanban-sena/app/Http/Controllers/Auth/), [`kanban-sena/app/Http/Requests/Auth/LoginRequest.php`](kanban-sena/app/Http/Requests/Auth/LoginRequest.php) |
| **RF-002** | Gestión de usuarios y roles | ⚠️ Parcial | Roles en columna `users.role` + políticas: [`kanban-sena/app/Http/Controllers/UserController.php`](kanban-sena/app/Http/Controllers/UserController.php), [`kanban-sena/app/Policies/UserPolicy.php`](kanban-sena/app/Policies/UserPolicy.php). No hay modelo `Role`/permisos granulares tipo paquete externo. |
| **RF-003** | Gestión de proyectos | ⚠️ Parcial | [`kanban-sena/app/Http/Controllers/ProjectController.php`](kanban-sena/app/Http/Controllers/ProjectController.php), [`kanban-sena/app/Models/Project.php`](kanban-sena/app/Models/Project.php). Membresías avanzadas / entidad **Ficha** separada: pendiente de modelo dedicado. |
| **RF-004** | Gestión de tableros Kanban (columnas configurables) | ⚠️ Parcial | Vista tablero: [`kanban-sena/resources/views/board.blade.php`](kanban-sena/resources/views/board.blade.php), [`kanban-sena/app/Http/Controllers/BoardController.php`](kanban-sena/app/Http/Controllers/BoardController.php). Estados fijos (`pending`, `progress`, `done`); columna dinámica eliminada en migración `drop_unused_columns`. Para columnas personalizables: reintroducir dominio `columns` + UI de configuración. |
| **RF-005** | Gestión de tareas / tickets | ⚠️ Parcial | [`kanban-sena/app/Http/Controllers/TaskController.php`](kanban-sena/app/Http/Controllers/TaskController.php), [`kanban-sena/app/Models/Task.php`](kanban-sena/app/Models/Task.php). Historial vía [`kanban-sena/app/Models/ActivityLog.php`](kanban-sena/app/Models/ActivityLog.php). **Etiquetas** y adjuntos: no modelados en `tasks`. |
| **RF-006** | Drag & drop de tareas | ✅ Implementado | SortableJS + `POST` orden: vista [`board.blade.php`](kanban-sena/resources/views/board.blade.php), método [`TaskController::updateOrder`](kanban-sena/app/Http/Controllers/TaskController.php) y ruta en [`web.php`](kanban-sena/routes/web.php). |
| **RF-007** | Comentarios en tareas | ❌ Pendiente | Crear `Comment` + migración + [`CommentController`](kanban-sena/app/Http/Controllers/) + vistas parciales en `resources/views/tasks/` o modal en tablero. |
| **RF-008** | Notificaciones internas | ⚠️ Parcial | Chat en tiempo real opcional (Reverb): [`kanban-sena/app/Http/Controllers/ChatController.php`](kanban-sena/app/Http/Controllers/ChatController.php). Notificaciones Laravel **database** por asignación/cambio de tarea: pendiente (`notifications` + eventos). |
| **RF-009** | Filtros y búsqueda | ⚠️ Parcial | Filtros básicos en listado: [`kanban-sena/app/Http/Controllers/TaskListController.php`](kanban-sena/app/Http/Controllers/TaskListController.php), vista [`resources/views/tasks/list.blade.php`](kanban-sena/resources/views/tasks/list.blade.php). Búsqueda libre/AJAX avanzada: pendiente (nuevo controlador o ampliar `TaskListController`). |
| **RF-010** | Reportes y métricas | ⚠️ Parcial | [`kanban-sena/app/Http/Controllers/ReportController.php`](kanban-sena/app/Http/Controllers/ReportController.php), [`kanban-sena/app/Http/Controllers/AdminController.php`](kanban-sena/app/Http/Controllers/AdminController.php). Gráficas tipo SRS / filtros por ficha avanzados: evaluar capa de presentación en `resources/views/reports/`. |
| **RF-011** | Asociación con fichas SENA | ⚠️ Parcial | Campo **`projects.code`** como número de ficha en esquema SQL y formularios. Entidad **Ficha** y reportes por ficha institucional completos: pendiente (`app/Models/Ficha.php`, controladores y rutas nuevas). |

---

## 🎨 Identidad visual SENA

- La **Guía de identidad visual** y el prompt técnico institucional deben seguirse desde el documento de referencia **`Identidad visual sena prompt tecnico.txt`** (incorpórelo al repositorio o a `kanban-sena/docs/` si aún no está versionado).
- **Paleta:** verde institucional **`#39A900`** y azul **`#00304D`** (ajustar tokens en [`kanban-sena/tailwind.config.js`](kanban-sena/tailwind.config.js) para alinear nombres `sena.*` con la guía).
- **Tipografía:** el lineamiento SENA usa **Work Sans**; el proyecto puede declarar hoy **Inter** como `fontFamily.sans` en Tailwind. Se recomienda sustituir por Work Sans (fuente web autorizada) en `tailwind.config.js` y en las importaciones CSS (`resources/css/app.css`).
- Componentes Blade y clases utilitarias deben mantener coherencia con esos tokens.

---

## 🤝 Contribución

1. **Ramas:** `feature/<descripcion-corta>` o `fix/<issue>` a partir de la rama principal acordada por el equipo.
2. **Commits:** mensajes claros en español o convención Conventional Commits (`feat:`, `fix:`, `docs:`, etc.).
3. **Pull Requests:** descripción del alcance, capturas si hay UI, checklist de pruebas.
4. **Pruebas:** desde `kanban-sena/`:
   ```bash
   npm run build
   php artisan test
   ```
   Asegure que las vistas con `@vite` no fallen en CI compilando assets antes de PHPUnit.

---

## 📄 Licencia y créditos

Proyecto desarrollado como evidencia o producto formativo para el **SENA** — Colombia. Los frameworks y paquetes de terceros conservan sus licencias (p. ej. Laravel MIT). Adapte la licencia del producto final según normativa institucional.

---

<p align="center">
  SenaKan · Gestión de tareas Kanban · SENA Colombia
</p>
