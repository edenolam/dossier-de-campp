/* Camp 11-14 */

insert into camp_8_17 (moss_nbre_accompagnement_specifique, moss_activite_marine, moss_projet_international, moss_accueil_unite_etrangere, moss_camp_accompagne, moss_camp_jumele, moss_activite_en_autonomie,
                       prevision_nbre_animateurs, prevision_nbre_participants, prevision_nbre_filles, prevision_nbre_garcons, prevision_nbre_6_13, prevision_nbre_14_17, age_mini, age_maxi)
VALUES (0, false, false, false, false, false, false,
        1, 5, 2, 3, 1, 4, 11, 14) ;

insert into camp (code_type_camp, code_groupe_camp, libelle, statut, synthese, date_debut, date_fin, id_lieu_principal, id_histo_creation, id_histo_derniere_modification,
                  id_camp_8_17, id_camp_compagnon)
VALUES ('11-14', '8-17', 'Camp 11-14 ans du 18/12/2019 au 05/01/2020 dirigé par Cédric Ouvrard aux Forts', 1, null, '2019-12-18', '2020-01-05', null, null, null,
        currval('camp_8_17_id_seq'), null);

SELECT currval('camp_id_seq');

/* Histo */

insert into camp_historique_modification (id_camp, date_heure_modification, numero_adherent, modification_json, code_module)
VALUES (currval('camp_id_seq'), now(), '150000000', '{}', 'GENERAL');

update camp
set id_histo_creation = currval('camp_historique_modification_id_seq')
where id = currval('camp_id_seq');

/* Structures */

insert into camp_structure (id_camp, code_structure, organisatrice, participante)
VALUES (currval('camp_id_seq'), '109501300', true, true),
       (currval('camp_id_seq'), '109501311', false, true),
       (currval('camp_id_seq'), '109501321', false, true);

/* Lieux */

insert into lieu (libelle)
VALUES ('Les Forts à Nonvilliers-Grandhoux');

insert into camp_lieu_etape (id_camp, id_lieu, date_debut, date_fin)
VALUES (currval('camp_id_seq'),currval('lieu_id_seq'), '2019-12-18', '2020-01-05');

update camp
set id_lieu_principal = currval('lieu_id_seq')
where id = currval('camp_id_seq');

/* Adherents */

insert into camp_adherent_soutien (id_camp, numero_adherent)
VALUES (currval('camp_id_seq'), '150000000');

/* staff */

insert into camp_adherent_staff (id_camp, numero_adherent, date_debut_presence, date_fin_presence)
VALUES (currval('camp_id_seq'), '150034986', '2019-12-18', '2020-01-05');

/* Filles */

insert into camp_adherent_participant (id_camp, numero_adherent, date_debut_presence, date_fin_presence, chef_equipe, coordonnees_parents)
VALUES (currval('camp_id_seq'), '150035030', '2019-12-18', '2020-01-05', true, 'A la maison');

insert into camp_adherent_participant (id_camp, numero_adherent, date_debut_presence, date_fin_presence, chef_equipe, coordonnees_parents)
VALUES (currval('camp_id_seq'), '150035050', '2019-12-18', '2020-01-05', false, 'Au bureau');

/* Garcons */

insert into camp_adherent_participant (id_camp, numero_adherent, date_debut_presence, date_fin_presence, chef_equipe, coordonnees_parents)
VALUES (currval('camp_id_seq'), '150035073', '2019-12-18', '2020-01-05', true, 'A la maison');

insert into camp_adherent_participant (id_camp, numero_adherent, date_debut_presence, date_fin_presence, chef_equipe, coordonnees_parents)
VALUES (currval('camp_id_seq'), '150035085', '2019-12-18', '2020-01-05', false, 'Au bureau');

insert into camp_adherent_participant (id_camp, numero_adherent, date_debut_presence, date_fin_presence, chef_equipe, coordonnees_parents)
VALUES (currval('camp_id_seq'), '150035055', '2019-12-18', '2020-01-05', false, 'Au bureau');

/* Discussions */

insert into camp_discussion_sujet (id_camp, code_module, date_heure_creation, numero_adherent_createur, sujet, statut, numero_adherent_destinataire)
VALUES (currval('camp_id_seq'), 'INFO_GENERALE', now(), '150000000', 'Discussion #1', 1, '150035000');

insert into camp_discussion_echange (id_camp_discussion_sujet, date_heure_echange, numero_adherent_echange, echange)
VALUES (currval('camp_discussion_sujet_id_seq'), now(), '150035000', 'Echange #1.1'),
       (currval('camp_discussion_sujet_id_seq'), now(), '150034987', 'Echange #1.2'),
        (currval('camp_discussion_sujet_id_seq'), now(), '150035012', 'Echange #1.3');

insert into camp_discussion_sujet (id_camp, code_module, date_heure_creation, numero_adherent_createur, sujet, statut, numero_adherent_destinataire)
VALUES (currval('camp_id_seq'), 'INFO_GENERALE', now(), '150035018', 'Discussion #2 - cloture', 2, '150034984');

insert into camp_discussion_echange (id_camp_discussion_sujet, date_heure_echange, numero_adherent_echange, echange)
VALUES (currval('camp_discussion_sujet_id_seq'), now(), '150035000', 'Echange #2.1'),
       (currval('camp_discussion_sujet_id_seq'), now(), '150000000', 'Echange #2.2'),
       (currval('camp_discussion_sujet_id_seq'), now(), '150035018', 'Echange #2.3'),
       (currval('camp_discussion_sujet_id_seq'), now(), '150034984', 'Echange #2.4 - cloture');

insert into camp_discussion_sujet (id_camp, code_module, date_heure_creation, numero_adherent_createur, sujet, statut, numero_adherent_destinataire)
VALUES (currval('camp_id_seq'), 'PARTICIPANT', now(), '150000000', 'Discussion #3', 1, '150034980');
