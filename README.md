# Proyecto: Pizza ABC Inventario

Repositorio: [https://github.com/SoyOchaita/Pizza-ABC-Inventario](https://github.com/SoyOchaita/Pizza-ABC-Inventario)

---

## 🚀 Requisitos previos

- Tener instalado **XAMPP** (Apache y MySQL activos)
- Tener instalado **PHP** (8.1 o superior)
- Tener instalado **Composer** [https://getcomposer.org/](https://getcomposer.org/)
- Tener instalado **Node.js** y **npm** [https://nodejs.org/](https://nodejs.org/)

---

## 📥 Pasos para instalar el proyecto

### 1. Clonar el repositorio

Puedes escoger la carpeta que prefieras en tu computadora, por ejemplo:

```bash
cd C:/MiCarpeta/Proyectos

git clone https://github.com/SoyOchaita/Pizza-ABC-Inventario.git Inventario_ABC
cd Inventario_ABC
```

---

### 2. Instalar dependencias de PHP (Laravel)

```bash
composer install
```

---

### 3. Configurar el archivo `.env`

Copia el archivo `.env.example`:

```bash
copy .env.example .env
```

Edita el archivo `.env` y configura las siguientes variables:

```dotenv
APP_NAME="PizzaABC"
APP_URL=http://localhost/Inventario_ABC/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pizzaabc
DB_USERNAME=root
DB_PASSWORD=
```

> Nota: Crea una base de datos llamada **pizzaabc** en phpMyAdmin antes de continuar.

---

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

---

### 5. Migrar la base de datos

(Si no tienes respaldo `.sql`, corre:)

```bash
php artisan migrate
```

---

### 6. Instalar dependencias de frontend (Vite)

```bash
npm install
```

---

### 7. Compilar assets para producción

```bash
npm run build
```

Esto generará la carpeta `/public/build` con el `manifest.json` que necesita Vite.

---

### 8. Iniciar el proyecto en el navegador

Asegúrate que Apache y MySQL estén encendidos en XAMPP, y abre:

```
http://localhost/Inventario_ABC/public
```

---

## ⚡ Comandos resumidos

```bash
cd ruta/donde/quieras/clonar

git clone https://github.com/SoyOchaita/Pizza-ABC-Inventario.git Inventario_ABC
cd Inventario_ABC

composer install
copy .env.example .env
php artisan key:generate
php artisan migrate

npm install
npm run build
```

---

## ✨ Observaciones

- Si ves el error **"Vite manifest not found"**, recuerda correr `npm run build`.
- Si quieres eliminar `/public` de la URL, puedes configurar un Virtual Host (opcional).
- Cada vez que modifiques archivos de frontend, debes volver a correr `npm run build`.

---

## 🌐 Links útiles

- Composer: [https://getcomposer.org/](https://getcomposer.org/)
- Node.js: [https://nodejs.org/](https://nodejs.org/)
- Documentación Laravel: [https://laravel.com/docs/10.x](https://laravel.com/docs/10.x)


## 🔗 Contacto para soporte

**Desarrollador:** Alfonso Ochaita  
**Email:** ochaita2404@gmail.com

---

¡Listo! Con estos pasos cualquier persona podrá instalar y correr el proyecto de forma rápida y segura. 🚀

