CREATE TABLE `cat_estatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_descripcion` varchar(255) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `cat_estatus` (`estatus_descripcion`, `creator_user_id`) VALUES
('Activo', 1),
('Inactivo', 1),
('Orden Activa', 1),
('Orden Generada', 1),
('Orden Servida', 1),
('Orden Finalizada', 1),
('Producto Cocinado', 1),
('Producto Entregado', 1);

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_descripcion` varchar(255) NOT NULL,
  `orden` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `categorias` (`categoria_descripcion`, `orden`, `id_estatus`,`creator_user_id`) VALUES
('Entradas', 0, 1, 1),
('Carnes', 1, 1, 1),
('Pescados', 2, 1, 1),
('Snacks', 3, 1, 1),
('Bebidas', 4, 1, 1),
('Postres', 5, 1, 1);

CREATE TABLE `cat_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `response_code` varchar(255) NOT NULL,
  `response_descripcion` varchar(255) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;


INSERT INTO `cat_responses` (`response_code`, `response_descripcion`, `creator_user_id`) VALUES
('200','El proceso se realizó correctamente', 1),
('500','Error del sistema', 1),
('501','Error usuario y contraseña incorrectos', 1),
('502','Error el usuario esta dado de baja', 1),
('503','Error contraseña incorrecta', 1);

CREATE TABLE `cat_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_descripcion` varchar(255) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `cat_perfiles` (`perfil_descripcion`, `id_estatus`, `creator_user_id`) VALUES
('Administrador', 1, 1),
('Mesero', 1, 1),
('Cocinero', 1, 1),
('Cliente', 1, 1);

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `total` double(10,2) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;


CREATE TABLE `detalle_ordenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double(10,2) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `opciones_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etiqueta` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `fa_icon` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `opciones_menu` (`etiqueta`, `url`, `fa_icon`, `orden`, `parent_menu_id`, `id_estatus`, `creator_user_id`) VALUES
('Admin Usuario', '', 'fa-laptop', 0, 0, 1, 1),
('Menú', 'opciones_menu', NULL, 0, 1, 1, 1),
('Perfiles', 'perfiles', NULL, 1, 1, 1, 1),
('Permisos', 'permisos', NULL, 2, 1, 1, 1),
('Usuarios', 'usuarios', NULL, 3, 1, 1, 1),
('Catálogos', '', 'fa-book', 1, 0, 1, 1),
('Categorías', 'categorias', NULL, 0, 6, 1, 1),
('Productos', 'productos', NULL, 1, 6, 1, 1),
('Ordenes', 'ordenes', NULL, 2, 6, 1, 1);

CREATE TABLE `permisos_perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `permisos_perfiles` (`id_perfil`, `id_menu`, `id_estatus`, `creator_user_id`) VALUES
(1, 1, 1, 1),
(1, 2, 1, 1),
(1, 3, 1, 1),
(1, 4, 1, 1),
(1, 5, 1, 1),
(1, 6, 1, 1),
(1, 7, 1, 1),
(1, 8, 1, 1),
(1, 9, 1, 1);

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `abilities` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_descripcion` varchar(255) NOT NULL,
  `producto_detalle` longtext NOT NULL,
  `producto_receta` longtext NOT NULL,
  `multimedia` varchar(255) NOT NULL,
  `precio` double(10,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `productos` (`producto_descripcion`, `producto_detalle`, `producto_receta`, `multimedia`, `precio`, `id_categoria`, `orden`, `id_estatus`, `creator_user_id`) VALUES
('Empanadas con Carne Molida', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'empanadas_carnemolida.jpeg',120.00,1,0,1,1),
('Burritos con Guacamole', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'burritos_guacamole.jpeg',100.00,1,1,1,1),
('Arrachera', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'arrachera.jpeg',280.00,2,0,1,1),
('T-Bone', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 't_bone.jpeg',320.00,2,1,1,1),
('Camaranoes a la Diabla', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'camarones_diabla.jpeg',220.00,3,0,1,1),
('Huachinango a la Talla', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'huachinango.jpeg',290.00,3,1,1,1),
('Alitas (Pack 10)', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'alitas.jpeg',150.00,4,0,1,1),
('Hamburguesa con Papas', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'hamburguesa.jpeg',130.00,4,1,1,1),
('Coca-Cola', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'cocacola.jpeg',30.00,5,0,1,1),
('Cerveza Corona', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'cerveza_corona.jpg',40.00,5,1,1,1),
('Flan', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'flan.jpeg',30.00,6,0,1,1),
('Brownie', 'Aqui va el detalle del producto', 'Aqui va la receta del producto', 'brownie.jpeg',25.00,6,1,1,1);

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `payload` text COLLATE utf8_spanish_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ape_paterno` varchar(255) NOT NULL,
  `ape_materno` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `intentos` tinyint(11) DEFAULT 0,
  `id_perfil` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `creator_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater_user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT = 1 CHARACTER SET utf8 COLLATE utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `usuarios` (`username`, `password`, `nombre`, `ape_paterno`, `ape_materno`, `email`, `telefono`, `id_perfil`, `id_estatus`, `creator_user_id`) VALUES
('admin', '$2y$12$4KyJPKKQFP46tvZ/LIBMnulWOYovGSdfI4duQ4MVRdkEs/zz1yjeq', 'Soy', 'Un', 'Administrador', 'adminsa@gmail.com', '7331234567', 1, 1, 1);