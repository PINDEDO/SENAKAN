# Matriz de trazabilidad SRS v1.0 ↔ código (SenaKan)

**Fuente de verdad documental:** este archivo.  
**Código de aplicación:** `kanban-sena/`.  
**Revisión:** 2026-05-05 (análisis estático del repositorio; sin ejecución de `artisan` por ausencia de `kanban-sena/vendor/` en el entorno de análisis).

> **Texto del SRS**  
> El documento `docs/SENA – Sistema de Gestión Kanban.txt` (SRS v1.0) **no está versionado aún** en el repositorio. Incorpórelo a `docs/` y vincule su hash o versión en el commit de trazabilidad. Hasta entonces, los títulos de requisitos se alinean con la nomenclatura IEEE habitual del proyecto y con las matrices auxiliares existentes.

> **Validación automática (pendiente en máquina de desarrollo)**  
> Tras `composer install` en `kanban-sena/`:
> ```bash
> php artisan route:list
> php artisan migrate:status
> ```
> Compare rutas y migraciones **Ran** con la columna *Evidencia en código* de esta matriz.

---

## ⚠️ DECISIONES ARQUITECTÓNICAS (SRS vs implementación)

| Tema | SRS / expectativa | Implementación actual | Recomendación |
|------|-------------------|------------------------|---------------|
| Columnas Kanban | Columnas configurables / flujo extendido | Tres estados fijos en modelo y vista: `pending`, `progress`, `done`. Migración `database/migrations/2026_04_24_120000_drop_unused_columns_table.php` eliminó la tabla `columns`. | **Opción A:** Actualizar SRS al flujo de tres columnas. **Opción B:** Reintroducir modelo `columns`, CRUD y UI; alinear `Task` con columnas dinámicas. |
| Autenticación | Posible JWT / API (según visiones antiguas) | Sesiones web Laravel Breeze (`routes/auth.php`). | Mantener SRS explícito en “sesión servidor”; eliminar referencias a JWT como obligatorio. |
| Rol “aprendiz” | Frecuente en normativa SENA | `users.role` ENUM y seeders: `admin`, `coordinador`, `instructor`, `funcionario` (no `aprendiz`). | Ampliar ENUM + políticas o renombrar `funcionario` en SRS si equivale al rol previsto. |

---

## Matriz de trazabilidad

| ID | Requisito | Estado | Evidencia en código | Brecha vs SRS | Acción prioritaria |
|----|-----------|--------|---------------------|---------------|-------------------|
| RF-001 | Autenticación de usuarios | ✅ Implementado | `kanban-sena/routes/auth.php`; `kanban-sena/app/Http/Controllers/Auth/` (`AuthenticatedSessionController`, `RegisteredUserController`, reset/contraseña); `kanban-sena/app/Http/Requests/Auth/LoginRequest.php`; `kanban-sena/bootstrap/app.php` (middleware); vistas `kanban-sena/resources/views/auth/`; tests `kanban-sena/tests/Feature/Auth/` | Si el SRS exige JWT u OAuth exclusivos: no aplicado (sesiones). | Alinear redacción del SRS con auth por sesión Breeze o documentar decisión explícita. |
| RF-002 | Gestión de usuarios y roles | ⚠️ Parcial | `kanban-sena/routes/web.php` (prefijo `/admin/users`, POST/PUT/DELETE); `kanban-sena/app/Http/Controllers/UserController.php`; `kanban-sena/app/Policies/UserPolicy.php`; `kanban-sena/app/Http/Middleware/CheckRole.php`; `kanban-sena/database/migrations/2026_03_07_003654_update_roles_in_users_table.php`; modelo `kanban-sena/app/Models/User.php`; tests `kanban-sena/tests/Feature/ProjectAuthorizationFeatureTest.php`, `DashboardScopeFeatureTest.php` | Sin paquete de permisos granular (p.ej. Spatie); rol `aprendiz` ausente; registro público fija `funcionario` en `RegisteredUserController`. | Definir matriz de roles en SRS = ENUM real; valorar `aprendiz` y políticas por centro (`center_id`). |
| RF-003 | Gestión de proyectos | ⚠️ Parcial | `kanban-sena/app/Http/Controllers/ProjectController.php`; `kanban-sena/app/Models/Project.php`; `kanban-sena/database/migrations/2026_03_05_015403_create_projects_table.php`; vistas `kanban-sena/resources/views/` (proyectos); `kanban-sena/app/Policies/ProjectPolicy.php` | Sin entidad `fichas` ni FK formal; `projects.code` actúa como identificador de ficha. Membresías tipo pivot no modeladas explícitamente. | Crear modelo/tablas de ficha o documentar `code` como vínculo institucional suficiente para MVP. |
| RF-004 | Tableros Kanban / columnas | ⚠️ Parcial | `kanban-sena/app/Http/Controllers/BoardController.php`; vista `kanban-sena/resources/views/board.blade.php`; rutas GET `/board` en `kanban-sena/routes/web.php` | Columnas no configurables; tabla `columns` eliminada por `2026_04_24_120000_drop_unused_columns_table.php`. Flujo de tres estados alineado con `tasks.status`. | Ver tabla “Decisiones arquitectónicas” arriba: actualizar SRS o restaurar columnas dinámicas. |
| RF-005 | Gestión de tareas / tickets | ⚠️ Parcial | `kanban-sena/app/Http/Controllers/TaskController.php`; `kanban-sena/app/Models/Task.php`; migración `kanban-sena/database/migrations/2026_03_05_015403_create_tasks_table.php`; `kanban-sena/app/Policies/TaskPolicy.php`; historial `kanban-sena/app/Models/ActivityLog.php` + migración `create_activity_logs_table`; `kanban-sena/database/migrations/2026_03_06_233950_create_activity_logs_table.php` | Sin modelos/tablas de comentarios, adjuntos ni etiquetas en esquema actual. | Añadir migraciones y capa UI si el SRS los exige como obligatorios. |
| RF-006 | Drag & drop entre columnas | ✅ Implementado | `kanban-sena/resources/views/board.blade.php` (SortableJS por CDN); `TaskController::updateOrder` en `kanban-sena/app/Http/Controllers/TaskController.php`; ruta POST `/tasks/update-order` en `kanban-sena/routes/web.php` | Acoplado a tres estados fijos; no a columnas DB. | Si SRS exige columnas arbitrarias, refactorizar endpoint y modelo (orden por `column_id`). |
| RF-007 | Comentarios en tareas | ❌ Ausente | Sin `Comment` model ni rutas dedicadas en `kanban-sena/routes/web.php`; sin migración `comments` en `kanban-sena/database/migrations/` | Requisito sin artefactos implementados localizables. | Crear migración `comments`, modelo, política y UI (modal o vista detalle). |
| RF-008 | Notificaciones internas | ⚠️ Parcial | Tiempo real opcional: `kanban-sena/resources/js/echo.js`, `kanban-sena/resources/js/bootstrap.js`; `kanban-sena/routes/channels.php`; chat `kanban-sena/app/Http/Controllers/ChatController.php`; migración `kanban-sena/database/migrations/2026_04_08_003809_create_messages_table.php`; eventos en `kanban-sena/app/Events/` si existen | No hay canal Laravel Notifications (`database`/mail) para eventos de tarea según escaneo de dominio estándar. | Implementar notificaciones de asignación/cambio de estado o acotar SRS al chat actual. |
| RF-009 | Filtros y búsqueda de tareas | ⚠️ Parcial | `kanban-sena/app/Http/Controllers/TaskListController.php` (query `status`, `priority`, `project_id`); vista lista `kanban-sena/resources/views/tasks/list.blade.php`; actividad filtrable `kanban-sena/app/Http/Controllers/ActivityLogController.php` | Sin búsqueda full-text ni filtros por etiqueta; sin endpoint API AJAX dedicado en `routes/web.php`. | Ampliar filtros y/o documentar MVP como listado paginado server-side. |
| RF-010 | Reportes y métricas | ✅ Implementado | `kanban-sena/app/Http/Controllers/ReportController.php`; `kanban-sena/app/Http/Controllers/AdminController.php` (métricas); export PDF `barryvdh/laravel-dompdf`; Excel `maatwebsite/excel`; vistas `kanban-sena/resources/views/reports/`; tests `kanban-sena/tests/Feature/ReportAccessFeatureTest.php` | Gráficas tipo dashboard avanzado (p.ej. Chart.js) no verificadas como obligatorias en código. | Integrar gráficas si el SRS las lista como RNF explícito o cerrar alcance en informe PDF/Excel. |
| RF-011 | Asociación con fichas SENA | ⚠️ Parcial | Campo `projects.code` en migración de proyectos y SQL de referencia `kanban-sena/database/sql/mysql/02_schema_tablas.sql`; datos demo `kanban-sena/database/seeders/DatabaseSeeder.php` | Sin tabla `fichas` ni informes institucionales multi-ficha según modelo relacional completo. | Normalizar entidad ficha o declarar `code` como trazabilidad suficiente en SRS. |
| RNF-001 | Disponibilidad / operación | ⚠️ Parcial | `kanban-sena/config/app.php`; despliegue documentado `kanban-sena/docs/INSTALACION_Y_DESPLIEGUE.md`; health Laravel `/up` en `kanban-sena/bootstrap/app.php` | SLA institucional y monitoreo no codificados en repo. | Documentar SLA y procedimiento de backup en `docs/` operativo. |
| RNF-002 | Seguridad | ⚠️ Parcial | CSRF en layouts (`kanban-sena/resources/views/layouts/app.blade.php`); hashing `User` casts; validación `TaskController`; políticas `kanban-sena/app/Policies/`; middleware `role` en `kanban-sena/bootstrap/app.php`; verificación email con throttle en `routes/auth.php` | Rate limiting global en login no auditado aquí; pentest ausente. | Revisión OWASP y rate limits en producción. |
| RNF-003 | Rendimiento | ⚠️ Parcial | Eloquent con `with()` en puntos del tablero (`BoardController`); paginación en listados (`TaskListController`); índices en migraciones de `tasks`/`projects` | Riesgo N+1 no perfilado; caché Redis no requerida en código base. | Profiling en consultas críticas; `with()` sistemático en reportes pesados. |
| RNF-004 | Usabilidad / identidad visual | ⚠️ Parcial | `kanban-sena/tailwind.config.js` (tokens `sena.*`); vistas Blade y `kanban-sena/resources/css/app.css` | Tipografía actual orientada a Inter vs Work Sans institucional; ajustes pendientes según guía SENA. | Aplicar guía `Identidad visual sena prompt tecnico.txt` y tokens acordados. |
| RNF-005 | Mantenibilidad | ⚠️ Parcial | `kanban-sena/tests/Feature/` (suite auth, tareas, proyectos, informes); `composer.json` (Pint, PHPUnit); `kanban-sena/phpunit.xml` | Cobertura incompleta vs todos los RF; capa Application/Services opcional no adoptada. | Ampliar tests por RF críticos; convenciones PSR-12 con Pint en CI. |
| RNF-006 | Escalabilidad / multi-contexto | ⚠️ Parcial | Campos `users.center_id` en migraciones de usuarios; colas/jobs tablas estándar Laravel | `center_id` sin uso dominante en `Project`/`Task`; monolito único. | Modelar multi-sede si el SRS lo exige o eliminar campo residual del SRS. |

---

## Rutas HTTP relevantes (referencia estática)

Derivadas de `kanban-sena/routes/web.php` y `kanban-sena/routes/auth.php` (no ejecutado `route:list`):

| Área | Métodos | URI principal |
|------|---------|----------------|
| Auth | GET/POST | `/login`, `/register`, `/logout`, recuperación de contraseña |
| App | GET | `/dashboard`, `/board`, `/projects`, `/calendar`, `/tasks-list`, `/chat`, `/chat/{user}` |
| App | POST/PUT | `/projects`, `/projects/{project}`, `/tasks`, `/tasks/{task}`, `/tasks/update-order`, `/chat` |
| Admin | GET | `/admin/metrics`, `/admin/users`, `/admin/reports`, `/admin/reports/export/pdf`, `/admin/reports/export/excel`, `/admin/activity` |

---

## Migraciones presentes en código (`database/migrations/`)

Incluye entre otras: `create_users_table`, `add_fields_to_users_table`, `update_roles_in_users_table`, `create_projects_table`, `create_tasks_table`, `create_columns_table` (posteriormente revertida por `drop_unused_columns_table`), `create_activity_logs_table`, `create_messages_table`, tablas Laravel cache/jobs.

---

*Fin del documento — mantener actualizado ante cada cambio de alcance SRS o de código.*
