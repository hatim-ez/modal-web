-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 16 Avril 2017 à 23:15
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `music`
--

-- --------------------------------------------------------

--
-- Structure de la table `audio`
--

CREATE TABLE `audio` (
  `id` int(11) NOT NULL,
  `loginUser` varchar(64) NOT NULL,
  `titre` varchar(64) NOT NULL,
  `artiste` varchar(64) DEFAULT NULL,
  `album` varchar(64) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `genre` varchar(64) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `audio`
--

INSERT INTO `audio` (`id`, `loginUser`, `titre`, `artiste`, `album`, `annee`, `genre`, `description`) VALUES
(2, 'superhatim', 'Ailleurs', 'Jean-Lours Aubert', '', 0, 'variete', ''),
(4, 'Barth', 'Canon (Primo)', 'Justice', '', 0, 'pop', ''),
(5, 'JeanMichel', 'La patrouille des éléphants', 'Walt Disney', '', 0, 'funk', ''),
(6, 'dominique', 'Shark in the Water', 'VV Brown', '', 0, 'variete', ''),
(7, 'dominique', 'Knocking On Heaven''s Door', 'Guns N Roses', '', 0, 'rock', ''),
(8, 'dominique', 'No Need to Argue', 'The Cranberries', '', 0, 'rock', ''),
(9, 'superhatim', 'Snow', 'The Red Hot Chili Peppers', '', 0, 'rock', ''),
(10, 'superhatim', 'Evelyn, A Modified Dog', 'Franck Zappa', '', 0, 'rock', ''),
(12, 'Barth', 'Winged', 'Django Soundtrack', '', 0, 'country', ''),
(13, 'dominique', '20th Century', 'Alfred Newman', '', 0, 'electro', ''),
(15, 'olivier', 'Piano', 'Dj Tasty', '', 0, 'variete', ''),
(19, 'J.Bieber', 'Baby', 'Justin Bieber', '', 0, 'pop', '');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `idmusic` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `date` varchar(64) NOT NULL,
  `commentaire` text NOT NULL,
  `idcomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`idmusic`, `login`, `date`, `commentaire`, `idcomment`) VALUES
(2, 'superhatim', '2017-04-16 18:37:55', 'Ma chanson préférée !!!!?', 1),
(4, 'superhatim', '2017-04-16 18:43:16', 'Sympa ta musique, je ferais attention à bien suivre tes prochains posts, n''hesite pas à faire de même ! Sympa ta musique, je ferais attention à bien suivre tes prochains posts, n''hesite pas à faire de même !', 2),
(5, 'JeanMichel', '2017-04-16 18:46:54', 'J''aime bien les dessins-animés, cela me rappelle mon enfance :)', 3),
(2, 'dominique', '2017-04-16 18:49:21', 'J''aime beaucoup la variété francais. Je suis aussi fan de variété allemande, hésitez très peu à en poster!', 4),
(5, 'dominique', '2017-04-16 18:54:32', 'Sympatique ca me rapelle également mon enfance, ca fait plaisir de voir ce genre de chansons ici !', 5),
(4, 'dominique', '2017-04-16 18:54:47', 'La musique electro c''est cool!', 6),
(8, 'superhatim', '2017-04-16 18:56:27', 'J''adore !!!', 7),
(8, 'superhatim', '2017-04-16 18:56:45', 'Sympa !\r\n', 8),
(8, 'superhatim', '2017-04-16 18:57:00', 'Hello ! Super!', 9),
(6, 'superhatim', '2017-04-16 18:57:43', 'Top !', 10),
(2, 'superhatim', '2017-04-16 19:05:18', 'Ailleurs !', 11),
(10, 'superhatim', '2017-04-16 19:08:48', 'J''adore !', 12),
(7, 'Barth', '2017-04-16 19:12:44', 'J''adore ce genre de musique partagez en plus souvent!! J''adore ce genre de musique partagez en plus souvent!! J''adore ce genre de musique partagez en plus souvent!! ', 13),
(8, 'Barth', '2017-04-16 19:12:48', 'J''adore ce genre de musique partagez en plus souvent!! ', 14),
(12, 'JeanMichel', '2017-04-16 19:14:59', 'J''adore ce genre de musique partagez en plus souvent!!  J''adore ce genre de musique partagez en plus souvent!!  J''adore ce genre de musique partagez en plus souvent!! ', 16),
(10, 'JeanMichel', '2017-04-16 19:15:03', 'J''adore ce genre de musique partagez en plus souvent!! J''adore ce genre de musique partagez en plus souvent!! J''adore ce genre de musique partagez en plus souvent!! ', 17),
(12, 'superhatim', '2017-04-16 19:15:18', 'Genial !', 18),
(9, 'superhatim', '2017-04-16 19:15:29', 'J''adore !', 19),
(12, 'dominique', '2017-04-16 19:17:30', 'Genial !', 20),
(10, 'dominique', '2017-04-16 19:17:35', 'J''adore !', 21),
(9, 'dominique', '2017-04-16 19:17:44', 'TOP !!!!', 22),
(13, 'superhatim', '2017-04-16 19:21:52', 'Enorme cette musique de film !\r\n', 23),
(13, 'Styx', '2017-04-16 19:51:45', 'Mythe !', 24),
(15, 'olivier', '2017-04-16 22:52:40', 'C''est moi qui l''ai posté !', 25),
(19, 'J.Bieber', '2017-04-16 22:56:58', 'Baby ! Baby ! Baby Nouuuuuuu !', 26);

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

CREATE TABLE `jaime` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jaime`
--

INSERT INTO `jaime` (`id`, `login`) VALUES
(5, 'dominique'),
(4, 'dominique'),
(8, 'superhatim'),
(7, 'superhatim'),
(6, 'superhatim'),
(2, 'superhatim'),
(12, 'Barth'),
(9, 'Barth'),
(10, 'Barth'),
(8, 'Barth'),
(2, 'Barth'),
(12, 'JeanMichel'),
(10, 'JeanMichel'),
(8, 'JeanMichel'),
(9, 'JeanMichel'),
(9, 'superhatim'),
(12, 'superhatim'),
(5, 'superhatim'),
(10, 'superhatim'),
(10, 'dominique'),
(12, 'dominique'),
(9, 'dominique'),
(13, 'Styx'),
(40, 'a'),
(18, 'olivier'),
(13, 'olivier'),
(12, 'olivier'),
(19, 'J.Bieber'),
(20, 'olivier'),
(15, 'J.Bieber');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `login` varchar(64) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `naissance` date DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `feuille` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `naissance`, `email`, `feuille`) VALUES
('Barth', '26901c26119ed259e6a3db948d369f4620ce40f2', 'DTH', 'Barthelemy', NULL, 'b@d.com', NULL),
('dominique', 'a2b40a7da1db76e270f0d09aab74a1891abde46d', 'Rossin', 'Dominique', NULL, 'd@r.com', NULL),
('J.Bieber', '97f903089abe6aed7bced47016f89f01947403fd', 'Bieber', 'Justin', NULL, 'jb@belieber.com', NULL),
('JeanMichel', 'd2ea6c786b4d02ea92d8e7f570501477dab388e4', 'Michel', 'Jean', NULL, 'j.m@j.com', NULL),
('olivier', 'ca37fc5fe29030d0cfe35eb90c411011f405439e', 'Serre', 'Olivier', NULL, 'o.s@modal.web', NULL),
('Styx', 'afd90ea68b39a063756c3f0a308a9825347b9dbd', 'Styx', 'mythe', NULL, 's@m.co', NULL),
('superhatim', 'cb21096c6d731a9323c8fb78e1a08c337d507618', 'EZBK', 'Hatim', NULL, 'hatim@b.com', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginUser` (`loginUser`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`idcomment`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `idcomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `audio_ibfk_1` FOREIGN KEY (`loginUser`) REFERENCES `utilisateurs` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
