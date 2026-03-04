# Sistema de Gestión Académica - SENA

Sistema web para la gestión de instructores, programas, competencias, fichas y asignaciones académicas del SENA.

## 🚀 Características

- **Gestión de Instructores**: Administración completa de instructores y sus datos
- **Gestión de Programas**: Control de programas de formación
- **Gestión de Competencias**: Administración de competencias académicas
- **Asignación de Competencias**: Relación entre programas, competencias e instructores
- **Gestión de Fichas**: Control de fichas de formación
- **Programación de Asignaciones**: Asignación de instructores a competencias, fichas y ambientes
- **Sistema de Roles**: Coordinadores, Centros de Formación e Instructores
- **Interfaz Moderna**: Diseño responsive con colores institucionales SENA

## 📋 Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache/Nginx
- Extensiones PHP: PDO, PDO_MySQL

## 🔧 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/juanbayonap30-droid/MVC.git
cd MVC
```

2. **Configurar la base de datos**
```bash
# Importar el archivo SQL
mysql -u root -p < gestion_academica\ \(3\).sql
```

3. **Configurar la conexión**

Editar `config/database.php` con tus credenciales:
```php
$host = 'localhost';
$dbname = 'gestion_academica';
$username = 'root';
$password = '';
```

4. **Configurar el servidor web**

Para Apache, asegúrate de que el DocumentRoot apunte a la carpeta del proyecto.

Para desarrollo rápido con PHP:
```bash
php -S localhost:8000
```

5. **Acceder al sistema**

Abrir en el navegador: `http://localhost/MVC/` o `http://localhost:8000/`

## 👥 Usuarios de Prueba

### Coordinador
- **Usuario**: Coordinación Sistemas
- **Contraseña**: (configurar en base de datos)

### Instructor
- **Usuario**: Carlos Rodriguez
- **Contraseña**: (configurar en base de datos)

## 📁 Estructura del Proyecto

```
MVC/
├── assets/
│   ├── css/           # Estilos CSS
│   ├── js/            # JavaScript
│   └── images/        # Imágenes
├── config/
│   └── database.php   # Configuración de BD
├── MVC/
│   ├── Controlador/   # Controladores
│   ├── Modelo/        # Modelos
│   └── Vista/         # Vistas
├── index.php          # Punto de entrada
└── README.md
```

## 🎨 Tecnologías Utilizadas

- **Backend**: PHP (MVC Pattern)
- **Base de Datos**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Estilos**: CSS personalizado con colores SENA
- **Arquitectura**: Modelo-Vista-Controlador (MVC)

## 🔐 Roles y Permisos

### Coordinador / Centro de Formación
- Acceso completo a todos los módulos
- Crear, editar y eliminar registros
- Gestionar asignaciones

### Instructor
- Ver sus asignaciones
- Actualizar su perfil
- Sin permisos de edición/eliminación

## 📚 Módulos del Sistema

1. **Coordinaciones**: Gestión de coordinaciones del centro
2. **Ambientes**: Administración de espacios físicos
3. **Programas**: Control de programas de formación
4. **Instructores**: Gestión de instructores
5. **Competencias**: Administración de competencias
6. **Fichas**: Control de fichas de formación
7. **Comp x Program**: Relación competencias-programas
8. **Instru x Compet**: Asignación de competencias a instructores
9. **Asignaciones**: Programación de asignaciones académicas

## 🛠️ Desarrollo

### Agregar un nuevo módulo

1. Crear el modelo en `MVC/Modelo/`
2. Crear el controlador en `MVC/Controlador/`
3. Crear las vistas en `MVC/Vista/`
4. Agregar la ruta en `index.php`

### Convenciones de código

- Nombres de clases: PascalCase
- Nombres de métodos: camelCase
- Nombres de archivos: PascalCase para clases
- Indentación: 4 espacios

## 🐛 Solución de Problemas

### Error de conexión a la base de datos
- Verificar credenciales en `config/database.php`
- Asegurar que MySQL esté corriendo
- Verificar que la base de datos existe

### Página en blanco
- Verificar logs de PHP
- Habilitar display_errors en desarrollo
- Revisar permisos de archivos

### Estilos no se cargan
- Limpiar caché del navegador (Ctrl + Shift + R)
- Verificar rutas de archivos CSS
- Revisar consola del navegador

## 📝 Licencia

Este proyecto es propiedad del SENA - Servicio Nacional de Aprendizaje.

## 👨‍💻 Autor

Desarrollado para el SENA - Centro de Desarrollo Tecnológico

## 📞 Soporte

Para soporte técnico, contactar a:
- Email: soporte@sena.edu.co
- Teléfono: (601) 5461500

## 🔄 Actualizaciones

### Versión 1.0 (Marzo 2026)
- Implementación inicial del sistema
- Módulos de gestión completos
- Sistema de roles y permisos
- Interfaz moderna y responsive
- Formularios con validación
- Modales para detalles de registros

---

**© 2026 SENA - Servicio Nacional de Aprendizaje**
