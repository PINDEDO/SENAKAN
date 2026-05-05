-- =============================================================================
-- Registra en Laravel las migraciones ya materializadas por 02_schema_tablas.sql
-- Así `php artisan migrate` no intentará volver a crear tablas existentes.
-- Ejecutar DESPUÉS de 02_schema_tablas.sql sobre la misma base (`kanban_sena`).
-- =============================================================================

USE `kanban_sena`;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Evita duplicar filas si ejecutas el script más de una vez.
DELETE FROM `migrations`;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2026_03_04_001400_add_fields_to_users_table', 1),
('2026_03_05_015403_create_projects_table', 1),
('2026_03_05_015403_create_tasks_table', 1),
('2026_03_06_233950_create_activity_logs_table', 1),
('2026_03_06_234146_create_columns_table', 1),
('2026_03_07_003654_update_roles_in_users_table', 1),
('2026_04_08_003809_create_messages_table', 1),
('2026_04_24_120000_drop_unused_columns_table', 1);
