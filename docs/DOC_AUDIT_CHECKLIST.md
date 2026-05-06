# Checklist de consistencia documental (post auditoría)

Use esta lista después de ejecutar `audit-docs.sh` (modo lectura o `--apply`) o tras cambios manuales en documentación. Objetivo: alinear textos y configuraciones de ejemplo con el stack real descrito en **`README.md`** y en **`kanban-sena/`**.

---

## 1. Verificación automática

| Paso | Acción | Criterio de éxito |
|------|--------|-------------------|
| 1.1 | Ejecutar `./audit-docs.sh` o `./audit-docs.sh --dry-run` desde la raíz del repo | El informe lista hallazgos o indica que no hay coincidencias con los patrones actuales. |
| 1.2 | Revisar la sección «Hallazgos por archivo» | No deben quedar referencias **activas** al monorepo aspiracional (`frontend/`, `backend/` como raíz del producto) fuera de `docs/LEGACY-VISION.md` o citas explícitas al histórico. |
| 1.3 | Si usó `--apply`, ejecutar `git diff` | Solo cambios en `*.md`, `*.txt`, `.env.example`; ningún `.php`, `.js`, `.blade.php` modificado por el script. |
| 1.4 | Respaldo `*.bak` | Si existen, confirmar contenido o eliminar tras validar: `git checkout -- archivo` o `mv archivo.bak archivo`. |

---

## 2. Revisiones manuales obligatorias

| Paso | Ámbito | Qué comprobar |
|------|--------|----------------|
| 2.1 | **`docs/LEGACY-VISION.md`** | El script **no** aplica sustituciones aquí. Verifique que el texto sigue siendo coherente y que los nombres de tecnología histórica permanecen legibles. |
| 2.2 | **`kanban-sena/.env.example`** | Las variables deben coincidir con Laravel 12 y el despliegue descrito; las menciones a motores SQL opcionales (MySQL, PostgreSQL, SQLite) deben ser **neutras**, no presentar un stack «oficial» distinto del README raíz. |
| 2.3 | **`kanban-sena/docs/INSTALACION_Y_DESPLIEGUE.md`** | Rutas relativas (`cd kanban-sena`), PHP/Composer/Node, sin instrucciones obsoletas `cd frontend` / `cd backend`. |
| 2.4 | **Código fuente** | Los hallazgos en `.php`, `.js`, `.blade.php` del informe (si aparecen) requieren edición **manual** (comentarios, strings de UI o docs inline). |

---

## 3. Trazabilidad con artefactos institucionales

| Artefacto | Comprobación |
|-----------|----------------|
| `SENA – Sistema de Gestión Kanban.txt` (SRS) | Términos y RF alineados con lo declarado en `README.md` (tabla RF). |
| `Identidad visual sena prompt tecnico.txt` | Referencias de color y tipografía coherentes con [`kanban-sena/tailwind.config.js`](../kanban-sena/tailwind.config.js). |
| `kanban_sena.sql` o scripts en [`kanban-sena/database/sql/mysql/`](../kanban-sena/database/sql/mysql/) | Esquema acorde con migraciones Laravel y con lo descrito en documentación. |

---

## 4. Rollback en caso de error

1. Si `--apply` produjo un resultado indeseado y existe **`archivo.bak`**:  
   `mv archivo.bak archivo` (restaura la versión previa a la pasada de `sed`).
2. Si los cambios ya están en Git:  
   `git checkout -- ruta/al/archivo.md`
3. Documentar en el PR o bitácora qué reglas sed fueron demasiado amplias para ajustar `audit-docs.sh` en el futuro.

---

## 5. Cierre

- [ ] `README.md` raíz describe solo el stack actual.
- [ ] No hay instrucciones de instalación que apunten a carpetas inexistentes (`frontend/`, `backend/` en la raíz).
- [ ] Equipo notificado de que la documentación histórica vive en `docs/LEGACY-VISION.md`.

---

*Documento de apoyo — auditoría documental SenaKan.*
