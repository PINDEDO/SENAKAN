# Diagramas de Clases — Sistema Kanban SENA

**Diagramas de Clases UML — IEEE 830 | v1.0 · 11 Casos de Uso**

---

## RF-001: Autenticación de Usuarios

Gestión del proceso de login, validación de credenciales y control de sesión activa mediante Laravel Auth con bcrypt y protección CSRF.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **User** | Modelo | id: int, name: string, email: string, password: string (bcrypt), role_id: int, active: boolean, remember_token: string | getAuthIdentifier(), getAuthPassword(), hasRole(role): bool |
| **AuthController** | Controlador | authService: AuthService | showLogin(): View, login(req): Response, logout(req): Response, validateCredentials(): bool |
| **LoginFormRequest** | Vista | email: string, password: string, remember: bool | rules(): array, authorize(): bool, failedAuthorization(): void |
| **SessionManager** | Servicio | driver: string, lifetime: int, token: string | start(): void, regenerate(): void, invalidate(): void, token(): string |
| **AuthService** | Servicio | guard: Guard | attempt(credentials): bool, check(): bool, user(): User, logout(): void |
| **HashService** | Servicio | algo: string = bcrypt, rounds: int = 12 | make(value): string, check(value, hash): bool |

### Relaciones
- AuthController --uses--> LoginFormRequest
- AuthController --delega a--> AuthService
- AuthService --busca--> User
- AuthService --gestiona--> SessionManager
- AuthService --verifica--> HashService
- User --genera--> SessionManager

---

## RF-002: Gestión de Usuarios y Roles

Administración de cuentas de usuario con asignación de roles y permisos mediante Gates/Policies o Spatie Permission.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **User** | Modelo | id, name, email, active, center_id | hasRole(), hasPermission(), roles(): BelongsToMany, activate() |
| **Role** | Modelo | id, name, slug, description | users(): BelongsToMany, permissions(): BelongsToMany, assignTo(user) |
| **Permission** | Modelo | id, name, slug, module | roles(): BelongsToMany, users(): BelongsToMany |
| **UserController** | Controlador | userRepo: UserRepository | index(), store(), update(), destroy(), assignRole() |
| **UserRepository** | Servicio | — | findAll(), findById(), create(), updateRole(), deactivate() |
| **UserPolicy** | Servicio | — | viewAny(), create(), update(), delete() |

### Relaciones
- User <--belongsToMany--> Role <--belongsToMany--> Permission
- UserController --usa--> UserRepository --gestiona--> User
- UserController --authorizes--> UserPolicy --verifica--> Permission

---

## RF-003: Gestión de Proyectos

Creación y administración de proyectos como contenedores de tableros, asociados a fichas de formación SENA.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **Project** | Modelo | id, name, description, ficha_id, owner_id, start_date, end_date, status | boards(): HasMany, members(): BelongsToMany, ficha(): BelongsTo |
| **Ficha** | Modelo | id, numero_ficha, nombre_programa, instructor_id, fecha_inicio | projects(): HasMany, instructor(): BelongsTo |
| **Board** | Modelo | id, name, project_id, description | columns(): HasMany, project(): BelongsTo |
| **User** | Modelo | id, name, role | projects(): BelongsToMany, ownedProjects(): HasMany |
| **ProjectController** | Controlador | — | index(), store(), addMember(), destroy() |
| **ProjectMember** | Modelo (pivot) | project_id, user_id, role, joined_at | — |

---

## RF-004: Gestión de Tableros Kanban

Creación y configuración de tableros con columnas personalizadas, reordenables y coloreadas.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **Board** | Modelo | id, name, project_id, description, created_by | columns(): HasMany, project(): BelongsTo, defaultColumns() |
| **Column** | Modelo | id, name, board_id, order, color, wip_limit | tasks(): HasMany, board(): BelongsTo, reorder(), isAtLimit() |
| **BoardController** | Controlador | — | show(), store(), addColumn(), reorderColumns(), destroy() |
| **ColumnController** | Controlador | — | store(), update(), reorder(), destroy() |

---

## RF-005: Gestión de Tareas / Tickets

Ciclo de vida completo de una tarea con título, descripción, asignación, prioridad, etiquetas e historial de cambios.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **Task** | Modelo | id, title, description, column_id, assigned_to, priority (alta/media/baja), due_date, created_by | column(), assignee(), comments(), history(), labels(), isOverdue() |
| **TaskHistory** | Modelo | id, task_id, user_id, from_column, to_column, changed_at, notes | task(): BelongsTo, user(): BelongsTo |
| **Label** | Modelo | id, name, color, board_id | tasks(): BelongsToMany |
| **TaskController** | Controlador | — | store(), show(), update(), destroy(), move() |
| **StoreTaskRequest** | Interfaz | title: required, description: nullable, assigned_to: exists:users, priority: in:alta,media,baja, due_date: date | rules(), authorize() |

---

## RF-006: Drag & Drop de Tareas

Movimiento de tareas entre columnas mediante SortableJS, actualización asíncrona vía AJAX y registro automático en historial.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **SortableJS** | Servicio | el: HTMLElement, animation: int, group: string | onEnd(event), serialize(), destroy() |
| **DragDropHandler** | Vista (JS) | boardId, csrfToken | init(), onDrop(), sendAjax(), updateUI(), rollback() |
| **TaskMoveRequest** | Interfaz | task_id: int, column_id: int, order: int | rules() |
| **TaskController** | Controlador | — | move(): JsonResponse |
| **Task** | Modelo | id, column_id, order | updateColumn(), reorder() |
| **TaskHistory** | Modelo | task_id, from_column, to_column, user_id | record() |

---

## RF-007: Sistema de Comentarios

Módulo de discusión por tarea que permite agregar, editar y eliminar comentarios con registro de autoría.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **Comment** | Modelo | id, task_id, user_id, body, edited, created_at, updated_at | task(), author(), isOwner(), getExcerpt() |
| **Task** | Modelo | id, title, column_id | comments(): HasMany, latestComment(): HasOne |
| **CommentController** | Controlador | — | store(), update(), destroy(), index() |
| **CommentRequest** | Interfaz | body: required, min:2, max:2000 | rules(), authorize() |
| **CommentPolicy** | Servicio | — | update(), delete() |

---

## RF-008: Notificaciones Internas

Sistema de alertas en plataforma mediante el canal database de Laravel.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **DatabaseNotification** | Modelo | id: uuid, type, notifiable_id, data: json, read_at | markAsRead(), isUnread(), getData() |
| **NotificationService** | Servicio | — | notifyAssignment(), notifyStatusChange(), notifyDueSoon(), notifyComment() |
| **User** | Modelo | id, name | notifications(): MorphMany, unreadNotifications(), notify() |
| **TaskAssignedNotif** | Interfaz | via: [database], task, assigner | via(), toDatabase(), toArray() |
| **TaskStatusChangedNotif** | Interfaz | task, from, to | via(), toDatabase() |
| **NotificationController** | Controlador | — | index(), markRead(), markAllRead(), count() |

---

## RF-009: Filtros y Búsqueda

Búsqueda y filtrado avanzado de tareas en tiempo real vía AJAX por múltiples criterios.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **TaskFilterService** | Servicio | query: Builder | byUser(), byPriority(), byLabel(), byColumn(), byDateRange(), search(), get() |
| **Task** | Modelo | id, title, priority, assigned_to, column_id, due_date | scopeFiltered() |
| **SearchRequest** | Interfaz | q, user_id, priority, label_id, column_id | rules(), filters() |
| **SearchController** | Controlador | — | search(), buildFilters() |
| **AjaxSearchHandler** | Vista (JS) | debounce: 300ms, url | onInput(), buildQuery(), fetch(), renderResults(), clearFilters() |
| **TaskResource** | Servicio | — | toArray(), collection() |

---

## RF-010: Reportes y Métricas

Generación de reportes con gráficas (Chart.js) y exportación a PDF mediante DomPDF.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **ReportController** | Controlador | — | dashboard(), tasksByStatus(), workloadByUser(), overdueTasks(), exportPDF() |
| **ReportService** | Servicio | — | getTasksByStatus(), getUserWorkload(), getOverdueTasks(), getProgressByFicha(), getCompletedInRange() |
| **PDFExporter** | Servicio | template, options | generate(), download(), stream() |
| **Task** | Modelo | id, priority, column_id, assigned_to, due_date | scopeOverdue(), scopeCompleted(), scopeInRange() |
| **Ficha** | Modelo | id, numero_ficha, nombre_programa | projects(): HasMany, getProgressSummary() |
| **ChartDataAdapter** | Vista | type, labels, datasets | toBarChart(), toPieChart(), toLineChart() |

---

## RF-011: Asociación con Fichas SENA

Vinculación de proyectos, tableros y tareas con fichas de formación del SENA.

### Clases

| Clase | Tipo | Atributos | Métodos |
|-------|------|-----------|---------|
| **Ficha** | Modelo | id, numero_ficha, nombre_programa, instructor_id, fecha_inicio, fecha_fin, estado | projects(): HasMany, instructor(): BelongsTo, getActiveLearners(), getProgressSummary() |
| **Project** | Modelo | id, name, ficha_id, owner_id | ficha(): BelongsTo, boards(): HasMany, tasks(): HasManyThrough |
| **User (Instructor)** | Modelo | id, name, role: instructor | fichas(): HasMany, assignedProjects(): HasMany |
| **FichaController** | Controlador | — | index(), store(), show(), update(), assignProject() |
| **Board** | Modelo | id, name, project_id | project(): BelongsTo |
| **FichaReportService** | Servicio | — | getProgressByFicha(), getInstructorWorkload(), getFichaMetrics() |

---

*Documento generado a partir de los diagramas de clases UML del Sistema Kanban SENA*