# Documentación de Implantación — Sistema Kanban SENA (SenaKan)

**Paquete Completo de Documentación de Implantación**
Estándares ISO/IEC 25000, IEEE, ICONTEC/APA
Versión 1.0 | Fecha: 04/02/2026 | Autor: Miguel Ángel Pineda López

---

## 1. Análisis de Contraste: Guía de Implantación vs. SRS SenaKan

| Componente | Guía de Implantación | SRS SenaKan | Resolución Aplicada |
|-----------|---------------------|-------------|---------------------|
| Stack Tecnológico | Genérico (Node/PostgreSQL) | Laravel 10/11 + MySQL 8.0 + XAMPP + Blade/Bootstrap5 | Se documenta sobre Laravel/XAMPP según RF-001 y RNF-005 |
| Roles | Usuarios finales y técnicos | Admin, Coordinador, Instructor, Aprendiz (RF-002) | Flujos diferenciados por permisos en manuales |
| Entorno | Producción genérica | Red LAN local, XAMPP, Apache 2.4 (SRS 3.1) | Procedimientos adaptados a despliegue local |
| Calidad | ISO/IEC 25000, IEEE 829, ICONTEC | RNF-002, RNF-004, RNF-005 | Documentación estructurada bajo estándares requeridos |

---

## 2. Manual de Usuario Completo

### 2.1 Introducción al Sistema

SenaKan es una plataforma web tipo Kanban diseñada para la coordinación interna del SENA. Permite visualizar, asignar y dar seguimiento a tareas académicas y administrativas mediante tableros interactivos.

### 2.2 Requisitos del Cliente

- Navegador moderno: Chrome 90+, Firefox 88+, Edge 90+
- Conexión a la red local del centro de formación
- Resolución mínima: 1280x720

### 2.3 Acceso y Roles

Ingrese a `http://localhost/senakan` con su correo institucional y contraseña.

| Rol | Funciones Principales | Restricciones |
|-----|----------------------|---------------|
| Administrador | Gestión global de usuarios, roles y configuración | Sin restricciones |
| Coordinador | Crea proyectos/tableros, asigna tareas, ve reportes | No modifica configuración de sistema |
| Instructor | Actualiza estado de tareas propias, agrega comentarios | No elimina tareas de otros |
| Aprendiz | Visualiza y actualiza tareas asignadas | Requiere aprobación para mover fuera de columna |

### 2.4 Funciones Principales

#### 2.4.1 Tablero Kanban
1. Acceda al menú **Tableros** y seleccione un proyecto
2. Las columnas por defecto son: *Por Hacer, En Progreso, En Revisión, Completado*
3. Arrastre una tarjeta entre columnas para actualizar su estado (RF-006)

#### 2.4.2 Crear/Editar Tarea
1. Haga clic en **+ Nueva Tarea**
2. Complete: Título, Descripción, Asignado, Prioridad (Alta/Media/Baja), Fecha Límite
3. Guarde. La tarea aparecerá en "Por Hacer"

#### 2.4.3 Comentarios y Notificaciones
Abra una tarjeta para ver el historial y agregar comentarios. Las notificaciones aparecen en la campana superior derecha.

### 2.5 Preguntas Frecuentes

- **¿No puedo arrastrar tareas?** Verifique que su rol tenga permisos de movimiento.
- **La fecha límite aparece en rojo:** La tarea está vencida.
- **¿Cómo recuperar contraseña?** Use el enlace en el login (requiere configuración SMTP).

---

## 3. Guía Rápida de Inicio (Quick Start)

**Objetivo:** Registrar y mover una tarea en 5 minutos.

1. **Inicie sesión** en `http://localhost/senakan/login`
2. En el **Dashboard**, haga clic en un tablero disponible
3. Presione **+ Nueva Tarea** en la columna "Por Hacer"
4. Complete el título, seleccione prioridad y asignado. Haga clic en **Guardar**
5. **Arrastre** la tarjeta a "En Progreso"

> Solo los roles Coordinador e Instructor pueden crear tareas.

---

## 4. Manual Técnico del Software

### 4.1 Arquitectura de Software

SenaKan sigue el patrón **Modelo-Vista-Controlador (MVC)** implementado por Laravel 11:
- **Modelos (Eloquent ORM):** User, Project, Column, Task, Comment, ActivityLog, Notification
- **Vistas (Blade + Bootstrap 5 + SortableJS):** Renderizado en servidor con interacción AJAX
- **Controladores:** Rutas agrupadas por middleware `auth` y `role`

### 4.2 Stack Tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Backend | PHP / Laravel | ≥8.1 / 11.x |
| Base de Datos | MySQL / MariaDB | 8.0 / 10.4+ |
| Frontend | Blade, Bootstrap 5, SortableJS | Últimas estables |
| Autenticación | Laravel Breeze / JWT | Session-based |
| Servidor | Apache 2.4 (XAMPP) | Configuración local |

### 4.3 Endpoints Principales

```
GET  /dashboard                 → Vista resumen por rol
POST /tasks                     → Crear tarea
PATCH /tasks/{id}/status        → Actualizar estado vía AJAX (RF-006)
POST /tasks/{id}/comments       → Agregar comentario (RF-007)
GET  /reports                   → Métricas por ficha/usuario (RF-010)
```

### 4.4 Seguridad
- Protección CSRF en todos los formularios
- Hashing de contraseñas con bcrypt
- Políticas de autorización (Gates/Policies) por rol
- Código documentado con PHPDoc, sigue PSR-12

---

## 5. Manual de Instalación Paso a Paso

### 5.1 Requisitos Previos
- Windows 10/11 o Ubuntu 20.04+
- XAMPP (Apache 2.4, MySQL 8.0+, PHP 8.1+)
- Composer 2.x

### 5.2 Procedimiento

1. **Instalar XAMPP** desde apachefriends.org
2. **Iniciar servicios:** Apache y MySQL
3. **Crear base de datos:** `kanban_sena` con cotejamiento `utf8mb4_unicode_ci`
4. **Desplegar código** en `C:\xampp\htdocs\senakan`
5. **Instalar dependencias:** `composer install`
6. **Configurar .env:** `DB_DATABASE=kanban_sena`, `DB_USERNAME=root`
7. **Generar clave y migrar:** `php artisan key:generate && php artisan migrate`
8. **Sembrar datos:** `php artisan db:seed --class=RoleSeeder`
9. **Verificar:** Acceder a `http://localhost/senakan`

---

## 6. Plan de Migración de Datos

### 6.1 Mapeo de Datos

| Origen (Excel) | Destino (MySQL) | Transformación |
|----------------|-----------------|----------------|
| Nombre Tarea | tasks.title | Trim + validación UTF-8 |
| Estado (Texto) | tasks.status | "Pendiente"→pending, "En curso"→progress, "Listo"→done |
| Prioridad | tasks.priority | high/medium/low |
| Fecha Límite | tasks.due_date | Formato Y-m-d |
| Ficha/Proyecto | projects.code | Unicidad validada |

### 6.2 Estrategia
1. Limpieza de datos en Excel
2. Exportar a CSV UTF-8
3. Ejecutar seeder: `php artisan db:seed --class=MigrationFromExcelSeeder`
4. Validar conteo
5. Registrar en `activity_logs`

---

## 7. Plan de Respaldo y Restauración

- **Frecuencia:** Diario (automático) + Semanal completo
- **Método:** `mysqldump` comprimido + backup de `storage/` y `.env`
- **Almacenamiento:** Disco local externo + carpeta red del centro SENA
- **Prueba periódica:** Mensualmente restaurar en entorno de pruebas

---

## 8. Procedimiento de Rollback y Contingencia

1. Activar modo mantenimiento: `php artisan down`
2. Revertir código: `git checkout <versión-anterior>`
3. Restaurar BD del backup del día anterior
4. Limpiar caché: `php artisan cache:clear && php artisan config:clear`
5. Reactivar: `php artisan up`
6. Notificar a Coordinadores

**SLA de restauración:** ≤ 45 minutos

---

## 9. Informe Final de Implantación

### 9.1 Resumen Ejecutivo
Se completó la implantación de SenaKan v1.0 en la red local del Centro de Procesos Industriales y Construcción. El sistema cumple con los 11 RF y 6 RNF definidos en el SRS.

### 9.2 Lecciones Aprendidas
- La capacitación temprana reduce la curva de adopción
- Documentar el entorno XAMPP evita incidencias de compatibilidad
- Los reportes PDF con DomPDF requieren optimización de memoria

---

## 10. Acta de Entrega y Aceptación del Software

**CLIENTE:** Coordinación Académica SENA
**DESARROLLADOR:** Miguel Ángel Pineda López (Tecnólogo ADSO)

### Entregables
- Código fuente (repositorio Git)
- Base de datos MySQL (dump + migraciones)
- Manual de Usuario y Guía Rápida
- Manual Técnico y de Instalación
- Planes de Migración, Backup y Rollback
- Informes y Actas

### Garantía y Soporte
Soporte técnico gratuito por **90 días** post-entrega.

---

## 11. Listas de Verificación (Checklists)

### Pre-Instalación
- [ ] XAMPP instalado y servicios activos
- [ ] PHP ≥ 8.1 verificado
- [ ] Composer 2.x instalado
- [ ] Puerto 80/3306 disponibles

### Post-Instalación
- [ ] `composer install` ejecutado sin errores
- [ ] `.env` configurado
- [ ] `php artisan key:generate` ejecutado
- [ ] Migraciones aplicadas
- [ ] Login funcional

### Pruebas de Aceptación (UAT)
- [ ] CP-001: Autenticación correcta
- [ ] CP-002: Drag & Drop funcional
- [ ] CP-003: Restricción de acceso 403
- [ ] CP-004: Creación/edición de tareas
- [ ] CP-005: Comentarios y notificaciones
- [ ] CP-006: Reportes exportan a PDF
- [ ] CP-007: Responsive

---

*© 2026 Servicio Nacional de Aprendizaje (SENA) — Centro de Procesos Industriales y Construcción*
*Documentación alineada con GFPI-F-135 | SRS IEEE 830/29148 | Estándares ISO/IEC 25000*