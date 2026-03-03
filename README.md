# 📋 SenaKan

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
