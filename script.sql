CREATE TABLE Lieu(
   idLieu INT,
   nom VARCHAR(50),
   type VARCHAR(50),
   coordonnées VARCHAR(100),
   PRIMARY KEY(idLieu)
)DEFAULT CHARSET=utf8;
INSERT INTO Lieu VALUES
(1, 'École primaire Jules Verne ', 'École primaire', '45.1234, 1.5678'),
(2, 'Lycée Henri IV', 'Lycée', '45.2345, 1.6789'),
(3, 'Collège Marie Curie', 'Collège', '45.3456, 1.7890'),
(4, 'École maternelle Les Petits Chats', 'École maternelle', '45.4567, 1.8901'),
(5, 'École secondaire Victor Hugo', 'École secondaire', '45.5678, 1.9012');

CREATE TABLE École  (
	idLieu INT,
  addresse VARCHAR(100),
  nbClasses INT,
   nom VARCHAR(50),
   type VARCHAR(50),
   coordonnées VARCHAR(100),
  FOREIGN KEY (idLieu) REFERENCES Lieu(idLieu),
  PRIMARY KEY (idLieu)
) DEFAULT CHARSET=utf8;
INSERT INTO École VALUES
(1, '12 Rue de la République ', 8, 'École primaire Jules Verne ', 'École primaire', '45.1234, 1.5678'),
(3, '34 Avenue des Écoliers', 12, 'Lycée Henri IV', 'Lycée', '45.2345, 1.6789'),
(2, '5 Rue du 4 Aout 1789', 10,'Collège Marie Curie', 'Collège', '45.3456, 1.7890'),
(4, '18 Boulevard des Étudiants', 15,'École maternelle Les Petits Chats', 'École maternelle', '45.4567, 1.8901'),
(5, '7 Rue de la Sagesse', 6,'École secondaire Victor Hugo', 'École secondaire', '45.5678, 1.9012');

CREATE TABLE Cantine(
   nom VARCHAR(50),
   adresse VARCHAR(100),
   nbPlaces INT,
   nbServices INT,
   coordonnées TEXT(100),
   PRIMARY KEY(nom, adresse)
)DEFAULT CHARSET=utf8;
INSERT INTO Cantine VALUES
('La Petite Cantine', '23 Rue de la Paix, 75001 Paris', 50, 1, '48.8566, 2.3522'),
('Cantine Scolaire', '7 Rue de la République , 75002 Paris', 120, 2, '48.8574, 2.3523'),
('Cantine du Jardin', '15 Rue du Jardin, 75003 Paris', 80, 1, '48.8579, 2.3525'),
('Cantine Familiale', '30 Rue de la Famille, 75004 Paris', 70, 2, '48.8582, 2.3527'),
('La Bonne Cantine', '12 Rue de la Joie, 75005 Paris', 90, 1, '48.8588, 2.3529');

CREATE TABLE Enfant(
   nom VARCHAR(50),
   prénom VARCHAR(50),
   nom_C VARCHAR(50),
   adresse VARCHAR(100),
   FOREIGN KEY(nom_C, adresse) REFERENCES Cantine(nom, adresse),
   PRIMARY KEY(nom, prénom)
)DEFAULT CHARSET=utf8;
INSERT INTO Enfant VALUES 
('Dupont', 'Jean','La Petite Cantine', '23 Rue de la Paix, 75001 Paris'),
('Bernard', 'Jean','Cantine Scolaire','7 Rue de la République , 75002 Paris'),
('Dubois', 'Pierre','Cantine du Jardin', '15 Rue du Jardin, 75003 Paris'),
('Lambert', 'Anne','Cantine Familiale', '30 Rue de la Famille, 75004 Paris'),
('Martin', 'Marie','La Bonne Cantine', '12 Rue de la Joie, 75005 Paris');

CREATE TABLE Citoyen(
   nomC VARCHAR(50),
   prénomC VARCHAR(50),
   adresse VARCHAR(100),
   email VARCHAR(50),
   dateNaissance DATE,
   téléphone VARCHAR(50),
   PRIMARY KEY(nomC, prénomC, adresse)
)DEFAULT CHARSET=utf8;
INSERT INTO Citoyen VALUES
('Martin', 'Jean', '12 Rue de la Paix, 75001 Paris', 'jean.durand@example.com', '1990-05-15', '1234567890'),
('Leroy', 'Emma', '5 Rue de la République, 75002 Paris', 'marie.leroy@example.com', '1985-08-20', '2345678901'),
('Lambert', 'Pierre', '15 Rue du Jardin, 75003 Paris', 'pierre.dubois@example.com', '1992-11-10', '3456789012'),
('Martin', 'Sophie', '30 Rue de la Famille, 75004 Paris', 'sophie.martin@example.com', '1988-03-25', '4567890123'),
('Moreau', 'Julie', '12 Rue de la Joie, 75005 Paris', 'julie.moreau@example.com', '1995-06-30', '5678901234');

CREATE TABLE Service(
   libellé VARCHAR(50),
   description VARCHAR(250),
   PRIMARY KEY(libellé)
)DEFAULT CHARSET=utf8;
INSERT INTO Service (libellé, description) VALUES
('État civil', 'L\'état civil est la situation de la personne dans la famille et la société,
 résultat d\'une procédure écrite d\'identification administrative '),
('Élections', 'Le service élections procède aux inscriptions sur les 
listes électorales et assure toutes les opérations liées aux élections.'),
('Signalement', 'Le signalement est un écrit objectif décrivant la situation d\'un mineur en danger 
ou en risque de danger nécessitant une mesure de protection administrative ou judiciaire'),
('Union civile', 'L\'union civile est un acte solennel par lequel deux personnes expriment publiquement leur
 consentement libre et éclairé à faire vie commune et à respecter les droits et obligations liés à cet état civil'),
('Scolaire', 'La mission du service scolaire est de favoriser et d\'améliorer la scolarisation des enfants de 3 à 11 ans.'), 
('Restauration', 'Le service en restauration est le fait de servir les plats aux convives');

CREATE TABLE Demande(
   idDemande INT,
   dateDemande DATE,
   message VARCHAR(50),
   auteur VARCHAR(50) ,
   listeJustificatifs VARCHAR(50),
   nom_E VARCHAR(50),
   prénom_E VARCHAR(50),
   libellé VARCHAR(50) NOT NULL,
   PRIMARY KEY(idDemande),
   FOREIGN KEY (nom_E, prénom_E) REFERENCES Enfant(nom, prénom),
   FOREIGN KEY (libellé) REFERENCES Service(libellé)
)DEFAULT CHARSET=utf8;
INSERT INTO Demande VALUES
(1, '2023-11-09', 'Demande 1', 'Auteur 1', 'Justificatif 1', 'Dupont', 'Jean', 'Restauration'),
(2, '2023-11-08', 'Demande 2', 'Auteur 2', 'Justificatif 2', 'Bernard', 'Jean', 'Restauration'),
(3, '2023-11-07', 'Demande 3', 'Auteur 3', 'Justificatif 3', 'Dubois', 'Pierre', 'Scolaire'),
(4, '2023-11-06', 'Demande 4', 'Auteur 4', 'Justificatif 4', 'Lambert', 'Anne', 'Scolaire'),
(5, '2023-11-06', 'Demande 5', 'Auteur 5', 'Justificatif 5', 'Lambert', 'Anne', 'Elections'),
(6, '2023-11-06', 'Demande 6', 'Auteur 6', 'Justificatif 6', 'Lambert', 'Anne', 'Etat civil'),
(7, '2023-11-06', 'Demande 7', 'Auteur 7', 'Justificatif 7', 'Lambert', 'Anne', 'Scolaire'),
(8, '2023-11-06', 'Demande 8', 'Auteur 8', 'Justificatif 8', 'Lambert', 'Anne', 'Signalement'),
(9, '2023-11-06', 'Demande 9', 'Auteur 9', 'Justificatif 9', 'Lambert', 'Anne', 'Scolaire'),
(10, '2023-11-05', 'Demande 10', 'Auteur 10', 'Justificatif 10', 'Martin', 'Marie', 'Etat civil');

CREATE TABLE Effectuer(
   idDemande INT,
   nomC VARCHAR(50),
   prénomC VARCHAR(50),
   adresse VARCHAR(100),
   PRIMARY KEY(idDemande, nomC, prénomC, adresse),
   FOREIGN KEY(idDemande) REFERENCES Demande(idDemande),
   FOREIGN KEY(nomC, prénomC, adresse) REFERENCES Citoyen(nomC, prénomC, adresse)
)DEFAULT CHARSET=utf8;
INSERT INTO Effectuer VALUES
(1, 'Martin', 'Jean', '12 Rue de la Paix, 75001 Paris'),
(2, 'Leroy', 'Emma', '5 Rue de la République, 75002 Paris'),
(3, 'Lambert', 'Pierre', '15 Rue du Jardin, 75003 Paris'),
(4, 'Martin', 'Sophie', '30 Rue de la Famille, 75004 Paris'),
(5, 'Moreau', 'Julie', '12 Rue de la Joie, 75005 Paris'),
(6, 'Martin', 'Jean', '12 Rue de la Paix, 75001 Paris'),
(7, 'Martin', 'Sophie', '30 Rue de la Famille, 75004 Paris'),
(8, 'Martin', 'Sophie', '30 Rue de la Famille, 75004 Paris'),
(9, 'Moreau', 'Julie', '12 Rue de la Joie, 75005 Paris'),
(10, 'Leroy', 'Emma', '5 Rue de la République, 75002 Paris');

CREATE TABLE Justificatif(
   idDemande INT,
   numéro INT,
   type VARCHAR(50),
   description VARCHAR(50),
   chemin VARCHAR(50),
   PRIMARY KEY(idDemande, numéro),
   FOREIGN KEY(idDemande) REFERENCES Demande(idDemande)
)DEFAULT CHARSET=utf8;
INSERT INTO Justificatif (idDemande, numéro, type, description, chemin) VALUES
(1, 1, 'Type 1', 'Description 1', '/chemin/vers/justificatif1'),
(2, 2, 'Type 2', 'Description 2', '/chemin/vers/justificatif2'),
(3, 3, 'Type 3', 'Description 3', '/chemin/vers/justificatif3'),
(4, 4, 'Type 4', 'Description 4', '/chemin/vers/justificatif4'),
(5, 5, 'Type 5', 'Description 5', '/chemin/vers/justificatif5');

CREATE TABLE Inscrit(
	idInscrit INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prénom VARCHAR(50),
   classe VARCHAR(50),
   premiereInscription BOOLEAN ,
   idLieu INT NOT NULL,
   PRIMARY KEY(idInscrit),
   FOREIGN KEY(nom, prénom) REFERENCES Enfant(nom, prénom),
   FOREIGN KEY(idLieu) REFERENCES École(idLieu)
)DEFAULT CHARSET=utf8;
INSERT INTO Inscrit VALUES
(1,'Dupont', 'Jean', 'Classe A', 1, 1),
(2,'Dupont', 'Jean', 'Classe A', 0, 3),
(3,'Dubois', 'Pierre', 'Classe C', 1, 2),
(4,'Lambert', 'Anne', 'Classe D', 0, 4),
(5,'Martin', 'Marie', 'Classe E', 1, 5);

CREATE TABLE Manger(
   nom VARCHAR(50),
   prénom VARCHAR(50),
   nbJoursAbsence INT,
   début DATE,
   fin DATE,
   PRIMARY KEY(nom, prénom),
   FOREIGN KEY(nom, prénom) REFERENCES Enfant(nom, prénom)
)DEFAULT CHARSET=utf8;
INSERT INTO Manger VALUES
('Dupont', 'Jean', 0, '2024-01-01', '2024-01-02'),
('Bernard', 'Jean', 1, '2024-01-01', '2024-01-02'),
('Dubois', 'Pierre', 9, '2024-01-02', '2024-01-09'),
('Lambert', 'Anne', 2, '2024-01-03', '2024-01-03'),
('Martin', 'Marie', 0, '2024-01-04', '2024-01-04');

CREATE TABLE Région(
   codeINSEE_1 INT,
   nom VARCHAR(50) NOT NULL,
   PRIMARY KEY(codeINSEE_1)
)DEFAULT CHARSET=utf8;
INSERT INTO Région VALUES
(84, 'Auvergne-Rhône-Alpes');

CREATE TABLE Département(
   codeINSEE_2 INT,
   nom VARCHAR(50) NOT NULL,
   codeINSEE_1 INT,
   PRIMARY KEY(codeINSEE_2),
   FOREIGN KEY(codeINSEE_1) REFERENCES Région(codeINSEE_1)
)DEFAULT CHARSET=utf8;
INSERT INTO Département (codeINSEE_2, nom, codeINSEE_1)
VALUES
(42, 'Loire', 84),
(74, 'Haute-Savoie', 84),
(3, 'Allier', 84),
(7, 'Ardèche', 84),
(69, 'Rhône', 84);

CREATE TABLE Commune(
   idCommune INT AUTO_INCREMENT,
   codePostal INT,
   nom VARCHAR(50),
   coordonnées VARCHAR(100),
   codeINSEE_3 INT(100),
   adresseMairie TEXT(100),
   codeINSEE_2 INT,
   PRIMARY KEY(idCommune),
   FOREIGN KEY(codeINSEE_2) REFERENCES Département(codeINSEE_2)
)DEFAULT CHARSET=utf8;
INSERT INTO Commune (codePostal, nom, coordonnées, codeINSEE_3, adresseMairie, codeINSEE_2)
VALUES
(42380, 'Aboën', '45.412713546, 4.12725438172', 42001, '1 Place de la Mairie, 42380 Aboën', 42),
(74360, 'Abondance', '46.266108081, 6.7321620538', 74001, '12 Route de la Mairie, 74360 Abondance', 74),
(3200, 'Abrest', '46.095576671, 3.45052482175', 3001, '5 Place de la Mairie, 3200 Abrest', 3),
(7160, 'Accons', '44.888532821, 4.39242968382', 7001, '3 Rue de la Mairie, 7160 Accons', 7),
(69170, 'Affoux', '45.844064530, 4.41392129755', 69001, '7 Place de la Mairie, 69170 Affoux', 69);

CREATE TABLE Proposer(
   idCommune INT,
   libellé VARCHAR(50),
   prix DECIMAL(10,2),
   début DATE,
   fin DATE,
   PRIMARY KEY(idCommune, libellé),
   FOREIGN KEY(idCommune) REFERENCES Commune(idCommune),
   FOREIGN KEY(libellé) REFERENCES Service(libellé)
)DEFAULT CHARSET=utf8;
INSERT INTO Proposer VALUES
(1, 'Élections', 10.00, '2023-07-01', '2024-09-30'),
(1, 'État civil', 12.50, '2023-07-01', '2025-09-30'),
(1, 'Scolaire', 20.00, '2023-07-01', '2024-12-31'),
(2, 'État civil', 14.00, '2023-04-01', '2025-06-29'),
(2, 'Restauration', 15.00, '2023-04-01', '2025-06-30'),
(2, 'Scolaire', 8.00, '2023-07-01', '2024-08-31'),
(2, 'Union civile', 14.00, '2023-07-01', '2024-10-15'),
(3, 'Signalement', 25.00, '2023-07-01', '2024-09-30'),
(4, 'Scolaire', 22.00, '2023-07-01', '2025-01-31'),
(4, 'Signalement', 18.00, '2023-07-01', '2024-07-31'),
(4, 'Union civile', 7.00, '2023-07-01', '2025-08-15'),
(5, 'Élections', 19.00, '2023-07-01', '2024-11-30'),
(5, 'Restauration', 12.00, '2023-07-01', '2024-11-25');

CREATE TABLE Union_civile(
   idDemande INT,
   typeUnion VARCHAR(50),
   datePrévue DATE,
   citoyenConcerné1 VARCHAR(50),
   citoyenConcerné2 VARCHAR(50),
   PRIMARY KEY(idDemande),
   FOREIGN KEY(idDemande) REFERENCES Demande(idDemande)
)DEFAULT CHARSET=utf8;
INSERT INTO Union_civile  VALUES 
(1, 'Mariage', '2023-12-15', 'Jean Dupont', 'Marie Martin'),
(2, 'PACS', '2024-05-20', 'Lucas Tremblay', 'Sophie Girard'),
(3, 'Mariage', '2024-07-10', 'Thomas Lefebvre', 'Laura Dubois'),
(4, 'PACS', '2023-11-25', 'Antoine Leroy', 'Camille Laurent'),
(5, 'Mariage', '2024-09-05', 'Hugo Bernard', 'Emma Moreau'),
(6, 'PACS', '2023-12-30', 'Alexandre Gagnon', 'Clara Roy'),
(7, 'Mariage', '2024-08-17', 'Théo Caron', 'Léa Gauthier'),
(8, 'PACS', '2023-11-10', 'Maxime Fortin', 'Alicia Côté'),
(9, 'Mariage', '2024-06-12', 'Nathan Boucher', 'Manon Martel'),
(10, 'PACS', '2024-10-22', 'Gabriel Leclerc', 'Anaïs Lavoie');