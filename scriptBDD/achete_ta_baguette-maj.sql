-- maj 1
INSERT INTO CLIENT (nom, prenom, naissance, email, motDePasse, rue, ville, province, codePostal, pays, administrateur) VALUES ('AFFIN', 'Jean-Yves', '1967-12-31', 'jean-yves.affin@gmail.com', '51f8b1fa9b424745378826727452997ee2a7c3d7', '616 St-Rédempteur', 'Matane', 'Québec', 'G4W 0H2', 'Canada', 0);
INSERT INTO CLIENT (nom, prenom, naissance, email, motDePasse, rue, ville, province, codePostal, pays, administrateur) VALUES ('Admin', 'Admin', '1967-12-31', 'admin@admin.com', 'eaa3dc36a7dc170e7e2c6e1bc7f04ba8c107a20d', '616 St-Rédempteur', 'Matane', 'Québec', 'G4W 0H2', 'Canada', 1);

INSERT INTO CATEGORIE(label, description) VALUES ('pain',null);
INSERT INTO CATEGORIE(label, description) VALUES ('viennoiserie',null);
INSERT INTO CATEGORIE(label, description) VALUES ('Autre',null);

-- maj 2
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Baguette classique','L\'originale et l\'unique',2,30,1,'baguette_classique.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Baguette tradition','Baguette plus grosse que l\'originale, parsemée de farine',2,30,1,'baguette_tradition.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Grosse baguette','Baguette classique mais plus grosse',2,30,1,'grosse_baguette.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Demi-baguette','Baguette classique coupée en deux',2,30,1,'demi_baguette.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Baguette aux graines','Baguette classique accompagnée de sa variété de 5 graines sur la croûte qui donne un goût spécial à votre pain. Se marie bien avec du fromage.',2,30,1,'baguette_aux_graines.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Baguette au pavot','Baguette classique accompagnée de graines de pavot sur sa croûte qui donne un goût plus relevé à votre pain.',2,30,1,'baguette_au_pavot.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Baguette aux olives','Baguette classique, sa mie est accompagnée et aromatisée de bouts d\'olives qui donnent un goût unique à votre pain. Se marie bien avec du fromage ou du poisson.',2,30,1,'baguette_aux_olives.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Baguette aux fruits secs','Baguette classique, sa mie est accompagnée et aromatisée de fruits secs qui lui donnent un goût fruité. Se marie bien avec du fois gras.',2,30,1,'baguette_aux_fruits_secs.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Pain aux raisins','La viennoiserie pour les gourmands et les amoureux des fruits secs',2,30,2,'pain_aux_raisins.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Pain au chocolat','Pain au chocolat et chocolatine pour certains, la fameuse viennoiserie Française',2,30,2,'pain_au_chocolat.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Croissant','L\'unique croissant Français par excellence',2,30,2,'croissant.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Galette des rois','La fameuse galette des rois qui se mange à l\'Epiphanie en famille',2,30,3,'galette_des_rois.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Eclair au chocolat','Le fameux et l\'unique éclair au chocolat pour les amoureux du chocolat',2,30,3,'eclair_au_chocolat.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Flan','Le fameux et l\'unique flan, à la vanille.',2,30,3,'flan.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Tarte aux pommes','Tarte aux pommes pour les amateurs de pommes',2,30,3,'tarte_aux_pommes.jpg');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Tarte aux fraises','Tarte aux fraises pour les amateurs de fraises et les gourmands',2,30,3,'tarte_aux_fraises.png');
INSERT INTO PRODUIT(nom, description, prix, stock, idCategorie, srcImage) VALUES ('Sachet de bonbons','Ne vous inquiétez pas pour les carries',2,30,3,'bonbons.jpg');

-- maj 3
ALTER TABLE CLIENT DROP naissance;

-- maj 4
ALTER TABLE CLIENT ADD UNIQUE(email);

-- maj 5
ALTER TABLE PANIER DROP FOREIGN KEY PANIER_fk0;
ALTER TABLE PANIER CHANGE idClient emailClient varchar(100);
ALTER TABLE PANIER ADD INDEX(emailClient);
ALTER TABLE CLIENT ADD INDEX(email);
ALTER TABLE PANIER ADD FOREIGN KEY (emailClient) REFERENCES CLIENT(email);

-- maj 6
ALTER TABLE FACTURER DROP FOREIGN KEY FACTURER_fk0;
ALTER TABLE FACTURER CHANGE idClient emailClient varchar(100);
ALTER TABLE FACTURER ADD INDEX(emailClient);
ALTER TABLE FACTURER ADD FOREIGN KEY (emailClient) REFERENCES CLIENT(email);

-- maj 7
CREATE TABLE FACTURE (
  idFacture INT(4) NOT NULL AUTO_INCREMENT,
  idProduit INT(4) NOT NULL,
  nbProduit INT(4) NOT NULL,
  dateAchat DATE NOT NULL,
  PRIMARY KEY (idFacture)
) ENGINE = InnoDB;
ALTER TABLE FACTURE ADD FOREIGN KEY (idProduit) REFERENCES PRODUIT(idProduit);

ALTER TABLE FACTURER DROP nbProduit, DROP date;
ALTER TABLE FACTURER CHANGE idProduit idFacture INT(4) NOT NULL;
ALTER TABLE FACTURER DROP PRIMARY KEY, ADD PRIMARY KEY( emailClient, idFacture);
ALTER TABLE FACTURER DROP FOREIGN KEY FACTURER_fk1;
ALTER TABLE FACTURER ADD FOREIGN KEY (idFacture) REFERENCES FACTURE(idFacture);

-- maj 8
ALTER TABLE PRODUIT CHANGE idCategorie idCategorie INT(4) NOT NULL;
ALTER TABLE CATEGORIE CHANGE idCategorie idCategorie INT(4) NOT NULL AUTO_INCREMENT;

-- facture
DROP TABLE FACTURER;
ALTER TABLE FACTURE DROP FOREIGN KEY FACTURE_ibfk_1;
ALTER TABLE FACTURE DROP idProduit, DROP nbProduit;
ALTER TABLE FACTURE ADD emailClient varchar(100) COLLATE utf8mb4_bin NOT NULL AFTER idFacture, ADD prixHT FLOAT(4) NOT NULL DEFAULT '0' AFTER dateAchat, ADD prixTTC FLOAT(4) NOT NULL DEFAULT '0' AFTER prixHT;
ALTER TABLE FACTURE ADD FOREIGN KEY (emailClient) REFERENCES CLIENT(email);

CREATE TABLE ARTICLE_FACTURE (
	idProduit int(4) NOT NULL,
	idFacture int(4) NOT NULL,
	quantite int(4) NOT NULL,
	PRIMARY KEY (idProduit,idFacture)
);
ALTER TABLE ARTICLE_FACTURE ADD FOREIGN KEY (idProduit) REFERENCES PRODUIT(idProduit);
ALTER TABLE ARTICLE_FACTURE ADD FOREIGN KEY (idFacture) REFERENCES FACTURE(idFacture);

-- panier
ALTER TABLE PANIER CHANGE nbProduit quantite INT(4) NOT NULL;
