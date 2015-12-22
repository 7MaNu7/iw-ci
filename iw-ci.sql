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
