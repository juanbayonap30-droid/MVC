# Manual de Usuario
## Sistema de Gestión Académica - SENA

---

**Versión:** 1.0  
**Fecha:** Marzo 2026  
**Desarrollado para:** SENA - Servicio Nacional de Aprendizaje

---

## Tabla de Contenidos

1. [Introducción](#introducción)
2. [Requisitos del Sistema](#requisitos-del-sistema)
3. [Acceso al Sistema](#acceso-al-sistema)
4. [Roles de Usuario](#roles-de-usuario)
5. [Módulos del Sistema](#módulos-del-sistema)
   - [Gestión de Coordinaciones](#gestión-de-coordinaciones)
   - [Gestión de Ambientes](#gestión-de-ambientes)
   - [Gestión de Programas](#gestión-de-programas)
   - [Gestión de Instructores](#gestión-de-instructores)
   - [Gestión de Competencias](#gestión-de-competencias)
   - [Gestión de Fichas](#gestión-de-fichas)
   - [Asignación de Competencias](#asignación-de-competencias)
   - [Gestión de Asignaciones](#gestión-de-asignaciones)
6. [Perfil de Usuario](#perfil-de-usuario)
7. [Preguntas Frecuentes](#preguntas-frecuentes)
8. [Soporte Técnico](#soporte-técnico)

---

## Introducción

El Sistema de Gestión Académica del SENA es una plataforma web diseñada para facilitar la administración de instructores, programas de formación, competencias, fichas y asignaciones académicas. Este sistema permite a los coordinadores gestionar eficientemente los recursos educativos y a los instructores consultar sus asignaciones.

### Características Principales

- Gestión centralizada de instructores y coordinaciones
- Administración de programas de formación y competencias
- Control de ambientes de aprendizaje
- Asignación de competencias a instructores
- Programación de horarios y asignaciones
- Interfaz moderna y responsive
- Sistema de roles y permisos

---

## Requisitos del Sistema

### Requisitos Mínimos

- **Navegador Web:** Google Chrome 90+, Firefox 88+, Edge 90+, Safari 14+
- **Conexión a Internet:** Banda ancha (mínimo 2 Mbps)
- **Resolución de Pantalla:** 1366x768 píxeles o superior
- **JavaScript:** Habilitado en el navegador

### Recomendaciones

- Utilizar Google Chrome o Microsoft Edge para mejor rendimiento
- Mantener el navegador actualizado
- Limpiar caché periódicamente

---

## Acceso al Sistema

### Inicio de Sesión

1. Abra su navegador web
2. Ingrese la URL del sistema: `http://localhost/MVC/` (o la URL proporcionada por su administrador)
3. En la pantalla de inicio de sesión, ingrese sus credenciales:
   - **Usuario:** Su nombre de usuario o correo electrónico
   - **Contraseña:** Su contraseña asignada

4. Haga clic en el botón **"Iniciar Sesión"**

### Tipos de Acceso

El sistema cuenta con tres tipos de acceso:

- **Coordinador:** Acceso completo a todos los módulos
- **Centro de Formación:** Acceso completo a todos los módulos
- **Instructor:** Acceso limitado a consulta de asignaciones y perfil personal

### Recuperación de Contraseña

Si olvidó su contraseña, contacte al administrador del sistema para que le asigne una nueva.

---

## Roles de Usuario

### Coordinador / Centro de Formación

**Permisos:**
- Crear, editar y eliminar coordinaciones
- Gestionar ambientes de formación
- Administrar programas académicos
- Gestionar instructores
- Administrar competencias
- Crear y modificar fichas
- Asignar competencias a programas
- Asignar competencias a instructores
- Programar asignaciones académicas

**Menú Principal:**
- Coordinaciones
- Ambientes
- Programas
- Instructores
- Competencias
- Fichas (oculto en menú, accesible)
- Comp x Program
- Instru x Compet
- Asignaciones

### Instructor

**Permisos:**
- Consultar sus asignaciones
- Ver detalles de asignaciones
- Actualizar su perfil personal

**Menú Principal:**
- Asignaciones
- Mi Perfil

---

## Módulos del Sistema

### Gestión de Coordinaciones

Este módulo permite administrar las coordinaciones del centro de formación.

#### Listar Coordinaciones

1. En el menú lateral, haga clic en **"Coordinaciones"**
2. Se mostrará una tabla con todas las coordinaciones registradas
3. Puede ver: ID, Nombre, y Acciones disponibles

#### Crear Nueva Coordinación

1. En la vista de coordinaciones, haga clic en **"+ Nueva Coordinación"**
2. Complete el formulario:
   - **ID de Coordinación:** Número único identificador
   - **Nombre de Coordinación:** Nombre descriptivo (ej: Coordinación Sistemas)
   - **Contraseña:** Contraseña de acceso (mínimo 6 caracteres)
   - **Centro de Formación:** ID del centro (por defecto: 2)
3. Haga clic en **"Guardar"**

#### Ver Detalles de Coordinación

1. En la lista de coordinaciones, haga clic en **"Ver Detalles"**
2. Se abrirá un modal con la información completa
3. Puede ver: ID, Nombre, Centro de Formación, Estado

#### Editar Coordinación

1. En el modal de detalles, haga clic en **"Editar"**
2. Modifique los campos necesarios
3. Haga clic en **"Actualizar"**

#### Eliminar Coordinación

1. En el modal de detalles, haga clic en **"Eliminar"**
2. Confirme la acción en el mensaje de advertencia
3. La coordinación será eliminada permanentemente

---

### Gestión de Ambientes

Administre los espacios físicos donde se imparten las clases.

#### Listar Ambientes

1. Haga clic en **"Ambientes"** en el menú lateral
2. Visualice todos los ambientes registrados

#### Crear Nuevo Ambiente

1. Haga clic en **"+ Nuevo Ambiente"**
2. Complete el formulario:
   - **ID Ambiente:** Código único (ej: A101, LAB01)
   - **Nombre del Ambiente:** Descripción (ej: Laboratorio de Sistemas)
   - **ID Sede:** Número de la sede
3. Haga clic en **"Crear Ambiente"**

**Nota:** El ID del ambiente se convierte automáticamente a mayúsculas.

#### Ver Detalles del Ambiente

1. Haga clic en **"Ver Detalles"** en la fila del ambiente
2. Revise la información completa en el modal

#### Editar Ambiente

1. Desde el modal de detalles, haga clic en **"Editar"**
2. Actualice la información necesaria
3. Guarde los cambios

---

### Gestión de Programas

Administre los programas de formación ofrecidos por el SENA.

#### Listar Programas

1. Seleccione **"Programas"** en el menú
2. Visualice la lista completa de programas

#### Crear Nuevo Programa

1. Haga clic en **"+ Nuevo Programa"**
2. Ingrese la información:
   - **Código del Programa:** Código oficial SENA (ej: 228106)
   - **Denominación:** Nombre del programa (ej: Análisis y Desarrollo de Software)
   - **ID Título:** Identificador del título
   - **Tipo de Programa:** Seleccione entre:
     - Técnico
     - Tecnólogo
     - Especialización
     - Complementario
3. Haga clic en **"Crear Programa"**

#### Ver Detalles del Programa

1. Haga clic en **"Ver Detalles"**
2. Revise: Código, Denominación, Título, Tipo

---

### Gestión de Instructores

Administre la información de los instructores del centro.

#### Listar Instructores

1. Haga clic en **"Instructores"** en el menú
2. Visualice: ID, Nombres, Apellidos, Correo, Teléfono

#### Crear Nuevo Instructor

1. Haga clic en **"+ Nuevo Instructor"**
2. Complete el formulario:
   - **ID Instructor:** Número de documento
   - **Nombres:** Nombres del instructor
   - **Apellidos:** Apellidos del instructor
   - **Correo Electrónico:** Email institucional
   - **Teléfono:** 10 dígitos numéricos
   - **Centro de Formación:** Seleccione el centro asignado
3. Haga clic en **"Guardar Instructor"**

**Validaciones:**
- El teléfono debe tener exactamente 10 dígitos
- El correo debe tener formato válido
- Todos los campos son obligatorios

#### Ver Detalles del Instructor

1. Haga clic en **"Ver Detalles"**
2. El modal mostrará:
   - ID Instructor
   - Nombres y Apellidos
   - Correo Electrónico
   - Teléfono
   - Centro de Formación asignado
   - Estado del Registro
   - Fecha de Registro

#### Editar Instructor

1. Desde el modal, haga clic en **"Editar"**
2. Modifique los datos necesarios
3. Puede cambiar el centro de formación asignado
4. Haga clic en **"Actualizar Instructor"**

**Nota:** El ID del instructor no puede ser modificado.

---

### Gestión de Competencias

Administre las competencias de los programas de formación.

#### Listar Competencias

1. Seleccione **"Competencias"** en el menú
2. Visualice todas las competencias registradas

#### Crear Nueva Competencia

1. Haga clic en **"+ Nueva Competencia"**
2. Complete el formulario:
   - **ID Competencia:** Número único
   - **Nombre Corto:** Nombre resumido
   - **Horas:** Duración en horas
   - **Nombre de la Unidad de Competencia:** Descripción completa
3. Haga clic en **"Crear Competencia"**

#### Ver Detalles de Competencia

1. Haga clic en **"Ver Detalles"**
2. Revise toda la información de la competencia

---

### Gestión de Fichas

Administre las fichas de formación del centro.

#### Listar Fichas

1. En el menú lateral, haga clic en el ícono de **Fichas** (📁)
2. Se mostrará una tabla con todas las fichas registradas
3. Puede ver: ID Ficha, Programa, Instructor Líder, Jornada, y Acciones

#### Crear Nueva Ficha

1. En la vista de fichas, haga clic en **"+ Nueva Ficha"**
2. Complete el formulario con la siguiente información:
   
   - **ID Ficha:** Número oficial de la ficha (ej: 2558963)
   - **Programa:** Seleccione el programa de formación de la lista desplegable
   - **Instructor Líder:** Seleccione el instructor responsable de la ficha
   - **Jornada:** Seleccione la jornada de formación:
     - Diurna
     - Nocturna
     - Mixta
     - Fin de Semana

3. Haga clic en **"Guardar Ficha"**

**Validaciones:**
- El ID de la ficha debe ser único
- Todos los campos son obligatorios
- El programa debe existir previamente
- El instructor líder debe estar registrado

#### Ver Detalles de Ficha

1. En la lista de fichas, haga clic en **"Ver Detalles"**
2. Se abrirá un modal mostrando:
   - ID de la Ficha
   - Programa asociado
   - Instructor Líder asignado
   - Jornada de formación
   - Estado del registro
   - Fecha de creación

#### Editar Ficha

1. En el modal de detalles, haga clic en **"Editar"**
2. Modifique los campos necesarios:
   - Puede cambiar el programa
   - Puede reasignar el instructor líder
   - Puede modificar la jornada
3. Haga clic en **"Actualizar Ficha"**

**Nota:** El ID de la ficha no puede ser modificado una vez creada.

#### Eliminar Ficha

1. En el modal de detalles, haga clic en **"Eliminar"**
2. Confirme la acción en el mensaje de advertencia
3. La ficha será eliminada permanentemente

**Advertencia:** Eliminar una ficha puede afectar las asignaciones asociadas.

---

### Asignación de Competencias

#### Competencia x Programa

Este módulo permite relacionar competencias con programas de formación. Es un paso previo necesario antes de asignar competencias a instructores.

##### Listar Relaciones Competencia-Programa

1. En el menú lateral, haga clic en **"Comp x Program"** (🔗)
2. Se mostrará una tabla con todas las relaciones existentes
3. Puede ver: Programa, Competencia, y Acciones disponibles

##### Crear Nueva Relación

1. Haga clic en **"+ Nueva Relación"**
2. Complete el formulario:
   
   - **Programa:** Seleccione el programa de formación de la lista desplegable
     - Se muestran todos los programas registrados en el sistema
     - Formato: Código - Nombre del Programa
   
   - **Competencia:** Seleccione la competencia a asociar
     - Se muestran todas las competencias disponibles
     - Formato: Nombre de la Competencia

3. Haga clic en **"Crear Relación"**

**Validaciones:**
- Ambos campos son obligatorios
- La combinación Programa-Competencia debe ser única
- Si intenta crear una relación duplicada, el sistema mostrará un error
- El programa debe existir previamente
- La competencia debe estar registrada

**Importante:** Esta relación es necesaria antes de poder asignar una competencia a un instructor en el módulo "Instru x Compet".

##### Ver Detalles de la Relación

1. En la lista, haga clic en **"Ver Detalles"**
2. El modal mostrará:
   - Nombre completo del Programa
   - Código del Programa
   - Nombre de la Competencia
   - Horas de la Competencia
   - Estado de la relación
   - Fecha de creación

##### Eliminar Relación

1. En el modal de detalles, haga clic en **"Eliminar"**
2. Lea el mensaje de advertencia
3. Confirme la eliminación
4. La relación será removida del sistema

**Advertencia:** Eliminar esta relación puede afectar las asignaciones de instructores que dependan de ella. Verifique antes de eliminar.

##### Flujo de Trabajo Recomendado

Para una correcta configuración del sistema, siga este orden:

1. **Paso 1:** Cree los **Programas** necesarios en el módulo de Programas
2. **Paso 2:** Cree las **Competencias** requeridas en el módulo de Competencias
3. **Paso 3:** Establezca las relaciones en **"Comp x Program"**
4. **Paso 4:** Asigne competencias a instructores en **"Instru x Compet"**
5. **Paso 5:** Programe las asignaciones académicas

##### Casos de Uso Comunes

**Ejemplo 1: Programa de Análisis y Desarrollo de Software**
- Programa: 228106 - Análisis y Desarrollo de Software
- Competencias asociadas:
  - Programación Web
  - Bases de Datos
  - Desarrollo Móvil
  - Análisis de Sistemas

**Ejemplo 2: Programa Técnico en Sistemas**
- Programa: 228172 - Técnico en Sistemas
- Competencias asociadas:
  - Mantenimiento de Equipos
  - Redes de Datos
  - Soporte Técnico

**Nota:** La combinación Programa-Competencia debe ser única.

#### Instructor x Competencia

Asigne competencias a instructores.

**Crear Asignación:**
1. Vaya a **"Instru x Compet"**
2. Haga clic en **"+ Nueva Asignación"**
3. Complete:
   - **Instructor:** Seleccione de la lista
   - **Programa:** Seleccione el programa
   - **Competencia:** Seleccione la competencia
   - **Fecha de Vigencia:** (Opcional)
4. Haga clic en **"Crear Asignación"**

**Importante:** La combinación Programa-Competencia debe existir previamente en "Comp x Program".

---

### Gestión de Asignaciones

Programe las asignaciones académicas de instructores.

#### Listar Asignaciones

1. Haga clic en **"Asignaciones"** en el menú
2. Visualice todas las asignaciones programadas

**Para Instructores:**
- Solo verán sus propias asignaciones
- No pueden editar ni eliminar

**Para Coordinadores:**
- Ven todas las asignaciones
- Pueden crear, editar y eliminar

#### Crear Nueva Asignación

1. Haga clic en **"+ Nueva Asignación"**
2. Complete el formulario:
   - **Instructor:** Seleccione de la lista
   - **Fecha Inicio:** Fecha de inicio de la asignación
   - **Fecha Fin:** Fecha de finalización
   - **Ficha:** Seleccione la ficha
   - **Ambiente:** Seleccione el ambiente
   - **Competencia:** Seleccione la competencia
3. Haga clic en **"Crear Asignación"**

#### Ver Detalles de Asignación

1. Haga clic en **"Ver Detalles"**
2. El modal mostrará:
   - ID de Asignación
   - Instructor asignado
   - Fechas de inicio y fin
   - Ficha asociada
   - Ambiente asignado
   - Competencia a impartir

#### Editar Asignación

1. Desde el modal, haga clic en **"Editar"** (solo coordinadores)
2. Modifique los datos necesarios
3. Guarde los cambios

---

## Perfil de Usuario

### Acceso al Perfil (Solo Instructores)

1. Haga clic en **"Mi Perfil"** en el menú lateral
2. Visualice su información personal

### Actualizar Perfil

1. En la vista de perfil, modifique:
   - Nombres
   - Apellidos
   - Correo Electrónico
   - Teléfono

2. Para cambiar contraseña:
   - Ingrese su **Contraseña Actual**
   - Ingrese la **Nueva Contraseña**
   - Confirme la **Nueva Contraseña**

3. Haga clic en **"Actualizar Perfil"**

**Validaciones:**
- La contraseña actual debe ser correcta
- Las contraseñas nuevas deben coincidir
- El teléfono debe tener 10 dígitos

---

## Preguntas Frecuentes

### ¿Qué hago si olvidé mi contraseña?

Contacte al coordinador o administrador del sistema para que le asigne una nueva contraseña.

### ¿Por qué no puedo ver todos los módulos?

Los módulos visibles dependen de su rol. Los instructores solo tienen acceso a Asignaciones y Mi Perfil.

### ¿Puedo eliminar una asignación como instructor?

No, solo los coordinadores pueden crear, editar o eliminar asignaciones.

### ¿Cómo sé qué competencias puedo asignar a un instructor?

Primero debe existir la relación Programa-Competencia en el módulo "Comp x Program".

### ¿Puedo cambiar el centro de formación de un instructor?

Sí, desde el formulario de edición de instructor, puede seleccionar un nuevo centro de formación.

### ¿Qué significa "Sin asignar" en el centro de formación?

Indica que el instructor no tiene un centro de formación asignado. Debe editarlo para asignar uno.

---

## Soporte Técnico

### Contacto

Para soporte técnico o reportar problemas:

- **Email:** soporte@sena.edu.co
- **Teléfono:** (601) 5461500
- **Horario:** Lunes a Viernes, 8:00 AM - 5:00 PM

### Reporte de Errores

Al reportar un error, incluya:
1. Descripción detallada del problema
2. Pasos para reproducir el error
3. Capturas de pantalla (si es posible)
4. Navegador y versión utilizada
5. Rol de usuario

---

## Notas Importantes

- Mantenga su contraseña segura y no la comparta
- Cierre sesión al terminar de usar el sistema
- Verifique que los datos ingresados sean correctos antes de guardar
- Las eliminaciones son permanentes y no se pueden deshacer
- Actualice su navegador regularmente para mejor rendimiento

---

**© 2026 SENA - Servicio Nacional de Aprendizaje**  
**Todos los derechos reservados**
