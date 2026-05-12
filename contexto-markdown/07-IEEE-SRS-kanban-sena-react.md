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