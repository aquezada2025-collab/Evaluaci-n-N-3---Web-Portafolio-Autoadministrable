# 🚀 Portafolio Web Dinámico - Allan Quezada

## 📖 Descripción de la Página
Este proyecto es un portafolio web personal, completamente dinámico y autoadministrable, desarrollado desde cero. Su objetivo principal es mostrar la biografía, habilidades, tecnologías dominadas y proyectos realizados de manera profesional[cite: 2, 4, 5, 7]. A diferencia de un portafolio estático, cuenta con un **Panel de Administración (Back-end)** protegido con usuario y contraseña, desde donde se puede realizar un CRUD (Crear, Leer, Actualizar, Eliminar) de toda la información visible en la página sin necesidad de tocar el código fuente[cite: 15, 17, 18, 19, 20]. También incluye un formulario de contacto funcional que envía mensajes directamente al correo del administrador[cite: 3, 6].

## 🌐 Enlace del Proyecto
> **[🔗 HAZ CLIC AQUÍ PARA VER LA PÁGINA EN VIVO](teclab)** 
*(Reemplaza este enlace con la URL de tu proyecto una vez subido a un hosting).*

## 🛠️ Tecnologías Usadas
El proyecto fue construido utilizando tecnologías puras para garantizar un rendimiento óptimo y control total sobre el código:

* **Front-end:** HTML5, CSS3 puro (mediante variables y estilos modulares)[cite: 8, 9, 10, 11] y Vanilla JavaScript (para efectos visuales como la escritura de texto y validaciones del DOM)[cite: 2, 12].
* **Framework CSS:** Bootstrap 5.3 (vía CDN para diseño responsivo y sistema de grillas)[cite: 2, 4, 5, 6, 7].
* **Back-end:** PHP 7.4+ con patrón de arquitectura modular[cite: 17, 18, 19, 20].
* **Base de Datos:** MySQL gestionado a través de PDO (PHP Data Objects) para consultas seguras y preparadas[cite: 1, 21].
* **Servidor Local:** Testeado en entorno XAMPP / WAMP (Apache).

## 📁 Estructura del Proyecto
La arquitectura del proyecto está organizada de la siguiente manera, separando estrictamente la vista pública de la lógica administrativa y los recursos:

```text
/aquezada2025
│
├── database.sql                  # Script completo para generar la base de datos y tablas
├── index.php                     # Página principal (Hero section y biografía pública)[cite: 2]
│
├── /admin                        # 🔒 ÁREA PROTEGIDA (Back-end)
│   ├── db_config.php             # Configuración de conexión PDO a MySQL
│   ├── /autch                    # Módulo de Autenticación
│   │   ├── login.php             # Vista y lógica de inicio de sesión[cite: 15]
│   │   └── logout.php            # Destrucción de sesión[cite: 16]
│   └── /panel                    # Módulos CRUD del Panel de Control
│       ├── g_biografia.php       # Edición de datos personales, redes y footer[cite: 20]
│       ├── g_habilidades.php     # Gestión de habilidades y colores[cite: 17]
│       ├── g_proyectos.php       # Gestión de proyectos, imágenes y links[cite: 18]
│       └── g_tecnologia.php      # Gestión de tecnologías, niveles y %[cite: 19]
│
├── /assets                       # 🎨 RECURSOS ESTÁTICOS
│   ├── /css                      # Hojas de estilo modulares
│   │   ├── admin.css             # Estilos del panel de control y sidebar[cite: 10]
│   │   ├── autch.css             # Estilos de la tarjeta de login[cite: 11]
│   │   ├── g_tabla.css           # Estilos de los inputs y tablas de gestión[cite: 8]
│   │   └── style.css             # Estilos públicos (Navbar, Hero, Cards, Footer)[cite: 9]
│   └── /img                      # Directorio de imágenes locales
│       └── tu_foto.jpg           # Foto de perfil[cite: 2, 12, 14]
│
├── /includes                     # 🧩 COMPONENTES REUTILIZABLES (Inclusiones PHP)
│   ├── footer.php                # Pie de página público con redes dinámicas[cite: 14]
│   ├── navbar.php                # Barra de navegación pública con script protector del DOM[cite: 12]
│   └── sidebar.php               # Menú lateral de navegación para el panel admin[cite: 13]
│
└── /sections                     # 🌍 VISTAS PÚBLICAS SECUNDARIAS
    ├── contacto.php              # Interfaz del formulario de contacto[cite: 6]
    ├── habilidades.php           # Renderizado dinámico de la tabla de habilidades[cite: 7]
    ├── procesar_contactos.php    # Lógica de envío de correos vía mail() de PHP[cite: 3]
    ├── proyecto.php              # Renderizado del catálogo de proyectos y enlaces[cite: 4]
    └── tecnologia.php            # Renderizado de barras de progreso de tecnologías[cite: 5]