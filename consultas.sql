




-- crear fotos
INSERT INTO fotos (publicacion_id, usuario_id, nombre_original, ruta, tipo_mime, tamano, ancho, alto, es_principal, creado_en) VALUES
-- Publicación ID 5
(5, 6240, 'foto-cielo.jpg', '/uploads/fotos/5/foto1.jpg', 'image/jpeg', 150000, 1920, 1080, 1, NOW()),
(5, 6240, 'foto-mar.png', '/uploads/fotos/5/foto2.png', 'image/png', 200000, 1280, 720, 0, NOW()),

-- Publicación ID 6
(6, 6239, 'foto-montana.jpg', '/uploads/fotos/6/foto1.jpg', 'image/jpeg', 300000, 1920, 1080, 1, NOW()),
(6, 6239, 'foto-bosque.jpg', '/uploads/fotos/6/foto2.jpg', 'image/jpeg', 250000, 1920, 1080, 0, NOW()),
(6, 6239, 'foto-rio.jpg', '/uploads/fotos/6/foto3.jpg', 'image/jpeg', 350000, 1920, 1080, 0, NOW()),

-- Publicación ID 7
(7, 6238, 'foto-ciudad.jpg', '/uploads/fotos/7/foto1.jpg', 'image/jpeg', 400000, 1920, 1080, 1, NOW()),
(7, 6238, 'foto-noche.jpg', '/uploads/fotos/7/foto2.jpg', 'image/jpeg', 500000, 1920, 1080, 0, NOW()),

-- Publicación ID 8
(8, 6237, 'foto-animal.jpg', '/uploads/fotos/8/foto1.jpg', 'image/jpeg', 220000, 1920, 1080, 1, NOW()),
(8, 6237, 'foto-mascota.jpg', '/uploads/fotos/8/foto2.jpg', 'image/jpeg', 180000, 1920, 1080, 0, NOW()),
(8, 6237, 'foto-parque.jpg', '/uploads/fotos/8/foto3.jpg', 'image/jpeg', 280000, 1920, 1080, 0, NOW()),
(8, 6237, 'foto-jardin.jpg', '/uploads/fotos/8/foto4.jpg', 'image/jpeg', 310000, 1920, 1080, 0, NOW()),

-- Publicación ID 9
(9, 6236, 'foto-evento.jpg', '/uploads/fotos/9/foto1.jpg', 'image/jpeg', 190000, 1920, 1080, 1, NOW()),
(9, 6236, 'foto-viaje.jpg', '/uploads/fotos/9/foto2.jpg', 'image/jpeg', 240000, 1920, 1080, 0, NOW()),
(9, 6236, 'foto-playa.jpg', '/uploads/fotos/9/foto3.jpg', 'image/jpeg', 280000, 1920, 1080, 0, NOW()),
(9, 6236, 'foto-vacaciones.jpg', '/uploads/fotos/9/foto4.jpg', 'image/jpeg', 320000, 1920, 1080, 0, NOW()),
(9, 6236, 'foto-amigos.jpg', '/uploads/fotos/9/foto5.jpg', 'image/jpeg', 290000, 1920, 1080, 0, NOW());