# MCC – Mi Clínica Control

Es una aplicación que intenta resolver el problema de comunicación y comprensión
entre paciente/médico en una unidad de tiempo como una visita médica. Posibilita la
interconexión entre paciente y médico para hacer más eficientes los procesos.
Vamos a ver cuáles son las ventajas de MCC – Mi Clínica Control donde se almacenan
datos de pacientes para realizar seguimientos más correctos y más accesibles a los
médicos.
Como paciente acumulamos una barbaridad de documentos en papel con las
anotaciones de cambios o evolución de nuestra enfermedad. O preguntas que nos
surge hasta la próxima cita. Y cuando por fin llega el día de nuestra consulta médica
tenemos muy poco tiempo mostrar los datos. Teniéndolos en nuestra aplicación
podremos mostrarlos en cualquier lugar y en cualquier momento. De una manera más
legible.
Para que el médico pueda hacer el seguimiento de sus pacientes más completo, es
mejor que lo hagamos de forma digital y nos olvidemos de los documentos en papel
que nos ocupan espacio en nuestra consulta y además, corren el riesgo de perderse o
dañarse si ocurre algo en la clínica.

# Descripción del Proyecto

Este es un proyecto web desarrollado con Laravel, utilizando el stack de autenticación Laravel Breeze y la herramienta de construcción de frontend Vite.

# Tecnologías Utilizadas

Laravel: Framework PHP moderno y robusto para desarrollo backend.

Laravel Breeze: Paquete oficial de autenticación ligera para Laravel. Proporciona una base sencilla con rutas, controladores, vistas Blade y autenticación ya configurada.

Vite: Herramienta de construcción moderna para frontend (reemplaza a Laravel Mix). Se utiliza para compilar y servir los assets frontend (JS, CSS).

Blade: Motor de plantillas de Laravel para el diseño de interfaces.

# Funcionalidades Clave

Sistema de autenticación (registro, login, logout) con Breeze.

División de roles: admin, facultativo, paciente.

CRUD completo para entidades como usuarios, enlaces y autorizaciones.

Paneles adaptados a cada tipo de usuario.

Interfaz responsiva con Bootstrap y Blade.

---

## Requisitos

-   PHP >= 8.1
-   Composer
-   MySQL o MariaDB
-   Node.js >= 18
-   NPM

---

## Instalación

1. **Clona el repositorio o descomprime el ZIP**
    ```bash
    https://github.com/black-cat-17/mcc.mi.clinica.control.git
    cd tu-repo
    ```

````

2. **Instala dependencias de PHP**

   ```bash
   composer install
   ```

3. **Instala dependencias de JavaScript**

   ```bash
   npm install
   ```

4. **Copia y configura el archivo de entorno**

   ```bash
   cp .env.example .env
   ```

   Configura los datos de conexión a base de datos y correo si aplica.

5. **Genera la clave de la aplicación**

   ```bash
   php artisan key:generate
   ```

6. **Compila los assets de Vite**

   ```bash
   npm run build
   ```

7. **Inicia el servidor**

   ```bash
   php artisan serve
   ```

   Visita: [http://localhost:8000](http://localhost:8000)

---

## Base de datos

El archivo `mcc10.sql` contiene la estructura y datos necesarios. Importe este archivo en tu gestor (phpMyAdmin, Adminer, etc.).

---

## Notas

* Para desarrollo, puedes usar `npm run dev` para recarga automática de assets.
* El proyecto está dividido por roles: admin, facultativo, paciente.
* Verifica las rutas personalizadas en `routes/web.php`.

---
````
# mcc.mi.clinica.control
# mcc.mi.clinica.control
