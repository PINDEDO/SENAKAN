# Arquitectura del Sistema KanbanSENA

**Documento Técnico — Arquitectura y Objetivos del Sistema**
v1.0.0 · SENA 2026

---

## Objetivos del Sistema

KanbanSENA automatiza y centraliza la gestión de actividades formativas del SENA, eliminando el seguimiento manual en papel o correo electrónico.

### Objetivo General
Desarrollar un sistema web de gestión de tareas bajo metodología Kanban, adaptado a la estructura institucional del SENA, que permita el seguimiento eficiente de actividades formativas por ficha, instructor y estado de avance.

### ¿Qué automatiza?
- Seguimiento de tareas por estado (Pendiente → En Proceso → Finalizado)
- Asignación de responsables
- Alertas por vencimiento
- Reportes de cumplimiento
- Comunicación interna entre instructores y coordinadores

### ¿Para qué se usa?
- Gestión de fichas de formación
- Seguimiento de carga de trabajo de instructores
- Visualización de proyectos activos por centro
- Reportes institucionales de cumplimiento
- Mensajería directa entre funcionarios

### Objetivos Específicos
1. Implementar un tablero Kanban interactivo con columnas de estado personalizables
2. Gestionar usuarios con roles diferenciados (Admin, Coordinador, Instructor, Funcionario)
3. Generar reportes e informes con métricas de cumplimiento por proyecto y ficha

---

## Arquitectura de 3 Capas

El sistema implementa una arquitectura MVC clásica con separación clara de responsabilidades.

### Frontend — Capa de Presentación
- **Blade Templates:** Motor de plantillas de Laravel para renderizado de vistas dinámicas
- **CSS Personalizado:** Estilos institucionales alineados con la identidad visual SENA
- **Alpine.js / JS Vanilla:** Interactividad del tablero Kanban, modales y actualizaciones dinámicas

### Backend — Lógica de Negocio
- **Laravel (PHP):** Framework MVC: rutas, controladores, middlewares y autenticación
- **Laravel Breeze:** Sistema de autenticación, registro y gestión de sesiones seguras
- **API RESTful:** Endpoints para CRUD de tareas, proyectos, usuarios y reportes

### Base de Datos — Persistencia
- **MySQL:** Base de datos relacional para almacenamiento
- **Eloquent ORM:** Mapeo objeto-relacional para consultas y relaciones
- **Migraciones:** Control de versiones del esquema de base de datos

---

## Entidades del Sistema

### Users
| Campo | Tipo |
|-------|------|
| id | bigint PK |
| name | string |
| email | string |
| password | hash |
| role | enum |
| is_active | boolean |
| last_login | timestamp |

### Projects
| Campo | Tipo |
|-------|------|
| id | bigint PK |
| name | string |
| description | text |
| ficha | string |
| status | enum |
| created_by | FK users |

### Tasks
| Campo | Tipo |
|-------|------|
| id | bigint PK |
| title | string |
| description | text |
| project_id | FK |
| assigned_to | FK users |
| priority | enum |
| status | enum |
| due_date | date |

### Messages
| Campo | Tipo |
|-------|------|
| id | bigint PK |
| sender_id | FK users |
| receiver_id | FK users |
| content | text |
| read_at | timestamp |

### Activity Log
| Campo | Tipo |
|-------|------|
| id | bigint PK |
| user_id | FK users |
| task_id | FK tasks |
| action | string |
| old_status | string |
| new_status | string |

---

## Roles y Permisos

| Rol | Permisos Clave |
|-----|---------------|
| **Administrador** | Gestionar todos los usuarios, crear/eliminar proyectos, ver todos los reportes, configurar sistema, acceso total al CRUD |
| **Coordinador** | Crear y gestionar proyectos, asignar tareas a instructores, ver reportes de su centro, gestionar fichas de formación |
| **Instructor** | Ver tareas asignadas, mover tareas en el tablero, enviar mensajes directos, consultar calendario |
| **Funcionario** | Ver tablero asignado, actualizar estado de tareas, comunicación interna, consultar calendario |

---

## Flujo de Trabajo Kanban

1. **Crear Tarea** — Admin o Coordinador crea la tarea con título, descripción, prioridad y fecha límite
2. **Asignar** — Se asigna al usuario responsable según rol
3. **Pendiente** — La tarea aparece en la columna PENDIENTE del tablero
4. **En Proceso** — El responsable mueve la tarea a EN PROCESO
5. **Finalizado** — La tarea se marca como FINALIZADO
6. **Reportes** — El sistema registra la actividad y actualiza métricas

---

## Stack Tecnológico

| Tecnología | Rol |
|-----------|-----|
| PHP 8.x | Lenguaje backend |
| Laravel 10 | Framework MVC |
| MySQL | Base de datos |
| Blade | Motor de vistas |
| CSS3 | Estilos |
| JavaScript | Interactividad |
| Breeze Auth | Autenticación |
| Apache/Nginx | Servidor web |

---

*KanbanSENA — Sistema de Gestión de Tareas Institucional · SENA 2026 · v1.0.0*