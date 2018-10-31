-- --------------------------------------------------------
-- Hôte :                        mvc
-- Version du serveur:           5.7.18 - MySQL Community Server (GPL)
-- SE du serveur:                GC7_Win10_VM003
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour tests
CREATE DATABASE IF NOT EXISTS `tests` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tests`;

-- Export de la structure de la table tests. comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Export de données de la table tests.comments : ~8 rows (environ)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`) VALUES
	(1, 2, 'Mathieu', 'Preum\'s', '2017-09-24 17:12:30'),
	(2, 2, 'Sam', 'Quelqu\'un a un avis là-dessus ? Je ne sais pas quoi en penser.', '2017-09-24 17:21:34'),
	(8, 1, 'Jojo', 'C\'est moi !', '2017-09-28 19:50:14'),
	(9, 2, 'Mathieu', 'Retest\r\nEncore', '2017-10-27 11:46:50'),
	(10, 2, 'Sam', 'tu testes quoi ?', '2017-10-27 15:44:14'),
	(11, 1, 'GrCOTE7', 'Go c57.fr !', '2018-10-31 09:17:18'),
	(12, 2, 'GrCOTE7', 'Go c57.fr !', '2018-10-31 10:17:16'),
	(13, 3, 'GrCOTE7', 'www.c57.fr !', '2018-10-31 10:20:01');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Export de la structure de la table tests. posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Export de données de la table tests.posts : ~3 rows (environ)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`) VALUES
	(1, 'Bienvenue sur mon blog !', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2017-09-18 16:28:41'),
	(2, 'Le PHP à la conquête du monde !', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir "J\'ai l\'intention de conquérir le monde !".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire "éléPHPant". Pas dur, ceci dit entre nous...', '2017-09-20 16:28:41'),
	(3, 'c57.fr', 'Pour apprendre en créant !', '2018-10-31 10:18:05');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
