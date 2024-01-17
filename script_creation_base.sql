DROP TABLE IF EXISTS Periode;
DROP TABLE IF EXISTS Scolaire;
DROP TABLE IF EXISTS Manger;
DROP TABLE IF EXISTS Enfant;
DROP TABLE IF EXISTS Unir;
DROP TABLE IF EXISTS Propose;
DROP TABLE IF EXISTS Commune;
DROP TABLE IF EXISTS Restauration;
DROP TABLE IF EXISTS Signalement;
DROP TABLE IF EXISTS Election;
DROP TABLE IF EXISTS Union_civile;
DROP TABLE IF EXISTS Etat_civil;
DROP TABLE IF EXISTS Justificatif;
DROP TABLE IF EXISTS Demande;
DROP TABLE IF EXISTS Departement;
DROP TABLE IF EXISTS Classe;
DROP TABLE IF EXISTS Ecole;
DROP TABLE IF EXISTS Periode;
DROP TABLE IF EXISTS Cantine;
DROP TABLE IF EXISTS Citoyen;
DROP TABLE IF EXISTS Lieux;
DROP TABLE IF EXISTS Service;
DROP TABLE IF EXISTS Region;

CREATE TABLE Region(
   Code_INSEE_R BIGINT,
   NOM_R VARCHAR(50),
   PRIMARY KEY(Code_INSEE_R)
);


CREATE TABLE Service(
   idService BIGINT NOT NULL AUTO_INCREMENT,
   Libellé_S VARCHAR(50),
   Description VARCHAR(50),
   boolPayant BOOLEAN,
   PRIMARY KEY(idService)
);

CREATE TABLE Lieux(
   idL BIGINT AUTO_INCREMENT,
   NomL VARCHAR(50),
   TypeL VARCHAR(50),
   longL VARCHAR(50),
   LatL VARCHAR(50),
   PRIMARY KEY(idL)
);


CREATE TABLE Citoyen(
   idCitoyen BIGINT AUTO_INCREMENT,
   emailC VARCHAR(50),
   NomC VARCHAR(50),
   PrenomC VARCHAR(50),
   Date_naissC DATE,
   num_telC VARCHAR(50),
   PRIMARY KEY(idCitoyen)
);

CREATE TABLE Cantine(
   idCantine BIGINT AUTO_INCREMENT,
   NomCan VARCHAR(50),
   AdresseCan VARCHAR(50),
   NbPlaces VARCHAR(50),
   NbServices VARCHAR(50),
   Long_Can VARCHAR(50),
   Lat_Can VARCHAR(50),
   PRIMARY KEY(idCantine)
);

CREATE TABLE Ecole(
   idEcole BIGINT AUTO_INCREMENT,
   AdresseE VARCHAR(50),
   NbClasses VARCHAR(50),
   NomE VARCHAR(50),
   idL BIGINT NOT NULL,
   PRIMARY KEY(idEcole),
   FOREIGN KEY(idL) REFERENCES Lieux(idL)
);

CREATE TABLE Classe(
   idEcole BIGINT,
   idClasse BIGINT,
   nomClasse VARCHAR(50),
   PRIMARY KEY(idEcole, idClasse),
   FOREIGN KEY(idEcole) REFERENCES Ecole(idEcole)
);


CREATE TABLE Departement(
   Code_INSEE_D BIGINT,
   NomD VARCHAR(50),
   Code_INSEE_R BIGINT NOT NULL,
   PRIMARY KEY(Code_INSEE_D),
   FOREIGN KEY(Code_INSEE_R) REFERENCES Region(Code_INSEE_R)
);


CREATE TABLE Demande(
   IdD BIGINT AUTO_INCREMENT,
   Message VARCHAR(500),
   DateD VARCHAR(50),
   idService BIGINT NOT NULL,
   idCitoyen BIGINT NOT NULL,
   PRIMARY KEY(IdD),
   FOREIGN KEY(idService) REFERENCES Service(idService),
   FOREIGN KEY(idCitoyen) REFERENCES Citoyen(idCitoyen)
);


CREATE TABLE Justificatif(
   IdD BIGINT AUTO_INCREMENT,
   Num_J BIGINT,
   Type_J VARCHAR(50),
   Description_J VARCHAR(50),
   Chemin_J VARCHAR(50),
   PRIMARY KEY(IdD, Num_J),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);

CREATE TABLE Etat_civil(
   idEtatCivil BIGINT AUTO_INCREMENT,
   TypeDocu VARCHAR(50),
   DateMiseDispo VARCHAR(50),
   IdD BIGINT NOT NULL,
   PRIMARY KEY(idEtatCivil),
   UNIQUE(IdD),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);


CREATE TABLE Union_civile(
   idUnion BIGINT AUTO_INCREMENT,
   TypeU VARCHAR(50),
   DateU VARCHAR(50),
   IdD BIGINT NOT NULL,
   PRIMARY KEY(idUnion),
   UNIQUE(IdD),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);

CREATE TABLE Election(
   idEelec BIGINT AUTO_INCREMENT,
   BureauVote VARCHAR(50),
   IdD BIGINT NOT NULL,
   PRIMARY KEY(idEelec),
   UNIQUE(IdD),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);



CREATE TABLE Signalement(
   idSigna BIGINT AUTO_INCREMENT,
   TypeSignalement VARCHAR(50),
   idL BIGINT NOT NULL,
   IdD BIGINT NOT NULL,
   PRIMARY KEY(idSigna),
   UNIQUE(IdD),
   FOREIGN KEY(idL) REFERENCES Lieux(idL),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);

CREATE TABLE Restauration(
   idQuota BIGINT AUTO_INCREMENT,
   QuotientFamilial VARCHAR(50),
   idCantine BIGINT NOT NULL,
   IdD BIGINT NOT NULL,
   PRIMARY KEY(idQuota),
   UNIQUE(idCantine),
   UNIQUE(IdD),
   FOREIGN KEY(idCantine) REFERENCES Cantine(idCantine),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);

CREATE TABLE Commune(
   IdComAuto BIgINT AUTO_INCREMENT,
   IdC BIGINT,
   Code_postal VARCHAR(50),
   NomC VARCHAR(50),
   LatitudeC VARCHAR(50),
   LongitudeC VARCHAR(50),
   Code_INSEE_C VARCHAR(50),
   Adresse VARCHAR(50),
   Code_INSEE_D BIGINT NOT NULL,
   PRIMARY KEY(IdComAuto),
   FOREIGN KEY(Code_INSEE_D) REFERENCES Departement(Code_INSEE_D)
);

CREATE TABLE Propose(
   IdComAuto BIGINT,
   idService BIGINT,
   ouverture DATE,
   fermeture DATE,
   PRIMARY KEY(IdComAuto, idService, ouverture, fermeture),
   FOREIGN KEY(IdComAuto) REFERENCES Commune(IdComAuto),
   FOREIGN KEY(idService) REFERENCES Service(idService)
);


CREATE TABLE Unir(
   idUnion BIGINT AUTO_INCREMENT,
   idCitoyen BIGINT,
   PRIMARY KEY(idUnion, idCitoyen),
   FOREIGN KEY(idUnion) REFERENCES Union_civile(idUnion),
   FOREIGN KEY(idCitoyen) REFERENCES Citoyen(idCitoyen)
);


CREATE TABLE Enfant(
   idE BIGINT AUTO_INCREMENT,
   NomEnf VARCHAR(50),
   PrenomEnf VARCHAR(50),
   boolPremiereInsc BOOLEAN,
   idEcole BIGINT,
   idClasse BIGINT,
   PRIMARY KEY(idE),
   FOREIGN KEY(idEcole, idClasse) REFERENCES Classe(idEcole, idClasse)
);

CREATE TABLE Manger(
   idCantine BIGINT,
   idE BIGINT,
   DebutMangeCANT VARCHAR(50),
   FinMangeCANT VARCHAR(50),
   nbAbs VARCHAR(50),
   PRIMARY KEY(idCantine, idE, DebutMangeCANT, FinMangeCANT),
   FOREIGN KEY(idCantine) REFERENCES Cantine(idCantine),
   FOREIGN KEY(idE) REFERENCES Enfant(idE)
);



CREATE TABLE Scolaire(
   idSco BIGINT AUTO_INCREMENT,
   nomCont VARCHAR(50),
   numCont VARCHAR(50),
   idE BIGINT NOT NULL,
   IdD BIGINT NOT NULL,
   PRIMARY KEY(idSco),
   UNIQUE(IdD),
   FOREIGN KEY(idE) REFERENCES Enfant(idE),
   FOREIGN KEY(IdD) REFERENCES Demande(IdD)
);

/* table pour l'insertion de les periodes d'essai*/

CREATE TABLE Periode (
   idPeriode BIGINT AUTO_INCREMENT,
   Departement VARCHAR(50),
   ListeCommues VARCHAR(50),
   ListeServices VARCHAR(50),
   ListeDuree VARCHAR(50),
   PRIMARY KEY (idPeriode)
);
/* requete pour sortir tous les services avec les communes qui les propose et les periodes d'ouvertures 

Faites pas gaffe à ça

SELECT NomC,libellé_s, ouverture, fermeture

FROM Service s

JOIN Propose p ON (p.idService=s.idService)

JOIN Commune c ON (p.IdComAuto = c.IdComAuto)

*/
