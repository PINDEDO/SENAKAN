# 📘 INFORME TÉCNICO CONSOLIDADO – PROYECTO SENAKAN
**Sistema de Gestión de Tareas tipo Kanban para la Coordinación Interna SENA**  
*Versión del documento:* 1.0 | *Fecha de consolidación:* Mayo 2026 | *Estándar base:* IEEE 830 / 29148

---

## 1. RESUMEN EJECUTIVO
**SenaKan** es una aplicación web de gestión de flujo de trabajo basada en la metodología Kanban, diseñada para digitalizar y centralizar la coordinación académica y administrativa del Servicio Nacional de Aprendizaje (SENA). El sistema reemplaza el seguimiento manual (hojas de cálculo, correo) por tableros visuales interactivos, permitiendo crear, asignar, priorizar y monitorear tareas en tiempo real, con trazabilidad completa y generación de reportes por ficha de formación. El proyecto se encuentra en fase de desarrollo del MVP, con documentación de requisitos validada y esquema de base de datos implementado.

---

## 2. ARQUITECTURA Y STACK TECNOLÓGICO
El proyecto presenta dos enfoques documentados: el **stack base implementado** y una **propuesta de evolución moderna**.

| Capa | Stack Actual (Validado en SRS y Dump SQL) | Stack Propuesto (README / Evolución) |
|------|------------------------------------------|--------------------------------------|
| **Frontend** | Blade Templates (Laravel) + Bootstrap 5 + SortableJS | React 18 + TypeScript + TailwindCSS |
| **Backend** | Laravel 10/11 (PHP 8.1+) – Patrón MVC | Node.js + NestJS – API RESTful |
| **Base de Datos** | MySQL / MariaDB (XAMPP local) | PostgreSQL + Redis (caché/sesiones) |
| **Comunicación** | HTTP/AJAX + CSRF Protection | Socket.io + JWT (Tiempo real) |
| **ORM/Query Builder** | Eloquent ORM | Prisma / TypeORM |
| **Autenticación** | Laravel Breeze/Jetstream + Sessions | NextAuth / Passport JWT |

> 📌 **Nota técnica:** El entorno actual funciona sobre XAMPP en red local, siguiendo el patrón MVC de Laravel. La arquitectura React/NestJS+PostgreSQL se mantiene como referencia para futuras iteraciones de escalabilidad y despliegue en red institucional.

---

## 3. MODELO DE DATOS Y ESQUEMA RELACIONAL
El esquema actual (extraído de `kanban_sena.sql`) prioriza la simplicidad y la trazabilidad. Se eliminó la tabla `columns` mediante migración, utilizando un campo `status` enum en `tasks`.

| Tabla | Propósito | Campos Clave | Relaciones |
|-------|-----------|--------------|------------|
| `users` | Gestión de cuentas y roles | `id`, `name`, `email`, `role`, `active` | 1:N con `projects`, `tasks`, `messages` |
| `projects` | Contenedor de fichas/áreas | `id`, `name`, `code` (N° ficha), `user_id` | 1:N con `tasks` |
| `tasks` | Ítems de trabajo | `id`, `title`, `status` (`pending/progress/done`), `priority`, `assigned_to`, `project_id` | N:1 con `users`, `projects` |
| `activity_logs` | Auditoría y historial | `user_id`, `task_id`, `action`, `description` | N:1 con `users`, `tasks` |
| `messages` | Comunicación interna | `sender_id`, `receiver_id`, `body`, `read_at` | N:1 con `users` |
| `sessions`, `cache`, `jobs` | Infraestructura Laravel | Estándar framework | Gestión interna de estado |

**Decisiones arquitectónicas relevantes:**
- El estado de la tarea se gestiona vía `enum` en lugar de tabla relacional `columns`, simplificando el Drag & Drop inicial.
- `projects.code` almacena directamente el número de ficha SENA, evitando una tabla intermedia en el MVP.
- Soft deletes y trazabilidad obligatoria mediante `activity_logs`.

---

## 4. REQUISITOS DEL SISTEMA

### 🔹 Requisitos Funcionales (RF-001 a RF-011)
| ID | Nombre | Alcance |
|----|--------|---------|
| RF-001 | Autenticación | Login seguro, recuperación de contraseña, protección CSRF |
| RF-002 | Gestión de Usuarios/Roles | CRUD de usuarios, asignación de 4 roles institucionales |
| RF-003 | Gestión de Proyectos | Creación, asociación a fichas, miembros por proyecto |
| RF-004 | Tableros Kanban | Columnas configurables, vista visual de flujo |
| RF-005 | Gestión de Tareas | CRUD completo, prioridad, fechas, asignación |
| RF-006 | Drag & Drop | Mover tareas entre estados con SortableJS + AJAX |
| RF-007 | Comentarios | Discusión por tarea, autoría y edición |
| RF-008 | Notificaciones | Alertas internas por asignación, cambios y vencimientos |
| RF-009 | Filtros/Búsqueda | Por responsable, prioridad, etiqueta, texto y fechas |
| RF-010 | Reportes y Métricas | Avance por tablero/usuario/ficha, exportación PDF |
| RF-011 | Asociación Fichas SENA | Vinculación académica específica del contexto institucional |

### 🔹 Requisitos No Funcionales (RNF-001 a RNF-006)
| ID | Nombre | Especificación |
|----|--------|----------------|
| RNF-001 | Disponibilidad | Horario 7:00–21:00, <2h mantenimiento/semana |
| RNF-002 | Seguridad | Hash bcrypt, CSRF, middleware de autorización, validación Eloquent |
| RNF-003 | Rendimiento | Carga <2s, AJAX <1s, Eager Loading, paginación |
| RNF-004 | Usabilidad | Responsive (Bootstrap 5), máx. 2 clics al tablero, tooltips |
| RNF-005 | Mantenibilidad | PSR-12, PHPDoc, patrón Repository, migraciones/seeders |
| RNF-006 | Escalabilidad | Diseño por `center_id`, migración a VPS/hosting institucional |

---

## 5. IDENTIDAD VISUAL Y LINEAMIENTOS UI/UX
Basado estrictamente en el **Manual de Identidad Visual SENA 2024**:

| Elemento | Especificación Técnica |
|----------|------------------------|
| **Logo** | Esquina superior izquierda. Versiones: verde `#39A900` (fondo claro), blanco (fondo oscuro). Área de seguridad = radio del círculo superior. Favicon = isotipo. |
| **Paleta Principal** | Verde SENA `#39A900`, Verde oscuro `#007832`, Azul oscuro `#00304D`, Amarillo `#FDC300`, Neutros `#FFFFFF` / `#F6F6F6` / `#6B7280` |
| **Tipografía** | `Work Sans` (400, 500, 600, 700). Prohibido Thin/ExtraLight. Interlineado ≥1.4. Fallback: `Calibri` |
| **Layout** | Topbar blanca con sombra, Sidebar `#00304D`, Contenido `#F6F6F6`, Padding base `24px` |
| **Tarjetas Kanban** | Fondo blanco, sombra suave, borde izquierdo 4px: Alta `#EF4444`, Media `#FDC300`, Baja `#39A900` |
| **Botones** | Primario: `#39A900` → hover `#007832`. Secundario: borde `#39A900`. Peligro: `#DC2626` |
| **Accesibilidad** | Contraste WCAG AA ≥4.5:1, foco visible `#39A900`, alt text en imágenes, no pesos <400 |

> 🎨 *Configuración Tailwind incluida en la guía visual para estandarización en futuras migraciones de frontend.*

---

## 6. GESTIÓN DE ROLES Y PERMISOS
| Rol | Permisos Clave | Restricciones |
|-----|----------------|---------------|
| **Administrador** | Gestión total de usuarios, roles, configuración global, acceso a todos los módulos | Sin restricciones internas |
| **Coordinador** | Crear/editar proyectos y tableros, asignar tareas/instructores, ver reportes | No puede eliminar usuarios globales |
| **Instructor** | Consultar y actualizar tareas asignadas, agregar comentarios, hacer seguimiento a aprendices | No elimina tareas ajenas. Movimientos requieren validación |
| **Aprendiz** | Visualizar tableros del proyecto, actualizar estado de tareas propias | No crea ni elimina tareas. Movimientos restringidos por política |

*Implementación:* Middleware de Laravel + Policies/Gates. Rutas protegidas por rol. Retorno `403` o redirección segura.

---

## 7. CRONOGRAMA Y ESTADO ACTUAL
| Fase | Duración | Entregable | Estado |
|------|----------|------------|--------|
| Sprint 1 (Sem 1-2) | 2 sem | XAMPP, Laravel, BD, Auth, CRUD usuarios | ✅ Completado |
| Sprint 2 (Sem 3-4) | 2 sem | Proyectos, Fichas, Tableros, Columnas | ✅ Completado |
| Sprint 3 (Sem 5-6) | 2 sem | Tareas CRUD, Drag & Drop, Historial | 🔄 En progreso (MVP) |
| Sprint 4 (Sem 7-8) | 2 sem | Comentarios, Notificaciones, Filtros | ⏳ Pendiente |
| Sprint 5 (Sem 9-10) | 2 sem | Reportes, PDF, UI/UX refinamiento | ⏳ Pendiente |
| Sprint 6 (Sem 11-12) | 2 sem | Pruebas, Bugs, Documentación, Despliegue | ⏳ Pendiente |

**Hitos validados:** Documento SRS IEEE 830, Prototipos funcionales, Esquema SQL operativo, Guía visual institucional.

---

## 8. LIMITACIONES, RIESGOS Y HOJA DE RUTA FUTURA
| Aspecto | Situación Actual | Acción Futura |
|---------|------------------|---------------|
| **Entorno** | Local XAMPP, red LAN | Migración a servidor interno SENA / VPS |
| **Integraciones** | Sin conexión a SofiaPlus u otros sistemas | APIs REST para sincronización académica |
| **Tiempo Real** | AJAX + Refresh parcial | Implementación WebSockets (Socket.io/Laravel Echo) |
| **Frontend** | Blade + Bootstrap 5 | Migración opcional a React + Tailwind |
| **BD** | MySQL (enum para estados) | Normalización a tabla `columns` relacional si se requieren flujos dinámicos avanzados |
| **Seguridad** | Sesiones + CSRF | JWT + 2FA para acceso remoto institucional |

---

## 9. CONCLUSIONES Y RECOMENDACIONES
1. **Viabilidad técnica:** El stack Laravel/MySQL es robusto para el MVP y cumple con los estándares de mantenimiento y seguridad requeridos por el SENA.
2. **Coherencia institucional:** La guía visual está estrictamente alineada al manual 2024, garantizando identidad corporativa y accesibilidad.
3. **Escalabilidad:** La arquitectura MVC y el diseño de BD permiten crecimiento por sedes y migración a stack moderno sin refactorización mayor.
4. **Recomendación inmediata:** Priorizar la validación del Drag & Drop con SortableJS + AJAX, cerrar políticas de permisos por rol, y realizar pruebas de usuario con coordinadores antes del Sprint 4.
5. **Documentación:** Mantener el trazado de requisitos IEEE 830 actualizado por cada iteración para evidencias de formación ADSO.

---
📎 *Este informe consolina la documentación técnica, visual, de base de datos y de requisitos proporcionada en los archivos de referencia. Disponible para revisión del equipo de coordinación y validación de entregables.*