-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 déc. 2023 à 00:20
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idmessage` int(11) NOT NULL,
  `idroom` int(11) DEFAULT NULL,
  `from_user` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idmessage`, `idroom`, `from_user`, `content`, `timestamp`) VALUES
(1, 10, 1, 'kdkqsdfbqkfsds q cdf', '2023-12-28 22:16:18'),
(2, 10, 2, 'kjbdfkjqdsbfkjdblqkj', '2023-12-28 22:16:18'),
(3, 10, 3, 'hada 3', '2023-12-28 22:16:18'),
(4, 10, 1, 'dnejskbhdkjfg', '2023-12-28 22:16:18');

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `idroom` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`idroom`, `name`, `id_creator`) VALUES
(1, 'mokhlis', 2),
(2, 'kdzklsj', 2),
(3, 'hello', 2),
(4, 'kjsdf', 2),
(5, 'test', 2),
(6, 'test', 2),
(7, ':lkjbsdkgjtd', 2),
(8, 'test2', 2),
(9, 'azazaza', 2),
(10, 'test3', 2);

-- --------------------------------------------------------

--
-- Structure de la table `room_member`
--

CREATE TABLE `room_member` (
  `idroom` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `blocked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `room_member`
--

INSERT INTO `room_member` (`idroom`, `iduser`, `blocked`) VALUES
(5, 1, NULL),
(5, 2, NULL),
(5, 3, NULL),
(6, 1, NULL),
(6, 2, NULL),
(6, 3, NULL),
(7, 1, NULL),
(7, 2, NULL),
(7, 3, NULL),
(8, 1, NULL),
(8, 2, NULL),
(8, 3, NULL),
(9, 1, NULL),
(9, 2, NULL),
(10, 1, NULL),
(10, 2, NULL),
(10, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userId`, `name`, `email`, `password`) VALUES
(1, 'Giselle Gay', 'mygev@mailinator.com', '$2y$10$SDq6jBuhvRyl8Hnf3DmlZO0CVmrg5fMPoK2bO11OxyXqLUjVxriY.'),
(2, 'Zelda Merritt', 'vanadyd@mailinator.com', '$2y$10$YZZNoIk9NgTlLrRhmi8rO.b4/umULY/W.JvNBfb1kpBRSpUgias2W'),
(3, 'test', 'test@gmail.com', '$2y$10$eW9wSy68mSuJXV.qxmPYzuaqUY1bIk6dXPXSjO4K9d2oJr9zGKqxS');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idmessage`),
  ADD KEY `idroom` (`idroom`),
  ADD KEY `from_user` (`from_user`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`idroom`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Index pour la table `room_member`
--
ALTER TABLE `room_member`
  ADD PRIMARY KEY (`idroom`,`iduser`),
  ADD KEY `iduser` (`iduser`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `idroom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idroom`) REFERENCES `room` (`idroom`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`from_user`) REFERENCES `user` (`userId`);

--
-- Contraintes pour la table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `user` (`userId`);

--
-- Contraintes pour la table `room_member`
--
ALTER TABLE `room_member`
  ADD CONSTRAINT `room_member_ibfk_1` FOREIGN KEY (`idroom`) REFERENCES `room` (`idroom`),
  ADD CONSTRAINT `room_member_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
