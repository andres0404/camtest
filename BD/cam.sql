/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 5.7.23 : Database - cam
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cam` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cam`;

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id_curso` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_curso` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cursos` */

insert  into `cursos`(`id_curso`,`nombre_curso`) values 
(1,'Biologia'),
(2,'Metafisica');

/*Table structure for table `estudiantes` */

DROP TABLE IF EXISTS `estudiantes`;

CREATE TABLE `estudiantes` (
  `id_estudiante` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_curso` bigint(20) unsigned DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`),
  KEY `REL_CURSO_ESTUDIANTE` (`id_curso`),
  CONSTRAINT `REL_CURSO_ESTUDIANTE` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `estudiantes` */

insert  into `estudiantes`(`id_estudiante`,`id_curso`,`nombre`) values 
(1,1,'Juanchito el machitus'),
(2,1,'Mariana Palacios'),
(3,2,'Pedro Navajas'),
(21,2,'Sandra 2'),
(28,2,'el man es german');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
