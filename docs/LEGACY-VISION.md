# Visión arquitectónica histórica (no implementada)

> **Aviso de desprecado**  
> Esta visión arquitectónica **no está implementada** en el código versionado del repositorio. Para el stack activo, dependencias y guía de instalación, consulte el archivo **`README.md`** en la raíz del proyecto.  
> **No utilice este documento como base para decisiones de desarrollo, despliegue ni auditorías técnicas del producto actual.**

---

## 1. Resumen de la visión aspiracional (archivo histórico)

En una etapa inicial del proyecto se documentó una arquitectura **full stack separada** orientada a servicios y a un cliente **SPA**. Dicha propuesta **no llegó a materializarse** en el repositorio; se conserva aquí únicamente como **registro de intención** y para evitar pérdida de contexto en equipos que trabajaron con documentación antigua.

### 1.1 Tabla de tecnologías (propuesta no realizada)

| Capa | Tecnología prevista |
|------|---------------------|
| Frontend | React, TypeScript, Tailwind CSS |
| Backend | Node.js, NestJS, API REST |
| Base de datos | PostgreSQL |
| ORM | Prisma o TypeORM (según documentación previa) |
| Tiempo real | Socket.io |
| Autenticación | JWT |
| Caché / sesiones distribuidas | Redis (según documentación previa) |

### 1.2 Estructura de directorios propuesta (no existente en el repo)

La documentación histórica describía una organización aproximada del tipo:

```text
proyecto/
├── frontend/          # Aplicación React + TypeScript + TailwindCSS
├── backend/           # API Node.js + NestJS
├── database/          # Scripts y configuración PostgreSQL
├── docs/              # Documentación IEEE y diagramas
└── tests/             # Pruebas automatizadas
```

**Esta jerarquía no corresponde al estado actual del repositorio.** La aplicación implementada vive bajo **`kanban-sena/`** y sigue el estándar de un proyecto **Laravel**.

---

## 2. Justificación técnica del cambio de enfoque (pivot hacia Laravel 12 + Blade)

La decisión de adoptar un **monolito Laravel** con vistas **Blade**, **Vite** y base de datos configurable respondió a criterios objetivos de contexto institucional y de entrega:

| Factor | Consideración |
|--------|----------------|
| **Entorno local institucional** | Entornos tipo **XAMPP** y equipos de formación suelen contar con **PHP** y **Apache** de forma habitual; reducir la fricción de “stack dual” (Node + PHP + dos servicios) favorece la reproducibilidad del proyecto en aulas y sedes. |
| **Curva de aprendizaje SENA** | Laravel concentra autenticación, validación, ORM y convenciones en un solo ecosistema documentado en español por la comunidad; es coherente con itinerarios que ya incluyen PHP u orientación web clásica. |
| **Velocidad de MVP** | Un único despliegue (servidor web + `public/`), migraciones y seeders integrados, y UI server-rendered aceleran un **producto mínimo funcional** alineado con plazos académicos. |
| **Alineación con el SRS v1.0 (IEEE 830)** | Los requisitos funcionales y no funcionales del sistema pueden implementarse de forma trazable mediante rutas, políticas, modelos y vistas en un solo código base, facilitando la correspondencia requisito ↔ módulo en revisiones formales. |

El stack vigente queda **descrito y acotado** en **`README.md`** en la raíz; no debe inferirse de este archivo.

---

## 3. Referencia cruzada a artefactos institucionales y de datos

Para auditorías, diseño y cumplimiento normativo, los documentos y artefactos siguientes deben tomarse como **fuente de verdad** junto al código bajo `kanban-sena/`:

| Artefacto | Uso |
|-----------|-----|
| **`SENA – Sistema de Gestión Kanban.txt`** | Especificación de requisitos (SRS) del sistema; referencia para RF/RNF y alcance funcional. |
| **`Identidad visual sena prompt tecnico.txt`** | Lineamiento de marca, colorimetría y tipografía institucional aplicables a la interfaz. |
| **`kanban_sena.sql`** | Esquema o volcado SQL de referencia para la base de datos del sistema Kanban (verificar en el repositorio la ruta equivalente bajo `kanban-sena/database/sql/` si el archivo fue versionado con otro nombre). |

Si alguno de estos archivos no está aún en el repositorio, debe incorporarse en la ubicación acordada por el equipo (por ejemplo `docs/` o la raíz del proyecto) y enlazarse desde el **README** principal.

---

## 4. Uso prohibido de este documento en desarrollo activo

- **No** utilice este archivo para instalar dependencias, configurar entornos ni definir rutas o APIs.  
- **No** cite este documento como evidencia del stack en uso ante instituciones o auditores sin remitir simultáneamente al **`README.md` raíz**.  
- **No** planifique migraciones de datos ni despliegues basándose en la tabla tecnológica de la sección 1.1.  
- Cualquier reactivación de la visión separada (React + NestJS, etc.) debe tratarse como **nuevo proyecto o épica**, con análisis de coste, SRS actualizado y decisión explícita del equipo.

---

*Documento de archivo — SenaKan — Conservación de contexto histórico.*
