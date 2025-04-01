# OutFlix - Gestor de Series y Películas

## Descripción
OutFlix es una aplicación web desarrollada en **PHP Laravel** que permite a los usuarios gestionar su lista personalizada de series y películas. 

### Funcionalidades principales:
- **CRUD de series y películas:** Agregar, editar, eliminar y visualizar series y películas en una lista personal.
- **Categorías:** Clasificación de contenido por géneros (acción, comedia, drama, etc.).
- **Registro de estado de visualización:** Marcar contenido como "visto", "en progreso" o "pendiente".
- **Interfaz intuitiva:** Diseñada para mejorar la experiencia del usuario.

Con **OutFlix**, los usuarios pueden disfrutar de una experiencia organizada y personalizada, centrándose en su contenido favorito. 

## Configuración del entorno
### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/outflix.git
cd outflix
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar el archivo `.env`
```bash
cp .env.example .env
```
Configura las credenciales de la base de datos en `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=OutFlix
DB_USERNAME=
DB_PASSWORD=
```

### 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones
Esto ejecutará las siguientes migraciones en orden:
- `2025_03_18_012553_create_usuarios_table.php`
- `2025_03_18_012638_create_categorias_table.php`
- `2025_03_18_012642_create_estado_visto_table.php`
- `2025_03_18_012632_create_series_peliculas_table.php`

```bash
php artisan migrate
```


### 6. Iniciar el servidor
```bash
php artisan serve
```
Ahora puedes acceder a la aplicación en `http://127.0.0.1:8000` 🚀
