-- =============================================================================
-- Kanban SENA — Creación del esquema lógico (MySQL / MariaDB, XAMPP)
-- Charset recomendado: utf8mb4 + collation unicode (emojis y texto global)
-- =============================================================================
-- Uso:
--   1. Abrir como usuario con permisos (root o cuenta administradora).
--   2. Ejecutar este script completo.
--   3. Continuar con 02_schema_tablas.sql en la base creada.
-- =============================================================================

CREATE DATABASE IF NOT EXISTS `kanban_sena`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
