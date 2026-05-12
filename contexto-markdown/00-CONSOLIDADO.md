# CONSOLIDADO — Documentación SenaKan / Kanban SENA

**Archivo consolidado con toda la documentación del proyecto.**

---

## Tabla de Contenido

1. [Identidad Visual SENA - Prompt Tecnico](#01-identidad-visual-sena-prompt)
2. [Como Funcionan los Sistemas Kanban](#02-como-funcionan-sistemas-kanban)
3. [Credenciales SenaKan](#03-credenciales-senakan)
4. [Informe Tecnico Consolidado](#04-informe-tecnico-consolidado)
5. [IEEE SRS - Kanban SENA (Laravel)](#05-IEEE-SRS-kanban-sena-laravel)
6. [README SenaKan](#06-README-senakan)
7. [IEEE SRS - Kanban SENA (React)](#07-IEEE-SRS-kanban-sena-react)
8. [Guia de Aprendizaje - Implantacion](#08-guia-aprendizaje-implantacion)
9. [Diagramas de Clases Kanban](#09-diagramas-clases-kanban)
10. [Documentacion de Implantacion](#10-documentacion-implantacion)
11. [Arquitectura Kanban SENA](#11-arquitectura-kanban-sena)
12. [Manual de Usuario Kanban SENA](#12-manual-usuario-kanban-sena)
13. [Manual de Identidad Visual SENA 2024](#13-manual-identidad-visual-sena-2024)
14. [Informe de Gestion Kanban](#14-informe-gestion-kanban)
15. [IEEE Kanban SENA (DOCX)](#15-IEEE-kanban-sena-docx)
16. [IEEE ERS Kanban SENA v1.0](#16-IEEE-ERS-kanban-sena-v1)
17. [Presentacion Proyecto Storm](#17-presentacion-proyecto-storm)


---

<a id="01-identidad-visual-sena-prompt"></a>

# Prompt de Agente Experto: Guía de Estilos Visuales SENA para SenaKan

Eres un agente de desarrollo frontend y diseño UI/UX altamente especializado. Debes aplicar de manera estricta la siguiente guía de estilos, basada en el **Manual de Identidad Visual SENA 2024**, para construir la interfaz de usuario del proyecto **SenaKan** (sistema de gestión de tareas tipo Kanban). Cualquier desviación deberá ser consultada y aprobada explícitamente.

## 1. Logotipo y Símbolos

- **Logosímbolo SENA**: Es el elemento principal de identidad. Debe aparecer en todas las vistas de la aplicación, preferiblemente en la barra de navegación superior.
- **Versiones permitidas**: Solo se admite el logo en color **verde institucional** (`#39A900`) sobre fondos blancos/claros, **blanco** (`#FFFFFF`) sobre fondos oscuros, o **negro** (`#000000`) en contextos monocromáticos.
- **Área de seguridad**: Debe respetarse un margen mínimo alrededor del logo equivalente al radio del círculo superior del símbolo.
- **Prohibiciones**: No distorsionar, rotar, añadir sombras, degradados, bisel, ni modificar tipografía o proporciones. No usar versiones antiguas.
- **Responsive**: Si el espacio es muy reducido y afecta la legibilidad, se permite separar el símbolo gráfico del texto “SENA”, manteniendo ambos elementos.
- **Ubicación en la app**: Colocar el logosímbolo en la **esquina superior izquierda** de la barra de navegación principal. En la barra lateral (si se usa), usar el símbolo solo o el logo en versión blanca si el fondo es oscuro.
- **Favicon**: Utilizar el isotipo (símbolo sin texto) en verde institucional sobre fondo blanco/transparente.

## 2. Paleta de Colores

### Color institucional principal
- **Verde SENA**: `#39A900`  
  RGB: `57, 169, 0` | CMYK: `75, 0, 100, 0`
- **Uso**: Logo, botones principales, enlaces activos, indicadores de prioridad baja, acentos.

### Colores secundarios (de apoyo, no usar en el logo)
| Color         | HEX       | Uso sugerido                             |
|---------------|-----------|------------------------------------------|
| Verde oscuro  | `#007832` | Hover de botones, fondos de alertas      |
| Azul oscuro   | `#00304D` | Barra lateral, fondos de cabeceras       |
| Violeta       | `#71277A` | Destacar información (campañas)          |
| Azul claro    | `#50E5F9` | Fondos decorativos, etiquetas secundarias|
| Amarillo      | `#FDC300` | Prioridad media, avisos, insignias       |

Corrección RGB del manual: Verde oscuro en RGB es `0, 120, 50` (no 150 como aparece erróneamente en el documento).

### Neutros
- **Blanco**: `#FFFFFF`
- **Negro**: `#000000`
- **Gris claro**: `#F6F6F6` – fondos de páginas, tarjetas, separadores.

### Reglas de uso del color
- El logosímbolo **siempre** será verde institucional, blanco o negro. Jamás en otro color.
- Predominancia recomendada para la interfaz general: **Caso 1 – Blanco predominante** (fondos claros, acentos verdes). Apto para la mayoría de las pantallas del sistema (dashboard, tableros, formularios).
- Para campañas o banners internos se puede usar el **Caso 2 – Verde predominante**, pero con textos cortos y tipografía de alto contraste.
- Se pueden incorporar colores diferentes solo con aprobación del equipo de comunicaciones, asegurando que la paleta SENA sigue siendo protagonista.

## 3. Tipografía

### Tipografía principal: **Work Sans**
- Familia de Google Fonts: `Work Sans` (pesos disponibles: 400, 500, 600, 700, 800, 900 + itálicas correspondientes).
- **Pesos prohibidos**: Thin (100) y ExtraLight (200) por problemas de accesibilidad.
- **Uso**: Toda la interfaz, encabezados, botones, menús, tarjetas, tablas. Los títulos deben usar al menos `SemiBold (600)` o `Bold (700)`.
- Configuración CSS:
  ```css
  --font-primary: 'Work Sans', sans-serif;
  ```

### Tipografía secundaria: **Calibri**
- Para piezas de divulgación, boletines internos o contenido extenso si se desea diferenciar.
- En el SenaKan se usará principalmente Work Sans. Calibri puede quedar como fallback del sistema o para textos de lectura larga en modales de descripción.
  ```css
  --font-secondary: 'Calibri', 'Work Sans', sans-serif;
  ```

### Reglas
- No usar tipografías decorativas fuera de campañas aprobadas.
- El interlineado debe garantizar legibilidad (mínimo 1.4 para cuerpo de texto).
- Los textos sobre imágenes o fondos de color deben cumplir criterios de accesibilidad (contraste mínimo WCAG AA).

## 4. Iconografía

- Estilo: **íconos de línea (outline)** con trazo uniforme, minimalistas. Preferir librerías como Heroicons (outline) o Phosphor Icons.
- Grosor del trazo: entre 1.5 y 2 px visuales.
- Color por defecto: `#00304D` (azul oscuro) o gris medio `#6B7280`. Para elementos activos o seleccionados usar verde institucional `#39A900`.
- Mantener las proporciones originales de los íconos, sin distorsión.
- En la barra lateral los íconos serán blancos con opacidad 0.7 (activo: opacidad 1, fondo verde).

## 5. Fotografía

- Si se emplean imágenes (por ejemplo en dashboards personalizados): deben ser **positivas**, que comuniquen trabajo en equipo, innovación, formación técnica.
- Evitar imágenes negativas, cenicientas o con bajo contraste.
- La tipografía sobre imágenes debe tener alto contraste; si es necesario, usar un overlay semitransparente (verde oscuro o negro) para mejorar la legibilidad.

## 6. Componentes UI y Layout

### 6.1 Estructura general
- **Barra superior (Topbar)**:
  - Fondo blanco `#FFFFFF` con ligera sombra (`box-shadow` sutil).
  - Logo SENA en verde alineado a la izquierda.
  - Nombre de la aplicación “SenaKan” en `Work Sans SemiBold`, color azul oscuro `#00304D`, al lado del logo (separado por línea vertical gris).
  - Acciones de usuario (notificaciones, perfil) a la derecha, con íconos en `#00304D`.
- **Barra lateral (Sidebar)**:
  - Fondo `#00304D` (azul oscuro institucional).
  - Íconos y texto en blanco, fuente `Work Sans Medium`.
  - Elemento activo: fondo verde `#39A900`, texto blanco.
  - El logo SENA reducido (símbolo o logotipo en blanco) puede ubicarse en la parte superior colapsada.
- **Contenido principal**:
  - Fondo `#F6F6F6` (gris claro) para la mayoría de las páginas, o blanco `#FFFFFF` en áreas de trabajo detallado (formularios, modales).
  - Padding generoso: `p-6` (24px) como base.

### 6.2 Tablero Kanban
- **Columnas**: 
  - Fondo de cada columna: `#F3F4F6` (#F3F4F6 ligeramente más gris) con borde redondeado (`border-radius: 8px`).
  - Cabecera de columna: fondo `#00304D` (azul oscuro) o verde oscuro, texto blanco `Work Sans SemiBold`, altura fija.
  - Los nombres por defecto: **Por Hacer**, **En Progreso**, **En Revisión**, **Completado**.
- **Tarjetas de tarea**:
  - Fondo blanco, sombra suave (`shadow-sm`), borde izquierdo de 4px según prioridad:  
    - Alta: `#EF4444` (rojo – se permite rojo genérico para UI, tonalidad similar a `#DC2626`)  
    - Media: `#FDC300` (amarillo institucional)  
    - Baja: `#39A900` (verde institucional)
  - Título en `Work Sans SemiBold`, tamaño 14px; descripción truncada en `Work Sans Regular`, 12px.
  - Avatar del asignado (círculo con iniciales) y fecha límite (si está vencida en rojo).
- **Drag & Drop**: Al arrastrar, la tarjeta muestra un relieve y la columna destino resalta su borde con verde institucional.

### 6.3 Botones
- **Primario**: Fondo `#39A900`, texto blanco, `border-radius: 6px`, padding `px-4 py-2`. Hover: `#007832`.
- **Secundario**: Borde `#39A900`, texto `#39A900`, fondo transparente. Hover: fondo `#E8F5E0`.
- **Peligro / Eliminar**: Fondo `#DC2626`, texto blanco.

### 6.4 Formularios
- Campos de entrada: borde `#D1D5DB`, foco con borde `#39A900` y sombra verde claro.
- Etiquetas en `Work Sans Medium`, color `#00304D`.
- Mensajes de error en `#DC2626`.

### 6.5 Notificaciones y Badges
- Badge de prioridad: pequeño rectángulo con color de fondo correspondiente y texto blanco.
- Notificaciones en campana: ícono con punto rojo si hay no leídas.
- Diálogos de confirmación: usar el estilo limpio, botón primario verde para acción positiva.

### 6.6 Tarjetas de métricas (Dashboard)
- Fondo blanco, sombra sutil, borde superior de 3px verde `#39A900` (o azul oscuro para variar).
- Números grandes en `Work Sans Bold`, color `#00304D`.
- Etiqueta descriptiva en `Work Sans Regular`, gris oscuro.

## 7. Accesibilidad

- Contraste mínimo: textos sobre fondos claros deben alcanzar relación 4.5:1.
- No usar pesos Thin/ExtraLight de Work Sans.
- Toda imagen informativa debe tener alt text.
- Los elementos interactivos deben tener estados foco visibles (anillo verde `#39A900`).

## 8. Configuración Técnica (Tailwind CSS)

Se debe extender el tema de Tailwind para reflejar la identidad del SENA. Añade en `tailwind.config.js`:

```javascript
theme: {
  extend: {
    colors: {
      sena: {
        green:  '#39A900',
        darkgreen: '#007832',
        navy:   '#00304D',
        violet: '#71277A',
        sky:    '#50E5F9',
        yellow: '#FDC300',
        graybg: '#F6F6F6',
      }
    },
    fontFamily: {
      sans: ['Work Sans', 'Calibri', 'sans-serif'],
    },
    borderRadius: {
      'xl': '0.75rem',
    }
  }
}
```

- Cargar Work Sans desde Google Fonts (pesos 400,500,600,700) en el `<head>`.
- Asegurarse de que Calibri esté disponible como fallback (fuente de sistema en Windows).

## 9. Aprobaciones y Excepciones

- Cualquier propuesta de uso de color o tipografía fuera de lo aquí definido debe ser validada con el equipo de comunicaciones (según el Manual de Identidad Visual).
- El código debe respetar la inclusión permanente del logotipo institucional sin alteraciones.
- Para el MVP, seguir estrictamente este lineamiento; para futuras iteraciones se podrá incorporar elementos adicionales aprobados.

---

**Referencia base**: Manual de Identidad Visual SENA 2024 (archivo `MANUAL_IDENTIDAD_VISUAL_SENA_2024.pdf`).  
**Documento actualizado para el proyecto SenaKan – Abril 2026**.
```



---

<a id="02-como-funcionan-sistemas-kanban"></a>

# Cómo Funcionan los Sistemas Kanban

**Cómo funcionan los sistemas Kanban/Jira**

Estos sistemas se basan en varios conceptos clave:

**1. Tableros (Boards):** Visualizan el flujo de trabajo con columnas
que representan estados (Por Hacer, En Progreso, En Revisión,
Completado)

**2. Tareas/Tickets:** Elementos de trabajo que se mueven entre
columnas. Cada tarea contiene:

-   Título y descripción

-   Asignado a (usuario responsable)

-   Prioridad (alta, media, baja)

-   Etiquetas/categorías

-   Fechas límite

-   Comentarios y adjuntos

-   Historial de cambios

**3. Funcionalidades principales:**

-   Gestión de usuarios y permisos

-   Filtros y búsqueda avanzada

-   Notificaciones

-   Reportes y métricas

-   Flujos de trabajo personalizables

**Arquitectura Recomendada**

Para un sistema robusto y escalable, te sugiero:

**Arquitectura de 3 capas:**

**Frontend (Cliente):**

-   React o Vue.js para interfaces interactivas

-   Drag & Drop para mover tareas

-   Estado global (Redux, Zustand, Pinia)

**Backend (Servidor):**

-   Node.js con Express o NestJS

-   API RESTful o GraphQL

-   Autenticación JWT

-   WebSockets para actualizaciones en tiempo real

**Base de Datos:**

-   PostgreSQL (relacional, robusto)

-   MongoDB (flexible para datos no estructurados)

-   Redis para caché y sesiones

**Stack Tecnológico Recomendado**

**Opción 1 - Stack Moderno JavaScript:**

Frontend: React + TypeScript + TailwindCSS

Backend: Node.js + NestJS

Base de Datos: PostgreSQL

ORM: Prisma o TypeORM

Tiempo Real: Socket.io

**Opción 2 - Full Stack Framework:**

Next.js (Full Stack React)

Base de Datos: PostgreSQL

ORM: Prisma

Autenticación: NextAuth.js

**Opción 3 - Separación clara:**

Frontend: Vue.js + Vuetify

Backend: Django (Python) o Laravel (PHP)

Base de Datos: PostgreSQL

API: Django REST Framework o Laravel API

**Estructura del Proyecto**

**Entidades principales:**

1.  **Usuarios:** roles (admin, coordinador, instructor, aprendiz)

2.  **Proyectos/Programas:** agrupación de tableros

3.  **Tableros:** visualización del flujo

4.  **Columnas:** estados del flujo

5.  **Tareas:** items de trabajo

6.  **Comentarios:** discusiones en tareas

7.  **Adjuntos:** archivos relacionados

8.  **Notificaciones:** alertas del sistema

**Funcionalidades esenciales para SENA:**

-   **Gestión de fichas:** asociar tareas a fichas de formación

-   **Seguimiento de instructores:** ver carga de trabajo

-   **Calendario académico:** integración con fechas importantes

-   **Reportes institucionales:** métricas específicas del SENA

-   **Permisos por rol:** coordinador, instructor, administrativo

**Recomendaciones específicas:**

1.  **Empieza con un MVP:** tablero básico, crear/editar/mover tareas,
    asignar usuarios

2.  **Prioriza la usabilidad:** muchos usuarios del SENA pueden no ser
    técnicos

3.  **Considera la escalabilidad:** el SENA tiene múltiples sedes

4.  **Seguridad:** datos educativos son sensibles

5.  **Responsive design:** acceso desde cualquier dispositivo



---

<a id="03-credenciales-senakan"></a>

# Credenciales SenaKan

## Credenciales de acceso al sistema

| Rol | Correo | Contraseña |
|-----|--------|------------|
| Administrador | admin@sena.demo | SenaAdmin2026! |
| Funcionario | funcionario@sena.demo | SenaFunc2026! |
| Coordinador | coordinador@sena.demo | SenaCoord2026! |
| Instructor | instructor@sena.demo | SenaInst2026! |

## Comando para iniciar el servidor

`ash
cd c:\\Users\\SENA\\Desktop\\SENAKAN\\kanban-sena
php artisan serve --host=127.0.0.1 --port=8000
`



---

<a id="04-informe-tecnico-consolidado"></a>

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



---

<a id="05-IEEE-SRS-kanban-sena-laravel"></a>

# SENA – Sistema de Gestión Kanban Coordinación | IEEE** SRS v1.0**

**SERVICIO NACIONAL DE APRENDIZAJE**

**SENA**

**ESPECIFICACIÓN DE REQUISITOS DE SOFTWARE**

*Estándar IEEE 830 / IEEE 29148*

**SISTEMA DE GESTIÓN DE TAREAS TIPO KANBAN**

*Para la Coordinación Interna SENA*

| **Nombre de la Evidencia:** | Especificación de Requisitos de Software – Sistema Kanban SENA |
| --- | --- |
| **Institución:** | Servicio Nacional de Aprendizaje (SENA) |
| **Centro:** | Centro de Procesos Industriales y Construcción |
| **Técnico / Tecnología:** | Tecnología en Análisis y Desarrollo de software |
| **Fase:** | Análisis y Diseño |
| **Tipo de Formación:** | MIXTA |
| **Fecha de Entrega:** | 10 de abril del 2026 |
| **Versión del Documento:** | 1.0 |
| **Estado:** | Borrador |

FICHA DEL DOCUMENTO

| **FECHA** | **REVISIÓN(ES)** | **AUTOR(ES)** |
| --- | --- | --- |
| 04 de febrero del 2026 | Versión inicial – creación del documento | Miguel Ángel Pineda López |
| [Fecha revisión] | Revisión de requisitos funcionales | [Revisor – completar] |
|  |  |  |

**DOCUMENTO VALIDADO POR LAS PARTES EN FECHA: ___________________________**

| **POR CLIENTE** | **DESARROLLADOR** |
| --- | --- |
| Fecha: ___________ | Fecha: ___________ |
| Nombre del Encargado: José German Estrada Clavijo | Nombre del Encargado: Miguel Ángel Pineda López |

**CONTENIDO**

**1.  INTRODUCCIÓN**

    1.1 Objetivo General

    1.2 Objetivos Específicos

    1.3 Propósito

    1.4 Alcance

    1.5 Personal Involucrado

    1.6 Definiciones, Acrónimos y Abreviaturas

    1.7 Referencias

    1.8 Resumen

**2.  DESCRIPCIÓN GENERAL**

    2.1 Perspectiva del Producto

    2.2 Funcionalidades del Producto

    2.3 Características de los Usuarios

    2.4 Restricciones

**3.  REQUISITOS ESPECÍFICOS**

    3.1 Requisitos del Sistema

    3.2 Requisitos Funcionales

    3.3 Requisitos No Funcionales

**4.  VALIDACIÓN DE REQUISITOS**

    4.1 Construcción de Prototipos

    4.2 Formatos de Casos de Prueba

**1. INTRODUCCIÓN**

La coordinación interna del SENA gestiona múltiples procesos académicos y administrativos que involucran instructores, aprendices y personal coordinador. Actualmente, el seguimiento de tareas, actividades y compromisos se realiza de forma manual o mediante herramientas no especializadas (correo electrónico, hojas de cálculo), lo que genera pérdida de información, duplicación de esfuerzos y baja trazabilidad del trabajo.

El presente documento establece los requisitos de software para el desarrollo de un Sistema de Gestión de Tareas tipo Kanban adaptado a las necesidades particulares de la coordinación SENA, permitiendo visualizar, asignar y dar seguimiento al flujo de trabajo en tiempo real.

**1.1 Objetivo General**

Desarrollar un sistema web de gestión de tareas tipo Kanban para la coordinación interna del SENA, que permita organizar, asignar y dar seguimiento al flujo de trabajo de instructores, coordinadores y aprendices mediante tableros visuales interactivos, utilizando el framework Laravel sobre un entorno XAMPP con MySQL.

**1.2 Objetivos Específicos**

- Diseñar e implementar un módulo de autenticación y gestión de usuarios con roles diferenciados (Administrador, Coordinador, Instructor, Aprendiz).

- Crear tableros Kanban personalizables con columnas configurables que representen los estados del flujo de trabajo.

- Permitir la creación, asignación, priorización y seguimiento de tareas dentro de los tableros.

- Implementar un sistema de notificaciones internas para alertar sobre cambios, asignaciones y fechas límite.

- Generar reportes básicos sobre el avance y carga de trabajo por usuario y por ficha de formación.

- Garantizar una interfaz responsiva y de fácil uso para usuarios con distintos niveles de conocimiento técnico.

**1.3 Propósito**

El software tiene como finalidad digitalizar y centralizar la gestión de tareas de la coordinación SENA, reemplazando los procesos manuales por un sistema visual e intuitivo que mejore la productividad, la comunicación interna y la trazabilidad de los procesos académicos y administrativos. El sistema permitirá a los coordinadores tener visibilidad total del estado de avance de las actividades de su equipo.

**1.4 Alcance**

El sistema abarcará las siguientes funcionalidades dentro del contexto de la coordinación SENA:

- Gestión completa de usuarios, roles y permisos.

- Creación y administración de proyectos y tableros Kanban.

- Ciclo de vida completo de tareas: creación, asignación, movimiento entre columnas, comentarios y cierre.

- Asociación de tareas a fichas de formación específicas.

- Módulo básico de reportes y métricas de productividad.

- Notificaciones en plataforma (sin integración con correo externo en la versión inicial).

El sistema NO incluirá en su versión inicial:

- Integración con sistemas externos del SENA (Sofia Plus, etc.).

- Aplicación móvil nativa.

- Módulos de facturación o nómina.

- Videoconferencia o chat en tiempo real.

**1.5 Personal Involucrado**

| **CAMPO** | **DESCRIPCIÓN** |
| --- | --- |
| NOMBRE | Miguel Ángel Pineda López |
| ROL | Desarrollador Full Stack / Analista de Requisitos |
| PROFESIÓN | Tecnólogo en Análisis y Desarrollo de Software (ADSO) – SENA |
| RESPONSABILIDADES | Análisis, diseño, desarrollo, pruebas e implementación del sistema |
| INFORMACIÓN DE CONTACTO | [Pinedo7u7@gmail.com](mailto:Pinedo7u7@gmail.com) / 3137466621 |
| APRUEBA | SI – Entrevista y seguimiento con el Coordinador SENA |

Cliente / Patrocinador del proyecto:

| **CAMPO** | **DESCRIPCIÓN** |
| --- | --- |
| NOMBRE | [Nombre del Coordinador SENA – completar] |
| ROL | Coordinador Académico / Cliente del sistema |
| RESPONSABILIDADES | Validar requisitos, aprobar entregables y proveer información del proceso |
| INFORMACIÓN DE CONTACTO | [Datos del Coordinador – completar] |

**1.6 Definiciones, Acrónimos y Abreviaturas**

| **TÉRMINO** | **DEFINICIÓN** |
| --- | --- |
| Kanban | Método visual de gestión de flujo de trabajo que usa tarjetas en columnas |
| Tablero (Board) | Espacio visual dividido en columnas que representa el flujo de un proyecto |
| Tarea / Ticket | Unidad mínima de trabajo dentro de un tablero Kanban |
| Columna | Estado del flujo de trabajo (ej: Por Hacer, En Progreso, Completado) |
| Laravel | Framework PHP de código abierto para desarrollo de aplicaciones web (MVC) |
| MySQL | Sistema de gestión de bases de datos relacional open source |
| XAMPP | Paquete de software local que incluye Apache, MySQL, PHP y Perl |
| MVC | Modelo-Vista-Controlador: patrón de arquitectura de software |
| API REST | Interfaz de programación de aplicaciones basada en el protocolo HTTP |
| JWT | JSON Web Token: estándar para autenticación mediante tokens |
| SENA | Servicio Nacional de Aprendizaje |
| ADSO | Análisis y Desarrollo de Software (nombre del programa de formación) |
| Ficha | Número identificador único de un grupo de aprendices en el SENA |
| SRS | Software Requirements Specification (Especificación de Requisitos de Software) |
| CRUD | Operaciones básicas: Crear, Leer, Actualizar, Eliminar |
| MVP | Producto Mínimo Viable (funcionalidad básica para primera entrega) |

**1.7 Referencias**

- Jira Software – Atlassian. https://www.atlassian.com/software/jira

- Trello – Atlas Sian. https://trello.com

- Asana – https://asana.com

- Laravel Documentation v11. https://laravel.com/docs

- MySQL Documentation. https://dev.mysql.com/doc/

- IEEE Standard 830-1998 – Recommended Practice for Software Requirements Specifications

- IEEE Standard 29148-2018 – Systems and Software Engineering – Requirements Engineering

**1.8 Resumen**

El sistema Kanban SENA es una aplicación web desarrollada con el framework Laravel (PHP) y base de datos MySQL local (XAMPP), que permite a la coordinación del SENA gestionar tareas y proyectos mediante tableros visuales interactivos. Los usuarios pueden crear tableros, organizar tareas por estados, asignarlas a miembros del equipo y hacer seguimiento al avance de cada actividad, mejorando la comunicación y la productividad interna de la coordinación.

**2. DESCRIPCIÓN GENERAL**

El Sistema de Gestión de Tareas Kanban para el SENA es una aplicación web de arquitectura MVC (Modelo-Vista-Controlador), accesible desde cualquier navegador moderno en la red local del centro de formación. Facilita la organización visual del trabajo mediante tableros con columnas que representan etapas del proceso, y tarjetas que representan tareas individuales.

**2.1 Perspectiva del Producto**

El sistema es una solución web independiente, desarrollada a medida para la coordinación SENA. Funciona sobre un servidor local Apache (XAMPP), con base de datos MySQL, accesible mediante navegadores web en la red interna. La interfaz presenta:

- Un panel de inicio con resumen de tareas asignadas al usuario autenticado.

- Tableros visuales Kanban con columnas configurables y tarjetas arrastrables.

- Panel de administración para gestión de usuarios, roles y configuraciones.

- Módulo de reportes con métricas de avance por tablero, usuario y ficha.

Usuarios del sistema y sus roles:

| **ROL** | **DESCRIPCIÓN** | **ACCESO PRINCIPAL** |
| --- | --- | --- |
| Administrador | Control total del sistema, gestión de usuarios y configuración global | Panel admin, todos los módulos |
| Coordinador | Gestiona proyectos, tableros y asigna tareas al equipo | Tableros, reportes, usuarios del proyecto |
| Instructor | Ve y actualiza el estado de sus tareas asignadas, agrega comentarios | Sus tableros y tareas asignadas |
| Aprendiz | Visualiza tareas del proyecto y actualiza estado de sus actividades | Tableros del proyecto al que pertenece |

**2.2 Funcionalidades del Producto (Elicitación)**

Las funcionalidades principales identificadas en el levantamiento de requisitos son:

- Registro, inicio de sesión y recuperación de contraseña.

- Gestión de usuarios con asignación de roles y permisos.

- Creación y administración de proyectos agrupadores de tableros.

- Creación de tableros Kanban con columnas configurables.

- Creación de tareas/tickets con título, descripción, responsable, prioridad, etiquetas y fecha límite.

- Arrastrar y soltar tareas entre columnas (Drag & Drop).

- Sistema de comentarios por tarea.

- Adjuntar archivos a tareas (opcional en MVP).

- Filtros y búsqueda de tareas por estado, responsable, prioridad y etiqueta.

- Notificaciones internas sobre asignación y cambios en tareas.

- Reportes de avance por tablero, usuario y ficha de formación.

- Historial de cambios de estado de cada tarea.

**2.3 Características de los Usuarios**

| **ROL** | **FUNCIÓN EN EL PROCESO** | **FRECUENCIA DE USO** | **NIVEL TÉCNICO** |
| --- | --- | --- | --- |
| Administrador | Configurar sistema, gestionar usuarios y roles globalmente | Esporádica | Alto |
| Coordinador | Planificar proyectos, crear tableros, asignar y supervisar tareas | Diaria | Medio |
| Instructor | Consultar y actualizar estado de tareas asignadas, comentar | Diaria | Bajo-Medio |
| Aprendiz | Consultar tareas del proyecto y actualizar actividades propias | Frecuente | Bajo |

**2.4 Restricciones**

Restricciones técnicas:

- El sistema funcionará inicialmente en entorno local (XAMPP – localhost) sin acceso externo a internet.

- La base de datos será MySQL gestionada con phpMyAdmin.

- El backend estará construido exclusivamente en Laravel (PHP >= 8.1).

- El frontend utilizará Blade Templates de Laravel con librerías CSS/JS (Bootstrap 5 y SortableJS para Drag & Drop).

Restricciones funcionales por rol:

- Solo el Administrador puede crear, editar y eliminar usuarios y roles.

- Solo el Coordinador y Administrador pueden crear o eliminar tableros y proyectos.

- Los Instructores no pueden eliminar tareas de otros usuarios, solo las propias.

- Los Aprendices no pueden mover tareas fuera de su columna asignada sin aprobación del Instructor.

- No se permite la eliminación permanente de tareas; solo el archivado (soft delete).

**3. REQUISITOS ESPECÍFICOS**

**3.1 Requisitos del Sistema**

Requisitos de hardware y software del entorno de desarrollo y despliegue inicial:

| **COMPONENTE** | **ESPECIFICACIÓN MÍNIMA** |
| --- | --- |
| Sistema Operativo | Windows 10/11 o Ubuntu 20.04+ |
| Procesador | Intel Core i5 o equivalente (2.0 GHz) |
| Memoria RAM | 4 GB mínimo (8 GB recomendado) |
| Almacenamiento | 20 GB libres en disco |
| Servidor Web | Apache 2.4 (incluido en XAMPP) |
| PHP | Versión 8.1 o superior |
| Base de Datos | MySQL 8.0 (incluido en XAMPP) |
| Gestor BD | phpMyAdmin (incluido en XAMPP) |
| Framework Backend | Laravel 10 o 11 |
| Gestor de paquetes | Composer 2.x (PHP) / npm (Node.js para assets) |
| Navegador cliente | Chrome 90+, Firefox 88+, Edge 90+ |
| Red | Red local LAN para acceso multi-usuario |

**3.2 Requisitos Funcionales**

**RF-001: Autenticación de Usuarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-001 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Autenticación de Usuarios |
| **CARACTERÍSTICAS** | El sistema debe permitir a los usuarios iniciar sesión con credenciales únicas (correo y contraseña) |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El sistema proveerá un formulario de login seguro. Las contraseñas se almacenarán encriptadas con bcrypt. Laravel Breeze o Jetstream gestionará la autenticación. Se incluirá protección CSRF. Se permitirá recuperación de contraseña por correo (configuración posterior). |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Seguridad) – RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-002: Gestión de Usuarios y Roles**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-002 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Usuarios y Roles |
| **CARACTERÍSTICAS** | CRUD completo de usuarios con asignación de roles diferenciados |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Administrador podrá crear, editar, activar/desactivar y eliminar usuarios. Cada usuario tendrá un rol: Administrador, Coordinador, Instructor o Aprendiz. El sistema usará Laravel Spatie Permission o gates/policies nativas para controlar el acceso por rol. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Seguridad) – RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-003: Gestión de Proyectos**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-003 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Proyectos |
| **CARACTERÍSTICAS** | Crear y administrar proyectos como contenedores de tableros relacionados |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Coordinador y Administrador pueden crear proyectos con nombre, descripción, fecha de inicio y fin, y asociarlos a una ficha de formación SENA. Un proyecto puede contener uno o más tableros Kanban. Se pueden agregar miembros al proyecto con roles específicos. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-004: Gestión de Tableros Kanban**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-004 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Tableros Kanban |
| **CARACTERÍSTICAS** | Creación y configuración de tableros con columnas personalizadas |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los tableros tendrán mínimo 3 columnas por defecto: 'Por Hacer', 'En Progreso' y 'Completado'. El Coordinador puede agregar, renombrar, reordenar y eliminar columnas. Cada tablero pertenece a un proyecto. La interfaz mostrará las tarjetas de tareas dentro de cada columna con información resumida. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) – RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-005: Gestión de Tareas / ****Tickets**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-005 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Tareas / Tickets |
| **CARACTERÍSTICAS** | CRUD completo de tareas con campos de información detallada |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Una tarea contendrá: título, descripción enriquecida, usuario asignado, prioridad (Alta/Media/Baja), etiquetas, fecha límite y columna de estado. Al hacer clic en una tarjeta se abrirá un panel lateral o modal con el detalle completo. Se registrará el historial de cambios de estado de cada tarea. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-006: Drag ****&**** Drop de Tareas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-006 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Arrastrar y Soltar Tareas (Drag & Drop) |
| **CARACTERÍSTICAS** | Mover tareas entre columnas arrastrándolas con el mouse o dedo (touch) |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Se implementará con la librería SortableJS o similar, integrada en las vistas Blade. Al soltar una tarea en una columna nueva, el sistema actualizará el estado vía petición AJAX/Fetch a la API REST de Laravel y registrará el cambio en el historial. Se validarán los permisos del usuario antes de guardar. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento) – RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-007: Sistema de Comentarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-007 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Sistema de Comentarios en Tareas |
| **CARACTERÍSTICAS** | Permitir que los usuarios agreguen comentarios dentro de cada tarea |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Dentro del detalle de una tarea, los miembros del proyecto podrán agregar comentarios de texto. Se mostrará el nombre del autor, fecha y hora del comentario. Los comentarios se guardarán en la tabla 'comments' relacionada con la tarea. El autor puede editar o eliminar su propio comentario. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-008: Notificaciones Internas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-008 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Notificaciones Internas del Sistema |
| **CARACTERÍSTICAS** | Alertar a los usuarios sobre eventos relevantes dentro de la plataforma |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Se generarán notificaciones en plataforma cuando: se asigne una tarea a un usuario, una tarea cambie de estado, se agregue un comentario a una tarea del usuario, o se aproxime la fecha límite de una tarea. Se usará el sistema de notificaciones de Laravel (database channel). Se mostrará un indicador de notificaciones no leídas en la barra de navegación. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-009: Filtros y Búsqueda**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-009 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Filtros y Búsqueda Avanzada de Tareas |
| **CARACTERÍSTICAS** | Filtrar y buscar tareas según múltiples criterios |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El tablero dispondrá de filtros por: usuario asignado, prioridad, etiqueta/categoría, estado (columna) y rango de fechas. También incluirá una barra de búsqueda por texto en título o descripción. Los filtros se aplicarán en tiempo real vía AJAX sin recargar la página. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-010: Reportes y Métricas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-010 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Módulo de Reportes y Métricas |
| **CARACTERÍSTICAS** | Generar reportes de avance y productividad por tablero, usuario y ficha |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Coordinador y Administrador podrán consultar: número de tareas por estado, carga de trabajo por instructor, tareas vencidas, tareas completadas en un rango de fechas y avance por ficha de formación. Los reportes se mostrarán con gráficas básicas (Chart.js) y podrán exportarse a PDF (usando la librería DomPDF de Laravel). |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) – RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-011: Asociación con Fichas de Formación SENA**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-011 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Asociación de Proyectos con Fichas SENA |
| **CARACTERÍSTICAS** | Relacionar proyectos y tareas con fichas de formación del SENA |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El sistema permitirá registrar las fichas de formación (número de ficha, nombre del programa, instructor titular) y asociarlas a proyectos y tableros. En los reportes se podrá filtrar por ficha. Esta relación facilita el seguimiento académico específico del contexto SENA. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**3.3 Requisitos No Funcionales**

**RNF-001: Disponibilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-001 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Disponibilidad del Sistema |
| **CARACTERÍSTICAS** | El sistema debe estar disponible durante el horario de actividades del SENA |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El sistema deberá operar sin interrupciones durante el horario laboral (7:00 AM – 9:00 PM). El tiempo de inactividad planificado para mantenimiento no debe superar 2 horas semanales y se realizará fuera del horario de mayor uso. En entorno local XAMPP, el servidor Apache debe estar en ejecución constante. |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-002: Seguridad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-002 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Seguridad del Sistema |
| **CARACTERÍSTICAS** | Proteger datos e impedir accesos no autorizados |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Las contraseñas se almacenarán con hash bcrypt. Se implementará protección CSRF en todos los formularios (ya incluida en Laravel). Se usará el sistema de autenticación de Laravel con sesiones seguras. Las rutas estarán protegidas con middleware de autenticación y autorización por rol. Se validarán todas las entradas del usuario para prevenir inyección SQL y XSS (validación Laravel + Eloquent ORM). |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-003: Rendimiento**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-003 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Rendimiento y Tiempos de Respuesta |
| **CARACTERÍSTICAS** | Garantizar respuestas rápidas para una experiencia de usuario fluida |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Las páginas principales del tablero Kanban deben cargar en menos de 2 segundos en condiciones normales de red local. Las operaciones AJAX (mover tarea, agregar comentario) deben responder en menos de 1 segundo. Se usará eager loading en Eloquent para evitar el problema N+1 de consultas. Se implementará paginación en listados extensos. |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-004: Usabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-004 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Usabilidad e Interfaz de Usuario |
| **CARACTERÍSTICAS** | Interfaz intuitiva, responsiva y accesible para usuarios no técnicos |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La interfaz usará Bootstrap 5 para garantizar diseño responsivo en dispositivos de escritorio y tablets. Los colores indicadores de prioridad (rojo=alta, amarillo=media, verde=baja) deben ser visibles e intuitivos. El tablero Kanban debe ser la vista principal con acceso en máximo 2 clics desde el login. Se incluirán tooltips y mensajes de ayuda contextual. |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-005: Mantenibilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-005 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Mantenibilidad del Código |
| **CARACTERÍSTICAS** | Código limpio, documentado y estructurado para facilitar mantenimiento futuro |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El código seguirá las convenciones PSR-12 de PHP y las buenas prácticas de Laravel (uso de migraciones, seeders, factories, eloquent relationships). Se documentarán los métodos principales con PHPDoc. Las rutas se organizarán en grupos por módulo en el archivo routes/web.php y routes/api.php. Se usará el patrón Repository para desacoplar la lógica de negocio de los controladores. |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RNF-006: Escalabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-006 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Escalabilidad |
| **CARACTERÍSTICAS** | El sistema debe poder escalar a múltiples sedes y usuarios en el futuro |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La arquitectura MVC de Laravel facilita la migración a un servidor en producción (hosting compartido o VPS). El diseño de base de datos soportará múltiples centros de formación mediante el campo 'center_id' en las tablas principales. La estructura de la aplicación permite agregar nuevos módulos sin afectar los existentes. |
| **PRIORIDAD DEL REQUERIMIENTO** | BAJA |

**4. VALIDACIÓN DE REQUISITOS**

**4.1 Construcción de Prototipos**

Para la validación de los requisitos funcionales, se construirán prototipos en las siguientes fases:

**Fase 1 – ****Wireframes**** (Baja Fidelidad):**

- Pantalla de Login y Registro de usuario.

- Dashboard principal con resumen de tareas.

- Vista de tablero Kanban con columnas y tarjetas.

- Formulario de creación/edición de tarea.

- Panel de administración de usuarios.

Herramientas sugeridas: Figma (gratuito) o Balsamiq para wireframes. Los prototipos serán validados con el Coordinador SENA antes del inicio del desarrollo.

**Fase 2 – Prototipo Funcional (MVP):**

- Autenticación funcional (RF-001).

- Tablero Kanban básico con columnas y tarjetas (RF-004, RF-005).

- Arrastrar y soltar tareas entre columnas (RF-006).

- Creación y asignación de tareas (RF-005).

**Fase 3 – Sistema Completo:**

- Todos los requisitos funcionales implementados.

- Módulo de reportes (RF-010).

- Notificaciones (RF-008).

- Pruebas de usuario con el equipo de coordinación.

**4.2 Formatos de Casos de Prueba**

| **FORMATO DE CASO DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA: **Verificar que un usuario registrado pueda iniciar sesión correctamente con credenciales válidas |
| **IDENTIFICADOR: **CP-001 |
| **NOMBRE DEL REQUERIMIENTO: **RF-001 – Autenticación de Usuarios |
| **PRECONDICIONES: **El usuario debe estar registrado en la base de datos con estado activo. El servidor XAMPP debe estar en ejecución. |
| **PASOS                                                                                 RESULTADOS ESPERADOS** |
| 1. Abrir el navegador y acceder a http://localhost/kanban-sena | 1. El formulario de login se muestra correctamente con campos de correo y contraseña |
| 2. En el formulario de login, ingresar correo válido registrado | 2. El campo acepta el correo sin errores de validación |
| 3. Ingresar la contraseña correcta del usuario | 3. El campo de contraseña muestra asteriscos y acepta la entrada |
| 4. Hacer clic en el botón 'Iniciar Sesión' | 4. El sistema procesa la solicitud de autenticación |
| 5. Verificar redirección al Dashboard del sistema | 5. El sistema redirige al dashboard con el nombre del usuario visible en la barra de navegación |

| **FORMATO DE CASO DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA: **Verificar que las tareas puedan moverse entre columnas mediante Drag & Drop y que el estado se actualice en la base de datos |
| **IDENTIFICADOR: **CP-002 |
| **NOMBRE DEL REQUERIMIENTO: **RF-006 – Arrastrar y Soltar Tareas (Drag & Drop) |
| **PRECONDICIONES: **El usuario Coordinador o Instructor debe estar autenticado. Debe existir al menos un tablero con tareas en la columna 'Por Hacer'. |
| **PASOS                                                                                 RESULTADOS ESPERADOS** |
| 1. Iniciar sesión con usuario Coordinador | 1. El dashboard y la lista de tableros se muestran correctamente |
| 2. Acceder al tablero Kanban del proyecto | 2. El tablero muestra las columnas con las tareas correspondientes |
| 3. Hacer clic y mantener presionado sobre una tarjeta en la columna 'Por Hacer' | 3. La tarjeta se resalta visualmente indicando que está siendo arrastrada |
| 4. Arrastrar la tarjeta hasta la columna 'En Progreso' y soltar | 4. La tarjeta se ubica visualmente dentro de la columna 'En Progreso' |
| 5. Verificar en la base de datos que el campo 'column_id' de la tarea cambió | 5. El estado de la tarea cambió a 'En Progreso' en BD y el historial registra el cambio |

| **FORMATO DE CASO DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA: **Verificar que un usuario sin permisos no pueda acceder a las rutas de administración del sistema |
| **IDENTIFICADOR: **CP-003 |
| **NOMBRE DEL REQUERIMIENTO: **RF-002 – Gestión de Usuarios y Roles (Restricción de acceso) |
| **PRECONDICIONES: **Debe existir un usuario con rol 'Aprendiz' registrado en el sistema. |
| **PASOS                                                                                 RESULTADOS ESPERADOS** |
| 1. Iniciar sesión con un usuario de rol 'Aprendiz' | 1. El sistema autentica al usuario Aprendiz y muestra su dashboard |
| 2. Intentar acceder manualmente a la URL http://localhost/kanban-sena/admin/users | 2. El middleware de autorización intercepta la solicitud |
| 3. Verificar la respuesta del sistema | 3. El sistema muestra error 403 (Acceso denegado) o redirige al dashboard con mensaje de error |
| 4. Intentar acceder a http://localhost/kanban-sena/admin/settings | 4. El sistema repite la restricción de acceso con mensaje apropiado |
| 5. Cerrar sesión y verificar que la ruta protegida tampoco es accesible sin autenticación | 5. El sistema redirige al formulario de login para usuarios no autenticados |

**APÉNDICE A: ARQUITECTURA Y STACK TÉCNICO**

Esta sección describe la arquitectura técnica propuesta para el desarrollo del sistema Kanban SENA utilizando Laravel y MySQL con XAMPP.

**Arquitectura MVC con Laravel**

El sistema seguirá el patrón Modelo-Vista-Controlador (MVC) implementado por el framework Laravel:

- Modelos (Model): Representan las entidades de la base de datos (User, Board, Column, Task, Comment, Notification). Usarán Eloquent ORM para las relaciones y consultas.

- Vistas (View): Plantillas Blade de Laravel con HTML, Bootstrap 5 y JavaScript. El Drag & Drop se implementará con SortableJS integrado en las vistas.

- Controladores (Controller): Procesarán las solicitudes HTTP, validarán datos con Form Requests de Laravel y responderán con vistas o JSON para peticiones AJAX.

**Estructura de Base de Datos – Entidades Principales**

| **TABLA** | **CAMPOS PRINCIPALES** | **RELACIONES** |
| --- | --- | --- |
| users | id, name, email, password, role_id, center_id, active | hasMany: tasks, comments, notifications |
| roles | id, name, slug (admin/coordinator/instructor/learner) | belongsToMany: users |
| fichas | id, numero_ficha, nombre_programa, instructor_id, fecha_inicio | hasMany: projects |
| projects | id, name, description, ficha_id, owner_id, start_date, end_date | hasMany: boards, belongsTo: ficha |
| boards | id, name, project_id, description, created_by | hasMany: columns, belongsTo: project |
| columns | id, name, board_id, order, color | hasMany: tasks, belongsTo: board |
| tasks | id, title, description, column_id, assigned_to, priority, due_date, created_by | hasMany: comments, belongsTo: column, user |
| comments | id, task_id, user_id, body, created_at | belongsTo: task, user |
| task_history | id, task_id, user_id, from_column, to_column, changed_at | belongsTo: task, user |
| notifications | id, user_id, type, data (JSON), read_at | belongsTo: user |

**Ruta de Desarrollo Sugerida (Hitos)**

| **SPRINT / FASE** | **ACTIVIDADES** | **ENTREGABLE** |
| --- | --- | --- |
| Sprint 1 (Semana 1-2) | Configuración XAMPP, Laravel, migraciones BD, autenticación con Laravel Breeze, gestión básica de usuarios | Login funcional + CRUD usuarios |
| Sprint 2 (Semana 3-4) | Módulo de Proyectos, Fichas SENA, Tableros y Columnas Kanban | Tableros con columnas configurables |
| Sprint 3 (Semana 5-6) | CRUD de Tareas, Drag & Drop con SortableJS + AJAX, historial de cambios | Tablero Kanban funcional completo |
| Sprint 4 (Semana 7-8) | Sistema de comentarios, notificaciones internas, filtros y búsqueda | Colaboración en tareas funcional |
| Sprint 5 (Semana 9-10) | Módulo de reportes, exportación PDF, ajustes de UI/UX con Bootstrap 5 | Reportes y dashboard de métricas |
| Sprint 6 (Semana 11-12) | Pruebas integrales, corrección de bugs, documentación técnica final y despliegue | Sistema entregable y documentado |

Página 1



---

<a id="06-README-senakan"></a>

# 📋 SenaKan

<img width="1408" height="768" alt="LOGO SENAKAN" src="https://github.com/user-attachments/assets/eeb821d4-4673-494e-bf9b-a57c3449f1fd" />

> Sistema de gestión de tareas tipo Kanban diseñado para el **SENA** — permite a coordinadores, instructores y aprendices organizar, asignar y hacer seguimiento de actividades formativas en tiempo real.

---

## 📌 Descripción

**SenaKan** es una plataforma web de gestión de proyectos inspirada en metodologías ágiles (Kanban/Jira), desarrollada específicamente para las necesidades del Servicio Nacional de Aprendizaje (SENA). Facilita la organización del trabajo académico mediante tableros visuales, asignación de tareas por roles y seguimiento del progreso de fichas de formación.

---

## ✨ Funcionalidades principales

- 🗂️ **Tableros Kanban** con columnas configurables: *Por Hacer → En Progreso → En Revisión → Completado*
- 🧩 **Gestión de tareas** con título, descripción, prioridad, fechas límite, etiquetas y adjuntos
- 👥 **Roles de usuario**: Administrador, Coordinador, Instructor, Aprendiz
- 📎 **Fichas de formación**: asociación de tareas a programas del SENA
- 🔔 **Notificaciones** en tiempo real vía WebSockets
- 📊 **Reportes e indicadores** institucionales
- 🔍 **Filtros y búsqueda avanzada** de tareas
- 📅 **Integración con calendario académico**
- 📱 **Diseño responsive** para acceso desde cualquier dispositivo

---

## 🏗️ Arquitectura

```
SenaKan/
├── frontend/          # React + TypeScript + TailwindCSS
├── backend/           # Node.js + NestJS (API RESTful)
├── database/          # PostgreSQL + Redis (caché/sesiones)
├── docs/              # Documentación IEEE y diagramas
└── tests/             # Casos de prueba y validaciones
```

### Stack tecnológico

| Capa        | Tecnología                        |
|-------------|-----------------------------------|
| Frontend    | React, TypeScript, TailwindCSS    |
| Backend     | Node.js, NestJS                   |
| Base de datos | PostgreSQL                      |
| ORM         | Prisma / TypeORM                  |
| Tiempo real | Socket.io                         |
| Autenticación | JWT                             |
| Caché       | Redis                             |

---

## 🗃️ Entidades del sistema

| Entidad        | Descripción                                  |
|----------------|----------------------------------------------|
| `Usuarios`     | Gestión de roles: admin, coordinador, instructor, aprendiz |
| `Proyectos`    | Agrupación de tableros por programa          |
| `Tableros`     | Visualización del flujo de trabajo           |
| `Columnas`     | Estados del flujo (configurables)            |
| `Tareas`       | Ítems de trabajo con metadatos               |
| `Comentarios`  | Discusiones internas por tarea               |
| `Adjuntos`     | Archivos vinculados a tareas                 |
| `Notificaciones` | Alertas automáticas del sistema            |

---

## 🚀 Instalación y uso

### Requisitos previos

- Node.js >= 18.x
- PostgreSQL >= 14
- Redis >= 6

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/senakan.git
cd senakan

# 2. Instalar dependencias del backend
cd backend
npm install
cp .env.example .env   # Configurar variables de entorno

# 3. Instalar dependencias del frontend
cd ../frontend
npm install

# 4. Ejecutar migraciones de base de datos
cd ../backend
npx prisma migrate dev

# 5. Iniciar en desarrollo
npm run dev            # Backend en http://localhost:3001
cd ../frontend
npm run dev            # Frontend en http://localhost:3000
```

---

## 📄 Documentación

El proyecto incluye documentación técnica bajo el estándar **IEEE 830** (Especificación de Requisitos de Software), que cubre:

- Introducción, objetivos y alcance
- Descripción general del producto
- Requisitos funcionales y no funcionales
- Casos de prueba y validación
- Prototipos y diagramas

> Consulta la carpeta `/docs` para acceder al documento completo.

---

## 👥 Roles y permisos

| Rol             | Permisos principales                                      |
|-----------------|-----------------------------------------------------------|
| Administrador   | Control total del sistema, gestión de usuarios y sedes   |
| Coordinador     | Crear/gestionar proyectos, asignar instructores           |
| Instructor      | Gestionar tareas propias, hacer seguimiento de aprendices |
| Aprendiz        | Ver y actualizar tareas asignadas                        |

---

## 🤝 Contribución

1. Haz un fork del proyecto
2. Crea tu rama de feature: `git checkout -b feature/nueva-funcionalidad`
3. Realiza tus cambios y haz commit: `git commit -m 'feat: agrega nueva funcionalidad'`
4. Sube la rama: `git push origin feature/nueva-funcionalidad`
5. Abre un Pull Request

---

## 📋 Estado del proyecto

| Fase           | Estado        |
|----------------|---------------|
| Documentación  | ✅ Completada  |
| MVP / Prototipo | 🔄 En progreso |
| Pruebas        | ⏳ Pendiente   |
| Despliegue     | ⏳ Pendiente   |

---

## 📝 Licencia

Este proyecto fue desarrollado como evidencia de formación para el **SENA** — Servicio Nacional de Aprendizaje, Colombia.

---

<p align="center">
  Desarrollado con ❤️ para el SENA · Colombia
</p>



---

<a id="07-IEEE-SRS-kanban-sena-react"></a>

**SENA — Sistema Kanban de Gestion de Tareas   **IEEE 830 v1.0

**SERVICIO NACIONAL DE APRENDIZAJE**

**SENA**

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

**ESPECIFICACION DE REQUISITOS DE SOFTWARE**

**Sistema de Gestion de Tareas Kanban**

Basado en el estandar IEEE 830

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

| **VERSION** | v1.0 - MVP |
| --- | --- |
| **FECHA** | Marzo 2026 |
| **ESTADO** | En Revision |
| **CENTRO** | Centro de Formacion SENA |
| **PROGRAMA** | Tecnologia en Desarrollo de Software |
| **FICHA** | 2758631 |

| **POR CLIENTE** | **DESARROLLADOR** |
| --- | --- |
| FECHA:  NOMBRE DEL ENCARGADO: | FECHA:  NOMBRE DEL ENCARGADO: |

# **FICHA DEL DOCUMENTO**

| **FECHA** | **REVISION(ES)** | **AUTOR(ES)** |
| --- | --- | --- |
| Marzo 2026 | Version inicial IEEE 830 | Equipo de Desarrollo |
|  |  |  |

DOCUMENTO VALIDADO POR LAS PARTES EN FECHA: ____________________

# **CONTENIDO**

1. INTRODUCCION

    1.1. Objetivo General

    1.2. Objetivos Especificos

    1.3. Proposito

    1.4. Alcance

    1.5. Personal Involucrado

    1.6. Definiciones, Acronimos y Abreviaturas

    1.7. Referencias

    1.8. Resumen

2. DESCRIPCION GENERAL

    2.1. Perspectiva del Producto

    2.2. Funcionalidades del Producto

    2.3. Caracteristicas de los Usuarios

    2.4. Restricciones

3. REQUISITOS ESPECIFICOS

    3.1. Requisitos del Sistema

    3.2. Requisitos Funcionales

    3.3. Requisitos No Funcionales

4. VALIDACION DE REQUISITOS

    4.1. Construccion de Prototipos

    4.2. Formato de Casos de Prueba

# **1. INTRODUCCION**

El SENA requiere una herramienta digital que permita gestionar de manera eficiente el flujo de tareas academicas y administrativas dentro de sus programas de formacion. Actualmente, el seguimiento de actividades de instructores y aprendices se realiza de forma manual o mediante herramientas dispersas, generando dificultades en la visibilidad del estado de los proyectos y en la asignacion de responsabilidades.

Este documento especifica los requisitos del Sistema de Gestion de Tareas Kanban para el SENA, siguiendo el estandar IEEE 830, con el objetivo de guiar el desarrollo de un software robusto, escalable y alineado con la identidad institucional.

## **1.1. Objetivo General**

Desarrollar un sistema de gestion de tareas tipo Kanban para el SENA que permita a coordinadores, instructores y aprendices visualizar, asignar y hacer seguimiento del estado de las actividades de formacion en tiempo real, mejorando la eficiencia operativa del centro educativo.

## **1.2. Objetivos Especificos**

- Implementar un tablero Kanban con flujo de estados configurable: Por Hacer, En Progreso, En Revision y Completado.

- Gestionar multiples roles de usuario: Administrador, Coordinador, Instructor y Aprendiz, con permisos diferenciados.

- Asociar tareas a fichas de formacion SENA para garantizar el seguimiento institucional.

- Proveer reportes y metricas de desempeno accesibles para coordinadores y administradores.

- Construir una arquitectura escalable que permita incorporar funcionalidades adicionales en versiones futuras.

## **1.3. Proposito**

El sistema Kanban SENA tiene como finalidad digitalizar y centralizar la gestion de actividades formativas, eliminando el uso de herramientas dispersas y proporcionando una plataforma unificada que respete los lineamientos institucionales del SENA en cuanto a roles, fichas de formacion y calendarios academicos.

## **1.4. Alcance**

El sistema cubrira las siguientes funciones dentro del centro de formacion:

- Autenticacion y gestion de usuarios por roles institucionales.

- Creacion y administracion de proyectos asociados a fichas de formacion.

- Tableros Kanban con columnas personalizables y arrastre de tareas (drag & drop).

- Asignacion de tareas a usuarios con prioridad, fecha limite y etiquetas.

- Sistema de comentarios por tarea para comunicacion contextual.

- Reportes basicos de avance por proyecto, instructor y aprendiz.

Fuera del alcance del MVP: carga de archivos adjuntos, integracion con calendario academico SENA, notificaciones en tiempo real, recuperacion de contrasena y soporte multitenancy por sede.

## **1.5. Personal Involucrado**

| **CAMPO** | **DETALLE** |
| --- | --- |
| **NOMBRE** | Equipo de Desarrollo — Ficha 2758631 |
| **ROL** | Analista / Desarrollador Full Stack |
| **PROFESION** | Tecnologo en Desarrollo de Software |
| **RESPONSABILIDADES** | Levantamiento de requisitos, diseno, desarrollo, pruebas y documentacion del sistema. |
| **INFORMACION DE CONTACTO** | Centro de Formacion SENA — Colombia |
| **APRUEBA** | SI — Entrevista y seguimiento validados por Coordinador y cliente. |

## **1.6. Definiciones, Acronimos y Abreviaturas**

| **TERMINO** | **DEFINICION** |
| --- | --- |
| **SENA** | Servicio Nacional de Aprendizaje — entidad colombiana de formacion profesional. |
| **Kanban** | Metodologia agil de gestion visual de trabajo mediante tableros y tarjetas. |
| **Ficha** | Numero identificador de un grupo de aprendices en un programa de formacion SENA. |
| **MVP** | Minimum Viable Product — version funcional basica del software con caracteristicas esenciales. |
| **JWT** | JSON Web Token — estandar de autenticacion sin estado basado en tokens firmados digitalmente. |
| **ORM** | Object-Relational Mapping — capa de abstraccion entre codigo orientado a objetos y base de datos relacional. |
| **API** | Application Programming Interface — interfaz de comunicacion entre sistemas de software. |
| **REST** | Representational State Transfer — estilo arquitectonico para APIs HTTP. |
| **Drag ****&**** Drop** | Funcionalidad de arrastrar y soltar elementos en la interfaz grafica de usuario. |
| **Rol** | Conjunto de permisos asignados a un tipo de usuario dentro del sistema. |
| **Board** | Tablero visual que agrupa columnas y tareas de un proyecto. |
| **Task** | Unidad de trabajo asignable dentro del sistema Kanban. |
| **Prisma** | ORM moderno para Node.js que permite gestionar bases de datos con TypeScript. |
| **SQLite** | Base de datos relacional embebida, usada en el entorno de desarrollo local. |
| **PostgreSQL** | Sistema de gestion de bases de datos relacional robusto, usado en produccion. |
| **Zustand** | Libreria de gestion de estado global ligera para aplicaciones React. |
| **Recharts** | Libreria de visualizacion de datos y graficos para React. |

## **1.7. Referencias**

- IEEE Std 830-1998 — Recommended Practice for Software Requirements Specifications.

- Documentacion oficial de React 18: https://react.dev

- Documentacion de Prisma ORM: https://prisma.io/docs

- Atlassian Jira — referencia de sistema Kanban empresarial: https://atlassian.com/software/jira

- Manual de Identidad Visual SENA 2024.

- Documento: Como funcionan los sistemas Kanban — contexto tecnico del proyecto.

- Documento tecnico: Prompt MVP Sistema Kanban SENA v1.0.

## **1.8. Resumen**

Este documento contiene la especificacion completa de requisitos del Sistema Kanban SENA, organizado en cuatro secciones: Introduccion (contexto y alcance), Descripcion General (arquitectura y usuarios), Requisitos Especificos (funcionales y no funcionales) y Validacion de Requisitos (casos de prueba).

# **2. DESCRIPCION GENERAL**

## **2.1. Perspectiva del Producto**

El Sistema Kanban SENA es una aplicacion web de tres capas (frontend React, backend Node.js/Express, base de datos SQLite/PostgreSQL) que opera de manera independiente sobre infraestructura local o en la nube. Se integra con el modelo institucional del SENA mediante la gestion de fichas de formacion y roles jerarquicos. No depende de sistemas externos en su version MVP.

La interfaz sigue la identidad visual institucional del SENA: color verde (#39A900) y azul navy (#003770), tipografia Arial, logotipo institucional en el panel lateral y pantalla de inicio. El sistema es responsive y accesible desde dispositivos moviles con pantalla mayor a 360px.

## **2.2. Funcionalidades del Producto**

- Autenticacion segura con JWT y control de sesion diferenciado por rol.

- Dashboard con metricas: tareas totales, en progreso, vencidas y completadas.

- Gestion de proyectos asociados a fichas de formacion SENA.

- Tableros Kanban con drag & drop entre columnas configurables.

- Creacion, edicion y eliminacion de tareas con prioridad, asignacion y fecha limite.

- Sistema de comentarios por tarea para comunicacion contextual.

- Gestion de usuarios con activacion/desactivacion por rol.

- Reportes basicos de avance con visualizacion grafica mediante Recharts.

## **2.3. Caracteristicas de los Usuarios**

### **ADMINISTRADOR**

Acceso total al sistema. Gestiona usuarios, proyectos, tableros y reportes globales. Es el responsable de la configuracion inicial y de la administracion de cuentas de usuario. Puede realizar cualquier operacion en el sistema.

### **COORDINADOR**

Crea proyectos y los asocia a fichas de formacion. Asigna instructores y supervisa el avance de todos los tableros del centro. Accede a reportes institucionales. No puede eliminar usuarios del sistema.

### **INSTRUCTOR**

Gestiona los tableros de sus proyectos asignados. Crea, edita y mueve tareas. Visualiza unicamente a sus aprendices asociados. No accede a las vistas de Usuarios ni a Reportes globales del centro.

### **APRENDIZ**

Visualiza los tableros de su ficha de formacion. Puede mover sus propias tareas entre columnas y agregar comentarios. No puede crear, editar ni eliminar tareas de otros usuarios.

## **2.4. Restricciones**

- El sistema debe funcionar en navegadores modernos: Chrome 110+, Firefox 115+, Edge 110+, Safari 16+.

- El MVP utilizara SQLite como base de datos local; la migracion a PostgreSQL es transparente (solo requiere cambio de variable de entorno DATABASE_URL).

- No se permiten archivos adjuntos en tareas en la version MVP.

- No habra integracion con sistemas externos del SENA (SOFIA Plus) en el MVP.

- Los aprendices no pueden visualizar informacion de otras fichas de formacion.

- Solo los Administradores pueden eliminar y cambiar roles de usuarios.

- La recuperacion de contrasenias estara disponible a partir de la version 2.0.

# **3. REQUISITOS ESPECIFICOS**

## **3.1. Requisitos del Sistema**

| **COMPONENTE** | **ESPECIFICACION MINIMA** |
| --- | --- |
| **Sistema Operativo** | Windows 10+, macOS 12+, Ubuntu 22.04+ (servidor) |
| **Procesador** | 2 nucleos / 2 GHz o superior |
| **Memoria RAM** | 4 GB minimo (8 GB recomendado para desarrollo) |
| **Almacenamiento** | 500 MB libres para el sistema y la base de datos |
| **Node.js** | v20 LTS o superior |
| **Navegador** | Chrome 110+, Firefox 115+, Edge 110+, Safari 16+ |
| **Resolucion minima** | 1280 x 720 px |
| **Conexion de red** | LAN o Internet para acceso multiusuario |

## **3.2. Requisitos Funcionales**

### **RF-001 — Autenticacion de Usuarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-001** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Autenticacion de Usuarios |
| **CARACTERÍSTICAS** | El sistema debe permitir el ingreso seguro de usuarios mediante credenciales unicas. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Se presenta una pantalla de login con campos de email y contrasenia. Al ingresar credenciales validas, el sistema genera un token JWT que se almacena en el cliente y redirige al usuario segun su rol. Si las credenciales son incorrectas, muestra un mensaje de error sin revelar cual campo fallo. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Seguridad), RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-002 — Gestion de Proyectos**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-002** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestion de Proyectos |
| **CARACTERÍSTICAS** | Crear, editar y desactivar proyectos asociados a fichas de formacion SENA. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los roles Administrador y Coordinador pueden crear proyectos con nombre, descripcion y numero de ficha. Cada proyecto puede tener multiples tableros. Los proyectos se desactivan logicamente (activo=false) pero no se eliminan fisicamente para preservar el historial. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Integridad de datos) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-003 — Tablero Kanban**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-003** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Tablero Kanban |
| **CARACTERÍSTICAS** | Visualizar y gestionar el flujo de tareas mediante un tablero con columnas y arrastre de tarjetas. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El tablero muestra columnas predeterminadas (Por Hacer, En Progreso, En Revision, Completado). Las tareas se presentan como tarjetas con titulo, prioridad, usuario asignado y fecha limite. El usuario puede arrastrar tarjetas entre columnas. Al soltar la tarjeta, el sistema llama a PATCH /api/v1/tasks/:id/move y actualiza el estado en la base de datos. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento), RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-004 — Gestion de Tareas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-004** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestion de Tareas |
| **CARACTERÍSTICAS** | Crear, editar, asignar y eliminar tareas dentro de los tableros. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los usuarios autorizados pueden crear tareas con: titulo (obligatorio), descripcion, prioridad (Alta/Media/Baja), usuario asignado, fecha limite y etiquetas. Las tareas se editan mediante un modal emergente. Solo Administrador, Coordinador e Instructor pueden eliminar tareas. Los Aprendices solo pueden mover y comentar sus propias tareas. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Integridad), RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-005 — Sistema de Comentarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-005** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Sistema de Comentarios |
| **CARACTERÍSTICAS** | Agregar y visualizar comentarios en cada tarea para comunicacion contextual entre usuarios. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Desde el modal de tarea, cualquier usuario con acceso al proyecto puede escribir y enviar comentarios. Los comentarios se muestran en orden cronologico con nombre del autor, rol y fecha/hora. No es posible editar ni eliminar comentarios en el MVP. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **MEDIA** |

### **RF-006 — Gestion de Usuarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-006** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestion de Usuarios |
| **CARACTERÍSTICAS** | Crear, editar y activar/desactivar cuentas de usuario con roles institucionales. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Administrador accede a la vista de Usuarios y puede crear nuevas cuentas con: nombre, email, contrasenia temporal, rol y ficha. Puede activar o desactivar usuarios mediante un toggle. Los usuarios desactivados no pueden iniciar sesion. Solo el Administrador puede modificar roles de usuario. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Seguridad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-007 — Dashboard de Metricas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-007** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Dashboard de Metricas |
| **CARACTERÍSTICAS** | Visualizar indicadores clave de rendimiento del sistema al iniciar sesion. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La pantalla principal muestra: total de tareas del usuario, tareas en progreso, tareas vencidas (fecha limite superada) y tareas completadas. Incluye lista de Mis tareas pendientes filtrada por el usuario logueado y acceso rapido a proyectos activos. Las metricas se calculan desde la API en cada carga del dashboard. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento), RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-008 — Reportes de Avance**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-008** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Reportes de Avance |
| **CARACTERÍSTICAS** | Generar y visualizar reportes graficos del estado de tareas por proyecto y usuario. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Disponible solo para Administrador y Coordinador. Muestra: grafico de barras con tareas por estado (Recharts), tabla de tareas por instructor/aprendiz e indicador de tareas vencidas. Los datos se consultan desde el backend y se renderizan en el cliente sin generar archivos. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | **MEDIA** |

### **RF-009 — Control de Acceso por Rol**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-009** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Control de Acceso por Rol |
| **CARACTERÍSTICAS** | Restringir el acceso a vistas y operaciones segun el rol del usuario autenticado. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El backend implementa un middleware requireRole() que verifica el JWT y el rol antes de cada endpoint protegido. El frontend oculta rutas y botones segun el rol del usuario. Un Aprendiz que intente acceder a /usuarios recibe error 403. Las rutas protegidas redirigen al Dashboard si el rol no tiene permisos suficientes. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Seguridad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

## **3.3. Requisitos No Funcionales**

### **RNF-001 — Seguridad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-001** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Seguridad del Sistema |
| **CARACTERÍSTICAS** | Proteger los datos y accesos del sistema contra uso no autorizado. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Las contrasenias se almacenan con hash bcrypt (salt rounds=12). Los tokens JWT tienen expiracion de 8 horas. Todas las rutas de la API (excepto /auth/login) requieren token valido. Variables sensibles (JWT_SECRET, DATABASE_URL) se gestionan exclusivamente mediante variables de entorno en archivo .env, nunca en el codigo fuente. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-002 — Integridad de Datos**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-002** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Integridad de Datos |
| **CARACTERÍSTICAS** | Garantizar la consistencia y trazabilidad de la informacion almacenada. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El esquema Prisma define relaciones con integridad referencial. Proyectos y usuarios se desactivan logicamente (campo activo:false) en lugar de eliminarse fisicamente. Cada tarea registra campos createdAt y updatedAt para auditoria. Las operaciones criticas usan transacciones de base de datos. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-003 — Rendimiento**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-003** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Rendimiento y Tiempos de Respuesta |
| **CARACTERÍSTICAS** | El sistema debe responder de manera eficiente bajo carga de uso normal. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los endpoints de la API deben responder en menos de 500ms bajo carga normal (hasta 50 usuarios simultaneos). La carga inicial del tablero con hasta 100 tareas no debe superar 2 segundos. El frontend implementa estado local con Zustand para minimizar llamadas redundantes a la API. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-004 — Usabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-004** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Usabilidad e Interfaz de Usuario |
| **CARACTERÍSTICAS** | La interfaz debe ser intuitiva y accesible para usuarios sin formacion tecnica avanzada. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El diseno sigue la identidad visual SENA: verde #39A900 y navy #003770. La interfaz es responsive y funciona en dispositivos moviles con pantalla mayor a 360px. Los mensajes de error son claros y orientados al usuario final. El sistema incluye indicadores de carga (spinners) en todas las operaciones asincronas. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-005 — Escalabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-005** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Escalabilidad Tecnica |
| **CARACTERÍSTICAS** | El sistema debe poder escalar en usuarios, datos y funcionalidades sin refactorizacion mayor. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La arquitectura separa frontend/backend/base de datos en capas independientes. El ORM Prisma permite cambiar SQLite por PostgreSQL modificando solo la variable DATABASE_URL. La API esta versionada desde /api/v1/. Los controladores estan separados de las rutas para facilitar migracion futura a NestJS. Los stores de Zustand estan desacoplados de los componentes. |
| **PRIORIDAD DEL REQUERIMIENTO** | **MEDIA** |

# **4. VALIDACION DE REQUISITOS**

## **4.1. Construccion de Prototipos**

Se construira un prototipo funcional del MVP con las siguientes vistas implementadas en orden de prioridad:

- Pantalla de Login con autenticacion JWT real contra base de datos.

- Dashboard con metricas calculadas dinamicamente desde la API.

- Tablero Kanban con drag & drop funcional y persistencia de cambios.

- Modal de tarea con creacion, edicion y sistema de comentarios.

- Vista de Gestion de Usuarios (solo rol ADMINISTRADOR).

- Reportes basicos con grafico de barras (Recharts).

El prototipo utilizara datos de seed que incluyen un usuario de prueba por cada rol, un proyecto con ficha asignada y tareas en distintos estados del tablero.

## **4.2. Formato de Casos de Prueba**

### **CP-001 — Login con credenciales validas**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un usuario con credenciales validas puede iniciar sesion y es redirigido segun su rol. |
| **IDENTIFICADOR** | CP-001 |
| **NOMBRE DEL REQUERIMIENTO** | RF-001 — Autenticacion de Usuarios |
| **PRECONDICIONES** | El sistema esta en funcionamiento. La base de datos contiene el usuario: admin@sena.edu.co / Admin123! |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Abrir la URL del sistema en el navegador. | 1. Se muestra la pantalla de login sin errores. |
| 2. Ingresar email: admin@sena.edu.co | 2. El campo de email acepta el valor ingresado. |
| 3. Ingresar contrasenia: Admin123! | 3. El campo de contrasenia oculta el texto con asteriscos. |
| 4. Hacer clic en el boton Ingresar. | 4. El sistema valida las credenciales, genera un JWT y redirige al Dashboard del Administrador con todas las vistas habilitadas. |

### **CP-002 — Mover tarea entre columnas (Drag ****&**** Drop)**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un Instructor puede mover una tarea de Por Hacer a En Progreso mediante arrastre. |
| **IDENTIFICADOR** | CP-002 |
| **NOMBRE DEL REQUERIMIENTO** | RF-003 — Tablero Kanban |
| **PRECONDICIONES** | Usuario Instructor autenticado. Proyecto activo con tablero. Tarea existente en columna Por Hacer. |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Iniciar sesion como instructor@sena.edu.co | 1. El sistema muestra el tablero con columnas y tareas correctamente. |
| 2. Navegar al tablero del proyecto asignado. | 2. La tarjeta es tomada y muestra efecto visual de arrastre. |
| 3. Hacer clic y mantener sobre la tarjeta de tarea en la columna Por Hacer. | 3. La columna destino indica la zona de drop activa. |
| 4. Arrastrar la tarjeta sobre la columna En Progreso y soltar. | 4. La tarjeta aparece en la columna En Progreso. El endpoint PATCH /api/v1/tasks/:id/move responde HTTP 200. La base de datos actualiza el columnId de la tarea correctamente. |

### **CP-003 — Control de acceso por rol (Aprendiz intenta acceder a Usuarios)**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un Aprendiz no puede acceder a la vista de Gestion de Usuarios. |
| **IDENTIFICADOR** | CP-003 |
| **NOMBRE DEL REQUERIMIENTO** | RF-009 — Control de Acceso por Rol |
| **PRECONDICIONES** | Usuario Aprendiz autenticado con sesion activa. |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Iniciar sesion como aprendiz@sena.edu.co | 1. El sistema permite el login y redirige al Dashboard restringido para Aprendiz. |
| 2. Verificar que el sidebar no muestra el enlace a Usuarios. | 2. El sidebar no muestra el enlace a Usuarios. |
| 3. Intentar navegar manualmente a /usuarios en la barra del navegador. | 3. El sistema intercepta la navegacion y muestra un mensaje de Acceso denegado o redirige al Dashboard. |
| 4. Observar el comportamiento del sistema. | 4. El backend retorna HTTP 403 si se intenta llamar a GET /api/v1/users sin los permisos correctos. |

### **CP-004 — Crear tarea nueva en tablero**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un Instructor puede crear una nueva tarea en un tablero asignado. |
| **IDENTIFICADOR** | CP-004 |
| **NOMBRE DEL REQUERIMIENTO** | RF-004 — Gestion de Tareas |
| **PRECONDICIONES** | Instructor autenticado. Proyecto con tablero disponible. Al menos un Aprendiz asignado al proyecto. |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Iniciar sesion como instructor@sena.edu.co | 1. El sistema muestra el tablero correctamente con columnas visibles. |
| 2. Abrir el tablero del proyecto asignado. | 2. La columna muestra el boton + Tarea habilitado. |
| 3. Hacer clic en + Tarea en la columna Por Hacer. | 3. El modal se abre con todos los campos vacios y listos para ingresar datos. |
| 4. Completar el modal: Titulo: Tarea de Prueba, Prioridad: Alta, asignar al aprendiz disponible. | 4. Los campos aceptan los valores ingresados correctamente. |
| 5. Hacer clic en el boton Guardar. | 5. La tarea aparece como tarjeta en la columna Por Hacer con titulo visible, badge rojo de prioridad Alta y avatar del aprendiz asignado. El endpoint POST /api/v1/tasks retorna HTTP 201. |

**FIN DEL DOCUMENTO**

Especificacion de Requisitos de Software — Sistema Kanban SENA — v1.0 — Marzo 2026

	Documento Confidencial SENA   	   Pagina



---

<a id="08-guia-aprendizaje-implantacion"></a>

# Guía de Aprendizaje — Documentación de Implantación de Software

**PROCESO DE GESTIÓN DE FORMACIÓN PROFESIONAL INTEGRAL**
Formato GFPI-F-135 Versión 4 | Código: GFPI-F-135

---

## 1. Identificación de la Guía de Aprendizaje

| Campo | Detalle |
|-------|---------|
| **Denominación del Programa** | Análisis y Desarrollo de Software |
| **Código del Programa** | 228118 |
| **Nombre del Proyecto** | Desarrollo de un software integrador de tecnologías que cumpla con los requerimientos del cliente en procesos que se lleven a cabo en el sector productivo de la región |
| **Fase del Proyecto** | Evaluación / Implantación |
| **Actividad de Proyecto** | Desarrollar las tareas de configuración y puesta en marcha del software |
| **Competencia** | 220501097 - Implementar la solución de software de acuerdo con los requisitos de operación y modelos de referencia |
| **Resultados de Aprendizaje** | 03. Documentar el proceso de implantación de software siguiendo estándares de calidad |
| **Duración de la Guía** | 96 horas |

---

## 2. Presentación

Guía de aprendizaje diseñada por el instructor **JOSÉ GERMÁN ESTRADA CLAVIJO** para desarrollar la competencia de **documentar profesionalmente el proceso de implantación de software**, aplicando estándares de calidad, normas técnicas y buenas prácticas de la industria.

Durante **96 horas** de formación intensiva, el aprendiz aprenderá a elaborar manuales técnicos, de instalación y de usuario, documentar planes de migración y respaldo de datos, y estructurar informes de implantación con altos estándares de calidad.

**Propósito:** Desarrollar la capacidad de documentar todas las fases del proceso de implantación de software, aplicando estándares de calidad (ISO/IEC 25000, IEEE), normas ICONTEC/APA y buenas prácticas de redacción técnica.

---

## 3. Formulación de las Actividades de Aprendizaje

### 3.1 Actividades de reflexión inicial (10 horas)

**Situación problémica:** El software de gestión de inventarios y pedidos para "Alimentos del Campo S.A.S." ha sido desarrollado exitosamente y superó las pruebas funcionales. Sin embargo, al momento de planificar la implantación, el equipo descubre que no existe documentación técnica del proceso de despliegue, no hay manuales para los usuarios, ni se ha documentado el plan de migración de datos.

**Ejercicios de reflexión:**

1. **(2h)** Análisis de documentación deficiente — Investigar 3 casos reales donde mala documentación causó problemas
2. **(2h)** Importancia de los estándares de calidad — ISO/IEC 25000, IEEE 829
3. **(2h)** Tipos de manuales de software — Manual técnico vs. instalación vs. usuario
4. **(2h)** Consecuencias de la falta de documentación
5. **(2h)** Debate en foro virtual sobre habilidades de redacción técnica

### 3.2 Actividades de contextualización (12 horas)

1. **(2h)** Autodiagnóstico de habilidades de redacción técnica
2. **(2h)** Estructura de una documentación de implantación — Mapa mental
3. **(2h)** Vocabulario técnico de documentación — 25 términos clave
4. **(2h)** Análisis de estándares de calidad — ISO/IEC 25000, IEEE 829, ICONTEC
5. **(2h)** Tipos de diagramas técnicos
6. **(2h)** Foro de discusión sobre herramientas digitales

### 3.3 Actividades de apropiación (54 horas — 17 ejercicios prácticos)

#### Módulo 1: Fundamentos de Documentación Técnica (8 horas)

1. **(2h)** Estructura base de un documento técnico
2. **(3h)** Control de versiones de documentos
3. **(3h)** Redacción clara y efectiva

#### Módulo 2: Manuales de Usuario y Guías Rápidas (10 horas)

4. **(3h)** Elaboración de manual de usuario
5. **(3h)** Creación de guías rápidas (Quick Start Guides)
6. **(2h)** Captura de pantalla y anotación
7. **(2h)** Uso de simuladores interactivos

#### Módulo 3: Manual Técnico y de Instalación (12 horas)

8. **(3h)** Manual técnico del software
9. **(3h)** Manual de instalación paso a paso
10. **(3h)** Documentación de scripts de despliegue
11. **(3h)** Lista de verificación de pre-instalación

#### Módulo 4: Planes de Migración, Respaldo y Recuperación (10 horas)

12. **(3h)** Plan de migración de datos
13. **(3h)** Plan de respaldo (backup) y restauración
14. **(2h)** Procedimiento de rollback ante fallos
15. **(2h)** Matriz de tiempos de inactividad

#### Módulo 5: Informes, Actas y Cierre de Implantación (8 horas)

16. **(4h)** Informe final de implantación
17. **(4h)** Acta de entrega y aceptación del software

### 3.4 Actividades de Transferencia del Conocimiento (20 horas)

**Proyecto Final (16h):** Documentación completa de implantación para el Proyecto Formativo, incluyendo:

- Manual de usuario completo
- Guía rápida de inicio (1 página)
- Manual técnico del software
- Manual de instalación paso a paso
- Plan de migración de datos
- Plan de respaldo y restauración
- Procedimiento de rollback y contingencia
- Informe final de implantación
- Acta de entrega y aceptación del software
- Listas de verificación

**Sustentación (4h):** Presentación y defensa del paquete de documentación ante el instructor.

---

## 4. Evidencias de Aprendizaje

**Resumen:** 19 evidencias evaluables (17 ejercicios de apropiación + 1 paquete documental + 1 sustentación).

---

## 5. Glosario de Términos

| Término | Definición |
|---------|-----------|
| **Implantación de Software** | Proceso de instalar, configurar y poner en producción una aplicación de software |
| **Manual de Usuario** | Documento que explica a los usuarios finales cómo utilizar el software |
| **Manual Técnico** | Documento dirigido a desarrolladores con arquitectura y configuraciones |
| **Manual de Instalación** | Instrucciones paso a paso para instalar el software |
| **Migración de Datos** | Proceso de transferir datos desde un sistema antiguo a uno nuevo |
| **Plan de Respaldo** | Estrategia para realizar copias de seguridad y restaurarlas |
| **Rollback** | Procedimiento para revertir un despliegue a una versión anterior |
| **Acta de Entrega** | Documento legal que formaliza la transferencia del software |
| **Lista de Verificación** | Herramienta de control que enumera condiciones a cumplir |
| **Lecciones Aprendidas** | Documentación de experiencias positivas y negativas |
| **Normas ICONTEC** | Reglas colombianas para presentación de trabajos escritos |
| **IEEE 829** | Estándar internacional para documentación de pruebas de software |
| **ISO/IEC 25000 (SQuaRE)** | Estándar para evaluación de calidad de productos de software |

---

## 6. Referentes Bibliográficos

- Pressman, R. S. (2010). *Ingeniería del software: un enfoque práctico* (7ª ed.). McGraw-Hill.
- Sommerville, I. (2011). *Ingeniería de software* (9ª ed.). Pearson Educación.
- ISO/IEC 25000:2014. *Systems and software engineering — SQuaRE*.
- IEEE Std 829-2008. *IEEE Standard for Software and System Test Documentation*.
- ICONTEC. (2022). *NTC 1486: Documentación*.
- Microsoft. (2024). *Writing Style Guide for Technical Documentation*.
- Google. (2024). *Technical Writing Courses*.

---

## 7. Control del Documento

| Nombre | Cargo | Dependencia | Fecha |
|--------|-------|-------------|-------|
| **JOSÉ GERMÁN ESTRADA CLAVIJO** | Instructor Técnico | Centro de Procesos Industriales y de Construcción - Regional Caldas | DD/MM/AAAA |

---

*Formato GFPI-F-135 Versión 4 — 96 horas | 17 ejercicios prácticos + 1 paquete documental integrador*
*© Servicio Nacional de Aprendizaje (SENA) — Centro de Procesos Industriales y de Construcción - Regional Caldas*



---

<a id="09-diagramas-clases-kanban"></a>

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



---

<a id="10-documentacion-implantacion"></a>

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



---

<a id="11-arquitectura-kanban-sena"></a>

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



---

<a id="12-manual-usuario-kanban-sena"></a>

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



---

<a id="13-manual-identidad-visual-sena-2024"></a>

# Manual de Identidad Visual SENA 2024

---

## Tabla de Contenido

1. Bienvenido
2. Símbolos
3. Arquitectura del Color
4. Tipografía
5. Marcaciones
6. Cobranding
7. Iconografía
8. Fotografía
9. Aplicaciones Visuales
10. Aplicaciones Audiovisuales
11. Recursos

---

## 01. Bienvenido

### ¿Qué es el manual de identidad?

En el Manual de Identidad Visual SENA se establecen y definen los lineamientos de aplicación de marca que logran proyectar una imagen institucional sólida que respalda a los públicos objetivos de la Entidad.

Los elementos básicos y plantillas que lo componen son aptos para ser utilizados o reproducidos con propósitos de diseño y artes finales, estos archivos no deben ser modificados o alterados de ninguna forma.

Este manual ha sido actualizado de acuerdo a lo establecido en la Ley 2345 de 2023 por medio de la cual se implementa el manual de identidad visual de las entidades estatales.

### ¿Quiénes somos?

El SENA, la entidad más querida por los colombianos, es un establecimiento público del orden Nacional y con autonomía administrativa, adscrito al Ministerio del Trabajo. Está encargado de cumplir la función que le corresponde al Estado de invertir en el desarrollo social y técnico de los trabajadores colombianos, ofreciendo y ejecutando la formación profesional integral (Ley 119/1994).

---

## 02. Símbolos

### Historia del logosímbolo SENA

El logosímbolo del SENA fue creado mediante la Resolución 1582 de 1984. Representa al hombre en un camino hacia el horizonte, incorporando conceptos filosóficos sobre la formación profesional.

Con la Resolución 00334 del 29 de febrero de 2012 se realizó un cambio en su construcción geométrica y tipográfica sin variar el concepto.

### Logosímbolo

Es el elemento principal de la imagen institucional. No deberá alterarse en sus proporciones, ni en su construcción geométrica y tipográfica.

#### Versiones permitidas:
- **Uso principal** (verde sobre fondo claro)
- **Negativo** (blanco sobre fondo oscuro)
- **Positivo en blanco y negro**

#### Logosímbolo responsive
Cuando la legibilidad no sea suficiente se permite desagregar el logo siempre y cuando conserve las características establecidas.

#### Tamaños mínimos
- **Impresos:** 1 cm
- **Digital:** 50 px

#### Área de seguridad
El círculo superior del logo se usa como referencia para determinar las márgenes mínimas.

### Usos incorrectos

- No rellenar con degradados
- No aplicar sombra, volumen, bisel o efectos
- No usar sobre fondos de bajo contraste
- No rotarlo
- No modificar el orden o proporción
- No usar colores diferentes a verde, blanco o negro
- No cambiar su tipografía
- No agregar elementos decorativos
- No distorsionar ni alterar proporciones
- No usar versiones anteriores

---

## 03. Arquitectura del Color

### Concepto

El verde simboliza la vida, la naturaleza, los recursos naturales. Se asocia con la prosperidad y con la riqueza que produce el campo.

### Paleta de Colores Institucionales

| Color | HEX | CMYK | RGB |
|-------|-----|------|-----|
| **Verde institucional** | #39A900 | C:75 M:0 Y:100 K:0 | R:57 G:169 B:0 |
| **Azul oscuro** | #00304D | C:100 M:77 Y:43 K:42 | R:0 G:48 B:77 |
| **Verde oscuro** | #007832 | C:88 M:27 Y:100 K:14 | R:0 G:120 B:150 |
| **Violeta** | #71277A | C:68 M:98 Y:11 K:2 | R:113 G:39 B:122 |
| **Amarillo** | #FDC300 | C:0 M:25 Y:94 K:0 | R:53 G:195 B:0 |
| **Azul claro** | #50E5F9 | C:55 M:0 Y:11 K:0 | R:80 G:229 B:249 |
| **Gris claro** | #F6F6F6 | C:4 M:3 Y:4 K:0 | R:246 G:246 B:246 |
| **Blanco** | #FFFFFF | — | R:255 G:255 B:255 |
| **Negro** | #000000 | — | R:0 G:0 B:0 |

### Casos de uso

- **Caso 1 — Blanco predominante:** 80% blanco, 20% verde. Para comunicación institucional y piezas formales.
- **Caso 2 — Verde predominante:** 80% verde, 20% blanco. Para posicionamiento del color corporativo.
- **Caso 3 — Fotografía predominante:** Con aplicaciones del color corporativo en elementos.

El logosímbolo SENA siempre debe estar presente en verde corporativo, blanco o negro.

---

## 04. Tipografía

### Tipografía principal: Work Sans

Variaciones disponibles: Light, Regular, Medium, SemiBold, Bold, ExtraBold, Black (y sus itálicas).

**No se recomienda** utilizar las variaciones Thin ni ExtraLight por criterios de accesibilidad.

### Tipografía secundaria: Calibri

Para piezas de divulgación de servicios, boletines internos y página web.

---

## 05. Marcaciones

### Identificador de programas, servicios y productos internos

Aplicación del logo SENA seguido de la línea vertical y el texto en Work Sans. La distancia entre los logos y la línea debe ser el equivalente al tamaño del círculo superior del logosímbolo.

Se permite la presencia de hasta dos identificadores junto al logo SENA. Si son tres o más, se usa únicamente el logo SENA.

---

## 06. Cobranding

### SENA + entidades del Estado
Todos los logos se disponen horizontalmente, separados por una línea vertical, según el Manual de Identidad Visual del Gobierno de Colombia.

### SENA + otras instituciones o empresas
El logosímbolo SENA debe ir primero, en la parte superior.

---

## 07. Iconografía

Se deben implementar íconos sin relleno, compuestos solo por una línea de contorno. Mantener las proporciones del contorno de la línea de los íconos para evitar distorsión.

---

## 08. Fotografía

Las fotografías deben comunicar el concepto de marca, ser positivas, promover el emprendimiento, la innovación y el trabajo en equipo. No está permitido utilizar imágenes negativas ni tipografía sobre imágenes con baja legibilidad.

---

## 09. Aplicaciones Visuales

Incluye lineamientos para: boletín de prensa, carné, backing genérico, pendón, aulas móviles, vehículos, vestuario, señalización, fachadas, placas de inauguración, presentaciones digitales, firma digital.

---

## 10. Aplicaciones Audiovisuales

Lineamientos para marcación horizontal y vertical en video, banners informativos, subtítulos e intérprete de lengua de señas.

---

## 11. Recursos

Descarga de documentos disponible en el repositorio SharePoint de la Oficina de Comunicaciones.

---

*MANUAL DE IDENTIDAD VISUAL SENA 2024*
*100 páginas — Documento oficial de la Oficina de Comunicaciones, Dirección General*



---

<a id="14-informe-gestion-kanban"></a>

# Informe de Gestión Institucional — Kanban SENA

**Servicio Nacional de Aprendizaje — SENA**
Generado: 06/05/2026 01:38 | Usuario: Administrador SENA

---

## Distribución Global de Tareas

| Estado | Porcentaje |
|--------|-----------|
| Completadas | 25% |
| En Proceso | 25% |
| Pendientes | 50% |

---

## Cumplimiento por Proyecto / Ficha

| Proyecto | Ficha | Cumplimiento | Tareas |
|----------|-------|-------------|--------|
| PROYECTOS FORMATIVOS | 2929061 | 0% | 0 / 1 |
| INDUCCIÓN FICHA NUEVA | 2828061 | 33% | 1 / 3 |

---

## Historial de Actividad Reciente

| Actualización | Responsable | Tarea / Proyecto | Estado |
|--------------|-------------|-----------------|--------|
| 07/03/2026 06:56 | Administrador SENA | RECORRIDO FICHA NUEVA / INDUCCIÓN FICHA NUEVA | En proceso |
| 07/03/2026 06:56 | Administrador SENA | CONOCER SERVICIOS BÁSICOS / INDUCCIÓN FICHA NUEVA | Pendiente |
| 07/03/2026 06:56 | Administrador SENA | CONOCER FICHA NUEVA / INDUCCIÓN FICHA NUEVA | Completada |
| 07/03/2026 06:48 | Administrador SENA | Crear modelo UML / PROYECTOS FORMATIVOS | Pendiente |

---

*Documento generado automáticamente por Kanban SENA. Los porcentajes de distribución son sobre el total de tareas del sistema.*



---

<a id="15-IEEE-kanban-sena-docx"></a>

# SENA – Sistema de Gestión Kanban Coordinación | IEEE** SRS v1.0**

**SERVICIO NACIONAL DE APRENDIZAJE**

**SENA**

**ESPECIFICACIÓN DE REQUISITOS DE SOFTWARE**

*Estándar IEEE 830 / IEEE 29148*

**SISTEMA DE GESTIÓN DE TAREAS TIPO KANBAN**

*Para la Coordinación Interna SENA*

| **Nombre de la Evidencia:** | Especificación de Requisitos de Software – Sistema Kanban SENA |
| --- | --- |
| **Institución:** | Servicio Nacional de Aprendizaje (SENA) |
| **Centro:** | Centro de Procesos Industriales y Construcción |
| **Técnico / Tecnología:** | Tecnología en Análisis y Desarrollo de software |
| **Fase:** | Análisis y Diseño |
| **Tipo de Formación:** | MIXTA |
| **Fecha de Entrega:** | 10 de abril del 2026 |
| **Versión del Documento:** | 1.0 |
| **Estado:** | Borrador |

FICHA DEL DOCUMENTO

| **FECHA** | **REVISIÓN(ES)** | **AUTOR(ES)** |
| --- | --- | --- |
| 04 de febrero del 2026 | Versión inicial – creación del documento | Miguel Ángel Pineda López |
| [Fecha revisión] | Revisión de requisitos funcionales | [Revisor – completar] |
|  |  |  |

**DOCUMENTO VALIDADO POR LAS PARTES EN FECHA: ___________________________**

| **POR CLIENTE** | **DESARROLLADOR** |
| --- | --- |
| Fecha: ___________ | Fecha: ___________ |
| Nombre del Encargado: José German Estrada Clavijo | Nombre del Encargado: Miguel Ángel Pineda López |

**CONTENIDO**

**1.  INTRODUCCIÓN**

    1.1 Objetivo General

    1.2 Objetivos Específicos

    1.3 Propósito

    1.4 Alcance

    1.5 Personal Involucrado

    1.6 Definiciones, Acrónimos y Abreviaturas

    1.7 Referencias

    1.8 Resumen

**2.  DESCRIPCIÓN GENERAL**

    2.1 Perspectiva del Producto

    2.2 Funcionalidades del Producto

    2.3 Características de los Usuarios

    2.4 Restricciones

**3.  REQUISITOS ESPECÍFICOS**

    3.1 Requisitos del Sistema

    3.2 Requisitos Funcionales

    3.3 Requisitos No Funcionales

**4.  VALIDACIÓN DE REQUISITOS**

    4.1 Construcción de Prototipos

    4.2 Formatos de Casos de Prueba

**1. INTRODUCCIÓN**

La coordinación interna del SENA gestiona múltiples procesos académicos y administrativos que involucran instructores, aprendices y personal coordinador. Actualmente, el seguimiento de tareas, actividades y compromisos se realiza de forma manual o mediante herramientas no especializadas (correo electrónico, hojas de cálculo), lo que genera pérdida de información, duplicación de esfuerzos y baja trazabilidad del trabajo.

El presente documento establece los requisitos de software para el desarrollo de un Sistema de Gestión de Tareas tipo Kanban adaptado a las necesidades particulares de la coordinación SENA, permitiendo visualizar, asignar y dar seguimiento al flujo de trabajo en tiempo real.

**1.1 Objetivo General**

Desarrollar un sistema web de gestión de tareas tipo Kanban para la coordinación interna del SENA, que permita organizar, asignar y dar seguimiento al flujo de trabajo de instructores, coordinadores y aprendices mediante tableros visuales interactivos, utilizando el framework Laravel sobre un entorno XAMPP con MySQL.

**1.2 Objetivos Específicos**

- Diseñar e implementar un módulo de autenticación y gestión de usuarios con roles diferenciados (Administrador, Coordinador, Instructor, Aprendiz).

- Crear tableros Kanban personalizables con columnas configurables que representen los estados del flujo de trabajo.

- Permitir la creación, asignación, priorización y seguimiento de tareas dentro de los tableros.

- Implementar un sistema de notificaciones internas para alertar sobre cambios, asignaciones y fechas límite.

- Generar reportes básicos sobre el avance y carga de trabajo por usuario y por ficha de formación.

- Garantizar una interfaz responsiva y de fácil uso para usuarios con distintos niveles de conocimiento técnico.

**1.3 Propósito**

El software tiene como finalidad digitalizar y centralizar la gestión de tareas de la coordinación SENA, reemplazando los procesos manuales por un sistema visual e intuitivo que mejore la productividad, la comunicación interna y la trazabilidad de los procesos académicos y administrativos. El sistema permitirá a los coordinadores tener visibilidad total del estado de avance de las actividades de su equipo.

**1.4 Alcance**

El sistema abarcará las siguientes funcionalidades dentro del contexto de la coordinación SENA:

- Gestión completa de usuarios, roles y permisos.

- Creación y administración de proyectos y tableros Kanban.

- Ciclo de vida completo de tareas: creación, asignación, movimiento entre columnas, comentarios y cierre.

- Asociación de tareas a fichas de formación específicas.

- Módulo básico de reportes y métricas de productividad.

- Notificaciones en plataforma (sin integración con correo externo en la versión inicial).

El sistema NO incluirá en su versión inicial:

- Integración con sistemas externos del SENA (Sofia Plus, etc.).

- Aplicación móvil nativa.

- Módulos de facturación o nómina.

- Videoconferencia o chat en tiempo real.

**1.5 Personal Involucrado**

| **CAMPO** | **DESCRIPCIÓN** |
| --- | --- |
| NOMBRE | Miguel Ángel Pineda López |
| ROL | Desarrollador Full Stack / Analista de Requisitos |
| PROFESIÓN | Tecnólogo en Análisis y Desarrollo de Software (ADSO) – SENA |
| RESPONSABILIDADES | Análisis, diseño, desarrollo, pruebas e implementación del sistema |
| INFORMACIÓN DE CONTACTO | [Pinedo7u7@gmail.com](mailto:Pinedo7u7@gmail.com) / 3137466621 |
| APRUEBA | SI – Entrevista y seguimiento con el Coordinador SENA |

Cliente / Patrocinador del proyecto:

| **CAMPO** | **DESCRIPCIÓN** |
| --- | --- |
| NOMBRE | [Nombre del Coordinador SENA – completar] |
| ROL | Coordinador Académico / Cliente del sistema |
| RESPONSABILIDADES | Validar requisitos, aprobar entregables y proveer información del proceso |
| INFORMACIÓN DE CONTACTO | [Datos del Coordinador – completar] |

**1.6 Definiciones, Acrónimos y Abreviaturas**

| **TÉRMINO** | **DEFINICIÓN** |
| --- | --- |
| Kanban | Método visual de gestión de flujo de trabajo que usa tarjetas en columnas |
| Tablero (Board) | Espacio visual dividido en columnas que representa el flujo de un proyecto |
| Tarea / Ticket | Unidad mínima de trabajo dentro de un tablero Kanban |
| Columna | Estado del flujo de trabajo (ej: Por Hacer, En Progreso, Completado) |
| Laravel | Framework PHP de código abierto para desarrollo de aplicaciones web (MVC) |
| MySQL | Sistema de gestión de bases de datos relacional open source |
| XAMPP | Paquete de software local que incluye Apache, MySQL, PHP y Perl |
| MVC | Modelo-Vista-Controlador: patrón de arquitectura de software |
| API REST | Interfaz de programación de aplicaciones basada en el protocolo HTTP |
| JWT | JSON Web Token: estándar para autenticación mediante tokens |
| SENA | Servicio Nacional de Aprendizaje |
| ADSO | Análisis y Desarrollo de Software (nombre del programa de formación) |
| Ficha | Número identificador único de un grupo de aprendices en el SENA |
| SRS | Software Requirements Specification (Especificación de Requisitos de Software) |
| CRUD | Operaciones básicas: Crear, Leer, Actualizar, Eliminar |
| MVP | Producto Mínimo Viable (funcionalidad básica para primera entrega) |

**1.7 Referencias**

- Jira Software – Atlassian. https://www.atlassian.com/software/jira

- Trello – Atlas Sian. https://trello.com

- Asana – https://asana.com

- Laravel Documentation v11. https://laravel.com/docs

- MySQL Documentation. https://dev.mysql.com/doc/

- IEEE Standard 830-1998 – Recommended Practice for Software Requirements Specifications

- IEEE Standard 29148-2018 – Systems and Software Engineering – Requirements Engineering

**1.8 Resumen**

El sistema Kanban SENA es una aplicación web desarrollada con el framework Laravel (PHP) y base de datos MySQL local (XAMPP), que permite a la coordinación del SENA gestionar tareas y proyectos mediante tableros visuales interactivos. Los usuarios pueden crear tableros, organizar tareas por estados, asignarlas a miembros del equipo y hacer seguimiento al avance de cada actividad, mejorando la comunicación y la productividad interna de la coordinación.

**2. DESCRIPCIÓN GENERAL**

El Sistema de Gestión de Tareas Kanban para el SENA es una aplicación web de arquitectura MVC (Modelo-Vista-Controlador), accesible desde cualquier navegador moderno en la red local del centro de formación. Facilita la organización visual del trabajo mediante tableros con columnas que representan etapas del proceso, y tarjetas que representan tareas individuales.

**2.1 Perspectiva del Producto**

El sistema es una solución web independiente, desarrollada a medida para la coordinación SENA. Funciona sobre un servidor local Apache (XAMPP), con base de datos MySQL, accesible mediante navegadores web en la red interna. La interfaz presenta:

- Un panel de inicio con resumen de tareas asignadas al usuario autenticado.

- Tableros visuales Kanban con columnas configurables y tarjetas arrastrables.

- Panel de administración para gestión de usuarios, roles y configuraciones.

- Módulo de reportes con métricas de avance por tablero, usuario y ficha.

Usuarios del sistema y sus roles:

| **ROL** | **DESCRIPCIÓN** | **ACCESO PRINCIPAL** |
| --- | --- | --- |
| Administrador | Control total del sistema, gestión de usuarios y configuración global | Panel admin, todos los módulos |
| Coordinador | Gestiona proyectos, tableros y asigna tareas al equipo | Tableros, reportes, usuarios del proyecto |
| Instructor | Ve y actualiza el estado de sus tareas asignadas, agrega comentarios | Sus tableros y tareas asignadas |
| Aprendiz | Visualiza tareas del proyecto y actualiza estado de sus actividades | Tableros del proyecto al que pertenece |

**2.2 Funcionalidades del Producto (Elicitación)**

Las funcionalidades principales identificadas en el levantamiento de requisitos son:

- Registro, inicio de sesión y recuperación de contraseña.

- Gestión de usuarios con asignación de roles y permisos.

- Creación y administración de proyectos agrupadores de tableros.

- Creación de tableros Kanban con columnas configurables.

- Creación de tareas/tickets con título, descripción, responsable, prioridad, etiquetas y fecha límite.

- Arrastrar y soltar tareas entre columnas (Drag & Drop).

- Sistema de comentarios por tarea.

- Adjuntar archivos a tareas (opcional en MVP).

- Filtros y búsqueda de tareas por estado, responsable, prioridad y etiqueta.

- Notificaciones internas sobre asignación y cambios en tareas.

- Reportes de avance por tablero, usuario y ficha de formación.

- Historial de cambios de estado de cada tarea.

**2.3 Características de los Usuarios**

| **ROL** | **FUNCIÓN EN EL PROCESO** | **FRECUENCIA DE USO** | **NIVEL TÉCNICO** |
| --- | --- | --- | --- |
| Administrador | Configurar sistema, gestionar usuarios y roles globalmente | Esporádica | Alto |
| Coordinador | Planificar proyectos, crear tableros, asignar y supervisar tareas | Diaria | Medio |
| Instructor | Consultar y actualizar estado de tareas asignadas, comentar | Diaria | Bajo-Medio |
| Aprendiz | Consultar tareas del proyecto y actualizar actividades propias | Frecuente | Bajo |

**2.4 Restricciones**

Restricciones técnicas:

- El sistema funcionará inicialmente en entorno local (XAMPP – localhost) sin acceso externo a internet.

- La base de datos será MySQL gestionada con phpMyAdmin.

- El backend estará construido exclusivamente en Laravel (PHP >= 8.1).

- El frontend utilizará Blade Templates de Laravel con librerías CSS/JS (Bootstrap 5 y SortableJS para Drag & Drop).

Restricciones funcionales por rol:

- Solo el Administrador puede crear, editar y eliminar usuarios y roles.

- Solo el Coordinador y Administrador pueden crear o eliminar tableros y proyectos.

- Los Instructores no pueden eliminar tareas de otros usuarios, solo las propias.

- Los Aprendices no pueden mover tareas fuera de su columna asignada sin aprobación del Instructor.

- No se permite la eliminación permanente de tareas; solo el archivado (soft delete).

**3. REQUISITOS ESPECÍFICOS**

**3.1 Requisitos del Sistema**

Requisitos de hardware y software del entorno de desarrollo y despliegue inicial:

| **COMPONENTE** | **ESPECIFICACIÓN MÍNIMA** |
| --- | --- |
| Sistema Operativo | Windows 10/11 o Ubuntu 20.04+ |
| Procesador | Intel Core i5 o equivalente (2.0 GHz) |
| Memoria RAM | 4 GB mínimo (8 GB recomendado) |
| Almacenamiento | 20 GB libres en disco |
| Servidor Web | Apache 2.4 (incluido en XAMPP) |
| PHP | Versión 8.1 o superior |
| Base de Datos | MySQL 8.0 (incluido en XAMPP) |
| Gestor BD | phpMyAdmin (incluido en XAMPP) |
| Framework Backend | Laravel 10 o 11 |
| Gestor de paquetes | Composer 2.x (PHP) / npm (Node.js para assets) |
| Navegador cliente | Chrome 90+, Firefox 88+, Edge 90+ |
| Red | Red local LAN para acceso multi-usuario |

**3.2 Requisitos Funcionales**

**RF-001: Autenticación de Usuarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-001 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Autenticación de Usuarios |
| **CARACTERÍSTICAS** | El sistema debe permitir a los usuarios iniciar sesión con credenciales únicas (correo y contraseña) |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El sistema proveerá un formulario de login seguro. Las contraseñas se almacenarán encriptadas con bcrypt. Laravel Breeze o Jetstream gestionará la autenticación. Se incluirá protección CSRF. Se permitirá recuperación de contraseña por correo (configuración posterior). |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Seguridad) – RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-002: Gestión de Usuarios y Roles**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-002 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Usuarios y Roles |
| **CARACTERÍSTICAS** | CRUD completo de usuarios con asignación de roles diferenciados |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Administrador podrá crear, editar, activar/desactivar y eliminar usuarios. Cada usuario tendrá un rol: Administrador, Coordinador, Instructor o Aprendiz. El sistema usará Laravel Spatie Permission o gates/policies nativas para controlar el acceso por rol. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Seguridad) – RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-003: Gestión de Proyectos**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-003 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Proyectos |
| **CARACTERÍSTICAS** | Crear y administrar proyectos como contenedores de tableros relacionados |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Coordinador y Administrador pueden crear proyectos con nombre, descripción, fecha de inicio y fin, y asociarlos a una ficha de formación SENA. Un proyecto puede contener uno o más tableros Kanban. Se pueden agregar miembros al proyecto con roles específicos. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-004: Gestión de Tableros Kanban**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-004 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Tableros Kanban |
| **CARACTERÍSTICAS** | Creación y configuración de tableros con columnas personalizadas |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los tableros tendrán mínimo 3 columnas por defecto: 'Por Hacer', 'En Progreso' y 'Completado'. El Coordinador puede agregar, renombrar, reordenar y eliminar columnas. Cada tablero pertenece a un proyecto. La interfaz mostrará las tarjetas de tareas dentro de cada columna con información resumida. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) – RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-005: Gestión de Tareas / ****Tickets**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-005 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestión de Tareas / Tickets |
| **CARACTERÍSTICAS** | CRUD completo de tareas con campos de información detallada |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Una tarea contendrá: título, descripción enriquecida, usuario asignado, prioridad (Alta/Media/Baja), etiquetas, fecha límite y columna de estado. Al hacer clic en una tarjeta se abrirá un panel lateral o modal con el detalle completo. Se registrará el historial de cambios de estado de cada tarea. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-006: Drag ****&**** Drop de Tareas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-006 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Arrastrar y Soltar Tareas (Drag & Drop) |
| **CARACTERÍSTICAS** | Mover tareas entre columnas arrastrándolas con el mouse o dedo (touch) |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Se implementará con la librería SortableJS o similar, integrada en las vistas Blade. Al soltar una tarea en una columna nueva, el sistema actualizará el estado vía petición AJAX/Fetch a la API REST de Laravel y registrará el cambio en el historial. Se validarán los permisos del usuario antes de guardar. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento) – RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RF-007: Sistema de Comentarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-007 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Sistema de Comentarios en Tareas |
| **CARACTERÍSTICAS** | Permitir que los usuarios agreguen comentarios dentro de cada tarea |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Dentro del detalle de una tarea, los miembros del proyecto podrán agregar comentarios de texto. Se mostrará el nombre del autor, fecha y hora del comentario. Los comentarios se guardarán en la tabla 'comments' relacionada con la tarea. El autor puede editar o eliminar su propio comentario. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-008: Notificaciones Internas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-008 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Notificaciones Internas del Sistema |
| **CARACTERÍSTICAS** | Alertar a los usuarios sobre eventos relevantes dentro de la plataforma |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Se generarán notificaciones en plataforma cuando: se asigne una tarea a un usuario, una tarea cambie de estado, se agregue un comentario a una tarea del usuario, o se aproxime la fecha límite de una tarea. Se usará el sistema de notificaciones de Laravel (database channel). Se mostrará un indicador de notificaciones no leídas en la barra de navegación. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-009: Filtros y Búsqueda**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-009 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Filtros y Búsqueda Avanzada de Tareas |
| **CARACTERÍSTICAS** | Filtrar y buscar tareas según múltiples criterios |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El tablero dispondrá de filtros por: usuario asignado, prioridad, etiqueta/categoría, estado (columna) y rango de fechas. También incluirá una barra de búsqueda por texto en título o descripción. Los filtros se aplicarán en tiempo real vía AJAX sin recargar la página. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-010: Reportes y Métricas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-010 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Módulo de Reportes y Métricas |
| **CARACTERÍSTICAS** | Generar reportes de avance y productividad por tablero, usuario y ficha |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Coordinador y Administrador podrán consultar: número de tareas por estado, carga de trabajo por instructor, tareas vencidas, tareas completadas en un rango de fechas y avance por ficha de formación. Los reportes se mostrarán con gráficas básicas (Chart.js) y podrán exportarse a PDF (usando la librería DomPDF de Laravel). |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) – RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RF-011: Asociación con Fichas de Formación SENA**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RF-011 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Asociación de Proyectos con Fichas SENA |
| **CARACTERÍSTICAS** | Relacionar proyectos y tareas con fichas de formación del SENA |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El sistema permitirá registrar las fichas de formación (número de ficha, nombre del programa, instructor titular) y asociarlas a proyectos y tableros. En los reportes se podrá filtrar por ficha. Esta relación facilita el seguimiento académico específico del contexto SENA. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Disponibilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**3.3 Requisitos No Funcionales**

**RNF-001: Disponibilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-001 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Disponibilidad del Sistema |
| **CARACTERÍSTICAS** | El sistema debe estar disponible durante el horario de actividades del SENA |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El sistema deberá operar sin interrupciones durante el horario laboral (7:00 AM – 9:00 PM). El tiempo de inactividad planificado para mantenimiento no debe superar 2 horas semanales y se realizará fuera del horario de mayor uso. En entorno local XAMPP, el servidor Apache debe estar en ejecución constante. |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-002: Seguridad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-002 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Seguridad del Sistema |
| **CARACTERÍSTICAS** | Proteger datos e impedir accesos no autorizados |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Las contraseñas se almacenarán con hash bcrypt. Se implementará protección CSRF en todos los formularios (ya incluida en Laravel). Se usará el sistema de autenticación de Laravel con sesiones seguras. Las rutas estarán protegidas con middleware de autenticación y autorización por rol. Se validarán todas las entradas del usuario para prevenir inyección SQL y XSS (validación Laravel + Eloquent ORM). |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-003: Rendimiento**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-003 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Rendimiento y Tiempos de Respuesta |
| **CARACTERÍSTICAS** | Garantizar respuestas rápidas para una experiencia de usuario fluida |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Las páginas principales del tablero Kanban deben cargar en menos de 2 segundos en condiciones normales de red local. Las operaciones AJAX (mover tarea, agregar comentario) deben responder en menos de 1 segundo. Se usará eager loading en Eloquent para evitar el problema N+1 de consultas. Se implementará paginación en listados extensos. |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-004: Usabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-004 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Usabilidad e Interfaz de Usuario |
| **CARACTERÍSTICAS** | Interfaz intuitiva, responsiva y accesible para usuarios no técnicos |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La interfaz usará Bootstrap 5 para garantizar diseño responsivo en dispositivos de escritorio y tablets. Los colores indicadores de prioridad (rojo=alta, amarillo=media, verde=baja) deben ser visibles e intuitivos. El tablero Kanban debe ser la vista principal con acceso en máximo 2 clics desde el login. Se incluirán tooltips y mensajes de ayuda contextual. |
| **PRIORIDAD DEL REQUERIMIENTO** | ALTA |

**RNF-005: Mantenibilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-005 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Mantenibilidad del Código |
| **CARACTERÍSTICAS** | Código limpio, documentado y estructurado para facilitar mantenimiento futuro |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El código seguirá las convenciones PSR-12 de PHP y las buenas prácticas de Laravel (uso de migraciones, seeders, factories, eloquent relationships). Se documentarán los métodos principales con PHPDoc. Las rutas se organizarán en grupos por módulo en el archivo routes/web.php y routes/api.php. Se usará el patrón Repository para desacoplar la lógica de negocio de los controladores. |
| **PRIORIDAD DEL REQUERIMIENTO** | MEDIA |

**RNF-006: Escalabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | RNF-006 |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Escalabilidad |
| **CARACTERÍSTICAS** | El sistema debe poder escalar a múltiples sedes y usuarios en el futuro |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La arquitectura MVC de Laravel facilita la migración a un servidor en producción (hosting compartido o VPS). El diseño de base de datos soportará múltiples centros de formación mediante el campo 'center_id' en las tablas principales. La estructura de la aplicación permite agregar nuevos módulos sin afectar los existentes. |
| **PRIORIDAD DEL REQUERIMIENTO** | BAJA |

**4. VALIDACIÓN DE REQUISITOS**

**4.1 Construcción de Prototipos**

Para la validación de los requisitos funcionales, se construirán prototipos en las siguientes fases:

**Fase 1 – ****Wireframes**** (Baja Fidelidad):**

- Pantalla de Login y Registro de usuario.

- Dashboard principal con resumen de tareas.

- Vista de tablero Kanban con columnas y tarjetas.

- Formulario de creación/edición de tarea.

- Panel de administración de usuarios.

Herramientas sugeridas: Figma (gratuito) o Balsamiq para wireframes. Los prototipos serán validados con el Coordinador SENA antes del inicio del desarrollo.

**Fase 2 – Prototipo Funcional (MVP):**

- Autenticación funcional (RF-001).

- Tablero Kanban básico con columnas y tarjetas (RF-004, RF-005).

- Arrastrar y soltar tareas entre columnas (RF-006).

- Creación y asignación de tareas (RF-005).

**Fase 3 – Sistema Completo:**

- Todos los requisitos funcionales implementados.

- Módulo de reportes (RF-010).

- Notificaciones (RF-008).

- Pruebas de usuario con el equipo de coordinación.

**4.2 Formatos de Casos de Prueba**

| **FORMATO DE CASO DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA: **Verificar que un usuario registrado pueda iniciar sesión correctamente con credenciales válidas |
| **IDENTIFICADOR: **CP-001 |
| **NOMBRE DEL REQUERIMIENTO: **RF-001 – Autenticación de Usuarios |
| **PRECONDICIONES: **El usuario debe estar registrado en la base de datos con estado activo. El servidor XAMPP debe estar en ejecución. |
| **PASOS                                                                                 RESULTADOS ESPERADOS** |
| 1. Abrir el navegador y acceder a http://localhost/kanban-sena | 1. El formulario de login se muestra correctamente con campos de correo y contraseña |
| 2. En el formulario de login, ingresar correo válido registrado | 2. El campo acepta el correo sin errores de validación |
| 3. Ingresar la contraseña correcta del usuario | 3. El campo de contraseña muestra asteriscos y acepta la entrada |
| 4. Hacer clic en el botón 'Iniciar Sesión' | 4. El sistema procesa la solicitud de autenticación |
| 5. Verificar redirección al Dashboard del sistema | 5. El sistema redirige al dashboard con el nombre del usuario visible en la barra de navegación |

| **FORMATO DE CASO DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA: **Verificar que las tareas puedan moverse entre columnas mediante Drag & Drop y que el estado se actualice en la base de datos |
| **IDENTIFICADOR: **CP-002 |
| **NOMBRE DEL REQUERIMIENTO: **RF-006 – Arrastrar y Soltar Tareas (Drag & Drop) |
| **PRECONDICIONES: **El usuario Coordinador o Instructor debe estar autenticado. Debe existir al menos un tablero con tareas en la columna 'Por Hacer'. |
| **PASOS                                                                                 RESULTADOS ESPERADOS** |
| 1. Iniciar sesión con usuario Coordinador | 1. El dashboard y la lista de tableros se muestran correctamente |
| 2. Acceder al tablero Kanban del proyecto | 2. El tablero muestra las columnas con las tareas correspondientes |
| 3. Hacer clic y mantener presionado sobre una tarjeta en la columna 'Por Hacer' | 3. La tarjeta se resalta visualmente indicando que está siendo arrastrada |
| 4. Arrastrar la tarjeta hasta la columna 'En Progreso' y soltar | 4. La tarjeta se ubica visualmente dentro de la columna 'En Progreso' |
| 5. Verificar en la base de datos que el campo 'column_id' de la tarea cambió | 5. El estado de la tarea cambió a 'En Progreso' en BD y el historial registra el cambio |

| **FORMATO DE CASO DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA: **Verificar que un usuario sin permisos no pueda acceder a las rutas de administración del sistema |
| **IDENTIFICADOR: **CP-003 |
| **NOMBRE DEL REQUERIMIENTO: **RF-002 – Gestión de Usuarios y Roles (Restricción de acceso) |
| **PRECONDICIONES: **Debe existir un usuario con rol 'Aprendiz' registrado en el sistema. |
| **PASOS                                                                                 RESULTADOS ESPERADOS** |
| 1. Iniciar sesión con un usuario de rol 'Aprendiz' | 1. El sistema autentica al usuario Aprendiz y muestra su dashboard |
| 2. Intentar acceder manualmente a la URL http://localhost/kanban-sena/admin/users | 2. El middleware de autorización intercepta la solicitud |
| 3. Verificar la respuesta del sistema | 3. El sistema muestra error 403 (Acceso denegado) o redirige al dashboard con mensaje de error |
| 4. Intentar acceder a http://localhost/kanban-sena/admin/settings | 4. El sistema repite la restricción de acceso con mensaje apropiado |
| 5. Cerrar sesión y verificar que la ruta protegida tampoco es accesible sin autenticación | 5. El sistema redirige al formulario de login para usuarios no autenticados |

**APÉNDICE A: ARQUITECTURA Y STACK TÉCNICO**

Esta sección describe la arquitectura técnica propuesta para el desarrollo del sistema Kanban SENA utilizando Laravel y MySQL con XAMPP.

**Arquitectura MVC con Laravel**

El sistema seguirá el patrón Modelo-Vista-Controlador (MVC) implementado por el framework Laravel:

- Modelos (Model): Representan las entidades de la base de datos (User, Board, Column, Task, Comment, Notification). Usarán Eloquent ORM para las relaciones y consultas.

- Vistas (View): Plantillas Blade de Laravel con HTML, Bootstrap 5 y JavaScript. El Drag & Drop se implementará con SortableJS integrado en las vistas.

- Controladores (Controller): Procesarán las solicitudes HTTP, validarán datos con Form Requests de Laravel y responderán con vistas o JSON para peticiones AJAX.

**Estructura de Base de Datos – Entidades Principales**

| **TABLA** | **CAMPOS PRINCIPALES** | **RELACIONES** |
| --- | --- | --- |
| users | id, name, email, password, role_id, center_id, active | hasMany: tasks, comments, notifications |
| roles | id, name, slug (admin/coordinator/instructor/learner) | belongsToMany: users |
| fichas | id, numero_ficha, nombre_programa, instructor_id, fecha_inicio | hasMany: projects |
| projects | id, name, description, ficha_id, owner_id, start_date, end_date | hasMany: boards, belongsTo: ficha |
| boards | id, name, project_id, description, created_by | hasMany: columns, belongsTo: project |
| columns | id, name, board_id, order, color | hasMany: tasks, belongsTo: board |
| tasks | id, title, description, column_id, assigned_to, priority, due_date, created_by | hasMany: comments, belongsTo: column, user |
| comments | id, task_id, user_id, body, created_at | belongsTo: task, user |
| task_history | id, task_id, user_id, from_column, to_column, changed_at | belongsTo: task, user |
| notifications | id, user_id, type, data (JSON), read_at | belongsTo: user |

**Ruta de Desarrollo Sugerida (Hitos)**

| **SPRINT / FASE** | **ACTIVIDADES** | **ENTREGABLE** |
| --- | --- | --- |
| Sprint 1 (Semana 1-2) | Configuración XAMPP, Laravel, migraciones BD, autenticación con Laravel Breeze, gestión básica de usuarios | Login funcional + CRUD usuarios |
| Sprint 2 (Semana 3-4) | Módulo de Proyectos, Fichas SENA, Tableros y Columnas Kanban | Tableros con columnas configurables |
| Sprint 3 (Semana 5-6) | CRUD de Tareas, Drag & Drop con SortableJS + AJAX, historial de cambios | Tablero Kanban funcional completo |
| Sprint 4 (Semana 7-8) | Sistema de comentarios, notificaciones internas, filtros y búsqueda | Colaboración en tareas funcional |
| Sprint 5 (Semana 9-10) | Módulo de reportes, exportación PDF, ajustes de UI/UX con Bootstrap 5 | Reportes y dashboard de métricas |
| Sprint 6 (Semana 11-12) | Pruebas integrales, corrección de bugs, documentación técnica final y despliegue | Sistema entregable y documentado |

Página 1



---

<a id="16-IEEE-ERS-kanban-sena-v1"></a>

**SENA — Sistema Kanban de Gestion de Tareas   **IEEE 830 v1.0

**SERVICIO NACIONAL DE APRENDIZAJE**

**SENA**

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

**ESPECIFICACION DE REQUISITOS DE SOFTWARE**

**Sistema de Gestion de Tareas Kanban**

Basado en el estandar IEEE 830

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

| **VERSION** | v1.0 - MVP |
| --- | --- |
| **FECHA** | Marzo 2026 |
| **ESTADO** | En Revision |
| **CENTRO** | Centro de Formacion SENA |
| **PROGRAMA** | Tecnologia en Desarrollo de Software |
| **FICHA** | 2758631 |

| **POR CLIENTE** | **DESARROLLADOR** |
| --- | --- |
| FECHA:  NOMBRE DEL ENCARGADO: | FECHA:  NOMBRE DEL ENCARGADO: |

# **FICHA DEL DOCUMENTO**

| **FECHA** | **REVISION(ES)** | **AUTOR(ES)** |
| --- | --- | --- |
| Marzo 2026 | Version inicial IEEE 830 | Equipo de Desarrollo |
|  |  |  |

DOCUMENTO VALIDADO POR LAS PARTES EN FECHA: ____________________

# **CONTENIDO**

1. INTRODUCCION

    1.1. Objetivo General

    1.2. Objetivos Especificos

    1.3. Proposito

    1.4. Alcance

    1.5. Personal Involucrado

    1.6. Definiciones, Acronimos y Abreviaturas

    1.7. Referencias

    1.8. Resumen

2. DESCRIPCION GENERAL

    2.1. Perspectiva del Producto

    2.2. Funcionalidades del Producto

    2.3. Caracteristicas de los Usuarios

    2.4. Restricciones

3. REQUISITOS ESPECIFICOS

    3.1. Requisitos del Sistema

    3.2. Requisitos Funcionales

    3.3. Requisitos No Funcionales

4. VALIDACION DE REQUISITOS

    4.1. Construccion de Prototipos

    4.2. Formato de Casos de Prueba

# **1. INTRODUCCION**

El SENA requiere una herramienta digital que permita gestionar de manera eficiente el flujo de tareas academicas y administrativas dentro de sus programas de formacion. Actualmente, el seguimiento de actividades de instructores y aprendices se realiza de forma manual o mediante herramientas dispersas, generando dificultades en la visibilidad del estado de los proyectos y en la asignacion de responsabilidades.

Este documento especifica los requisitos del Sistema de Gestion de Tareas Kanban para el SENA, siguiendo el estandar IEEE 830, con el objetivo de guiar el desarrollo de un software robusto, escalable y alineado con la identidad institucional.

## **1.1. Objetivo General**

Desarrollar un sistema de gestion de tareas tipo Kanban para el SENA que permita a coordinadores, instructores y aprendices visualizar, asignar y hacer seguimiento del estado de las actividades de formacion en tiempo real, mejorando la eficiencia operativa del centro educativo.

## **1.2. Objetivos Especificos**

- Implementar un tablero Kanban con flujo de estados configurable: Por Hacer, En Progreso, En Revision y Completado.

- Gestionar multiples roles de usuario: Administrador, Coordinador, Instructor y Aprendiz, con permisos diferenciados.

- Asociar tareas a fichas de formacion SENA para garantizar el seguimiento institucional.

- Proveer reportes y metricas de desempeno accesibles para coordinadores y administradores.

- Construir una arquitectura escalable que permita incorporar funcionalidades adicionales en versiones futuras.

## **1.3. Proposito**

El sistema Kanban SENA tiene como finalidad digitalizar y centralizar la gestion de actividades formativas, eliminando el uso de herramientas dispersas y proporcionando una plataforma unificada que respete los lineamientos institucionales del SENA en cuanto a roles, fichas de formacion y calendarios academicos.

## **1.4. Alcance**

El sistema cubrira las siguientes funciones dentro del centro de formacion:

- Autenticacion y gestion de usuarios por roles institucionales.

- Creacion y administracion de proyectos asociados a fichas de formacion.

- Tableros Kanban con columnas personalizables y arrastre de tareas (drag & drop).

- Asignacion de tareas a usuarios con prioridad, fecha limite y etiquetas.

- Sistema de comentarios por tarea para comunicacion contextual.

- Reportes basicos de avance por proyecto, instructor y aprendiz.

Fuera del alcance del MVP: carga de archivos adjuntos, integracion con calendario academico SENA, notificaciones en tiempo real, recuperacion de contrasena y soporte multitenancy por sede.

## **1.5. Personal Involucrado**

| **CAMPO** | **DETALLE** |
| --- | --- |
| **NOMBRE** | Equipo de Desarrollo — Ficha 2758631 |
| **ROL** | Analista / Desarrollador Full Stack |
| **PROFESION** | Tecnologo en Desarrollo de Software |
| **RESPONSABILIDADES** | Levantamiento de requisitos, diseno, desarrollo, pruebas y documentacion del sistema. |
| **INFORMACION DE CONTACTO** | Centro de Formacion SENA — Colombia |
| **APRUEBA** | SI — Entrevista y seguimiento validados por Coordinador y cliente. |

## **1.6. Definiciones, Acronimos y Abreviaturas**

| **TERMINO** | **DEFINICION** |
| --- | --- |
| **SENA** | Servicio Nacional de Aprendizaje — entidad colombiana de formacion profesional. |
| **Kanban** | Metodologia agil de gestion visual de trabajo mediante tableros y tarjetas. |
| **Ficha** | Numero identificador de un grupo de aprendices en un programa de formacion SENA. |
| **MVP** | Minimum Viable Product — version funcional basica del software con caracteristicas esenciales. |
| **JWT** | JSON Web Token — estandar de autenticacion sin estado basado en tokens firmados digitalmente. |
| **ORM** | Object-Relational Mapping — capa de abstraccion entre codigo orientado a objetos y base de datos relacional. |
| **API** | Application Programming Interface — interfaz de comunicacion entre sistemas de software. |
| **REST** | Representational State Transfer — estilo arquitectonico para APIs HTTP. |
| **Drag ****&**** Drop** | Funcionalidad de arrastrar y soltar elementos en la interfaz grafica de usuario. |
| **Rol** | Conjunto de permisos asignados a un tipo de usuario dentro del sistema. |
| **Board** | Tablero visual que agrupa columnas y tareas de un proyecto. |
| **Task** | Unidad de trabajo asignable dentro del sistema Kanban. |
| **Prisma** | ORM moderno para Node.js que permite gestionar bases de datos con TypeScript. |
| **SQLite** | Base de datos relacional embebida, usada en el entorno de desarrollo local. |
| **PostgreSQL** | Sistema de gestion de bases de datos relacional robusto, usado en produccion. |
| **Zustand** | Libreria de gestion de estado global ligera para aplicaciones React. |
| **Recharts** | Libreria de visualizacion de datos y graficos para React. |

## **1.7. Referencias**

- IEEE Std 830-1998 — Recommended Practice for Software Requirements Specifications.

- Documentacion oficial de React 18: https://react.dev

- Documentacion de Prisma ORM: https://prisma.io/docs

- Atlassian Jira — referencia de sistema Kanban empresarial: https://atlassian.com/software/jira

- Manual de Identidad Visual SENA 2024.

- Documento: Como funcionan los sistemas Kanban — contexto tecnico del proyecto.

- Documento tecnico: Prompt MVP Sistema Kanban SENA v1.0.

## **1.8. Resumen**

Este documento contiene la especificacion completa de requisitos del Sistema Kanban SENA, organizado en cuatro secciones: Introduccion (contexto y alcance), Descripcion General (arquitectura y usuarios), Requisitos Especificos (funcionales y no funcionales) y Validacion de Requisitos (casos de prueba).

# **2. DESCRIPCION GENERAL**

## **2.1. Perspectiva del Producto**

El Sistema Kanban SENA es una aplicacion web de tres capas (frontend React, backend Node.js/Express, base de datos SQLite/PostgreSQL) que opera de manera independiente sobre infraestructura local o en la nube. Se integra con el modelo institucional del SENA mediante la gestion de fichas de formacion y roles jerarquicos. No depende de sistemas externos en su version MVP.

La interfaz sigue la identidad visual institucional del SENA: color verde (#39A900) y azul navy (#003770), tipografia Arial, logotipo institucional en el panel lateral y pantalla de inicio. El sistema es responsive y accesible desde dispositivos moviles con pantalla mayor a 360px.

## **2.2. Funcionalidades del Producto**

- Autenticacion segura con JWT y control de sesion diferenciado por rol.

- Dashboard con metricas: tareas totales, en progreso, vencidas y completadas.

- Gestion de proyectos asociados a fichas de formacion SENA.

- Tableros Kanban con drag & drop entre columnas configurables.

- Creacion, edicion y eliminacion de tareas con prioridad, asignacion y fecha limite.

- Sistema de comentarios por tarea para comunicacion contextual.

- Gestion de usuarios con activacion/desactivacion por rol.

- Reportes basicos de avance con visualizacion grafica mediante Recharts.

## **2.3. Caracteristicas de los Usuarios**

### **ADMINISTRADOR**

Acceso total al sistema. Gestiona usuarios, proyectos, tableros y reportes globales. Es el responsable de la configuracion inicial y de la administracion de cuentas de usuario. Puede realizar cualquier operacion en el sistema.

### **COORDINADOR**

Crea proyectos y los asocia a fichas de formacion. Asigna instructores y supervisa el avance de todos los tableros del centro. Accede a reportes institucionales. No puede eliminar usuarios del sistema.

### **INSTRUCTOR**

Gestiona los tableros de sus proyectos asignados. Crea, edita y mueve tareas. Visualiza unicamente a sus aprendices asociados. No accede a las vistas de Usuarios ni a Reportes globales del centro.

### **APRENDIZ**

Visualiza los tableros de su ficha de formacion. Puede mover sus propias tareas entre columnas y agregar comentarios. No puede crear, editar ni eliminar tareas de otros usuarios.

## **2.4. Restricciones**

- El sistema debe funcionar en navegadores modernos: Chrome 110+, Firefox 115+, Edge 110+, Safari 16+.

- El MVP utilizara SQLite como base de datos local; la migracion a PostgreSQL es transparente (solo requiere cambio de variable de entorno DATABASE_URL).

- No se permiten archivos adjuntos en tareas en la version MVP.

- No habra integracion con sistemas externos del SENA (SOFIA Plus) en el MVP.

- Los aprendices no pueden visualizar informacion de otras fichas de formacion.

- Solo los Administradores pueden eliminar y cambiar roles de usuarios.

- La recuperacion de contrasenias estara disponible a partir de la version 2.0.

# **3. REQUISITOS ESPECIFICOS**

## **3.1. Requisitos del Sistema**

| **COMPONENTE** | **ESPECIFICACION MINIMA** |
| --- | --- |
| **Sistema Operativo** | Windows 10+, macOS 12+, Ubuntu 22.04+ (servidor) |
| **Procesador** | 2 nucleos / 2 GHz o superior |
| **Memoria RAM** | 4 GB minimo (8 GB recomendado para desarrollo) |
| **Almacenamiento** | 500 MB libres para el sistema y la base de datos |
| **Node.js** | v20 LTS o superior |
| **Navegador** | Chrome 110+, Firefox 115+, Edge 110+, Safari 16+ |
| **Resolucion minima** | 1280 x 720 px |
| **Conexion de red** | LAN o Internet para acceso multiusuario |

## **3.2. Requisitos Funcionales**

### **RF-001 — Autenticacion de Usuarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-001** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Autenticacion de Usuarios |
| **CARACTERÍSTICAS** | El sistema debe permitir el ingreso seguro de usuarios mediante credenciales unicas. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Se presenta una pantalla de login con campos de email y contrasenia. Al ingresar credenciales validas, el sistema genera un token JWT que se almacena en el cliente y redirige al usuario segun su rol. Si las credenciales son incorrectas, muestra un mensaje de error sin revelar cual campo fallo. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Seguridad), RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-002 — Gestion de Proyectos**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-002** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestion de Proyectos |
| **CARACTERÍSTICAS** | Crear, editar y desactivar proyectos asociados a fichas de formacion SENA. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los roles Administrador y Coordinador pueden crear proyectos con nombre, descripcion y numero de ficha. Cada proyecto puede tener multiples tableros. Los proyectos se desactivan logicamente (activo=false) pero no se eliminan fisicamente para preservar el historial. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Integridad de datos) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-003 — Tablero Kanban**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-003** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Tablero Kanban |
| **CARACTERÍSTICAS** | Visualizar y gestionar el flujo de tareas mediante un tablero con columnas y arrastre de tarjetas. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El tablero muestra columnas predeterminadas (Por Hacer, En Progreso, En Revision, Completado). Las tareas se presentan como tarjetas con titulo, prioridad, usuario asignado y fecha limite. El usuario puede arrastrar tarjetas entre columnas. Al soltar la tarjeta, el sistema llama a PATCH /api/v1/tasks/:id/move y actualiza el estado en la base de datos. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento), RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-004 — Gestion de Tareas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-004** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestion de Tareas |
| **CARACTERÍSTICAS** | Crear, editar, asignar y eliminar tareas dentro de los tableros. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los usuarios autorizados pueden crear tareas con: titulo (obligatorio), descripcion, prioridad (Alta/Media/Baja), usuario asignado, fecha limite y etiquetas. Las tareas se editan mediante un modal emergente. Solo Administrador, Coordinador e Instructor pueden eliminar tareas. Los Aprendices solo pueden mover y comentar sus propias tareas. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-002 (Integridad), RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-005 — Sistema de Comentarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-005** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Sistema de Comentarios |
| **CARACTERÍSTICAS** | Agregar y visualizar comentarios en cada tarea para comunicacion contextual entre usuarios. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Desde el modal de tarea, cualquier usuario con acceso al proyecto puede escribir y enviar comentarios. Los comentarios se muestran en orden cronologico con nombre del autor, rol y fecha/hora. No es posible editar ni eliminar comentarios en el MVP. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **MEDIA** |

### **RF-006 — Gestion de Usuarios**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-006** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Gestion de Usuarios |
| **CARACTERÍSTICAS** | Crear, editar y activar/desactivar cuentas de usuario con roles institucionales. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El Administrador accede a la vista de Usuarios y puede crear nuevas cuentas con: nombre, email, contrasenia temporal, rol y ficha. Puede activar o desactivar usuarios mediante un toggle. Los usuarios desactivados no pueden iniciar sesion. Solo el Administrador puede modificar roles de usuario. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Seguridad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-007 — Dashboard de Metricas**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-007** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Dashboard de Metricas |
| **CARACTERÍSTICAS** | Visualizar indicadores clave de rendimiento del sistema al iniciar sesion. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La pantalla principal muestra: total de tareas del usuario, tareas en progreso, tareas vencidas (fecha limite superada) y tareas completadas. Incluye lista de Mis tareas pendientes filtrada por el usuario logueado y acceso rapido a proyectos activos. Las metricas se calculan desde la API en cada carga del dashboard. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento), RNF-004 (Usabilidad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RF-008 — Reportes de Avance**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-008** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Reportes de Avance |
| **CARACTERÍSTICAS** | Generar y visualizar reportes graficos del estado de tareas por proyecto y usuario. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Disponible solo para Administrador y Coordinador. Muestra: grafico de barras con tareas por estado (Recharts), tabla de tareas por instructor/aprendiz e indicador de tareas vencidas. Los datos se consultan desde el backend y se renderizan en el cliente sin generar archivos. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-003 (Rendimiento) |
| **PRIORIDAD DEL REQUERIMIENTO** | **MEDIA** |

### **RF-009 — Control de Acceso por Rol**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RF-009** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Control de Acceso por Rol |
| **CARACTERÍSTICAS** | Restringir el acceso a vistas y operaciones segun el rol del usuario autenticado. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El backend implementa un middleware requireRole() que verifica el JWT y el rol antes de cada endpoint protegido. El frontend oculta rutas y botones segun el rol del usuario. Un Aprendiz que intente acceder a /usuarios recibe error 403. Las rutas protegidas redirigen al Dashboard si el rol no tiene permisos suficientes. |
| **REQUERIMIENTO NO FUNCIONAL** | RNF-001 (Seguridad) |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

## **3.3. Requisitos No Funcionales**

### **RNF-001 — Seguridad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-001** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Seguridad del Sistema |
| **CARACTERÍSTICAS** | Proteger los datos y accesos del sistema contra uso no autorizado. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Las contrasenias se almacenan con hash bcrypt (salt rounds=12). Los tokens JWT tienen expiracion de 8 horas. Todas las rutas de la API (excepto /auth/login) requieren token valido. Variables sensibles (JWT_SECRET, DATABASE_URL) se gestionan exclusivamente mediante variables de entorno en archivo .env, nunca en el codigo fuente. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-002 — Integridad de Datos**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-002** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Integridad de Datos |
| **CARACTERÍSTICAS** | Garantizar la consistencia y trazabilidad de la informacion almacenada. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El esquema Prisma define relaciones con integridad referencial. Proyectos y usuarios se desactivan logicamente (campo activo:false) en lugar de eliminarse fisicamente. Cada tarea registra campos createdAt y updatedAt para auditoria. Las operaciones criticas usan transacciones de base de datos. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-003 — Rendimiento**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-003** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Rendimiento y Tiempos de Respuesta |
| **CARACTERÍSTICAS** | El sistema debe responder de manera eficiente bajo carga de uso normal. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | Los endpoints de la API deben responder en menos de 500ms bajo carga normal (hasta 50 usuarios simultaneos). La carga inicial del tablero con hasta 100 tareas no debe superar 2 segundos. El frontend implementa estado local con Zustand para minimizar llamadas redundantes a la API. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-004 — Usabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-004** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Usabilidad e Interfaz de Usuario |
| **CARACTERÍSTICAS** | La interfaz debe ser intuitiva y accesible para usuarios sin formacion tecnica avanzada. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | El diseno sigue la identidad visual SENA: verde #39A900 y navy #003770. La interfaz es responsive y funciona en dispositivos moviles con pantalla mayor a 360px. Los mensajes de error son claros y orientados al usuario final. El sistema incluye indicadores de carga (spinners) en todas las operaciones asincronas. |
| **PRIORIDAD DEL REQUERIMIENTO** | **ALTA** |

### **RNF-005 — Escalabilidad**

| **IDENTIFICACIÓN DEL REQUERIMIENTO** | **RNF-005** |
| --- | --- |
| **NOMBRE DEL REQUERIMIENTO** | Escalabilidad Tecnica |
| **CARACTERÍSTICAS** | El sistema debe poder escalar en usuarios, datos y funcionalidades sin refactorizacion mayor. |
| **DESCRIPCIÓN DEL REQUERIMIENTO** | La arquitectura separa frontend/backend/base de datos en capas independientes. El ORM Prisma permite cambiar SQLite por PostgreSQL modificando solo la variable DATABASE_URL. La API esta versionada desde /api/v1/. Los controladores estan separados de las rutas para facilitar migracion futura a NestJS. Los stores de Zustand estan desacoplados de los componentes. |
| **PRIORIDAD DEL REQUERIMIENTO** | **MEDIA** |

# **4. VALIDACION DE REQUISITOS**

## **4.1. Construccion de Prototipos**

Se construira un prototipo funcional del MVP con las siguientes vistas implementadas en orden de prioridad:

- Pantalla de Login con autenticacion JWT real contra base de datos.

- Dashboard con metricas calculadas dinamicamente desde la API.

- Tablero Kanban con drag & drop funcional y persistencia de cambios.

- Modal de tarea con creacion, edicion y sistema de comentarios.

- Vista de Gestion de Usuarios (solo rol ADMINISTRADOR).

- Reportes basicos con grafico de barras (Recharts).

El prototipo utilizara datos de seed que incluyen un usuario de prueba por cada rol, un proyecto con ficha asignada y tareas en distintos estados del tablero.

## **4.2. Formato de Casos de Prueba**

### **CP-001 — Login con credenciales validas**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un usuario con credenciales validas puede iniciar sesion y es redirigido segun su rol. |
| **IDENTIFICADOR** | CP-001 |
| **NOMBRE DEL REQUERIMIENTO** | RF-001 — Autenticacion de Usuarios |
| **PRECONDICIONES** | El sistema esta en funcionamiento. La base de datos contiene el usuario: admin@sena.edu.co / Admin123! |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Abrir la URL del sistema en el navegador. | 1. Se muestra la pantalla de login sin errores. |
| 2. Ingresar email: admin@sena.edu.co | 2. El campo de email acepta el valor ingresado. |
| 3. Ingresar contrasenia: Admin123! | 3. El campo de contrasenia oculta el texto con asteriscos. |
| 4. Hacer clic en el boton Ingresar. | 4. El sistema valida las credenciales, genera un JWT y redirige al Dashboard del Administrador con todas las vistas habilitadas. |

### **CP-002 — Mover tarea entre columnas (Drag ****&**** Drop)**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un Instructor puede mover una tarea de Por Hacer a En Progreso mediante arrastre. |
| **IDENTIFICADOR** | CP-002 |
| **NOMBRE DEL REQUERIMIENTO** | RF-003 — Tablero Kanban |
| **PRECONDICIONES** | Usuario Instructor autenticado. Proyecto activo con tablero. Tarea existente en columna Por Hacer. |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Iniciar sesion como instructor@sena.edu.co | 1. El sistema muestra el tablero con columnas y tareas correctamente. |
| 2. Navegar al tablero del proyecto asignado. | 2. La tarjeta es tomada y muestra efecto visual de arrastre. |
| 3. Hacer clic y mantener sobre la tarjeta de tarea en la columna Por Hacer. | 3. La columna destino indica la zona de drop activa. |
| 4. Arrastrar la tarjeta sobre la columna En Progreso y soltar. | 4. La tarjeta aparece en la columna En Progreso. El endpoint PATCH /api/v1/tasks/:id/move responde HTTP 200. La base de datos actualiza el columnId de la tarea correctamente. |

### **CP-003 — Control de acceso por rol (Aprendiz intenta acceder a Usuarios)**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un Aprendiz no puede acceder a la vista de Gestion de Usuarios. |
| **IDENTIFICADOR** | CP-003 |
| **NOMBRE DEL REQUERIMIENTO** | RF-009 — Control de Acceso por Rol |
| **PRECONDICIONES** | Usuario Aprendiz autenticado con sesion activa. |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Iniciar sesion como aprendiz@sena.edu.co | 1. El sistema permite el login y redirige al Dashboard restringido para Aprendiz. |
| 2. Verificar que el sidebar no muestra el enlace a Usuarios. | 2. El sidebar no muestra el enlace a Usuarios. |
| 3. Intentar navegar manualmente a /usuarios en la barra del navegador. | 3. El sistema intercepta la navegacion y muestra un mensaje de Acceso denegado o redirige al Dashboard. |
| 4. Observar el comportamiento del sistema. | 4. El backend retorna HTTP 403 si se intenta llamar a GET /api/v1/users sin los permisos correctos. |

### **CP-004 — Crear tarea nueva en tablero**

| **FORMATO DE CASOS DE PRUEBA** |
| --- |
| **OBJETIVO DEL CASO DE PRUEBA** | Verificar que un Instructor puede crear una nueva tarea en un tablero asignado. |
| **IDENTIFICADOR** | CP-004 |
| **NOMBRE DEL REQUERIMIENTO** | RF-004 — Gestion de Tareas |
| **PRECONDICIONES** | Instructor autenticado. Proyecto con tablero disponible. Al menos un Aprendiz asignado al proyecto. |
| **PASOS** | **RESULTADOS ESPERADOS** |
| 1. Iniciar sesion como instructor@sena.edu.co | 1. El sistema muestra el tablero correctamente con columnas visibles. |
| 2. Abrir el tablero del proyecto asignado. | 2. La columna muestra el boton + Tarea habilitado. |
| 3. Hacer clic en + Tarea en la columna Por Hacer. | 3. El modal se abre con todos los campos vacios y listos para ingresar datos. |
| 4. Completar el modal: Titulo: Tarea de Prueba, Prioridad: Alta, asignar al aprendiz disponible. | 4. Los campos aceptan los valores ingresados correctamente. |
| 5. Hacer clic en el boton Guardar. | 5. La tarea aparece como tarjeta en la columna Por Hacer con titulo visible, badge rojo de prioridad Alta y avatar del aprendiz asignado. El endpoint POST /api/v1/tasks retorna HTTP 201. |

**FIN DEL DOCUMENTO**

Especificacion de Requisitos de Software — Sistema Kanban SENA — v1.0 — Marzo 2026

	Documento Confidencial SENA   	   Pagina



---

<a id="17-presentacion-proyecto-storm"></a>

# Presentación Proyecto Storm — Georreferenciación Transporte Escolar

**SENA Caldas — Centro de Procesos Industriales y Construcción**
Tecnólogo en Análisis y Desarrollo de Software | Ficha: 2613934
Autor: Marco Eduar Serna López

---

## 1. Introducción

El proyecto busca desarrollar un prototipo de software de georreferenciación diseñado para optimizar y asegurar el transporte escolar privado en Manizales. A través de esta solución tecnológica, los padres y tutores podrán monitorear en tiempo real la ubicación de sus hijos durante sus trayectos hacia y desde la escuela.

### Abstract

This project develops a georeferencing software prototype to improve the safety and efficiency of private school transportation in Manizales, Colombia. The platform enables real-time vehicle tracking via a web interface and mobile app, offering parents notifications, driver details, and route histories.

---

## 2. Objetivos

### Objetivo General
Desarrollar un prototipo de software de georreferenciación para transporte escolar privado como herramienta efectiva en el monitoreo de la movilidad en tiempo real de los niños, niñas y adolescentes en la ciudad de Manizales.

### Objetivos Específicos
1. Realizar un análisis de requisitos incluyendo funcionalidades de rastreo en tiempo real
2. Diseñar un prototipo funcional con interfaz intuitiva accesible desde dispositivos móviles y ordenadores
3. Implementar una solución de georreferenciación en tiempo real usando GPS

---

## 3. Descripción

El prototipo está diseñado para brindar una solución integral que mejora la seguridad, eficiencia y comunicación en el transporte escolar privado.

### Características principales
- **Monitoreo en tiempo real:** GPS para rastreo y visualización en mapas interactivos
- **Alertas estratégicas:** Proximidad a paradas de recogida y entrega
- **Información del conductor y vehículo:** Nombre, contacto, matrícula
- **Historial de rutas:** Registro de recorridos previos
- **Seguridad y privacidad:** Protección de datos sensibles

---

## 4. Justificación

La seguridad y bienestar de los estudiantes son de suma importancia para la comunidad educativa y los padres/tutores de Manizales. La implementación de un software de georreferenciación se presenta como una solución innovadora y necesaria.

---

## 5. Antecedentes

- Aumento del uso de tecnologías móviles e impulso de soluciones con GPS
- Adopción de sistemas de georreferenciación como SIGAVL EDU
- Normativas nacionales: Decreto 1079 de 2015
- Necesidad local en Manizales de herramientas de monitoreo

---

## 6. Alcance

- **Geografía:** Implementación inicial en Manizales, Caldas, con potencial de escalabilidad
- **Usuarios:** Padres/tutores, conductores, administradores escolares
- **Funcionalidades:** Rastreo GPS, alertas automáticas, gestión y optimización de rutas

---

## 7. Arquitectura y Tecnología

### Componentes principales

| Componente | Tecnología |
|-----------|-----------|
| Frontend | HTML, CSS, JavaScript, Bootstrap |
| Backend | PHP, Node.js |
| Georreferenciación | Mapbox con token configurado |
| Base de datos | MySQL |

### Característica especial
Se desarrolló un algoritmo basado en la **teoría de Dijkstra**, que ubica varios puntos en el mapa y traza la ruta óptima entre todos los puntos mediante coordenadas.

---

## 8. Impacto

- **Social:** Fortalece la confianza entre padres, escuelas y conductores
- **Económico:** Promueve empleo y desarrollo tecnológico local
- **Ambiental:** Reduce huella de carbono mediante optimización de rutas
- **Tecnológico:** Moderniza la gestión del transporte escolar

### Beneficios
- **Para los padres:** Tranquilidad y control sobre los tiempos
- **Para los conductores:** Organización eficiente de rutas
- **Para las escuelas:** Monitoreo centralizado
- **Para la comunidad:** Estándar de transporte más seguro

---

## 9. Recomendaciones Adicionales

- Mensajes en tiempo real
- Capacitación para usuarios
- Integración con normativas
- Optimización de rutas
- Soporte multicanal
- Historial y análisis de datos
- Escalabilidad y actualizaciones
- Seguridad de la información

---

## 10. Referencias

- Bohórquez, D. (2016). *Control y Geolocalización de rutas escolares.* Fundación Universitaria Los Libertadores.
- Vélez-Pereira, A. y Toro, D. (2019). *XIII Congreso Colombiano de Transporte y Tránsito.*
- Rondón, L. (2016). *Evaluación de un sistema de geolocalización para el transporte escolar.* Revista Ingeniería, Investigación y Desarrollo, 16(1).
- Rodríguez, A. (2020). *Impacto de la tecnología de geolocalización en la seguridad del transporte escolar.* Universidad Agustiniana.
- Ley 1753 de 2015 — Sostenibilidad de sistemas de transporte público
- Decreto 348 de 2015 — Regulación de servicios de transporte escolar
- Ley 1581 de 2012 — Protección de datos personales

---

*SENA Caldas — Centro de Procesos Industriales y Construcción*
*Tecnólogo en Análisis y Desarrollo de Software — Ficha 2613934*


