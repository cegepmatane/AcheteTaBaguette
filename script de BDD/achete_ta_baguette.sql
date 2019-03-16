--
-- Base de données :  `achete_ta_baguette_fr`
--

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORIE`
--
USE achete_ta_baguette_fr;

CREATE TABLE `CATEGORIE` (
  `idCategorie` int(3) NOT NULL,
  `label` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `CLIENT`
--

CREATE TABLE `CLIENT` (
  `idClient` int(3) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `naissance` date NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `motDePasse` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `rue` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `province` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `codePostal` varchar(7) COLLATE utf8mb4_bin NOT NULL,
  `pays` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `administrateur` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `FACTURER`
--

CREATE TABLE `FACTURER` (
  `idClient` int(5) NOT NULL,
  `idProduit` int(3) NOT NULL,
  `nbProduit` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `PANIER`
--

CREATE TABLE `PANIER` (
  `idClient` int(5) NOT NULL,
  `idProduit` int(4) NOT NULL,
  `nbProduit` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `PRODUIT`
--

CREATE TABLE `PRODUIT` (
  `idProduit` int(4) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `prix` float NOT NULL,
  `stock` int(5) NOT NULL,
  `idCategorie` int(3) NOT NULL,
  `srcImage` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `CATEGORIE`
--
ALTER TABLE `CATEGORIE`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `FACTURER`
--
ALTER TABLE `FACTURER`
  ADD PRIMARY KEY (`idClient`,`idProduit`),
  ADD KEY `FACTURER_fk1` (`idProduit`);

--
-- Index pour la table `PANIER`
--
ALTER TABLE `PANIER`
  ADD PRIMARY KEY (`idClient`,`idProduit`),
  ADD KEY `PANIER_fk1` (`idProduit`);

--
-- Index pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `PRODUIT_fk0` (`idCategorie`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `CATEGORIE`
--
ALTER TABLE `CATEGORIE`
  MODIFY `idCategorie` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `CLIENT`
--
ALTER TABLE `CLIENT`
  MODIFY `idClient` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  MODIFY `idProduit` int(4) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `FACTURER`
--
ALTER TABLE `FACTURER`
  ADD CONSTRAINT `FACTURER_fk0` FOREIGN KEY (`idClient`) REFERENCES `CLIENT` (`idClient`),
  ADD CONSTRAINT `FACTURER_fk1` FOREIGN KEY (`idProduit`) REFERENCES `PRODUIT` (`idProduit`);

--
-- Contraintes pour la table `PANIER`
--
ALTER TABLE `PANIER`
  ADD CONSTRAINT `PANIER_fk0` FOREIGN KEY (`idClient`) REFERENCES `CLIENT` (`idClient`),
  ADD CONSTRAINT `PANIER_fk1` FOREIGN KEY (`idProduit`) REFERENCES `PRODUIT` (`idProduit`);

--
-- Contraintes pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  ADD CONSTRAINT `PRODUIT_fk0` FOREIGN KEY (`idCategorie`) REFERENCES `CATEGORIE` (`idCategorie`);
