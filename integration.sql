INSERT INTO Région (codeINSEE_1, nom)
SELECT DISTINCT
    CONVERT(code_region, SIGNED INTEGER) AS codeINSEE_1,
    nom_region AS nom
FROM
    dataset.Communes
WHERE
    nom_region = "Auvergne-Rhône-Alpes"
ON DUPLICATE KEY UPDATE nom = VALUES(nom);

INSERT INTO Département (codeINSEE_2, nom, codeINSEE_1)
SELECT DISTINCT
    CONVERT(code_departement, SIGNED INTEGER) AS codeINSEE_2,
    nom_departement AS nom,
    code_region AS codeINSEE_1
FROM
    dataset.Communes
WHERE
    nom_region = "Auvergne-Rhône-Alpes"
ON DUPLICATE KEY UPDATE nom = VALUES(nom), codeINSEE_1 = VALUES(codeINSEE_1);


INSERT INTO Commune (codePostal, nom, coordonnées, codeINSEE_3, adresseMairie, codeINSEE_2)
SELECT DISTINCT
    CONVERT(code_postal, SIGNED INTEGER) AS codePostal,
    nom_commune_complet AS nom,
    CONCAT(latitude, ',', longitude) AS coordonnées,
    CONVERT(code_commune_INSEE, SIGNED INTEGER) AS codeINSEE_3,
    NULL AS adresseMairie,
    CONVERT(code_departement, SIGNED INTEGER) AS codeINSEE_2
FROM
    dataset.Communes AS d
WHERE
    nom_region = "Auvergne-Rhône-Alpes"
    AND NOT EXISTS (
        SELECT 1
        FROM Commune AS c
        WHERE c.codePostal = CONVERT(d.code_postal, SIGNED INTEGER)
           OR c.codeINSEE_3 = CONVERT(d.code_commune_INSEE, SIGNED INTEGER)
    );




