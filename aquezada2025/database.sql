CREATE DATABASE IF NOT EXISTS `aquezada_db2`;
USE `aquezada_db2`;

CREATE TABLE `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuarios` (`email`, `password`) VALUES 
('admin@admin.cl', 'aquezada2025XD26');


CREATE TABLE biografia (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nombre        VARCHAR(100)  DEFAULT NULL,
    descripcion   TEXT          DEFAULT NULL,
    ciudad        VARCHAR(50)   DEFAULT NULL,
    email         VARCHAR(100)  DEFAULT NULL,
    footer_texto  VARCHAR(255)  DEFAULT NULL,
    linkedin      VARCHAR(255)  DEFAULT NULL,
    github        VARCHAR(255)  DEFAULT NULL,
    twitter       VARCHAR(255)  DEFAULT NULL
);

-- Insertar datos iniciales para que no esté vacía
INSERT INTO biografia (nombre, descripcion, ciudad, email, footer_texto, linkedin, github, twitter)
VALUES (
    'Allan Quezada',
    'Desarrollador Web apasionado por crear soluciones digitales.',
    'Temuco',
    'admin@admin.cl',
    '© 2026 Allan Quezada — Todos los derechos reservados',
    'https://linkedin.com/in/tu-perfil',
    'https://github.com/tu-usuario',
    'https://twitter.com/tu-usuario'
);
-- Tabla de Habilidades (Corregida con la columna color)
CREATE TABLE habilidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    clase VARCHAR(50),
    color VARCHAR(20)
);

-- Insertamos tus habilidades con sus colores originales
INSERT INTO habilidades (nombre, clase, color) VALUES 
('HTML5', 'html5', '#e34f26'),
('CSS3', 'css3', '#1572b6'),
('JavaScript', 'javascript', '#f7df1e'),
('PHP', 'php', '#777bb4'),
('MySQL', 'mysql', '#4479a1'),
('Bootstrap', 'bootstrap', '#7952b3'),
('GitHub', 'github', '#181717'),
('IA Dev', 'iadev', '#00d1b2');

-- Tabla de Tecnologías (Creada con los campos necesarios para tu lógica)
CREATE TABLE tecnologias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    porcentaje INT NOT NULL,
    nivel VARCHAR(30),
    clase_badge VARCHAR(50),
    color VARCHAR(20)
);
-- Inserta un dato de prueba
INSERT INTO tecnologias (nombre, porcentaje, nivel, clase_badge, color) VALUES 
('PHP', 85, 'Avanzado', 'badge-avanzado', '#8e44ad'),
('JavaScript', 78, 'Intermedio', 'badge-intermedio', '#f1c40f'),
('MySQL', 82, 'Intermedio', 'badge-intermedio', '#3498db'),
('HTML / CSS', 92, 'Avanzado', 'badge-avanzado', '#e67e22'),
('Bootstrap', 88, 'Avanzado', 'badge-avanzado', '#9b59b6'),
('GitHub', 75, 'Intermedio', 'badge-intermedio', '#2c3e50'),
('AJAX / JSON', 68, 'Básico', 'badge-basico', '#1a2a6c'),
('Responsive Design', 80, 'Intermedio', 'badge-intermedio', '#008080');

CREATE TABLE proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(255),
    enlace_demo VARCHAR(255),
    enlace_github VARCHAR(255),
    tags VARCHAR(255)
);

INSERT INTO proyectos (titulo, descripcion, imagen, enlace_demo, enlace_github, tags) VALUES 
('Proyecto 1', 'Sistema de gestión web con PHP y MySQL.', 'ruta/imagen1.jpg', '#', '#', 'PHP,MySQL'),
('Proyecto 2', 'Landing page responsive con Bootstrap.', 'ruta/imagen2.jpg', '#', '#', 'HTML,CSS,Bootstrap'),
('Proyecto 3', 'Aplicación JS con consumo de API.', 'ruta/imagen3.jpg', '#', '#', 'JS,AJAX,API');

