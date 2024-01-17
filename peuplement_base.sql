/* sql pour peupler la region */

INSERT INTO `Region`(`Code_INSEE_R`, `NOM_R`)

SELECT DISTINCT code_region, nom_region FROM dataset.Communes WHERE nom_region LIKE "Auvergne-Rhône-Alpes" 

 /* pour peupler les departements */

INSERT INTO `Departement`(`Code_INSEE_D`, `NomD`, `Code_INSEE_R`)

SELECT DISTINCT code_departement, nom_departement, code_region FROM dataset.Communes WHERE code_region = 84

/* peuupler les communes */

ALTER TABLE Commune AUTO_INCREMENT = 1;

INSERT INTO `Commune`(`IdC`, `Code_postal`, `NomC`, `LatitudeC`, `LongitudeC`, `Code_INSEE_C`, `Code_INSEE_D`)

SELECT DISTINCT code_commune,code_postal,nom_commune_complet,latitude,longitude,code_commune_INSEE,code_departement

FROM dataset.Communes 

WHERE code_region=84

/* pour peupler la table citoyen */

ALTER TABLE Citoyen AUTO_INCREMENt = 1;

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("ibra.sow@gmail.com","Sow","Ibra",'2001-01-01',"0548697520");

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("elhadj.barry@gmail.com","Barry","Elhadj",'1999-03-25',"0185741952");

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("sidimeh.daddy@gmail.com","Sidimeh","Daddy",'2005-08-15',"0857425792");

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("said.balde@yahoo.com","Balde","Said",'1995-04-15',"0205869741");

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("laoura.diallo@hotmail.com","Diallo","Laoura",'1997-09-05',"0684405625");

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("m-ali.bah@etu.univ-lyon1.fr","Bah","Mamadou",'2005-02-28',"0786549780");

INSERT INTO `Citoyen`(`emailC`, `NomC`, `PrenomC`, `Date_naissC`, `num_telC`) VALUES ("sidy.diallo@gmail.com","Diallo","Sidy",'1996-04-05',"0795847625");


/* pour peupler la table service */
ALTER TABLE Service AUTO_INCREMENt = 1;
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("scolaire","inscription des enfants à l'école",0);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("restauration","gestion de la nourriture en milieu scolaire",1);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("signalement","gratuit pour les poucaves",0);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("etat civil","demande de documents administratifs",0);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("election","inscription sur les listes éléctorales",0);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("union civile","reconnaissance légale des couples",0);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("finance","gestion des impôts",0);
INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`) VALUES ("déchet","collecte et traitements des déchets",1);

/* pour peupler la table demande */
ALTER TABLE Demande AUTO_INCREMENt = 1;

INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("Je souhaiterais signaler un stationnement genant","22/11/2023",3,4);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("Je voudrais m'inscrire sur la liste éléctorale","05/05/2023",5,5);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("Je souhaiterais signaler un panneau cassé","14/01/2023",3,5);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je veux faire une demande de passeport","28/04/2023",4,1);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je veux faire une demande de CNI","10/12/2023",4,1);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais un extrait de naissance","10/12/2023",4,2);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais recupérer mon avis d'imposition","10/07/2023",7,2);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais me marier","03/03/2021",6,3);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais me pacser","20/07/2022",6,7);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais me pacser","08/11/2022",6,6);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais declarer un concubinage","05/06/2023",6,5);
INSERT INTO `Demande`(`Message`, `DateD`, `idService`, `idCitoyen`) VALUES ("je voudrais me marier","15/04/2023",6,2);

/* pour peupler la table propose */

INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (3575,6,'2023-12-25','2024-02-10');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (3579,6,'2023-12-10','2024-01-25');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (3541,6,'2024-02-15','2024-04-05');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (3541,1,'2024-01-01','2024-02-20');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (3541,3,'2023-12-20','2024-02-05');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (1,6,'2024-01-10','2024-03-01');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (1,8,'2024-01-25','2024-03-15');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (23,2,'2024-02-05','2024-03-25');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (31,3,'2023-12-30','2024-02-15');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (50,3,'2023-12-15','2024-02-01');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (4151,6,'2024-01-15','2024-03-05');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (4165,2,'2024-01-05','2024-02-25');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (4170,1,'2024-02-10','2024-04-01');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (4170,2,'2023-12-01','2024-01-15');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (4170,8,'2024-02-20','2024-04-10');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (275,4,'2024-01-20','2024-03-10');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (300,4,'2023-12-05','2024-01-20');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (325,5,'2024-02-01','2024-03-20');
INSERT INTO `Propose`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (400,7,'2024-02-01','2024-03-20');


/* pour peupler union civile */
ALTER TABLE Union_civile AUTO_INCREMENt = 1;
INSERT INTO `Union_civile`(`TypeU`, `DateU`, `IdD`) VALUES ("Mariage","15/03/2021",8);
INSERT INTO `Union_civile`(`TypeU`, `DateU`, `IdD`) VALUES ("Pacs","20/07/2022",9);
INSERT INTO `Union_civile`(`TypeU`, `DateU`, `IdD`) VALUES ("Pacs","08/11/2022",10);
INSERT INTO `Union_civile`(`TypeU`, `DateU`, `IdD`) VALUES ("Concubinage","05/06/2023",11);
INSERT INTO `Union_civile`(`TypeU`, `DateU`, `IdD`) VALUES ("Mariage","30/04/2023",12);

/* peupler Lieux */
ALTER TABLE Lieux AUTO_INCREMENt = 1;
INSERT INTO Lieux (`NomL`,`TypeL` , `longL`, `LatL`) VALUES
("Mont Blanc", "Montagne", "45.8325", "6.8644"),
("Lac d'Annecy", "Lac", "45.8497", "6.1256"),
("Vieux Lyon", "Quartier historique", "45.7588", "4.8276"),
("Parc de la Tête d'Or", "Parc", "45.7772", "4.8540"),
("Le Puy du Fou", "Parc d'attractions", "46.8900", "-0.9305"),
("Château de Chambord", "Château", "47.6166", "1.5110"),
("Gorges du Verdon", "Canyon", "43.7500", "6.3833"),
("Palais des Papes", "Palais", "43.9500", "4.8100"),
("Mont Ventoux", "Montagne", "44.1736", "5.2778"),
("Basilique Notre-Dame de Fourvière", "Basilique", "45.7621", "4.8222"),
("Grenoble", "Ville", "45.1885", "5.7245"),
("Parc Naturel Régional du Vercors", "Parc naturel", "45.0072", "5.4199"),
("Saint-Étienne", "Ville", "45.4397", "4.3872"),
("Volcans d'Auvergne", "Chaine de volcans", "45.7044", "2.8894"),
("Cité de Carcassonne", "Cité médiévale", "43.2120", "2.3536"),
("Valence", "Ville", "44.9334", "4.8924"),
("Lyon Part-Dieu", "Gare", "45.7606", "4.8593"),
("Musée des Confluences", "Musée", "45.7324", "4.8183"),
("Roanne", "Ville", "46.0326", "4.0684"),
("Vallée de la Drôme", "Vallée", "44.7152", "5.3000");

/* table ecole */
ALTER TABLE Ecole AUTO_INCREMENt = 1;
INSERT INTO Ecole (`AdresseE`, `NbClasses`, `NomE`,`idL`) VALUES
("1 Rue de l'École, Lyon", "10","Ecole primaire Marie Curie",1),
("5 Avenue Scolaire, Villeurbanne", "15","Collège Jean Jaurès", 2),
("10 Rue de l'Éducation, Grenoble", "12","Lycée Victor Hugo", 3),
("15 Boulevard des Études, Annecy", "20", "École élémentaire Saint-Exupéry", 4),
("20 Rue de l'Apprentissage, Saint-Étienne", "18", "Collège Simone de Beauvoir", 5),
("25 Avenue de l'Enseignement, Valence", "14", "Lycée Montesquieu", 6),
("30 Boulevard des Cours, Clermont-Ferrand", "16", "École maternelle Paul Cézanne", 7),
("35 Rue des Écoliers, Chambéry", "22", "Collège Paul Valéry", 8),
("40 Avenue de l'Instruction, Vienne", "17", "Lycée Henri Bergson", 9),
("45 Rue de l'Éducatif, Bourg-en-Bresse", "19", "École élémentaire Jules Verne", 10),
("50 Boulevard des Enseignants, Roanne", "21", "Collège Rosa Parks", 11),
("55 Rue de l'Apprenti, Aurillac", "13", "Lycée Jean Moulin", 12),
("60 Avenue des Leçons, Montélimar", "11", "École primaire Pierre et Marie Curie", 13),
("65 Rue des Savoirs, Le Puy-en-Velay", "23", "Collège Antoine de Saint-Exupéry", 14),
("70 Boulevard de l'Apprentissage, Aix-les-Bains", "25", "Lycée Louise Michel", 15);

/* table classe */
ALTER TABLE Classe AUTO_INCREMENt = 1;
INSERT INTO Classe (`idEcole`, `idClasse`,`nomClasse`)
VALUES
/* ecole 1*/
(1, 1, "CP"),
(1, 2, "CE1"),
(1, 3, "CE2"),
(1, 4, "CM1"),
(1, 5, "CM2"),
(1, 6, "6e"),
(1, 7, "5e"),
(1, 8, "4e"),
(1, 9, "3e"),
(1, 10, "Seconde"),

/* ecole 5 */ 

(5, 1, "CM I"), (5, 2, "CM II"), (5, 3, "CM III"), (5, 4, "CM IV"), (5, 5, "CM V"),
(5, 6, "6e A"), (5, 7, "6e B"), (5, 8, "5e A"), (5, 9, "5e B"), (5, 10, "4e A"),
(5, 11, "4e B"), (5, 12, "3e A"), (5, 13, "3e B"), (5, 14, "Seconde A"), (5, 15, "Seconde B"),
(5, 16, "Terminale S A"), (5, 17, "Terminale S B"), (5, 18, "Terminale L"),

/* ecole 8*/

(8, 1, "CM1"), (8, 2, "CM2"), (8, 3, "6e"), (8, 4, "5e"), (8, 5, "4e"),
(8, 6, "3e"), (8, 7, "Seconde"), (8, 8, "Première"), (8, 9, "Terminale S"),
(8, 10, "Terminale L"), (8, 11, "Terminale ES"), (8, 12, "Terminale STMG"),
(8, 13, "BTS Informatique"), (8, 14, "BTS Comptabilité"), (8, 15, "BTS Commerce"), (8, 16, "BTS Tourisme"),

/* ecole 4*/

(4, 1, "CM1"), (4, 2, "CM2"), (4, 3, "6e"), (4, 4, "5e"), (4, 5, "4e"),
(4, 6, "3e"), (4, 7, "Seconde"), (4, 8, "Première"), (4, 9, "Terminale S"),
(4, 10, "Terminale L"), (4, 11, "Terminale ES"), (4, 12, "Terminale STMG"),
(4, 13, "BTS Informatique"), (4, 14, "BTS Comptabilité"), (4, 15, "BTS Commerce"), (4, 16, "BTS Tourisme"),
(4, 17, "Licence Informatique"), (4, 18, "Licence Économie");

/* pour la table enfant */
ALTER TABLE Enfant AUTO_INCREMENt = 1;
INSERT INTO Enfant (`NomEnf`, `PrenomEnf`, `boolPremiereInsc`, `idEcole`, `idClasse`)
VALUES

("Dupont", "Jean", 0, 1, 1),
("Martin", "Alice", 0, 5, 6),
("Lefevre", "Thomas", 0, 8, 13),
("Robert", "Sophie", 0, 4, 15),
("Dubois", "Lucas", 0, 1, 2),
("Leroux", "Emma", 0, 5, 11),
("Moreau", "Hugo", 0, 8, 7),
("Girard", "Chloé", 0, 4, 9),
("Fournier", "Léa", 0, 1, 5),
("Lambert", "Mathis", 0, 5, 17),
("Petit", "Lucie", 1, 8, 2),
("Roux", "Arthur", 1, 4, 3),
("Colin", "Juliette", 1, 5, 5),
("Caron", "Maxime", 1, 1, 8),
("Lemoine", "Eva", 1, 8, 12),
("Bourgeois", "Nathan", 1, 4, 14),
("Fontaine", "Inès", 1, 5, 15),
("Garnier", "Enzo", 1, 1, 9),
("Meyer", "Manon", 1, 8, 1),
("Blanc", "Antoine", 1, 4, 6),
("Renard", "Zoé", 1, 5, 10),
("Gallet", "Léo", 1, 1, 6),
("Mallet", "Clara", 1, 8, 15),
("Lemoine", "Théo", 1, 4, 17),
("Lefevre", "Louise", 1, 5, 4),
("Picard", "Paul", 1, 1, 3),
("Legrand", "Camille", 1, 8, 9),
("Girard", "Tom", 1, 4, 11),
("Robin", "Mia", 1, 5, 13),
("Lopez", "Jules", 1, 1, 7),
("Vidal", "Léa", 1, 8, 5),
("Leclerc", "Timéo", 1, 4, 17),
("Guillot", "Léna", 1, 5, 1),
("Berger", "Hugo", 1, 1, 2),
("Leroux", "Jade", 1, 8, 6),
("Benoit", "Matéo", 1, 4, 15),
("Fournier", "Lola", 1, 5, 14),
("Petit", "Noah", 1, 1, 9),
("Leroux", "Eva", 1, 8, 16),
("Garnier", "Lucas", 1, 4, 7),
("Bourgeois", "Anna", 1, 5, 12),
("Roux", "Léo", 1, 1, 4),
("Fontaine", "Arthur", 1, 8, 10),
("Caron", "Mia", 1, 4, 18),
("Blanc", "Enzo", 1, 5, 8),
("Robin", "Chloé", 1, 1, 9),
("Guillot", "Manon", 1, 8, 14),
("Gallet", "Liam", 1, 4, 16),
("Leclerc", "Inès", 1, 5, 4),
("Berger", "Louis", 1, 1, 9),
("Martin", "Noémie", 1, 5, 18),
("Martin", "Noémie", 1, 8, 3),
("Dubois", "Raphaël", 1, 1, 8),
("Dubois", "Raphaël", 1, 4, 8);

/* pour la table cantine */

ALTER TABLE Cantine AUTO_INCREMENt = 1;
INSERT INTO Cantine (`NomCan`, `AdresseCan`, `NbPlaces`, `NbServices`, `Long_Can`, `Lat_Can`)
VALUES
("Cantine Éducative Lyon", "1 Rue de l'École, Lyon", "100", "2", "4.8357", "45.7640"),
("Cantine Scolaire Villeurbanne", "5 Avenue Scolaire, Villeurbanne", "120", "3", "4.8897", "45.7676"),
("Cantine du Savoir Grenoble", "10 Rue de l'Éducation, Grenoble", "80", "1", "5.7225", "45.1876"),
("Cantine des Saveurs Annecy", "15 Boulevard des Études, Annecy", "150", "2", "6.1237", "45.9000"),
("Cantine du Savoir Saint-Étienne", "20 Rue de l'Apprentissage, Saint-Étienne", "90", "1", "4.3852", "45.4346"),
("Cantine Joyeuse Valence", "25 Avenue de l'Enseignement, Valence", "110", "3", "4.8910", "44.9323"),
("Cantine Gourmande Clermont-Ferrand", "30 Boulevard des Cours, Clermont-Ferrand", "80", "1", "3.0898", "45.7772"),
("Cantine Conviviale Chambéry", "35 Rue des Écoliers, Chambéry", "100", "2", "5.9111", "45.5659"),
("Cantine Délice Vienne", "40 Avenue de l'Instruction, Vienne", "130", "3", "4.8786", "45.5263"),
("Cantine des Saveurs Bourg-en-Bresse", "45 Rue de l'Éducatif, Bourg-en-Bresse", "95", "2", "5.2268", "46.2050"),
("Cantine Gourmande Roanne", "50 Boulevard des Enseignants, Roanne", "80", "1", "3.4894", "46.0342"),
("Cantine Savoureuse Aurillac", "55 Rue de l'Apprenti, Aurillac", "100", "3", "2.4387", "44.9292"),
("Cantine Festive Montélimar", "60 Avenue des Leçons, Montélimar", "120", "2", "4.7518", "44.5569"),
("Cantine Délicieuse Le Puy-en-Velay", "65 Rue des Savoirs, Le Puy-en-Velay", "150", "1", "3.8783", "45.0428"),
("Cantine Gourmet Aix-les-Bains", "70 Boulevard de l'Apprentissage, Aix-les-Bains", "110", "2", "5.9188", "45.6915");

/* pour manger */

INSERT INTO `Manger`(`idCantine`, `idE`, `DebutMangeCANT`, `FinMangeCANT`, `nbAbs`) VALUES
-- École 1
(1, 1,'2023-09-15', '2024-03-20', 0),
(1, 5,'2023-09-01', '2023-12-20', 1),
(1, 9,'2023-10-01', '2023-12-20',0),
(1, 14,'2023-09-01', '2024-02-20', 2),
(1, 18,'2023-09-20', '2023-11-20', 0),
(1, 22,'2023-09-01', '2023-12-30', 0),
(1, 26,'2023-09-25', '2024-01-01', 0),
(1, 30,'2023-09-01', '2024-01-05', 0),

-- École 4

(4, 4,'2023-09-01', '2024-05-20', 1),
(4, 8,'2023-09-01', '2024-03-20', 0),
(4, 12,'2023-09-01', '2023-12-20', 2),
(4, 16,'2023-09-01', '2024-01-10', 0),
(4, 20,'2023-09-01', '2023-12-20', 1),
(4, 24, '2023-09-01', '2023-12-20',1),
(4, 28,'2023-09-01', '2023-11-30', 1),

-- École 5

(5, 2,'2023-09-01', '2023-12-20', 0),
(5, 6,'2023-09-01', '2023-12-20', 1),
(5, 10,'2023-09-01', '2023-12-20', 2),
(5, 13,'2023-09-01', '2023-12-20', 0),
(5, 17, '2023-09-01', '2023-12-20',1),
(5, 21,'2023-09-01', '2023-12-20', 1),
-- École 8
(8, 3,'2023-09-01', '2023-10-20', 0),
(8, 7,'2023-09-01', '2024-02-20', 1),
(8, 11,'2023-09-01', '2023-10-30', 2),
(8, 15, '2023-09-01', '2023-12-20',0),
(8, 19, '2023-09-01', '2024-01-01',1);