# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.1.44)
# Database: devicelost4
# Generation Time: 2012-05-25 16:11:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ALBUMS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ALBUMS`;

CREATE TABLE `ALBUMS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `ano` int(4) DEFAULT NULL,
  `genero` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table AUTORES
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AUTORES`;

CREATE TABLE `AUTORES` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '',
  `nivel_politica` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table CAMBIOS_SUGERIDOS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CAMBIOS_SUGERIDOS`;

CREATE TABLE `CAMBIOS_SUGERIDOS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_cambio` int(1) NOT NULL COMMENT '1 cancion, 2 disco, 3 autor, 4 genero, 5 año',
  `id_elemento` int(11) NOT NULL,
  `nuevo_valor` varchar(250) NOT NULL DEFAULT '',
  `estado` int(1) NOT NULL COMMENT '0 pendiente, 1 aceptado, 2 denegado',
  `fecha` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL COMMENT 'Cuando pasa de estado 0 a 1 se guarda quien ha aceptado el cambio',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table CANCIONES
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CANCIONES`;

CREATE TABLE `CANCIONES` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `id_autor` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table GENEROS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `GENEROS`;

CREATE TABLE `GENEROS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table LISTAS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LISTAS`;

CREATE TABLE `LISTAS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` int(11) NOT NULL,
  `creacion` datetime NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '1 creado. 2 auto',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table REL_ALBUMS_ORIGINALES
# ------------------------------------------------------------

DROP TABLE IF EXISTS `REL_ALBUMS_ORIGINALES`;

CREATE TABLE `REL_ALBUMS_ORIGINALES` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Los usuarios pueden marcar discos indicando que tienen la ve';



# Dump of table REL_LISTAS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `REL_LISTAS`;

CREATE TABLE `REL_LISTAS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_cancion` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table REL_UPLOADS_ALBUMS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `REL_UPLOADS_ALBUMS`;

CREATE TABLE `REL_UPLOADS_ALBUMS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table USUARIOS
# ------------------------------------------------------------

DROP TABLE IF EXISTS `USUARIOS`;

CREATE TABLE `USUARIOS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL DEFAULT '',
  `pass` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `nivel` int(1) NOT NULL DEFAULT '0',
  `datetime_registro` datetime NOT NULL,
  `datetime_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
