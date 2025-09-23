


-- crear publicaciones
INSERT INTO publicaciones (usuario_id, texto, privacidad, numero_megusta, numero_comentarios, creado_en, actualizado_en, borrado_en) VALUES
(6241, 'Mi primera publicación en esta red social.', 'publico', 5, 2, '2025-09-23 09:00:00', '2025-09-23 09:00:00', NULL),
(6242, '¡Hola a todos! Emocionado de estar aquí.', 'amigos', 10, 4, '2025-09-23 09:05:00', '2025-09-23 09:05:00', NULL),
(6243, 'Compartiendo un pensamiento del día.', 'mejores amigos', 15, 6, '2025-09-23 09:10:00', '2025-09-23 09:10:00', NULL),
(6244, 'Me encanta este diseño. Es muy limpio.', 'publico', 20, 8, '2025-09-23 09:15:00', '2025-09-23 09:15:00', NULL),
(6245, 'Nuevo día, nueva oportunidad para crear.', 'amigos', 25, 10, '2025-09-23 09:20:00', '2025-09-23 09:20:00', NULL),
(6246, 'Explorando las funciones de la plataforma.', 'publico', 30, 12, '2025-09-23 09:25:00', '2025-09-23 09:25:00', NULL),
(6247, 'El café es mi combustible para la creatividad.', 'amigos', 35, 14, '2025-09-23 09:30:00', '2025-09-23 09:30:00', NULL),
(6248, 'Una publicación de prueba para ver cómo se ve.', 'mejores amigos', 40, 16, '2025-09-23 09:35:00', '2025-09-23 09:35:00', NULL),
(6249, 'Descubriendo nuevas comunidades.', 'publico', 45, 18, '2025-09-23 09:40:00', '2025-09-23 09:40:00', NULL),
(6250, 'Listo para conectar con gente nueva.', 'amigos', 50, 20, '2025-09-23 09:45:00', '2025-09-23 09:45:00', NULL);

-- crear fotos
INSERT INTO fotos (publicacion_id, usuario_id, nombre_original, ruta, tipo_mime, tamano, ancho, alto, es_principal, creado_en) VALUES
-- Publicación ID 5
(29, 6241, 'foto-cielo.jpg', '/uploads/fotos/5/foto1.jpg', 'image/jpeg', 150000, 1920, 1080, 1, NOW()),
(29, 6241, 'foto-mar.png', '/uploads/fotos/5/foto2.png', 'image/png', 200000, 1280, 720, 0, NOW()),

-- Publicación ID 6
(30, 6242, 'foto-montana.jpg', '/uploads/fotos/6/foto1.jpg', 'image/jpeg', 300000, 1920, 1080, 1, NOW()),
(30, 6242, 'foto-bosque.jpg', '/uploads/fotos/6/foto2.jpg', 'image/jpeg', 250000, 1920, 1080, 0, NOW()),
(30, 6242, 'foto-rio.jpg', '/uploads/fotos/6/foto3.jpg', 'image/jpeg', 350000, 1920, 1080, 0, NOW()),

-- Publicación ID 7
(31, 6243, 'foto-ciudad.jpg', '/uploads/fotos/7/foto1.jpg', 'image/jpeg', 400000, 1920, 1080, 1, NOW()),
(31, 6243, 'foto-noche.jpg', '/uploads/fotos/7/foto2.jpg', 'image/jpeg', 500000, 1920, 1080, 0, NOW()),

-- Publicación ID 8
(32, 6244, 'foto-animal.jpg', '/uploads/fotos/8/foto1.jpg', 'image/jpeg', 220000, 1920, 1080, 1, NOW()),
(32, 6244, 'foto-mascota.jpg', '/uploads/fotos/8/foto2.jpg', 'image/jpeg', 180000, 1920, 1080, 0, NOW()),
(32, 6244, 'foto-parque.jpg', '/uploads/fotos/8/foto3.jpg', 'image/jpeg', 280000, 1920, 1080, 0, NOW()),
(32, 6244, 'foto-jardin.jpg', '/uploads/fotos/8/foto4.jpg', 'image/jpeg', 310000, 1920, 1080, 0, NOW()),

-- Publicación ID 9
(33, 6245, 'foto-evento.jpg', '/uploads/fotos/9/foto1.jpg', 'image/jpeg', 190000, 1920, 1080, 1, NOW()),
(33, 6245, 'foto-viaje.jpg', '/uploads/fotos/9/foto2.jpg', 'image/jpeg', 240000, 1920, 1080, 0, NOW()),
(33, 6245, 'foto-playa.jpg', '/uploads/fotos/9/foto3.jpg', 'image/jpeg', 280000, 1920, 1080, 0, NOW()),
(33, 6245, 'foto-vacaciones.jpg', '/uploads/fotos/9/foto4.jpg', 'image/jpeg', 320000, 1920, 1080, 0, NOW()),
(33, 6245, 'foto-amigos.jpg', '/uploads/fotos/9/foto5.jpg', 'image/jpeg', 290000, 1920, 1080, 0, NOW());