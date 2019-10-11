-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 12 avr. 2019 à 18:21
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET time_zone
= "+00:00";

--
-- Base de données :  `devis`
--

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis`
(
  `id` int
(11) NOT NULL,
  `accessoires` varchar
(255) NOT NULL,
  `caisses` varchar
(255) NOT NULL,
  `domaine` varchar
(255) NOT NULL,
  `appel` varchar
(255) NOT NULL,
  `perso_id` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne`
(
  `perso_id` int
(11) NOT NULL,
  `perso_username` varchar
(255) NOT NULL,
  `perso_nom` varchar
(255) NOT NULL,
  `perso_prenom` varchar
(255) NOT NULL,
  `perso_civilite` int
(255) NOT NULL,
  `role` int
(255) NOT NULL,
  `perso_phone` varchar
(10) NOT NULL,
  `perso_mail` varchar
(255) NOT NULL,
  `perso_psw` varchar
(255) NOT NULL,
  `perso_adresse` varchar
(255) NOT NULL,
  `perso_cp` varchar
(5) NOT NULL,
  `perso_ville` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
ADD PRIMARY KEY
(`id`),
ADD KEY `perso_id`
(`perso_id`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
ADD PRIMARY KEY
(`perso_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `perso_id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
ADD CONSTRAINT `devis_ibfk_1` FOREIGN KEY
(`perso_id`) REFERENCES `personne`
(`perso_id`);
