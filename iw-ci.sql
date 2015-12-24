/*
Nueva base de datos

Nombre: iw-youtube

Como crearla: phpMyAdmin/nueva/crear/SQL/copiar todo el script de abajo
Como crear usuario: click en nombre tabla/privilegios/Agregar usuario/
	servidor: Local
	nombre y password usuario = iw (los demás campos como vienen por defecto)
	dejar seleccionado: Otorgar todos los privilegios para la base de datos "iw-youtube"
	
	oooo
	
	utilizar este script justo debajo:
*/

/* Crear usuario con derechos para la tabla iw-youtube */
CREATE USER 'iw'@'localhost' IDENTIFIED BY '***';GRANT USAGE ON *.* TO 'iw'@'localhost' IDENTIFIED BY '***' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `iw-youtube`.* TO 'iw'@'localhost';


CREATE TABLE `iw-youtube`.`User` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `userName` VARCHAR(255) NOT NULL DEFAULT '',
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(255) NOT NULL DEFAULT '',
    `verified` BOOLEAN NOT NULL DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`License` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Category` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoVisibility` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Language` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Tag` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Quality` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Playlist` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT '',
    `private` BOOLEAN NOT NULL DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Video` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `title` varchar(255) NOT NULL DEFAULT '',
		`url` varchar(255) NOT NULL,
    `description` text,
    `visits` INT NOT NULL DEFAULT 0,
    `numLikes` INT NOT NULL DEFAULT 0,
    `numDislikes` INT NOT NULL DEFAULT 0,
    `numComments` INT NOT NULL DEFAULT 0,
    `video3D` BOOLEAN NOT NULL DEFAULT FALSE,
    `insertionAllowed` BOOLEAN NOT NULL DEFAULT TRUE,
    `ageRestrictions` BOOLEAN NOT NULL DEFAULT FALSE,
    `notifications` BOOLEAN NOT NULL DEFAULT TRUE,
    `duration` float NOT NULL DEFAULT 0,
    `direct` BOOLEAN NOT NULL DEFAULT TRUE,
    `user` BIGINT UNSIGNED NOT NULL,
    `license` BIGINT UNSIGNED NOT NULL,
    `category` BIGINT UNSIGNED NOT NULL,
    `visibility` BIGINT UNSIGNED NOT NULL,
    `language` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`user`) REFERENCES User(id),
    FOREIGN KEY (`license`) REFERENCES License(id),
    FOREIGN KEY (`category`) REFERENCES Category(id),
    FOREIGN KEY (`visibility`) REFERENCES VideoVisibility(id),
    FOREIGN KEY (`language`) REFERENCES Language(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`Comment` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `comment` text,
    `numLikes` INT NOT NULL DEFAULT 0,
    `numDislikes` INT NOT NULL DEFAULT 0,
    `likesBalance` INT NOT NULL DEFAULT 0,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user` BIGINT UNSIGNED NOT NULL,
    `video` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`user`) REFERENCES User(id),
    FOREIGN KEY (`video`) REFERENCES Video(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoTag` (
    `video` BIGINT UNSIGNED NOT NULL,
    `tag` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `tag`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`tag`) REFERENCES Tag(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoQuality` (
    `video` BIGINT UNSIGNED NOT NULL,
    `quality` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `quality`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`quality`) REFERENCES Quality(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoPlaylist` (
    `video` BIGINT UNSIGNED NOT NULL,
    `playlist` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `playlist`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`playlist`) REFERENCES Playlist(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoComment` (
    `video` BIGINT UNSIGNED NOT NULL,
    `comment` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `comment`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`comment`) REFERENCES Comment(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoLikes` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`user`) REFERENCES User(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`VideoDislikes` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`user`) REFERENCES User(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`SeeLater` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`user`) REFERENCES User(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`History` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES Video(id),
    FOREIGN KEY (`user`) REFERENCES User(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*
Insertar datos:
quality,seelater, tags (ponen lo que quieren)
*/

INSERT INTO `iw-youtube`.`category` (`id`, `name`) VALUES ('1', 'Musica');
INSERT INTO `iw-youtube`.`category` (`id`, `name`) VALUES ('2', 'Trailer');
INSERT INTO `iw-youtube`.`category` (`id`, `name`) VALUES ('3', 'Tutorial');
INSERT INTO `iw-youtube`.`category` (`id`, `name`) VALUES ('4', 'Pelicula');

INSERT INTO `iw-youtube`.`language` (`id`, `name`) VALUES ('1', 'Español');
INSERT INTO `iw-youtube`.`language` (`id`, `name`) VALUES ('2', 'Ingles');
INSERT INTO `iw-youtube`.`language` (`id`, `name`) VALUES ('3', 'Frances');
INSERT INTO `iw-youtube`.`language` (`id`, `name`) VALUES ('4', 'Portugues');
INSERT INTO `iw-youtube`.`language` (`id`, `name`) VALUES ('5', 'Ruso');
INSERT INTO `iw-youtube`.`language` (`id`, `name`) VALUES ('6', 'Chino');

INSERT INTO `iw-youtube`.`license` (`id`, `name`) VALUES ('1', 'CC');
INSERT INTO `iw-youtube`.`license` (`id`, `name`) VALUES ('2', 'GPL');
INSERT INTO `iw-youtube`.`license` (`id`, `name`) VALUES ('3', 'CC-BY');
INSERT INTO `iw-youtube`.`license` (`id`, `name`) VALUES ('4', 'Licencia de YouTube estandar');

INSERT INTO `iw-youtube`.`quality` (`id`, `name`) VALUES ('1', '144');
INSERT INTO `iw-youtube`.`quality` (`id`, `name`) VALUES ('2', '240');
INSERT INTO `iw-youtube`.`quality` (`id`, `name`) VALUES ('3', '360');
INSERT INTO `iw-youtube`.`quality` (`id`, `name`) VALUES ('4', '480');
INSERT INTO `iw-youtube`.`quality` (`id`, `name`) VALUES ('5', '1080');

INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('1', 'pepe@gm.com', 'Pepe', 'pepeIW', 'TRUE');
INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('2', 'ana@gm.com', 'Ana', 'anaLaz', 'TRUE');
INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('3', 'bob@gm.com', 'Bob', 'bobTomas', 'TRUE');
INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('4', 'maria@gm.com', 'Maria', 'mariaYotuber', 'TRUE');

INSERT INTO `iw-youtube`.`videovisibility` (`id`, `name`) VALUES ('1', 'Public');
INSERT INTO `iw-youtube`.`videovisibility` (`id`, `name`) VALUES ('2', 'Private');


/* INSERT VIDEOS */

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('1', 'https://www.youtube.com/watch?v=XNSSdC_a85U', 'Videos graciosos', 'Las mejores recopilaciones de cámara oculta y caídas graciosas.
Si estás buscando vídeos graciosos este es tu canal.', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '1', '4', '3', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('2', 'https://www.youtube.com/watch?v=MG-bJITxL1I', 'Video 2', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '1', '4', '2', '1', '1');


INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('3', 'https://www.youtube.com/watch?v=kxVUee4WsoA', 'Video 3', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '2', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('4', 'https://www.youtube.com/watch?v=O57wbvAC6fY', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '3', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('5', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '4', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('6', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '1', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('7', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '2', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('8', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '3', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('9', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '4', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('10', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '1', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('11', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '2', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('12', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '3', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('13', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '4', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('14', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '1', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('15', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '2', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('16', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '3', '4', '2', '1', '1');

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('17', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'AuronPlay Record', 'Para más videos miren mi canal! Denle Like!!!', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '4', '4', '2', '1', '1');