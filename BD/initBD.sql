USE db626009884;
DROP TABLE Annonces;
DROP TABLE Achats;
DROP TABLE Adherents;
DROP TABLE Lieux;
DROP TABLE Types;


CREATE TABLE Adherents
(
    id_adherent INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(30),
    password VARCHAR(255),
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR(50),
    telephone VARCHAR(12),
    description VARCHAR(150),
    possede_bateau BOOLEAN,
    admin BIT DEFAULT 0
);

CREATE TABLE Types
(
    id_type INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30)
);

CREATE TABLE Lieux
(
    id_lieu INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30)
);

CREATE TABLE Annonces
(
    id_annonce INT NOT NULL AUTO_INCREMENT,
    date_creation DATE,
    date_debut DATE,
    date_fin DATE,
    type INT,
    lieu INT,
    adherent INT,
    commentaire VARCHAR(150),
    participation BOOLEAN,
    cherche BOOLEAN,
    CONSTRAINT 
    PRIMARY KEY (id_annonce),
    FOREIGN KEY (type) REFERENCES Types (id_type),
    FOREIGN KEY (lieu) REFERENCES Lieux (id_lieu),
    FOREIGN KEY (adherent) REFERENCES Adherents (id_adherent)
);

CREATE TABLE Achats
(
    id_achat INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date_creation DATE,
    prix VARCHAR(7),
    adherent INT,
    commentaire VARCHAR(200),
    vend BOOLEAN,
    CONSTRAINT FOREIGN KEY (adherent) REFERENCES Adherents (id_adherent)
);

--TRIGGERS
DROP TRIGGER verificateur_dates; 
CREATE TRIGGER Verificateur_dates BEFORE INSERT ON Annonces 
    REFERENCING NEW ROW AS New
    REFERENCING OLD ROW AS Old
FOR EACH ROW 
BEGIN
SET New.date_creation = CURDATE(); 
    IF ( DATEDIFF(Old.date_debut , CURDATE()) < 0 )
        THEN
            SET New.date_creation = CURDATE();
    END IF;
    IF ( DATEDIFF(New.date_debut , Old.date_fin()) < 0 )
        THEN
            New.date_fin = CURDATE() + INTERVAL 1 DAY;
    END IF;
END;


--INSERTS DE TEST

--ADHERENTS
INSERT INTO Adherents (`id_adherent`, `pseudo`, `password`, `nom`, `prenom`, `email`, `telephone`, `description`, `possede_bateau`) VALUES (NULL, 'Tombean', 'test', 'Somerville', 'Tom', 'tom.somervillerobetrts@gmail.com', '0665534957', 'Coucou, je test la BD. Sinon j''aime le wake et j''ai le permis cotier !', '0');
INSERT INTO Adherents (`id_adherent`, `pseudo`, `password`, `nom`, `prenom`, `email`, `telephone`, `description`, `possede_bateau`) VALUES (NULL, 'jyromagne', 'test', 'Romagne', 'Jean-Yves', 'jyromagne@sfr.fr', '0299464828', 'J''aime la pêche et la voile. J''ai mon Zodiac au port de Dinard. Je fais partie de l ADUPP', '1');
INSERT INTO Adherents (`id_adherent`, `pseudo`, `password`, `nom`, `prenom`, `email`, `telephone`, `description`, `possede_bateau`) VALUES (NULL, 'Beebee2', 'test', 'Lolo', 'LILI', 'abcd@defgt.fr', '0000000000', 'J aime la mer', '0');

--LIEUX
INSERT INTO Lieux (`id_lieu`, `nom`) VALUES (NULL, 'Port de Dinard');
INSERT INTO Lieux (`id_lieu`, `nom`) VALUES (NULL, 'Port de Saint-Malo');
INSERT INTO Lieux (`id_lieu`, `nom`) VALUES (NULL, 'Plage de l Ecluse');
INSERT INTO Lieux (`id_lieu`, `nom`) VALUES (NULL, 'Port de Saint-Lunaire');
INSERT INTO Lieux (`id_lieu`, `nom`) VALUES (NULL, 'Plage de Saint-Lunaire');

--TYPES
INSERT INTO Types (`id_type`, `nom`) VALUES (NULL, 'Peche');
INSERT INTO Types (`id_type`, `nom`) VALUES (NULL, 'Voile');
INSERT INTO Types (`id_type`, `nom`) VALUES (NULL, 'Sports nautiques');
INSERT INTO Types (`id_type`, `nom`) VALUES (NULL, 'Promenade');

--ANNONCES
INSERT INTO Annonces (`id_annonce`, `date_creation`, `date_debut`, `date_fin`, `type`, `lieu`, `adherent`, `commentaire`, `participation`, `cherche`) VALUES (NULL, '2016-05-25', '2016-05-26', '2016-06-30', '1', '1', '5', 'Je propose de la peche a la dorade pres de la bouee 13 ', '0', '0');
INSERT INTO Annonces (`id_annonce`, `date_creation`, `date_debut`, `date_fin`, `type`, `lieu`, `adherent`, `commentaire`, `participation`, `cherche`) VALUES (NULL, '2016-05-11', '2016-05-12', '2016-08-31', '3', '3', '4', 'Je cherche des sportifs ayant un bateau de 50 Ch ou plus pour faire du wakeboard cet ete', '1', '1');

--ACHATS
INSERT INTO Achats (`id_vente`, `date_creation`, `prix`, `adherent`, `commentaire`, `vend`) VALUES (NULL, '2016-05-11', '12000', '4', 'Je cherche un bateau de wakeboard aux alentours des 12000E', '0');

--DEMANDES
INSERT INTO Demandes (`id_demande`, `annonce`, `adherent`, `date_debut`, `date_fin`, `commentaire`) VALUES ('1', '2', '5', '2016-05-12', '2016-09-15', 'Je possede un zodiac de 50CH et voudrais faire du wake avec vous ');
