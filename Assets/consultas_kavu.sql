SELECT COUNT(*) , usuarios.nombre AS nombre_usuario
FROM usuarios
INNER JOIN mascota ON usuarios.id_usuario = mascota.id_dueno
WHERE usuarios.nombre like "Augusto";