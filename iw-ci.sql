
--
-- Base de datos: `iw-youtube`
-- Usuario: iw
-- Contraseña: iw
--

CREATE TABLE `iw-youtube`.`user` (
    `id` SERIAL NOT NULL PRIMARY KEY,
    `userName` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(255) NOT NULL DEFAULT '',
    `admin` BOOLEAN NOT NULL DEFAULT FALSE,
    `verified` BOOLEAN NOT NULL DEFAULT FALSE,
    UNIQUE (`userName`)
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
    `user` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`channel`, `user`),
    FOREIGN KEY (`channel`) REFERENCES user(id),
    FOREIGN KEY (`user`) REFERENCES user(userName)
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

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `email`, `verified`, `admin`) VALUES
(1, 'pepeIW', 'Pepe', 'pepe@gm.com', 1, 0),
(2, 'anaLaz', 'Ana', 'ana@gm.com', 1, 0),
(3, 'bobTomas', 'Bob', 'bob@gm.com', 1, 0),
(4, 'mariaYotuber', 'Maria', 'maria@gm.com', 1, 0),
(5, 'sinvideos', 'Prueba123', 'sinvideos@mail.com', 0, 0),
(100, 'Admin', 'Admin', 'admin@gm.com', 0, 1),
(101, 'Admin2', 'Admin2', 'admin2@gm.com', 0, 1),
(102, 'nuevo', 'Nuevo123', 'nuevo@gm.com', 0, 0);

--
-- Volcado de datos para la tabla `channelcomment`
--

INSERT INTO `channelcomment` (`id`, `comment`, `numLikes`, `numDislikes`, `likesBalance`, `date`, `user`, `channel`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 1),
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 3, 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 4, 2),
(4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 2),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 4, 3),
(8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 4),
(9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 2),
(10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 3, 1);

--
-- Volcado de datos para la tabla `channelrelated`
--

INSERT INTO `channelrelated` (`channel`, `user`) VALUES
(1, 'anaLaz'),
(1, 'mariaYotuber'),
(2, 'pepeIW'),
(100, 'pepeIW'),
(1, 'sinvideos'),
(3, 'sinvideos');

--
-- Volcado de datos para la tabla `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'Español'),
(2, 'Ingles'),
(3, 'Frances'),
(4, 'Portugues'),
(5, 'Ruso'),
(6, 'Chino'),
(7, 'Catalan');

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Musica'),
(2, 'Trailer'),
(3, 'Tutorial'),
(4, 'Pelicula'),
(5, 'Humor');


--
-- Volcado de datos para la tabla `videovisibility`
--

INSERT INTO `videovisibility` (`id`, `name`) VALUES
(1, 'Public'),
(2, 'Private');

--
-- Volcado de datos para la tabla `license`
--

INSERT INTO `license` (`id`, `name`) VALUES
(1, 'CC'),
(2, 'GPL'),
(3, 'CC-BY'),
(4, 'Licencia de YouTube estandar');

--
-- Volcado de datos para la tabla `quality`
--

INSERT INTO `quality` (`id`, `name`) VALUES
(1, '144'),
(2, '240'),
(3, '360'),
(4, '480'),
(5, '1080');

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'musica'),
(2, 'star wars'),
(3, ' humor'),
(4, ' parodia'),
(6, 'news'),
(7, 'del bueno'),
(10, 'nuevo tag'),
(11, 'movil'),
(12, 'review'),
(13, 'comico'),
(14, 'design');



--
-- Volcado de datos para la tabla `video`
--

INSERT INTO `video` (`id`, `title`, `url`, `description`, `visits`, `numLikes`, `numDislikes`, `numComments`, `video3D`, `insertionAllowed`, `ageRestrictions`, `notifications`, `duration`, `direct`, `user`, `license`, `category`, `visibility`, `language`) VALUES
(1, 'Videos graciosos', 'https://www.youtube.com/watch?v=XNSSdC_a85U', 'Las mejores recopilaciones de cámara oculta y caídas graciosas.Si estás buscando vídeos graciosos este es tu canal.', 8, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 3, 1, 1),
(3, 'Video 3', 'https://www.youtube.com/watch?v=kxVUee4WsoA', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(4, 'AuronPlay Record', 'https://www.youtube.com/watch?v=O57wbvAC6fY', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(5, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(7, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 1, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(8, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(9, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(11, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(12, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(13, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(15, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(16, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(17, 'AuronPlay Record', 'https://www.youtube.com/watch?v=JFSs7rwmTEs', 'Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(18, 'Video 3', 'https://www.youtube.com/watch?v=8uJd4ENv5kA', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 9, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
(19, 'Video 4', 'https://www.youtube.com/watch?v=Y9C7qmEu4gY', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(20, 'Video 5', 'https://www.youtube.com/watch?v=BeYxZJwFsUg', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(21, 'Video 6', 'https://www.youtube.com/watch?v=WvPlLofJkX0', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(22, 'Si cumplir los propósitos de Año Nuevo fuera fácil', 'https://www.youtube.com/watch?v=PAK-g8YHywQ', 'Video de Mr Jagger', 75, 1, 0, 0, 0, 1, 0, 1, 60, 1, 1, 1, 5, 1, 1),
(23, 'Video 8', 'https://www.youtube.com/watch?v=PgNinclNUOo', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 3, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(24, 'Video 9', 'https://www.youtube.com/watch?v=f15R_sXGtA4', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(25, 'Video 10', 'https://www.youtube.com/watch?v=cbZ4gTIxcc8', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(26, 'Video 11', 'https://www.youtube.com/watch?v=mAIGMSmNLdo', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 1, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
(27, 'Video 12', 'https://www.youtube.com/watch?v=mmO22gs5F3E', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(28, 'Video 13', 'https://www.youtube.com/watch?v=TWC7OL6ob_Q', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(29, 'Video 14', 'https://www.youtube.com/watch?v=tsqOIKE96MQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(30, 'Video 15', 'https://www.youtube.com/watch?v=NfS0UstrJXQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 5, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
(31, 'Video 16', 'https://www.youtube.com/watch?v=flFV8NqZ9Zs', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(32, 'Video 17', 'https://www.youtube.com/watch?v=_juoGOW8rlk', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(33, 'Video 18', 'https://www.youtube.com/watch?v=fwvXWzgNOII', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(34, 'Video 19', 'https://www.youtube.com/watch?v=rDeXSVJy0qU', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 1, 0, 0, 0, 0, 1, 0, 1, 60, 1, 1, 4, 2, 1, 1),
(35, 'Video 20', 'https://www.youtube.com/watch?v=K7i2ZleKZkI', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(36, 'Video 21', 'https://www.youtube.com/watch?v=ESKg1cQw0oo', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(37, 'Video 22', 'https://www.youtube.com/watch?v=g7JpQkWEw8w', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 12, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(38, 'Star Wars - Todo sobre mi padre', 'https://www.youtube.com/watch?v=wOCexctOdaw', 'Parodia de Star Wars.', 24, 0, 1, 0, 0, 1, 0, 1, 60, 1, 1, 3, 5, 1, 1),
(39, 'Video 24', 'https://www.youtube.com/watch?v=4PF5ef_QWM0', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 2, 4, 2, 1, 1),
(40, 'Video 25', 'https://www.youtube.com/watch?v=oYBn6dnzX60', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 3, 4, 2, 1, 1),
(41, 'Video 26', 'https://www.youtube.com/watch?v=dWtoOzh_kDQ', 'Un video de la mejor banda del momento. Se enfocan cada vez más en lo técnico, lo que les está dando una calidad cada vez mayor. Para más videos miren mi canal! Denle Like!!!', 0, 0, 0, 0, 0, 1, 0, 1, 60, 1, 4, 4, 2, 1, 1),
(43, 'Star Wars News', 'https://www.youtube.com/watch?v=auCXanyDruU', '', 1, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1),
(48, 'Somos cualquiera', 'https://www.youtube.com/watch?v=j_khs18R34Q', '', 1, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1),
(49, 'Huawei Mate 8', 'https://www.youtube.com/watch?v=vwtXs2-bEkQ', '', 10, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 3, 1, 1),
(50, 'Star Wars BB8 CSS Speed Drawing', 'https://www.youtube.com/watch?v=QZdj42liTtU', 'Star Wars BB-8 animated with CSS', 4, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 3, 1, 1),
(52, 'El robot que quiere ser samurai', 'https://www.youtube.com/watch?v=l8xg9njJTaU', '', 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1),
(53, 'Marvel - Daredevil - Temporada 2 - Avance - Netflix [HD]', 'https://www.youtube.com/watch?v=iUjxmLH2kzI', '', 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 2, 1, 1),
(54, 'Five Finger Death Punch - Wash it all away', 'https://www.youtube.com/watch?v=l9VFg44H2z8', '', 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1),
(55, 'Five Finger Death Punch - Wash it all away', 'https://www.youtube.com/watch?v=l9VFg44H2z8', '', 1, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1);

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `comment`, `numLikes`, `numDislikes`, `likesBalance`, `date`, `user`, `video`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 1),
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 3, 1),
(4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 3),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 4, 4),
(6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 1, 5),
(8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 8),
(9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 2, 9),
(10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto nemo impedit, architecto sequi dignissimos laudantium, temporibus ad quidem ipsam! Aspernatur, tempora. Quam ad asperiores maxime voluptas culpa quod velit dolores.', 0, 0, 0, '2016-01-02 13:10:47', 3, 3),
(11, 'Buen video!!', 0, 0, 0, '2016-01-03 23:38:10', 1, 39),
(12, 'Grande!!', 0, 0, 0, '2016-01-03 23:38:30', 1, 39),
(13, 'Otro comentario!!', 0, 0, 0, '2016-01-03 23:40:04', 1, 39),
(21, 'hello world!', 0, 0, 0, '2016-01-04 13:04:18', 1, 26),
(27, 'comentar', 0, 0, 0, '2016-01-05 19:39:06', 1, 38),
(28, 'prueba', 0, 0, 0, '2016-01-05 19:39:58', 1, 38),
(29, 'nuevo comentario', 0, 0, 0, '2016-01-05 19:43:58', 1, 38);

--
-- Volcado de datos para la tabla `videodislikes`
--

INSERT INTO `videodislikes` (`video`, `user`) VALUES
(38, 1);

--
-- Volcado de datos para la tabla `videolikes`
--

INSERT INTO `videolikes` (`video`, `user`) VALUES
(22, 1);

--
-- Volcado de datos para la tabla `videoquality`
--

INSERT INTO `videoquality` (`video`, `quality`) VALUES
(22, 3),
(38, 3);

--
-- Volcado de datos para la tabla `videotag`
--

INSERT INTO `videotag` (`video`, `tag`) VALUES
(38, 1),
(38, 2),
(50, 2),
(22, 3),
(34, 3),
(38, 3),
(38, 4),
(43, 6),
(52, 6),
(48, 10),
(49, 11),
(49, 12),
(50, 14);
