USE manadas

SELECT * FROM usuarios;

INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, fecha_registro, img) 
VALUES ('Juan','Kavulakian','jpkavulakian@gmail.com','1234','1234567890','Calle Falsa 123',NOW(),'https://example.com/image.jpg');

INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, fecha_registro, img) VALUES
('María','Pérez','maria.perez@gmail.com','1234','1134567890','Av. Libertador 456',NOW(),'https://example.com/img2.jpg'),
('Lucía','Fernández','lucia.fernandez@gmail.com','1234','1145678901','San Martín 789',NOW(),'https://example.com/img3.jpg'),
('Agustín','Gómez','agustin.gomez@gmail.com','1234','1156789012','Rivadavia 1010',NOW(),'https://example.com/img4.jpg'),
('Valentina','Torres','valen.torres@gmail.com','1234','1167890123','Belgrano 202',NOW(),'https://example.com/img5.jpg'),
('Tomás','Rodríguez','tomas.rodriguez@gmail.com','1234','1178901234','Sarmiento 345',NOW(),'https://example.com/img6.jpg'),
('Sofía','López','sofia.lopez@gmail.com','1234','1189012345','Mitre 678',NOW(),'https://example.com/img7.jpg'),
('Martina','Silva','martina.silva@gmail.com','1234','1190123456','Alsina 789',NOW(),'https://example.com/img8.jpg'),
('Felipe','Díaz','felipe.diaz@gmail.com','1234','1201234567','Lavalle 321',NOW(),'https://example.com/img9.jpg'),
('Camila','Moreno','camila.moreno@gmail.com','1234','1212345678','Florida 654',NOW(),'https://example.com/img10.jpg'),
('Joaquín','Sánchez','joaquin.sanchez@gmail.com','1234','1223456789','Corrientes 987',NOW(),'https://example.com/img11.jpg'),
('Emilia','Rossi','emilia.rossi@gmail.com','1234','1234567890','Castro Barros 432',NOW(),'https://example.com/img12.jpg'),
('Mateo','Rivas','mateo.rivas@gmail.com','1234','1245678901','Olleros 214',NOW(),'https://example.com/img13.jpg'),
('Carolina','Martínez','carolina.martinez@gmail.com','1234','1256789012','Córdoba 101',NOW(),'https://example.com/img14.jpg'),
('Nicolás','Bianchi','nicolas.bianchi@gmail.com','1234','1267890123','Scalabrini Ortiz 555',NOW(),'https://example.com/img15.jpg'),
('Julieta','Domínguez','julieta.dominguez@gmail.com','1234','1278901234','Pueyrredón 777',NOW(),'https://example.com/img16.jpg'),
('Benjamín','Cruz','benjamin.cruz@gmail.com','1234','1289012345','Dorrego 232',NOW(),'https://example.com/img17.jpg'),
('Valeria','Gutiérrez','valeria.gutierrez@gmail.com','1234','1290123456','Gorriti 909',NOW(),'https://example.com/img18.jpg'),
('Ignacio','Ruiz','ignacio.ruiz@gmail.com','1234','1301234567','Mendoza 1234',NOW(),'https://example.com/img19.jpg'),
('Florencia','Acosta','florencia.acosta@gmail.com','1234','1312345678','Urquiza 678',NOW(),'https://example.com/img20.jpg');

INSERT INTO paseador 
(nombre, apellido, email, password, telefono, zona, disponibilidad, estado, bio, rating, fecha_alta, img) VALUES 
('Carlos', 'Medina', 'carlos.medina@manadas.com', '1234', '1165432109', 'Palermo', 'manana', 'activo', 
'Paseador con 3 años de experiencia en grupos pequeños y manejo de razas grandes.', 4.7, NOW(), 
'https://example.com/paseadores/carlos.jpg');

INSERT INTO mascota (id_mascota, id_dueno, nombre, raza, tamano, observaciones, creada_en, img) VALUES
(NULL, 1,  'Firulais', 'Labrador Retriever', 'grande',  'Muy sociable, le encanta el agua',         NOW(), 'https://example.com/dogs/dog01.jpg'),
(NULL, 1,  'Luna',     'Caniche',            'chico',   'Ansiosa con petardos',                     NOW(), 'https://example.com/dogs/dog02.jpg'),
(NULL, 1,  'Rocky',    'Bulldog Francés',    'mediano', 'No se lleva con gatos',                    NOW(), 'https://example.com/dogs/dog03.jpg'),
(NULL, 4,  'Nina',     'Beagle',             'mediano', 'Olfatea todo, llevar correa corta',        NOW(), 'https://example.com/dogs/dog04.jpg'),
(NULL, 5,  'Toby',     'Golden Retriever',   'grande',  'Ama jugar a la pelota',                    NOW(), 'https://example.com/dogs/dog05.jpg'),
(NULL, 6,  'Milo',     'Mestizo',            'mediano', 'Rescatado, muy cariñoso',                  NOW(), 'https://example.com/dogs/dog06.jpg'),
(NULL, 7,  'Kira',     'Border Collie',      'mediano', 'Alta energía, necesita paseo largo',       NOW(), 'https://example.com/dogs/dog07.jpg'),
(NULL, 8,  'Olivia',   'Dachshund',          'chico',   'Evitar subir/bajar escaleras',             NOW(), 'https://example.com/dogs/dog08.jpg'),
(NULL, 9,  'Simón',    'Boxer',              'grande',  'Fuerte, usar pretal',                      NOW(), 'https://example.com/dogs/dog09.jpg'),
(NULL, 10, 'Greta',    'Schnauzer Mini',     'chico',   'Ladra a bicicletas',                       NOW(), 'https://example.com/dogs/dog10.jpg'),
(NULL, 11, 'Bruno',    'Rottweiler',         'grande',  'Obediente, adiestrado',                    NOW(), 'https://example.com/dogs/dog11.jpg'),
(NULL, 12, 'Mora',     'Shih Tzu',           'chico',   'Ojos sensibles, cuidado con polvo',        NOW(), 'https://example.com/dogs/dog12.jpg'),
(NULL, 13, 'Coco',     'Pug',                'chico',   'Evitar calor intenso',                     NOW(), 'https://example.com/dogs/dog13.jpg'),
(NULL, 14, 'Zoe',      'Pastor Alemán',      'grande',  'Protector, muy leal',                      NOW(), 'https://example.com/dogs/dog14.jpg'),
(NULL, 15, 'Rita',     'Galgo',              'grande',  'Tranquila, tirones inesperados',           NOW(), 'https://example.com/dogs/dog15.jpg'),
(NULL, 16, 'Choco',    'Cocker Spaniel',     'mediano', 'Le gusta olfatear arbustos',               NOW(), 'https://example.com/dogs/dog16.jpg'),
(NULL, 17, 'Lola',     'Bichón Frisé',       'chico',   'Piel sensible, evitar barro',              NOW(), 'https://example.com/dogs/dog17.jpg'),
(NULL, 18, 'Max',      'Husky Siberiano',    'grande',  'Muy activo, puede tirar de la correa',     NOW(), 'https://example.com/dogs/dog18.jpg'),
(NULL, 19, 'Nico',     'Akita Inu',          'grande',  'Independiente, paseos tranquilos',         NOW(), 'https://example.com/dogs/dog19.jpg'),
(NULL, 20, 'Pampa',    'Mestizo',            'mediano', 'Sociable con otros perros',                NOW(), 'https://example.com/dogs/dog20.jpg');

SELECT 
    mascota.id_mascota,
    mascota.nombre AS nombre_mascota,
    mascota.raza,
    usuarios.nombre AS nombre_dueno,
    usuarios.apellido,
    usuarios.email
FROM mascota
INNER JOIN usuarios
    ON mascota.id_dueno = usuarios.id_usuario;


