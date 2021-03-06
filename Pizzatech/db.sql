-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 05 avr. 2019 à 09:48
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `art_id` int(11) NOT NULL,
  `art_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `art_nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `art_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `art_prix` float NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`art_id`, `art_image`, `art_nom`, `art_description`, `art_prix`, `cat_id`) VALUES
(1, 'https://commande.dominos.fr/ManagedAssets/FR/product/PMAR/FR_PMAR_fr_menu_1846.jpg', 'Margherita', 'Sauce tomate, mozzarella', 5.5, 2),
(3, 'https://commande.dominos.fr/ManagedAssets/FR/product/PREI/FR_PREI_fr_menu_2047.jpg', 'Royale', 'Sauce tomate, mozzarella, jambon, champignons', 6, 2),
(39, 'https://commande.dominos.fr/ManagedAssets/FR/product/PVPE/FR_PVPE_fr_menu_3117.jpg', 'Végétarienne', 'Sauce tomate, champignons, oignons, poivrons, olives, tomates', 9, 2),
(40, 'https://commande.dominos.fr/ManagedAssets/FR/product/P4FR/FR_P4FR_fr_menu_2142.jpg', '4 fromages', 'Sauce tomate, mozzarella, chèvre, emmental, bleu', 7, 2),
(41, 'https://commande.dominos.fr/ManagedAssets/FR/product/PSSE/FR_PSSE_fr_menu_2142.jpg', 'Saumon', 'Crème fraîche légère, mozzarella, saumon, oignons, crème à l’échalote', 9, 2),
(42, 'https://commande.dominos.fr/ManagedAssets/FR/product/PSVY/FR_PSVY_fr_menu_2047.jpg', 'Savoyarde', 'Crème fraîche légère, mozzarella, lardons fumés, pommes de terre sautées, Reblochon de Savoie', 10, 2),
(43, 'https://commande.dominos.fr/ManagedAssets/FR/product/PHAW/FR_PHAW_fr_menu_2047.jpg', 'Hawaïenne', 'Sauce tomate, mozzarella, jambon, ananas', 8, 2),
(44, 'https://commande.dominos.fr/ManagedAssets/FR/product/PCHI/FR_PCHI_fr_menu_2047.jpg', 'Poulet', 'Sauce tomate, mozzarella, poulet rôti, pepperoni, tomates fraîches, emmental', 12, 2),
(45, 'https://commande.dominos.fr/ManagedAssets/FR/product/PEXT/FR_PEXT_fr_menu_2762.jpg', 'Extra', 'Sauce tomate, mozzarella, pepperoni, jambon, champignons, oignons, poivrons, olives, boulettes de boeuf', 12, 2),
(48, 'https://commande.dominos.fr/ManagedAssets/FR/product/EIVBR/FR_EIVBR_fr_menu_3296.png', 'Vanille Noix de Pecan', 'Crème glacée vanille avec des morceaux de noix de pécan caramélisées Ben & Jerry (100ml).', 2, 1),
(49, 'https://commande.dominos.fr/ManagedAssets/FR/product/EICBP/FR_EICBP_fr_menu_3296.png', 'Caramel Brownie', 'Crème glacée caramel avec des morceaux de brownies et de cookies au chocolat, avec une sauce caramel salé (500ml).', 4, 1),
(52, 'https://commande.dominos.fr/ManagedAssets/FR/product/EDMBE/FR_EDMBE_fr_menu_2047.jpg', 'Beignets Chocolat', 'De délicieux beignets fourrés au chocolat. (5 beignets)', 3, 1),
(53, 'https://commande.dominos.fr/ManagedAssets/FR/product/EDCHO/FR_EDCHO_fr_menu_2047.jpg', 'Brownies', '6 brownies au chocolat partager (ou pas).', 3, 1),
(54, 'https://commande.dominos.fr/ManagedAssets/FR/product/DEVI0500/FR_DEVI0500_fr_menu_541.png', 'Evian', 'Eau en bouteille (50cl)', 1.5, 3),
(55, 'https://commande.dominos.fr/ManagedAssets/FR/product/DCOK/FR_DCOK_fr_menu_843.png', 'Coca Cola', 'Cannette (33 cl)', 2, 3),
(56, 'https://commande.dominos.fr/ManagedAssets/FR/product/DCOC/FR_DCOC_fr_menu_843.png', 'Coca Cola Cherry', 'Cannette (33 cl)', 2, 3),
(57, 'https://commande.dominos.fr/ManagedAssets/FR/product/DSPR/FR_DSPR_fr_menu_843.png', 'Sprite', 'Cannette (33 cl)', 2, 3),
(58, 'https://commande.dominos.fr/ManagedAssets/FR/product/DOTR/FR_DOTR_fr_menu_843.png', 'Oasis', 'Cannette (33 cl)', 2, 3),
(59, 'https://commande.dominos.fr/ManagedAssets/FR/product/DFAN/FR_DFAN_fr_menu_843.png', 'Fanta', 'Cannette (33 cl)', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(11) NOT NULL,
  `cat_libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `cat_libelle`) VALUES
(1, 'Dessert'),
(2, 'Pizza'),
(3, 'Boisson');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `cmd_id` int(11) NOT NULL,
  `cmd_date` date NOT NULL,
  `cmd_prix` int(255) NOT NULL,
  `cmd_valide` int(11) NOT NULL,
  `perso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`cmd_id`, `cmd_date`, `cmd_prix`, `cmd_valide`, `perso_id`) VALUES
(8, '2019-03-21', 25, 1, 13),
(9, '2019-03-21', 11, 1, 13),
(12, '2019-04-01', 18, 0, 13),
(13, '2019-04-01', 25, 1, 17),
(14, '2019-04-01', 24, 0, 17);

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

CREATE TABLE `ligne` (
  `cmd_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `lig_quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ligne`
--

INSERT INTO `ligne` (`cmd_id`, `art_id`, `lig_quantite`) VALUES
(8, 1, 1),
(8, 3, 2),
(8, 40, 1),
(9, 1, 2),
(12, 1, 1),
(12, 3, 2),
(13, 42, 1),
(13, 1, 1),
(13, 41, 1),
(14, 3, 2),
(14, 45, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `perso_id` int(11) NOT NULL,
  `perso_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `perso_civilite` int(11) NOT NULL,
  `perso_nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `perso_prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `perso_dnais` date NOT NULL,
  `perso_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `perso_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `perso_psw` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `perso_profil` int(11) NOT NULL,
  `perso_adresse` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `perso_cp` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `perso_ville` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`perso_id`, `perso_username`, `perso_civilite`, `perso_nom`, `perso_prenom`, `perso_dnais`, `perso_phone`, `perso_mail`, `perso_psw`, `perso_profil`, `perso_adresse`, `perso_cp`, `perso_ville`) VALUES
(1, 'admin', 1, '', '', '2017-12-14', '', 'admin@pizzatech.fr', '21232f297a57a5a743894a0e4a801fc3', 1, '', '', ''),
(2, 'employe', 1, '', '', '2019-01-29', '', 'employe@pizzatech.fr', '2e893ba55c4bedcc010a45a7e6c7af67', 2, '', '', ''),
(13, 'tim', 1, 'PELTIER', 'Tim', '1999-09-24', '0689567273', 'tim89140@gmail.com', 'b15d47e99831ee63e3f47cf3d4478e9a', 3, '5 square des Glières, 123', '77300', 'Fontainebleau'),
(14, 'user1', 1, 'Leboeuf', 'Jean', '1995-06-07', '0678567576', 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d', 3, '2 rue Grande', '77300', 'Fontainebleau'),
(17, 'user2', 2, 'Durand', 'Marie', '1999-06-15', '0674234512', 'user2@gmail.com', '7e58d63b60197ceb55a1c487989a3720', 3, '16 rue Bois Jolie', '77210', 'Avon'),
(18, 'TotomInc', 1, 'Cazade', 'Thomas', '1999-08-05', '0642871966', 'cazade.thomas@gmail.com', 'cb6e87819098f24c9f41f6b62c1d3603', 3, '12 rue des Faïenciers', '77250', 'Ecuelles'),
(19, 'test', 1, 'test', 'test', '2019-03-05', '0689567273', 'test1@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 3, '5 square des Glières', '77300', 'Fontainebleau');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `FK_article_cat_id` (`cat_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`cmd_id`),
  ADD KEY `perso_id` (`perso_id`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD KEY `cmd_id` (`cmd_id`,`art_id`),
  ADD KEY `FK_ligne_art_id` (`art_id`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`perso_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `cmd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `perso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_article_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `categorie` (`cat_id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_perso_id` FOREIGN KEY (`perso_id`) REFERENCES `personne` (`perso_id`);

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `FK_ligne_art_id` FOREIGN KEY (`art_id`) REFERENCES `article` (`art_id`),
  ADD CONSTRAINT `FK_ligne_cmd_id` FOREIGN KEY (`cmd_id`) REFERENCES `commande` (`cmd_id`);
