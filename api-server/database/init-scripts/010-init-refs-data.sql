
INSERT INTO type_camp(code, code_groupe_camp, libelle, fichier_css, fichier_logo, actif)
 VALUES ('6-8', '6-8', '6-8 ans', 'tc-6-8.css', 'tc-6-8.png', true),
        ('8-11', '8-17', '8-11 ans', 'tc-8-11.css', 'tc-8-11.png', true),
        ('11-14', '8-17', '11-14 ans', 'tc-11-14.css', 'tc-11-14.png', true),
        ('14-17', '8-17', '14-17 ans', 'tc-14-17.css', 'tc-14-17.png', true),
        ('COMPAGNONS-T1', 'COMPAGNON', 'Compagnons - Temps 1', 'tc-comp-t1.css', 'tc-comp-t1.png', true),
        ('COMPAGNONS-T2', 'COMPAGNON', 'Compagnons - Temps 2', 'tc-comp-t2.css', 'tc-comp-t2.png', true),
        ('COMPAGNONS-T3', 'COMPAGNON', 'Compagnons - Temps 3', 'tc-comp-t3.css', 'tc-comp-t3.png', true),
        ('JADE', 'JADE', 'Jeunes Adultes Départ à l''Etranger', 'tc-jade.css', 'tc-jade.png', true),
        ('VENT-DU-LARGE', 'VDL', 'Vent du Large', 'tc-vdl.css', 'tc-vdl.png', true),
        ('CAMP-ACCOMPAGNE', '8-17', 'Camp accompagné', 'tc-ca.css', 'tc-ca.png', true);

INSERT INTO type_module(code, libelle, ordre_affichage, type_systeme)
VALUES ('MOSS', 'Modules Obligatoires Selon Situation', -1, true),
       ('OPTIONNEL', 'Modules optionnels', 999, true);

INSERT INTO module(code, code_type_module, libelle, rattachement_multiple, type_moss, ordre_affichage, surveyjs_json)
VALUES ('APAS', 'MOSS', 'Accueillir un participant nécessitant un accompagnement spécifique', false, 'APAS', 10, '{}'),
       ('MARIN', 'MOSS', 'Réaliser des activités de navigation (camp Marin)', false, 'MARIN', 20, '{}'),
       ('INTERNATIONAL-8-17', 'MOSS', 'Vivre un projet à l''international (8-17 ans)', false, 'INTERNATIONAL', 30, '{}'),
       ('INTERNATIONAL-COMP', 'MOSS', 'Vivre un projet à l''international (Compagnons)', false, 'INTERNATIONAL', 40, '{}'),
       ('INTERNATIONAL-JADE', 'MOSS', 'Vivre un projet à l''international (JADE)', false, 'INTERNATIONAL', 50, '{}'),
       ('ACCUEIL-ETRANGER', 'MOSS', 'Accueillir une unité étrangère', false, 'ACCUEIL-ETRANGER', 60, '{}'),
       ('INTEGRATION-CA', 'MOSS', 'Intégrer un camp accompagné', false, 'INTEGRATION-CA', 70, '{}'),
       ('JUMELAGE', 'MOSS', 'Partir en jumelage SGDF ou Scoutisme Français', false, 'JUMELAGE', 80, '{}'),
       ('AUTONOMIE', 'MOSS', 'Activité en autonomie', false, 'AUTONOMIE', 90, '{}');

INSERT INTO module(code, code_type_module, libelle, rattachement_multiple, type_moss, ordre_affichage, surveyjs_json)
VALUES ('OUVERTURE', 'OPTIONNEL', 'Mettre en place une démarche d''ouverture', false, null, 200, '{}'),
       ('SCOUTE', 'OPTIONNEL', 'Méthode Scoute', false, null, 210, '{}'),
       ('SPIRIT', 'OPTIONNEL', 'Construire une démarche spirituelle', false, null, 220, '{}'),
       ('BAFA/BAFD', 'OPTIONNEL', 'Accompagner un stagiaire BAFA/BAFD', false, null, 230, '{}'),
       ('MAITRISE', 'OPTIONNEL', 'Charte de maîtrise', false, null, 240, '{}'),
       ('APPEL-AGE-SUP', 'OPTIONNEL', 'Appel de la tranche d''age supérieure', false, null, 250, '{}'),
       ('CHECK-LIST-VALIDE', 'OPTIONNEL', 'Check-list de validation', true, null, 260, '{}'),
       ('HALP', 'OPTIONNEL', 'Réaliser un camp HALP', false, null, 270, '{}'),
       ('ITINERANCE', 'OPTIONNEL', 'Préparation d''une itinérance', false, null, 280, '{}'),
       ('EMPREINTE', 'OPTIONNEL', 'Empreinte du camp', false, null, 290, '{}');

INSERT INTO numero_utile(categorie, libelle, ordre_affichage)
VALUES (1, 'DDJS d''accueil', 10),
       (1, 'Gendarmerie', 20),
       (1, 'Mairie', 30),
       (1, 'Territoire d''accueil', 40),
       (1, 'DDJS d''origine', 50),
       (1, 'Territoire d''origine', 60),
       (1, 'Délégué territorial', 70),
       (1, 'Ligne d''urgence nationale', 80),
       (1, 'Assurance', 90),
       (2, 'Pompiers', 100),
       (2, 'SAMU', 110),
       (2, 'Médecin n°1', 120),
       (2, 'Médecin n°2', 130),
       (2, 'Hôpital', 140),
       (2, 'Centre antipoison', 150),
       (2, 'Pharmacie', 160),
       (2, 'Dentiste', 170),
       (3, 'Supermarché', 200),
       (3, 'Maraicher', 210),
       (3, 'Boulangerie', 220),
       (3, 'Epicerie', 230),
       (3, 'Boucherie', 240),
       (3, 'Allo Enfance Maltraitée', 250),
       (3, 'Paroisse', 260),
       (3, 'Scierie', 270),
       (3, 'Syndicat d''initialive', 280),
       (3, 'ONF', 290),
       (3, 'Presse locale', 300),
       (3, 'Service météo', 310),
       (3, 'Taxi', 320),
       (3, 'Ambulance', 330),
       (4, 'SGDF en France', 400),
       (4, 'Partenaires Scouts/Guides', 410),
       (4, 'Associations locales', 420),
       (4, 'Consulats de France dans les lieux', 430),
       (4, 'Espace France Volontaire', 440);
