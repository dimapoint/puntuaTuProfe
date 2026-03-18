# puntuaTuProfe

**puntuaTuProfe** es una plataforma web estilo "Rate My Professor" diseñada específicamente para que los estudiantes puedan calificar y reseñar a sus docentes. El objetivo es crear una comunidad transparente que ayude a los alumnos a tomar mejores decisiones académicas basadas en la experiencia de sus pares.

---

## Características Principales

- **Dashboard Dinámico:** Visualización de estadísticas generales (total de profesores, materias y reseñas) y últimas actividades.
- **Directorio de Profesores:** Búsqueda y filtrado de docentes por nombre o departamento.
- **Sistema de Calificación:** 
  - Calidad (1-5)
  - Dificultad (1-5)
  - Recomendación (¿Volverías a cursar?)
  - Comentarios detallados por materia.
- **Base de Datos Académica:** Incluye el plan de estudios completo de **Ingeniería en Informática (UCC)**.
- **Panel de Administración:** Gestión completa de profesores, materias y usuarios.
- **Seguridad Institucional:** Validación de registro exclusiva para correos `@ucc.edu.ar`.

---

## Stack Tecnológico

- **Backend:** [Laravel 11+](https://laravel.com/) (PHP 8.2+)
- **Frontend:** [Blade](https://laravel.com/docs/blade), [Tailwind CSS 4](https://tailwindcss.com/)
- **Base de Datos:** SQLite (Desarrollo)
- **Herramientas:** Vite, Composer, NPM

---

## Instalación y Configuración

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/puntuatuprofe.git
cd puntuaTuProfe
```

### 2. Instalar dependencias
```bash
composer install
npm install
```

### 3. Configurar el entorno
Copia el archivo de ejemplo y genera la clave de la aplicación:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Preparar la base de datos
Crea el archivo de SQLite y ejecuta las migraciones junto con los seeders (esto cargará las materias de la UCC y datos de prueba):
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### 5. Compilar assets y ejecutar servidor
En terminales separadas:
```bash
# Terminal A: Servidor de desarrollo
php artisan serve

# Terminal B: Compilación de frontend (Vite)
npm run dev
```

---

## Estructura del Proyecto (Modularizada)

El proyecto sigue una arquitectura limpia para facilitar su mantenimiento:

- **`app/Services`**: Contiene la lógica de negocio (e.g., `TeacherService`, `ReviewService`).
- **`app/Http/Requests`**: Clases de validación personalizadas para formularios.
- **`app/Models`**: Modelos Eloquent con Scopes para consultas optimizadas.
- **`resources/views/components`**: Componentes Blade reutilizables (e.g., `teacher-card`).
- **`lang/es.json`**: Traducciones completas al español.

---

## Pruebas (Testing)

Para ejecutar la suite de pruebas unitarias y de integración:
```bash
php artisan test
```

---

## Credenciales de Prueba (Seeder)

Si utilizaste el comando `--seed`, puedes acceder con:
- **Admin:** `admin@example.com` / `password`
- **Usuarios:** Revisa la tabla `users` para correos autogenerados (todos usan la contraseña `password`).

---

## Convenciones de Desarrollo

- **Idiomas:** El código (clases, métodos, variables) está en inglés por convención técnica, mientras que la interfaz de usuario está 100% en español.
- **Validación:** Todas las reseñas requieren un comentario mínimo de 10 caracteres y una materia asociada.
- **Seguridad:** El registro está restringido a dominios `@ucc.edu.ar`.

---

Desarrollado para la comunidad estudiantil de la UCC.
