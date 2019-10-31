-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 08 avr. 2019 à 21:25
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `musique`
--

-- --------------------------------------------------------

--
-- Structure de la table `aimerchanson`
--

DROP TABLE IF EXISTS `aimerchanson`;
CREATE TABLE IF NOT EXISTS `aimerchanson` (
  `fk_numT` int(11) NOT NULL,
  `fk_login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aimerchanson`
--

INSERT INTO `aimerchanson` (`fk_numT`, `fk_login`) VALUES
(17, 'Admin'),
(14, 'Admin'),
(19, 'Admin'),
(8, 'Admin'),
(2, 'Admin'),
(24, 'Nahmed'),
(26, 'Nahmed'),
(30, 'Nahmed'),
(34, 'Nahmed'),
(2, 'Nahmed'),
(19, 'Nahmed'),
(17, 'Nahmed'),
(6, 'Nahmed'),
(12, 'Nahmed'),
(17, 'JFerry'),
(20, 'JFerry'),
(22, 'JFerry'),
(8, 'JFerry'),
(6, 'JFerry'),
(17, 'LeaH'),
(19, 'LeaH');

-- --------------------------------------------------------

--
-- Structure de la table `chanson`
--

DROP TABLE IF EXISTS `chanson`;
CREATE TABLE IF NOT EXISTS `chanson` (
  `numT` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `interprete` varchar(100) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `lien` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `nb_likes` int(11) DEFAULT NULL,
  `fk_num` int(11) DEFAULT NULL,
  `fk_idTheme` int(11) DEFAULT NULL,
  PRIMARY KEY (`numT`),
  KEY `FK_chanson_utilisateur` (`fk_num`),
  KEY `FK_chanson_theme` (`fk_idTheme`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chanson`
--

INSERT INTO `chanson` (`numT`, `titre`, `interprete`, `duree`, `lien`, `image`, `nb_likes`, `fk_num`, `fk_idTheme`) VALUES
(26, 'Jump', 'Van Halen', '00:04:01', 'https://www.youtube.com/watch?v=SwYN7mTi6HM', '220px-Van_Halen_-_Jump.jpg', 1, 2, 4),
(25, ' Smoke On The Water 1972', 'Deep Purple', '00:06:12', 'https://www.youtube.com/watch?v=ikGyZh0VbPQ', 'Smoke_on_the_Water.jpg', 0, 2, 4),
(24, 'Enter Sandman', 'Metallica', '00:05:35', 'https://www.youtube.com/watch?v=CD-E-LDc384', 'hqdefault.jpg', 1, 3, 4),
(23, 'Nothing Else Matters', 'Metallica', '00:06:28', 'https://www.youtube.com/watch?v=waBb-UM5m4g', 'metallica.jpg', 0, 3, 4),
(22, 'Smells Like Teen Spirit', 'Nirvana', '00:04:37', 'https://www.youtube.com/watch?v=hTWKbfoikeg', 'giphy.gif', 1, 1, 1),
(21, 'Tous les cris les S.O.S', 'Zaz', '00:04:32', 'https://www.youtube.com/watch?v=5VBSaGz0fnc', 'zaz.png', 0, 2, 1),
(20, 'White Christmas', 'Frank Sinatra', '00:03:26', 'https://www.youtube.com/watch?v=12Oqgp6hgP0', 'white.jpeg', 1, 1, 1),
(19, 'Seven Nation Army', 'The White Stripes', '00:03:59', 'https://www.youtube.com/watch?v=0J2QdDbelmY', 'white.jpg', 3, 2, 3),
(18, 'Highway to Hel', 'AC/DC', '00:04:44', 'https://www.youtube.com/watch?v=gEPmA3USJdI', 'ac.jpg', 0, 3, 3),
(17, 'Bohemian Rhapsody', 'Queen', '00:06:06', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', 'bohemian.jpg', 4, 3, 3),
(16, 'Rock Around The Clock (1955)', ' Bill Haley & His Comets', '00:02:21', 'https://www.youtube.com/watch?v=ZgdufzXvjqw', 'bill.jpeg', 0, 3, 3),
(15, 'Johnny B. Goode', ' Chuck Berry', '00:02:41', 'https://www.youtube.com/watch?v=ZFo8-JqzSCM', 'chucky.jpg', 0, 3, 3),
(14, 'Stairway To Heaven', 'Led Zeppelin', '00:08:00', 'https://www.youtube.com/watch?v=D9ioyEvdggk', 'strairway.jpg', 1, 1, 3),
(13, 'Smells Like Teen Spirit', ' Nirvana', '00:04:37', 'https://www.youtube.com/watch?v=hTWKbfoikeg', 'smells.jpg', 1, 1, 3),
(12, 'Lost in the Fire', 'The Weeknd, Gesaffelstein', '00:03:19', 'https://www.youtube.com/watch?v=ZGDGdRIxvd0', 'lost.png', 1, 1, 2),
(11, 'Arms Around You', ' XXXTentacion', '00:03:15', 'https://www.youtube.com/watch?v=tLNOce4Y4uc', 'armearound.jpg', 0, 2, 2),
(10, 'Con Calma', 'Daddy Yankee & Snow', '00:03:30', 'https://www.youtube.com/watch?v=DiItGE3eAyQ', 'doncalma.png', 0, 2, 2),
(9, 'Bigflo & Oli - Plus tard', ' Bigflo et Oli', '00:03:29', 'https://www.youtube.com/watch?v=_UgsqtaXiwI', 'plustard.jpg', 0, 1, 2),
(8, 'Rappers Delight', 'The Sugarhill Gang', '00:06:28', 'https://www.youtube.com/watch?v=tUqvPJ3cbUQ', 'sugarhillgang.jpg', 2, 2, 2),
(7, 'le jugement', 'Tandem', '00:07:57', 'https://www.youtube.com/watch?v=4oaBmjNCtAs', 'tandemlejujement.jpg', 0, 3, 2),
(5, 'Lose Yourself', 'Eminem', '00:05:23', 'https://www.youtube.com/watch?v=_Yhyp-_hX2s', 'eminemYourself.jpg', 0, 2, 2),
(6, 'This Is America', 'Donald Glover', '00:04:04', 'https://www.youtube.com/watch?v=VYOjWnS4cMY', 'ChildishGambino.png', 2, 3, 2),
(3, 'Billie Jean', 'Micheal Jackson', '00:04:55', 'https://www.youtube.com/watch?v=Zi_XLOBDo_Y', 'billejeans.jpg', 0, 2, 1),
(2, 'One Love', 'The Wailers', '00:02:46', 'https://www.youtube.com/watch?v=UsP3MdJYblY', 'reggae.jpg', 2, 1, 6),
(27, 'Fuir le bonheur de peur qu’il ne se sauve', 'Jane Birkin', '00:03:04', 'https://www.youtube.com/watch?v=cSt5_ODSCZo', 'fuir.jpg', 0, 3, 5),
(28, 'La pince à linge', 'Les 4 barbus', '00:03:49', 'https://www.youtube.com/watch?v=LQ5_GZfIOsg', 'pince.jpg', 0, 3, 5),
(29, 'Midnight blue en Irlande', 'Michèle Torr', '00:03:20', 'https://www.youtube.com/watch?v=Mi3kqBwLlWc', 'midnight.jpg', 0, 3, 5),
(30, 'Ils s’en vont', 'Dave', '00:04:31', 'https://www.discogs.com/fr/Dave-Classique/release/3330759', 'vont.jpeg', 1, 1, 5),
(31, 'no woman no cry', 'Bob Marley', '00:07:09', 'https://www.youtube.com/watch?v=jGqrvn3q1oo', 'nowoman.jpg', 0, 1, 6),
(32, 'Brigadier Sabari', 'Alpha Blondy', '00:04:47', 'https://www.youtube.com/watch?\nv=RQOWRSwy_8A', 'brigardier.jpg', 0, 1, 6),
(33, 'One Love', 'The Wailers', '00:02:25', 'https://www.youtube.com/watch?v=UsP3MdJYblY', 'onelove.jpeg', 2, 3, 6),
(34, 'Could you be loved - Lyrics', 'Bob Marley', '00:04:27', 'https://www.youtube.com/watch?\nv=Mm7muPjevik', 'couldbe.jpg', 1, 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `idTheme` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`idTheme`, `libelle`) VALUES
(1, 'Pop'),
(2, 'Rap'),
(3, 'Rock'),
(4, 'Metal'),
(5, 'Classique'),
(6, 'Reggae');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(18) DEFAULT NULL,
  `mdp` varchar(18) DEFAULT NULL,
  `nom` varchar(18) DEFAULT NULL,
  `prenom` varchar(18) DEFAULT NULL,
  `ddn` date DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`num`, `login`, `mdp`, `nom`, `prenom`, `ddn`, `email`, `grade`) VALUES
(2, 'JFerry', 'Ferry007', 'Ferry', 'Jules', '1995-01-01', 'ferry@gmail.com', 'membre'),
(3, 'Nahmed', 'Ahmed1', 'AHMED', 'Noufeine', '2000-01-22', 'ahmednoufeine@gmail.com', 'admin'),
(1, 'Admin', 'Nath+1', 'Quellec', 'Nathan', '1999-07-30', 'nathan.quellec@gmail.com', 'admin'),
(4, 'LeaH', 'Lea99', 'Habert', 'Lea', '1999-10-23', 'lea.habert@hotmail.fr', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
