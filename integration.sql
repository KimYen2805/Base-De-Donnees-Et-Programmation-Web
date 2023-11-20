INSERT INTO Commune(codePostal, nom, coordonnées, codeINSEE_3, adresseMairie, codeINSEE_2)
SELECT DISTINCT
CONVERT(code_postal, SIGNED INTEGER), 
nom_commune_complet, 
CONCAT(latitude, ',', longitude) AS coordonnées, 
CONVERT(code_commune_INSEE, SIGNED INTEGER) AS codeINSEE_3, 
NULL AS adresseMairie,
CONVERT(code_departement, SIGNED INTEGER) AS codeINSEE_2
FROM 
dataset.Communes
WHERE 
nom_region = "Auvergne-Rhône-Alpes" ;

INSERT IGNORE INTO Région(codeINSEE_1,nom) 
SELECT DISTINCT
CONVERT(code_region, SIGNED INTEGER) AS codeINSEE_1,
nom_region AS nom
FROM dataset.Communes
WHERE nom_region = "Auvergne-Rhône-Alpes";

INSERT IGNORE INTO Département(codeINSEE_2, nom, codeINSEE_1)
SELECT DISTINCT
CONVERT(code_departement, SIGNED INTEGER), 
nom_departement, 
code_region AS codeINSEE_1
FROM dataset.Communes
WHERE nom_region = "Auvergne-Rhône-Alpes";
