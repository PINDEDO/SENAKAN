# Manual de Usuario — KanbanSENA

**Guía completa para el uso del sistema KanbanSENA**
v1.0.0 | SENA | Abril 2026

---

## 1. Introducción al Sistema

KanbanSENA es un sistema de gestión de tareas institucional diseñado para el Servicio Nacional de Aprendizaje (SENA), basado en la metodología ágil Kanban.

**Finalidad:** Automatizar el seguimiento de actividades formativas por ficha, permitiendo que instructores, coordinadores y administrativos visualicen en tiempo real el estado de las tareas.

**¿Qué automatiza?** La asignación de tareas, el cambio de estado (Pendiente → En Proceso → Finalizado), las alertas de vencimiento, los reportes de cumplimiento, la mensajería interna y el calendario de actividades.

---

## 2. Especificaciones y Requisitos

| Categoría | Requisito | Detalle |
|-----------|----------|---------|
| Navegador | Chrome, Firefox, Edge, Safari | Versión 2023 o superior |
| Resolución | Mínimo 1280 × 720 px | Optimizado para 1920×1080 |
| Conexión | Internet estable | Mínimo 2 Mbps |
| Credenciales | Correo institucional @sena.edu.co | Asignadas por el administrador |
| Servidor | PHP 8.x + MySQL + Apache/Nginx | Para despliegue local o en nube |
| Dispositivo | PC, tablet o smartphone | Diseño responsive |

---

## 3. Pantallas — Rol Administrador

### Pantalla de Login
1. Ingresar correo institucional en el campo "Correo electrónico"
2. Digitar la contraseña asignada
3. Marcar "Recordar sesión" si se desea mantener activa
4. Presionar el botón **Ingresar**

### Dashboard — Panel Principal
Las 4 tarjetas superiores muestran en tiempo real: **Total Tareas**, **Proyectos** activos, **Vencidas** (en rojo) y **Completadas** (en verde).

### Tablero Kanban
1. Usar el selector desplegable para cambiar entre proyectos/fichas
2. Clic en **+ Nueva Tarea** para crear tareas
3. Arrastrar tarjetas entre columnas para actualizar estado
4. Clic en el ícono de editar para modificar tareas

### Gestión de Usuarios
Tabla con usuario, rol, estado y último acceso. Solo el administrador puede crear, editar y eliminar usuarios.

**Roles disponibles:** INSTRUCTOR · COORDINADOR · FUNCIONARIO · ADMIN

### Informe de Gestión Institucional
Gráficas de cumplimiento por proyecto/ficha, distribución de tareas e historial de actividad reciente.

### Mensajes Directos
Panel izquierdo de contactos, área de conversación a la derecha.

### Calendario de Actividades
Vista mensual con el día vigente resaltado en verde.

---

## 4. Pantallas — Rol Instructor

El instructor **no puede** crear proyectos, gestionar usuarios ni ver reportes globales.

Su menú lateral solo muestra: Dashboard, Mensajes, Calendario, Mis Tareas y Configuración.

- **Dashboard:** Mismas métricas que el admin pero con menú limitado
- **Mis Tareas:** Solo ve las tareas que le están asignadas directamente
- **Configuración de Perfil:** Puede actualizar nombre y contraseña

---

## 5. Operaciones CRUD del Sistema

| Módulo | Crear | Leer | Actualizar | Eliminar |
|--------|-------|------|-----------|----------|
| Tareas | Admin/Coord. | Todos | Asignado | Admin |
| Proyectos | Admin/Coord. | Todos | Admin/Coord. | Admin |
| Usuarios | Admin | Admin | Admin | Admin |
| Mensajes | Todos | Propio | — | — |
| Perfil | — | Propio | Propio | — |

---

## 6. Diccionario de Datos

| Término | Definición |
|---------|-----------|
| **role** (users) | Enumeración: admin, coordinador, instructor, funcionario |
| **status** (tasks) | Estados: pending (Pendiente), progress (En Proceso), done (Finalizado) |
| **priority** (tasks) | Niveles: high (Alta), medium (Media), low (Baja) |
| **ficha** (projects) | Número de ficha de formación del SENA |
| **due_date** (tasks) | Fecha límite; si superada y no "done", se considera vencida |
| **Tablero Kanban** | Vista principal dividida en columnas de estados |
| **Dashboard** | Panel de control con métricas clave |
| **Ficha de Formación** | Identificador que agrupa aprendices bajo un programa |

---

## 7. Requisitos del Sistema

| ID | Nombre | Descripción | Prioridad |
|----|--------|------------|-----------|
| RF-01 | Autenticación | Autenticar usuarios mediante correo y contraseña | Alta |
| RF-02 | Tablero Kanban | Visualizar tareas y permitir drag & drop | Alta |
| RF-03 | CRUD Tareas | Crear, editar, mover y eliminar tareas | Alta |
| RF-04 | Gestión Proyectos | Crear proyectos vinculados a fichas SENA | Alta |
| RF-05 | Gestión Usuarios | Administrar usuarios con roles y permisos | Alta |
| RF-06 | Reportes | Informes de cumplimiento por proyecto | Media |
| RF-07 | Mensajería | Mensajes directos entre usuarios | Media |
| RF-08 | Calendario | Vista mensual de actividades | Baja |
| RNF-01 | Responsive | Interfaz adaptable a dispositivos | Alta |
| RNF-02 | Seguridad | Contraseñas cifradas y control de acceso por rol | Alta |

---

## 8. Referencias

- Anderson, D. J. (2010). *Kanban: Successful Evolutionary Change for Your Technology Business.*
- Laravel Framework. (2024). *Official Documentation.* https://laravel.com/docs
- SENA. (2024). *Portal Institucional.* https://www.sena.edu.co
- IEEE. (2011). *IEEE Std 830-1998.*
- MySQL. (2024). *MySQL 8.0 Reference Manual.*

---

## 9. Conclusiones

- **Gestión Digitalizada:** Elimina el seguimiento manual, centralizando toda la información
- **Control por Roles:** Cada usuario accede únicamente a la información pertinente a su cargo
- **Trazabilidad y Reportes:** Seguimiento real del cumplimiento por ficha y proyecto
- **Escalabilidad:** La arquitectura Laravel + MySQL permite escalar a múltiples sedes

**Trabajo Futuro:** Notificaciones en tiempo real (WebSockets), integración con calendario académico, generación de reportes en PDF, módulo de asistencia/evidencias.

---

*KanbanSENA — Manual de Usuario · SENA 2026 · v1.0.0*