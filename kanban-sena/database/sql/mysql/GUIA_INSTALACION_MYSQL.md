# Guía: base de datos MySQL (XAMPP) para Kanban SENA

Esta guía explica cómo **reconstruir la base desde cero** e integrarla con el proyecto Laravel, usando **MySQL del XAMPP** y, si lo deseas, **scripts SQL** versionados en esta carpeta.

## Principios de calidad aplicados

| Criterio | Qué se hace |
|----------|-------------|
| **Codificación** | `utf8mb4` + `utf8mb4_unicode_ci` (texto completo Unicode, emojis). |
| **Motor** | `InnoDB` (ACID, transacciones, claves foráneas). |
| **Integridad** | Claves foráneas con `ON DELETE` alineado a las migraciones de Laravel (`CASCADE` / `SET NULL`). |
| **Rendimiento básico** | Índices en FKs, email único, campos de filtrado frecuente (`role`, `status`, etc.). |
| **Coherencia con el código** | El script `02_schema_tablas.sql` refleja el **estado final** de `database/migrations` (la tabla `columns` ya no existe; fue eliminada por migración). |

## Requisitos

- XAMPP con **MySQL (o MariaDB)** en marcha (panel de control: **MySQL Start**).
- PHP del sistema o del XAMPP con extensión **pdo_mysql** habilitada (Laravel la usa).
- Proyecto Laravel en `kanban-sena`.

---

## Opción A — Recomendada: solo Laravel (`migrate`)

Fuente única de verdad: las migraciones en `database/migrations/`. Evita divergencias entre SQL manual y código.

1. Crea una base vacía en phpMyAdmin (por ejemplo `kanban_sena`) con cotejamiento `utf8mb4_unicode_ci`, **o** ejecuta solo `01_create_database_utf8mb4.sql`.
2. Configura `.env` (copia desde `.env.example`):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kanban_sena
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Comenta o elimina las variables `DB_*` de SQLite si estaban activas.

3. Desde la carpeta del proyecto:

   ```bash
   php artisan config:clear
   php artisan migrate:fresh --force
   ```

4. Datos demo y usuarios por rol:

   ```bash
   php artisan db:seed --force
   ```

5. Comprueba:

   ```bash
   php artisan migrate:status
   ```

---

## Opción B: scripts SQL + integración Laravel

Útil si quieres **crear todo desde phpMyAdmin** o automatizar con un único volcado, y seguir usando Artisan después sin conflictos.

### Orden de ejecución

Ejecuta en **esta secuencia** (pestaña SQL de phpMyAdmin o cliente MySQL):

1. `01_create_database_utf8mb4.sql` — crea la base `kanban_sena` (ajusta el nombre si usas otro).
2. Selecciona la base `kanban_sena` y ejecuta `02_schema_tablas.sql` — tablas, FKs e índices.
3. `03_registrar_migraciones_laravel.sql` — crea la tabla `migrations` y registra todas las migraciones como ya aplicadas.

Después:

```bash
php artisan config:clear
php artisan migrate:status
```

Debe listar las migraciones como ejecutadas; **`php artisan migrate`** no debería intentar recrear tablas.

### Variables `.env`

Igual que en la Opción A (`DB_CONNECTION=mysql`, `DB_DATABASE=kanban_sena`, usuario/contraseña de tu XAMPP).

### Datos iniciales

Los scripts **no** insertan usuarios; para cargar roles y datos demo:

```bash
php artisan db:seed --force
```

Si el seeder borra y vuelve a insertar datos, hazlo **después** de tener el esquema creado (por migrate o por SQL).

---

## Destruir y volver a crear todo (reset limpio)

### Solo Artisan

```bash
php artisan migrate:fresh --seed --force
```

### Base creada por scripts SQL

1. En phpMyAdmin: eliminar la base `kanban_sena` o ejecutar de nuevo `02_schema_tablas.sql` (incluye `DROP TABLE` en orden seguro).
2. Ejecutar `03_registrar_migraciones_laravel.sql` de nuevo.
3. `php artisan db:seed --force` si necesitas datos demo.

---

## Solución de problemas

| Situación | Acción |
|-----------|--------|
| `SQLSTATE[HY000] [1045] Access denied` | Revisa usuario/contraseña de MySQL en `.env` (root sin clave es habitual en XAMPP). |
| `Unknown database` | Crea la base o ejecuta `01_create_database_utf8mb4.sql`. |
| `php artisan migrate` intenta crear tablas que ya existen | Ejecuta `03_registrar_migraciones_laravel.sql` o usa **Opción A** con base vacía y solo `migrate`. |
| Errores de FK al importar | Importa siempre `02_schema_tablas.sql` completo; no cortes en medio de un `CREATE TABLE`. |

---

## Archivos en esta carpeta

| Archivo | Función |
|---------|---------|
| `01_create_database_utf8mb4.sql` | Crea la base con charset/collation adecuados. |
| `02_schema_tablas.sql` | Esquema completo alineado al proyecto (InnoDB, FKs). |
| `03_registrar_migraciones_laravel.sql` | Tabla `migrations` + filas para sincronizar con Artisan. |

La fuente normativa del esquema sigue siendo **`database/migrations/`**; si en el futuro cambian las migraciones, actualiza estos scripts o prioriza la **Opción A** (`migrate`).
