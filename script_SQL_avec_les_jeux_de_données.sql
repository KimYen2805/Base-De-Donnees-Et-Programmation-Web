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
INSERT INTO Enfant VALUES ('Dupont', 'Jean','La Petite Cantine', '23 Rue de la Paix, 75001 Paris');
INSERT INTO Enfant VALUES('Bernard', 'Jean','Cantine Scolaire','7 Rue de la République , 75002 Paris');
INSERT INTO Enfant VALUES('Dubois', 'Pierre','Cantine du Jardin', '15 Rue du Jardin, 75003 Paris');
INSERT INTO Enfant VALUES('Lambert', 'Anne','Cantine Familiale', '30 Rue de la Famille, 75004 Paris');
INSERT INTO Enfant VALUES('Martin', 'Marie','La Bonne Cantine', '12 Rue de la Joie, 75005 Paris');
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
   description VARCHAR(200),
   PRIMARY KEY(libellé)
)DEFAULT CHARSET=utf8;
INSERT INTO Service (libellé, description) VALUES
('État civil', 'Le service d\'état civil est responsable de l\'enregistrement et de la gestion des événements civils tels que les naissances, mariages, décès, délivrant des certificats et actes officiels associés.'),
('Élections', 'Le service élections assure la gestion des processus électoraux, enregistrant les votants, organisant les scrutins et garantissant le respect des procédures démocratiques.'),
('Signalement', 'Le service de signalement gère la réception et le traitement des signalements concernant diverses situations problématiques ou infractions dans une communauté donnée.'),
('Union civile', 'Le service union civile supervise les procédures légales entourant les mariages civils, PACS (Pacte civil de solidarité) et autres formes d\'engagements légaux entre partenaires.'),
('Scolaire', 'Le service scolaire gère les activités éducatives, le suivi des élèves, et coordonne les programmes pédagogiques au sein des établissements d'enseignement.'), 
('Restauration', 'Le service restauration fournit des repas et gère les aspects logistiques liés à la nourriture dans des contextes éducatifs ou institutionnels.');
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
INSERT INTO Demande  VALUES
(1, '2023-11-09', 'Demande 1', 'Auteur 1', 'Justificatif 1', 'Dupont', 'Jean', 'Service 6'),
(2, '2023-11-08', 'Demande 2', 'Auteur 2', 'Justificatif 2', 'Bernard', 'Jean', 'Service 6'),
(3, '2023-11-07', 'Demande 3', 'Auteur 3', 'Justificatif 3', 'Dubois', 'Pierre', 'Service 5'),
(4, '2023-11-06', 'Demande 4', 'Auteur 4', 'Justificatif 4', 'Lambert', 'Anne', 'Service 5'),
(5, '2023-11-06', 'Demande 5', 'Auteur 5', 'Justificatif 5', 'Lambert', 'Anne', 'Service 2'),
(6, '2023-11-06', 'Demande 6', 'Auteur 6', 'Justificatif 6', 'Lambert', 'Anne', 'Service 1'),
(7, '2023-11-06', 'Demande 7', 'Auteur 7', 'Justificatif 7', 'Lambert', 'Anne', 'Service 5'),
(8, '2023-11-06', 'Demande 8', 'Auteur 8', 'Justificatif 8', 'Lambert', 'Anne', 'Service 3'),
(9, '2023-11-06', 'Demande 9', 'Auteur 9', 'Justificatif 9', 'Lambert', 'Anne', 'Service 5'),
(10, '2023-11-05', 'Demande 10', 'Auteur 10', 'Justificatif 10', 'Martin', 'Marie', 'Service 1');

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
CREATE TABLE Période(
   dateC DATE,
   PRIMARY KEY(dateC)
)DEFAULT CHARSET=utf8; 
INSERT INTO Période (dateC) VALUES ('2024-01-01');
INSERT INTO Période (dateC) VALUES ('2024-01-02');
INSERT INTO Période (dateC) VALUES ('2024-01-03');
INSERT INTO Période (dateC) VALUES ('2024-01-04');
INSERT INTO Période (dateC) VALUES ('2024-01-05');
CREATE TABLE Manger(
   nom VARCHAR(50),
   prénom VARCHAR(50),
   périodeDonnée DATE,
   nbJoursAbsence INT,
   dateC DATE NOT NULL,
   PRIMARY KEY(nom, prénom),
   FOREIGN KEY(nom, prénom) REFERENCES Enfant(nom, prénom),
   FOREIGN KEY(dateC) REFERENCES Période(dateC)
)DEFAULT CHARSET=utf8;
INSERT INTO Manger VALUES
('Dupont', 'Jean', '2024-01-01', 0, '2024-01-01'),
('Bernard', 'Jean', '2024-01-01', 1, '2024-01-01'),
('Dubois', 'Pierre', '2024-01-02', 2, '2024-01-02'),
('Lambert', 'Anne', '2024-01-03', 2,'2024-01-03'),
('Martin', 'Marie', '2024-01-04', 0, '2024-01-04');
CREATE TABLE Région(
   codeINSEE_1 INT,
   nom VARCHAR(50) NOT NULL,
   PRIMARY KEY(codeINSEE_1)
)DEFAULT CHARSET=utf8;
INSERT INTO Région VALUES (75, 'Île-de-France'),
(76, 'Occitanie'),
(84, 'Auvergne-Rhône-Alpes'),
(93, 'Provence-Alpes-Côte d\'Azur'),
(52, 'Pays de la Loire'),
(44, 'Grand Est'), 
(28,'Normandie');
CREATE TABLE Département(
   codeINSEE_2 INT,
   nom VARCHAR(50) NOT NULL,
   codeINSEE_1 INT,
   PRIMARY KEY(codeINSEE_2),
   FOREIGN KEY(codeINSEE_1) REFERENCES Région(codeINSEE_1)
)DEFAULT CHARSET=utf8;
INSERT INTO Département VALUES (75, 'Paris', 75),
(31, 'Haute-Garonne', 76),
(69, 'Auvergne-Rhône-Alpes', 84),
(06, 'Alpes-Maritimes', 93), 
(44,'Loire-Atlantique', 52),
(52, 'Haute-Marne',44), 
(76,'Seine-Maritime', 28);
CREATE TABLE Commune(
   idCommune INT,
   codePostal INT,
   nom VARCHAR(50),
   coordonnées TEXT(100),
   codeINSEE_3 INT(100),
   adresseMairie TEXT(100),
    codeINSEE_2 INT,
   PRIMARY KEY(idCommune),
   FOREIGN KEY(codeINSEE_2) REFERENCES Département(codeINSEE_2)
)DEFAULT CHARSET=utf8;
INSERT INTO Commune VALUES (1, 75002, 'Paris 2er Arrondissement', '48.8566, 2.3522', 75056, '1 Rue de la Mairie, 75002 Paris', 75)
 ,(2, 31000, 'Toulouse 1er Arrondissement', '43.6047, 1.4442', 31555, '2 Place de la Mairie, 31000 Toulouse', 31),
 (3, 69009, 'Lyon 9er Arrondissement', '45.7578, 4.8320', 69123, '3 Rue de la Mairie, 69009 Lyon', 69),
 (4, 06000, 'Nice', '43.7102, 7.2619', 06088, '4 Rue de la Mairie, 06000 Nice', 06),
(5, 44000, 'Nantes', '47.2184, 1.5536', 44109, '5 Rue de la Mairie, 44000 Nantes', 44),
(6, 75001, 'Paris 1er Arrondissement', '48.862630, 2.336293', 75101, 'Mairie du 1er Arrondissement, 4 Rue de la Banque, 75002 Paris', 75),
(7, 31002, 'Toulouse 2er Arrondissement', '43.604652, 1.444209', 31555, 'Place du Capitole, 31000 Toulouse', 31),
(8, 69001, 'Lyon 1er Arrondissement', '45.767, 4.834', 69381, 'Place de la Comédie, 69001 Lyon', 69),
(9, 31003, 'Toulouse 3er Arrondissement', '43.7031, 7.2661', 31003, '5 Rue de l\'Hôtel de ville, 31003 Toulouse', 31),
(10, 44000, 'Nantes', '47.2181, -1.5528', 44109, '2 Rue de l\'Hôtel de ville, 44094 Nantes', 52),
(11, 75006, 'Paris 6er Arrondissement', '43.2964, 5.3698', 75006, 'Hôtel de Ville, 75006', 75),
(12, 33000, 'Bordeaux', '44.8378, -0.5792', 33063, 'Place Pey Berland, 33000 Bordeaux', 75),
(13, 34000, 'Montpellier', '43.6108, 3.8767', 34172, '1 Place Georges Frêche, 34267 Montpellier', 76),
(14, 69002, 'Lyon 2e Arrondissement', '45.7513 , 4.8328', 69382, 'Place Bellecour, 69002 Lyon', 69),
(15, 69003, 'Lyon 3e Arrondissement', '45.7637, 4.8511', 69383, '215 Rue Duguesclin, 69003 Lyon', 69);
CREATE TABLE Proposer(
   idCommune INT,
   libellé VARCHAR(50),
   prix VARCHAR(50),
   PRIMARY KEY(idCommune, libellé),
   FOREIGN KEY(idCommune) REFERENCES Commune(idCommune),
   FOREIGN KEY(libellé) REFERENCES Service(libellé)
)DEFAULT CHARSET=utf8;
INSERT INTO Proposer VALUES
(1, 'Service 1', '10.00'),
(2, 'Service 1', '15.00'),
(3, 'Service 3', '12.50'),
(4, 'Service 2', '20.00'),
(5, 'Service 5', '8.00'),
(6, 'Service 4', '7.00'),
(7, 'Service 2', '25.00'),
(8, 'Service 4', '8.00'),
(9, 'Service 1', '18.00'),
(10, 'Service 3', '14.00'),
(11, 'Service 3', '22.00'),
(12, 'Service 4', '10.00'),
(13, 'Service 4', '25.00'),
(14, 'Service 4', '12.50'),
(15, 'Service 4', '8.00');


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
 

