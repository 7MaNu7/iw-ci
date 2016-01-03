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


CREATE TABLE `iw-youtube`.`user` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `userName` VARCHAR(255) NOT NULL DEFAULT '',
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(255) NOT NULL DEFAULT '',
    `verified` BOOLEAN NOT NULL DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`license` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`category` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videovisibility` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`language` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`tag` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`quality` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`playlist` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL DEFAULT '',
    `private` BOOLEAN NOT NULL DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`video` (
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
    FOREIGN KEY (`user`) REFERENCES user(id),
    FOREIGN KEY (`license`) REFERENCES license(id),
    FOREIGN KEY (`category`) REFERENCES category(id),
    FOREIGN KEY (`visibility`) REFERENCES videovisibility(id),
    FOREIGN KEY (`language`) REFERENCES language(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`comment` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `comment` text,
    `numLikes` INT NOT NULL DEFAULT 0,
    `numDislikes` INT NOT NULL DEFAULT 0,
    `likesBalance` INT NOT NULL DEFAULT 0,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user` BIGINT UNSIGNED NOT NULL,
    `video` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`user`) REFERENCES user(id),
    FOREIGN KEY (`video`) REFERENCES video(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`channelcomment` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `comment` text,
    `numLikes` INT NOT NULL DEFAULT 0,
    `numDislikes` INT NOT NULL DEFAULT 0,
    `likesBalance` INT NOT NULL DEFAULT 0,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user` BIGINT UNSIGNED NOT NULL,
    `channel` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`user`) REFERENCES user(id),
    FOREIGN KEY (`channel`) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videotag` (
    `video` BIGINT UNSIGNED NOT NULL,
    `tag` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `tag`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`tag`) REFERENCES tag(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videoquality` (
    `video` BIGINT UNSIGNED NOT NULL,
    `quality` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `quality`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`quality`) REFERENCES quality(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videoplaylist` (
    `video` BIGINT UNSIGNED NOT NULL,
    `playlist` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `playlist`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`playlist`) REFERENCES playlist(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videocomment` (
    `video` BIGINT UNSIGNED NOT NULL,
    `comment` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `comment`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`comment`) REFERENCES comment(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`channelrelated` (
    `channel` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`channel`, `user`),
    FOREIGN KEY (`channel`) REFERENCES user(id),
    FOREIGN KEY (`user`) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videolikes` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`user`) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`videodislikes` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`user`) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`seelater` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`user`) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `iw-youtube`.`history` (
    `video` BIGINT UNSIGNED NOT NULL,
    `user` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`video`, `user`),
    FOREIGN KEY (`video`) REFERENCES video(id),
    FOREIGN KEY (`user`) REFERENCES user(id)
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

INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('1', 'pepe@gm.com', 'Pepe', 'pepeIW', TRUE);
INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('2', 'ana@gm.com', 'Ana', 'anaLaz', TRUE);
INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('3', 'bob@gm.com', 'Bob', 'bobTomas', TRUE);
INSERT INTO `iw-youtube`.`user` (`id`, `email`, `password`, `userName`, `verified`) VALUES ('4', 'maria@gm.com', 'Maria', 'mariaYotuber', TRUE);

INSERT INTO `iw-youtube`.`videovisibility` (`id`, `name`) VALUES ('1', 'Public');
INSERT INTO `iw-youtube`.`videovisibility` (`id`, `name`) VALUES ('2', 'Private');


/* INSERT VIDEOS */

INSERT INTO `iw-youtube`.`video` (`id`, `url`, `title`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES ('1', 'https://www.youtube.com/watch?v=XNSSdC_a85U', 'Videos graciosos', 'Las mejores recopilaciones de cámara oculta y caídas graciosas.Si estás buscando vídeos graciosos este es tu canal.', '0', '0', '0', '0', '0', '1', '0', '1', '60', '1', '1', '4', '3', '1', '1');

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

INSERT INTO `comment` (`id`, `comment`, `numLikes`, `numDislikes`, `likesBalance`, `date`, `user`, `video`) VALUES
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '1'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '3', '1'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '4', '2'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '3'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '4', '4'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '1', '5'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '1', '6'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '8'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '9'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '3', '3');

INSERT INTO `channelcomment` (`id`, `comment`, `numLikes`, `numDislikes`, `likesBalance`, `date`, `user`, `channel`) VALUES
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '1'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '3', '1'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '4', '2'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '2'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '4', '3'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '1', '3'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '1', '4'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '4'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '2', '2'),
(NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', '0', '0', '0', CURRENT_TIMESTAMP, '3', '1');




/* MAS VIDEOS */

INSERT INTO `video` (`title`, `url`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES
('Video 3', 'https://www.youtube.com/watch?v=8uJd4ENv5kA', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
('Video 4', 'https://www.youtube.com/watch?v=Y9C7qmEu4gY', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
('Video 5', 'https://www.youtube.com/watch?v=BeYxZJwFsUg', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
('Video 6', 'https://www.youtube.com/watch?v=WvPlLofJkX0', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
('Video 7', 'https://www.youtube.com/watch?v=PAK-g8YHywQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
('Video 8', 'https://www.youtube.com/watch?v=PgNinclNUOo', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
('Video 9', 'https://www.youtube.com/watch?v=f15R_sXGtA4', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
('Video 10', 'https://www.youtube.com/watch?v=cbZ4gTIxcc8', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
('Video 11', 'https://www.youtube.com/watch?v=mAIGMSmNLdo', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
('Video 12', 'https://www.youtube.com/watch?v=mmO22gs5F3E', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
('Video 13', 'https://www.youtube.com/watch?v=TWC7OL6ob_Q', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
('Video 14', 'https://www.youtube.com/watch?v=tsqOIKE96MQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
('Video 15', 'https://www.youtube.com/watch?v=NfS0UstrJXQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
('Video 16', 'https://www.youtube.com/watch?v=flFV8NqZ9Zs', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
('Video 17', 'https://www.youtube.com/watch?v=_juoGOW8rlk', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
('Video 18', 'https://www.youtube.com/watch?v=fwvXWzgNOII', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
('Video 19', 'https://www.youtube.com/watch?v=rDeXSVJy0qU', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
('Video 20', 'https://www.youtube.com/watch?v=K7i2ZleKZkI', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
('Video 21', 'https://www.youtube.com/watch?v=ESKg1cQw0oo', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
('Video 22', 'https://www.youtube.com/watch?v=g7JpQkWEw8w', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
('Video 23', 'https://www.youtube.com/watch?v=wOCexctOdaw', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
('Video 24', 'https://www.youtube.com/watch?v=4PF5ef_QWM0', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
('Video 25', 'https://www.youtube.com/watch?v=oYBn6dnzX60', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
('Video 26', 'https://www.youtube.com/watch?v=dWtoOzh_kDQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1);
