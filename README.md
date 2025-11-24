# 📇 Sistema de Gestión de Contactos Municipales

> Sistema web para la gestión de contactos y organizaciones de instituciones municipales de Costa Rica

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 📋 Descripción

Sistema de gestión desarrollado en Laravel 11 para administrar contactos de organizaciones municipales. Incluye:

- 🏢 Gestión de organizaciones (instituciones públicas/privadas)
- 👥 Gestión de contactos (personas dentro de las organizaciones)
- 📍 Sistema de ubicación geográfica (provincias, cantones, distritos de Costa Rica)
- 🔐 Sistema de roles y permisos (Admin/User)
- ✅ Sistema de aprobación de usuarios
- 🔒 Autenticación segura con Laravel Sanctum

---

## 🚀 Inicio Rápido

### Requisitos Previos
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laragon (recomendado para Windows)

### Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/cristoferAn1234/proyectContactosMuni.git
cd proyectContactosMuni

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias Node
npm install

# 4. Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env
DB_DATABASE=contactos_muni
DB_USERNAME=root
DB_PASSWORD=

# 6. Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# 7. Iniciar servidores
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

### 🔑 Acceso Inicial

Después de ejecutar los seeders, usa estas credenciales:

```
🌐 URL: http://127.0.0.1:8000/login

📧 Email: admin@contactosmuni.com
🔑 Password: Admin123!
```

⚠️ **IMPORTANTE:** Cambiar la contraseña después del primer inicio de sesión

---

## 📚 Documentación

## 📚 Documentación

| Documento | Descripción |
|-----------|-------------|
| 🚀 [INICIO_RAPIDO.md](./INICIO_RAPIDO.md) | Guía de inicio rápido en 3 pasos |
| 📄 [INFORME_AUDITORIA_Y_CORRECCIONES.md](./INFORME_AUDITORIA_Y_CORRECCIONES.md) | Análisis completo de problemas y soluciones |
| 📊 [DIAGRAMA_ROLES.md](./DIAGRAMA_ROLES.md) | Visualización del sistema de roles y permisos |
| 📝 [RESUMEN_CAMBIOS.md](./RESUMEN_CAMBIOS.md) | Lista de todos los cambios implementados |
| 🔐 [CREDENCIALES_ADMIN.md](./CREDENCIALES_ADMIN.md) | Credenciales de acceso y seguridad |

---

## 🎭 Sistema de Roles

### Roles Disponibles

| Rol | Descripción | Permisos |
|-----|-------------|----------|
| **admin** | Administrador del sistema | Acceso completo, gestión de usuarios, eliminar registros |
| **user** | Usuario regular | Ver, crear y editar contactos/organizaciones |

### Estados de Usuario

| Estado | Descripción | Acceso |
|--------|-------------|--------|
| **aprobado** | Usuario autorizado | ✅ Acceso completo según su rol |
| **pendiente** | Esperando aprobación | ❌ Sin acceso al sistema |
| **no_aprobado** | Usuario rechazado | ❌ Sin acceso al sistema |

---

## 🗄️ Estructura de la Base de Datos

### Tablas Principales

- **users** - Usuarios del sistema
- **organizaciones** - Instituciones/empresas
- **contactos** - Personas dentro de organizaciones
- **telefonos** - Números telefónicos de contactos
- **provincias** - Provincias de Costa Rica
- **cantones** - Cantones por provincia
- **distritos** - Distritos por cantón
- **tiposOrganizacion** - Tipos de organizaciones
- **puestos** - Cargos/posiciones laborales

---

## 🛡️ Middleware Implementados

### CheckRole
Verifica que el usuario tenga el rol requerido.

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rutas solo para administradores
});
```

### CheckApproved
Verifica que el usuario esté aprobado.

```php
Route::middleware(['auth', 'approved'])->group(function () {
    // Rutas solo para usuarios aprobados
});
```

---

## 📍 Rutas Principales

### Públicas
```
GET  /                  # Página de inicio
GET  /login             # Iniciar sesión
POST /login             # Procesar login
GET  /register          # Registro
POST /register          # Procesar registro
```

### Usuario Aprobado
```
GET  /dashboard                      # Panel principal
GET  /contactos                      # Listar contactos
POST /contactos                      # Crear contacto
GET  /organizaciones                 # Listar organizaciones
POST /organizaciones                 # Crear organización
```

### Administrador
```
GET  /users                          # Gestionar usuarios
POST /users/{id}/approve             # Aprobar usuario
POST /users/{id}/reject              # Rechazar usuario
DELETE /contactos/{id}               # Eliminar contacto
DELETE /organizaciones/{id}          # Eliminar organización
```

---

## 🔧 Comandos Útiles

```bash
# Reiniciar base de datos
php artisan migrate:fresh --seed

# Crear solo usuario admin
php artisan db:seed --class=AdminUserSeeder

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Ver todas las rutas
php artisan route:list

# Acceder a consola interactiva
php artisan tinker
```

---

## 🧪 Testing

```bash
# Ejecutar todos los tests
php artisan test

# Tests específicos
php artisan test --filter=RoleMiddlewareTest
```

---

## 🚨 Solución de Problemas

### Error: Vite manifest not found
```bash
npm install
npm run dev
```

### Error: No puedo acceder al dashboard
- Verificar que el usuario esté **aprobado** (`aprobado = 'aprobado'`)
- El administrador debe aprobar usuarios en `/users`

### Olvidé la contraseña del admin
```bash
php artisan tinker
```
```php
$admin = User::where('email', 'admin@contactosmuni.com')->first();
$admin->password = Hash::make('NuevaContraseña123!');
$admin->save();
```

---

## 📊 Características Implementadas

- ✅ Sistema de autenticación con Laravel Sanctum
- ✅ Sistema de roles y permisos
- ✅ Aprobación de usuarios por administrador
- ✅ CRUD completo para organizaciones y contactos
- ✅ Gestión de ubicación geográfica de Costa Rica
- ✅ Middleware de protección de rutas
- ✅ Políticas de autorización
- ✅ Seeders automáticos con datos de prueba
- ✅ Interfaz responsive con Tailwind CSS

---

## 🔮 Próximas Mejoras

- [ ] Dashboard con estadísticas
- [ ] Notificaciones por email
- [ ] Exportación de datos (Excel/PDF)
- [ ] Sistema de búsqueda avanzada
- [ ] Autenticación de dos factores (2FA)
- [ ] API REST documentada con Swagger
- [ ] Logs de auditoría
- [ ] Tests unitarios y de integración

---

## 👥 Equipo de Desarrollo

- **Repositorio:** [cristoferAn1234/proyectContactosMuni](https://github.com/cristoferAn1234/proyectContactosMuni)
- **Branch:** Kristin

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

---

## 🙏 Agradecimientos

- [Laravel](https://laravel.com) - Framework PHP
- [Tailwind CSS](https://tailwindcss.com) - Framework CSS
- [Vite](https://vitejs.dev) - Build tool

---

## 📞 Soporte

Para reportar problemas o sugerencias:
- 🐛 [Issues en GitHub](https://github.com/cristoferAn1234/proyectContactosMuni/issues)
- 📧 Email de soporte (configurar)
- 📖 Consultar documentación en la carpeta del proyecto

---

**Última actualización:** 23/11/2025  
**Versión:** 1.0  
**Estado:** ✅ En producción
