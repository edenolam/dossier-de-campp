CREATE TABLE camp
(
    id                             int GENERATED ALWAYS AS IDENTITY NOT NULL,
    code_type_camp                 dom_code                         NOT NULL,
    code_groupe_camp               dom_code_groupe_camp,
    libelle                        varchar                          NOT NULL,
    statut                         int2                             NOT NULL DEFAULT 1,
    synthese                       varchar,
    date_debut                     date,
    date_fin                       date,
    id_lieu_principal              int,
    id_histo_creation              int,
    id_histo_derniere_modification int,
    id_camp_8_17                   int                              NULL,
    id_camp_compagnon              int                              NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
COMMENT ON COLUMN camp.code_groupe_camp IS 'typage de l''enregistrement pour gestion héritage';
COMMENT ON COLUMN camp.id_histo_creation IS 'pointe vers l''enregistrement historique de la création';
COMMENT ON COLUMN camp.id_histo_derniere_modification IS 'pointe vers l''enregistrement historique de la derniere modif';

CREATE TABLE type_camp
(
    code             dom_code NOT NULL,
    code_groupe_camp dom_code_groupe_camp,
    libelle          varchar  NOT NULL,
    fichier_css      varchar  NOT NULL,
    fichier_logo     varchar  NOT NULL,
    actif            bool     NOT NULL DEFAULT true,
    PRIMARY KEY (code)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX type_camp_uidx_c_2 ON type_camp USING btree (libelle ASC);
COMMENT ON COLUMN type_camp.fichier_css IS 'Nom du fichier CSS associé';

CREATE TABLE module
(
    code                  dom_code NOT NULL,
    code_type_module      dom_code NOT NULL,
    libelle               varchar  NOT NULL,
    rattachement_multiple bool     NOT NULL DEFAULT false,
    type_moss             dom_code,
    ordre_affichage       int2     NOT NULL,
    surveyjs_json         json     NOT NULL,
    PRIMARY KEY (code)
)
    WITHOUT OIDS;
COMMENT ON COLUMN module.code IS 'Code (Enum) d''identification du module pour application des régles de gestion';
COMMENT ON COLUMN module.rattachement_multiple IS 'Peut être rattaché plusieurs fois au même camp (ex: Fiche intention)';
COMMENT ON COLUMN module.type_moss IS 'module Obligatoire Sur Situation : MARINE, INTL, HANDICAP, ...';

CREATE TABLE type_camp_module
(
    id                       int GENERATED ALWAYS AS IDENTITY NOT NULL,
    code_type_camp           dom_code                         NOT NULL,
    code_module              dom_code                         NOT NULL,
    surveyjs_traduction_json json,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX type_camp_module_uidx_c_2_3 ON type_camp_module USING btree (code_type_camp ASC, code_module ASC);

CREATE TABLE camp_module
(
    id                     int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp                int                              NOT NULL,
    code_module            dom_code                         NOT NULL,
    actif                  bool                             NOT NULL DEFAULT true,
    surveyjs_reponses_json jsonb,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE INDEX camp_module_idx_c_2_3 ON camp_module USING btree (id_camp ASC, code_module ASC);
COMMENT ON COLUMN camp_module.actif IS 'Support désactivation temporaire pour ne pas perdre données saisies';

CREATE TABLE structure
(
    code    dom_structure_code NOT NULL,
    libelle varchar            NOT NULL,
    PRIMARY KEY (code)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX structure_uidx_c_2 ON structure USING btree (libelle ASC);

CREATE TABLE adherent
(
    numero         dom_numero NOT NULL,
    prenom         varchar    NOT NULL,
    nom            varchar    NOT NULL,
    genre          dom_genre  NOT NULL,
    date_naissance date       NOT NULL,
    PRIMARY KEY (numero)
)
    WITHOUT OIDS;
COMMENT ON COLUMN adherent.genre IS 'H ou F';

CREATE TABLE camp_structure
(
    id             int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp        int                              NOT NULL,
    code_structure dom_structure_code               NOT NULL,
    organisatrice  bool                             NOT NULL DEFAULT false,
    participante   bool                             NOT NULL DEFAULT false,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_structure_uidx_c_2_3 ON camp_structure USING btree (id_camp ASC, code_structure ASC);

CREATE TABLE camp_adherent_staff
(
    id                              int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp                         int                              NOT NULL,
    numero_adherent                 dom_numero                       NOT NULL,
    date_debut_presence             date                             NOT NULL,
    date_fin_presence               date                             NOT NULL,
    moss_accompagnement_specifique  bool                             NOT NULL DEFAULT false,
    role_staff_directeur            bool                             NOT NULL DEFAULT false,
    role_staff_chef                 bool                             NOT NULL DEFAULT false,
    validation_stage_pratique_bafa  bool                             NOT NULL DEFAULT false,
    validation_stage_pratique_bafd1 bool                             NOT NULL DEFAULT false,
    validation_stage_pratique_bafd2 bool                             NOT NULL DEFAULT false,
    role_maitrise_intendant         bool                             NOT NULL DEFAULT false,
    role_maitrise_tresorier         bool                             NOT NULL DEFAULT false,
    role_maitrise_as                bool                             NOT NULL DEFAULT false,
    role_maitrise_materiel          bool                             NOT NULL DEFAULT false,
    role_maitrise_autre             bool                             NOT NULL DEFAULT false,
    role_maitrise_autre_detail      varchar,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;

CREATE UNIQUE INDEX camp_adherent_staff_uidx_c_2_3 ON camp_adherent_staff USING btree (id_camp ASC, numero_adherent ASC);

CREATE TABLE camp_adherent_participant
(
    id                             int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp                        int                              NOT NULL,
    numero_adherent                dom_numero                       NOT NULL,
    date_debut_presence            date                             NOT NULL,
    date_fin_presence              date                             NOT NULL,
    moss_accompagnement_specifique bool                             NOT NULL DEFAULT false,
    chef_equipe                    bool                             NOT NULL DEFAULT false,
    coordonnees_parents            varchar,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;

CREATE UNIQUE INDEX camp_adherent_participant_uidx_c_2_3 ON camp_adherent_participant USING btree (id_camp ASC, numero_adherent ASC);

CREATE TABLE camp_8_17
(
    id                                  int GENERATED ALWAYS AS IDENTITY NOT NULL,
    moss_nbre_accompagnement_specifique int                              NOT NULL DEFAULT 0,
    moss_activite_marine                bool                             NOT NULL DEFAULT false,
    moss_projet_international           bool                             NOT NULL DEFAULT false,
    moss_accueil_unite_etrangere        bool                             NOT NULL DEFAULT false,
    moss_camp_accompagne                bool                             NOT NULL DEFAULT false,
    moss_camp_jumele                    bool                             NOT NULL DEFAULT false,
    moss_activite_en_autonomie          bool                             NOT NULL DEFAULT false,
    prevision_nbre_animateurs           int                              NOT NULL DEFAULT 0,
    prevision_nbre_participants         int                              NOT NULL DEFAULT 0,
    prevision_nbre_filles               int                              NOT NULL DEFAULT 0,
    prevision_nbre_garcons              int                              NOT NULL DEFAULT 0,
    prevision_nbre_6_13                 int                              NOT NULL DEFAULT 0,
    prevision_nbre_14_17                int                              NOT NULL DEFAULT 0,
    age_mini                            int                              NOT NULL DEFAULT 8,
    age_maxi                            int                              NOT NULL DEFAULT 17,
    commentaire_staff                   varchar,
    telephone_contact_staff             varchar,
    projet_peda_bilan_annee             varchar,
    projet_peda_ambitions               varchar,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
COMMENT ON COLUMN camp_8_17.moss_nbre_accompagnement_specifique IS 'Nombre de participants/staff cohé en tant que mossAccompagnementSpecifique';

CREATE TABLE camp_compagnon
(
    id int GENERATED ALWAYS AS IDENTITY NOT NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE TABLE camp_adherent_soutien
(
    id              int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp         int                              NOT NULL,
    numero_adherent dom_numero                       NOT NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_adherent_soutien_uidx_c_2_3 ON camp_adherent_soutien USING btree (id_camp ASC, numero_adherent ASC);

CREATE TABLE lieu
(
    id              int GENERATED ALWAYS AS IDENTITY NOT NULL,
    libelle         varchar                          NOT NULL,
    adresse_ligne_1 varchar                          NULL,
    adresse_ligne_2 varchar                          NULL,
    code_postal     varchar                          NULL,
    ville           varchar                          NULL,
    geojson         jsonb                            NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;

CREATE TABLE camp_lieu_etape
(
    id         int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp    int                              NOT NULL,
    id_lieu    int                              NOT NULL,
    date_debut date                             NOT NULL,
    date_fin   date                             NOT NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_lieu_etape_uidx_c_2 ON camp_lieu_etape USING btree (id_camp ASC, date_debut ASC);


CREATE TABLE camp_journee_type
(
    id                    int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp               int                              NOT NULL,
    heure_debut           varchar(5)                       NOT NULL,
    activite_participants varchar                          NOT NULL,
    activite_staff        varchar,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_journee_type_uidx_c_2_3 ON camp_journee_type USING btree (id_camp ASC, heure_debut ASC);

CREATE TABLE camp_grille_activite
(
    id                   int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp              int                              NOT NULL,
    date_activite        date                             NOT NULL,
    creneau              int2                             NOT NULL,
    description          varchar,
    imaginaire           varchar,
    id_staff_responsable int,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_grille_activite_uidx_c_2_3_4 ON camp_grille_activite USING btree (id_camp ASC, date_activite ASC, creneau ASC);
COMMENT ON COLUMN camp_grille_activite.creneau IS '1=matin, 2=après-midi, 3=soir';

CREATE TABLE numero_utile
(
    id              int GENERATED ALWAYS AS IDENTITY NOT NULL,
    categorie       int                              NOT NULL,
    libelle         varchar                          NOT NULL,
    ordre_affichage int2                             NOT NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
COMMENT ON COLUMN numero_utile.categorie IS '1=Structure, 2=Secours, 3=Utiles, 4=International';

CREATE TABLE type_camp_numero_utile
(
    id              int GENERATED ALWAYS AS IDENTITY NOT NULL,
    code_type_camp  dom_code                         NOT NULL,
    id_numero_utile int                              NOT NULL,
    obligatoire     bool                             NOT NULL DEFAULT false,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX type_camp_numero_utile_uidx_c_2_3 ON type_camp_numero_utile USING btree (code_type_camp ASC, id_numero_utile ASC);

CREATE TABLE camp_numero_utile
(
    id                int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp           int                              NOT NULL,
    id_numero_utile   int                              NOT NULL,
    infos_contact     varchar                          NOT NULL,
    telephone_contact varchar,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_numero_utile_uidx_c_2_3 ON camp_numero_utile USING btree (id_camp ASC, id_numero_utile ASC);

CREATE TABLE camp_historique_modification
(
    id                      int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp                 int                              NOT NULL,
    date_heure_modification timestamptz(0)                   NOT NULL,
    code_module             dom_code                         NOT NULL,
    numero_adherent         dom_numero                       NOT NULL,
    modification_json       jsonb                            NOT NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE INDEX camp_historique_modification_idx_c_2_3_4 ON camp_historique_modification USING btree (id_camp ASC, date_heure_modification DESC, code_module ASC);

CREATE TABLE camp_discussion_sujet
(
    id                           int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp                      int                              NOT NULL,
    code_module                  dom_code                         NOT NULL,
    date_heure_creation          timestamptz(0)                   NOT NULL,
    numero_adherent_createur     dom_numero                       NOT NULL,
    sujet                        varchar                          NOT NULL,
    statut                       int                              NOT NULL DEFAULT 1,
    numero_adherent_destinataire dom_numero,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE INDEX camp_discussion_sujet_idx_c_2_3_4 ON camp_discussion_sujet USING btree (id_camp ASC, code_module ASC, date_heure_creation ASC);
COMMENT ON COLUMN camp_discussion_sujet.code_module IS 'Module, ecran concerné';
COMMENT ON COLUMN camp_discussion_sujet.statut IS '1=Ouvert';

CREATE TABLE camp_discussion_echange
(
    id                       int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp_discussion_sujet int                              NOT NULL,
    date_heure_echange       timestamptz(0)                   NOT NULL,
    numero_adherent_echange  dom_numero                       NOT NULL,
    echange                  varchar                          NOT NULL,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE INDEX camp_discussion_echange_idx_c_2_3 ON camp_discussion_echange USING btree (id_camp_discussion_sujet ASC, date_heure_echange ASC);

CREATE TABLE camp_verrou
(
    id                    int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp               int                              NOT NULL,
    code_module           dom_code                         NOT NULL,
    adherent_proprietaire dom_numero                       NOT NULL,
    date_heure_verrou_on  timestamptz(0)                   NOT NULL,
    date_heure_verrou_off timestamptz(0)                   NULL,
    version_data          int                              NOT NULL DEFAULT 1,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_verrou_uidx_c_2_3 ON camp_verrou USING btree (id_camp ASC, code_module ASC);

CREATE TABLE type_module
(
    code            dom_code NOT NULL,
    libelle         varchar  NOT NULL,
    ordre_affichage int2     NOT NULL,
    type_systeme    bool     NOT NULL DEFAULT false,
    PRIMARY KEY (code)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX type_module_uidx_c_2 ON type_module USING btree (libelle ASC);
COMMENT ON COLUMN type_module.type_systeme IS 'type systeme non supprimable (ex: MOSS)';

CREATE TABLE camp_avis
(
    id                           int GENERATED ALWAYS AS IDENTITY NOT NULL,
    id_camp                      int                              NOT NULL,
    type_avis                    dom_code                         NOT NULL,
    date_heure_dernier_avis      timestamptz(0)                   NOT NULL,
    numero_adherent_dernier_avis dom_numero                       NOT NULL,
    statut                       dom_code                         NOT NULL DEFAULT 'NON-EMIS',
    commentaire                  varchar,
    PRIMARY KEY (id)
)
    WITHOUT OIDS;
CREATE UNIQUE INDEX camp_avis_uidx_c_2_3 ON camp_avis USING btree (id_camp ASC, type_avis ASC);
COMMENT ON COLUMN camp_avis.type_avis IS 'marine, intl, RG, AP';


ALTER TABLE camp
    ADD CONSTRAINT fk_camp_type_camp FOREIGN KEY (code_type_camp) REFERENCES type_camp (code);
ALTER TABLE type_camp_module
    ADD CONSTRAINT fk_type_camp_module_type_camp FOREIGN KEY (code_type_camp) REFERENCES type_camp (code);
ALTER TABLE type_camp_module
    ADD CONSTRAINT fk_type_camp_module_module FOREIGN KEY (code_module) REFERENCES module (code);
ALTER TABLE camp_module
    ADD CONSTRAINT fk_camp_module_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_module
    ADD CONSTRAINT fk_camp_module_module FOREIGN KEY (code_module) REFERENCES module (code);
ALTER TABLE camp_structure
    ADD CONSTRAINT fk_camp_structure_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_structure
    ADD CONSTRAINT fk_camp_structure_structure FOREIGN KEY (code_structure) REFERENCES structure (code);

ALTER TABLE camp_adherent_staff
    ADD CONSTRAINT fk_camp_adherent_staff_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_adherent_staff
    ADD CONSTRAINT fk_camp_adherent_staff_adherent FOREIGN KEY (numero_adherent) REFERENCES adherent (numero);

ALTER TABLE camp_adherent_participant
    ADD CONSTRAINT fk_camp_adherent_participant_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_adherent_participant
    ADD CONSTRAINT fk_camp_adherent_participant_adherent FOREIGN KEY (numero_adherent) REFERENCES adherent (numero);


ALTER TABLE camp
    ADD CONSTRAINT fk_camp_camp_8_17 FOREIGN KEY (id_camp_8_17) REFERENCES camp_8_17 (id) ON DELETE CASCADE;
ALTER TABLE camp
    ADD CONSTRAINT fk_camp_camp_compagnon FOREIGN KEY (id_camp_compagnon) REFERENCES camp_compagnon (id) ON DELETE CASCADE;

ALTER TABLE camp_adherent_soutien
    ADD CONSTRAINT fk_camp_adherent_soutien_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_adherent_soutien
    ADD CONSTRAINT fk_camp_adherent_soutien_adherent FOREIGN KEY (numero_adherent) REFERENCES adherent (numero);
ALTER TABLE camp_lieu_etape
    ADD CONSTRAINT fk_camp_lieu_etape_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_lieu_etape
    ADD CONSTRAINT fk_camp_lieu_etape_lieu FOREIGN KEY (id_lieu) REFERENCES lieu (id);
ALTER TABLE camp
    ADD CONSTRAINT fk_camp_lieu FOREIGN KEY (id_lieu_principal) REFERENCES lieu (id);
ALTER TABLE camp_journee_type
    ADD CONSTRAINT fk_camp_journee_type_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_grille_activite
    ADD CONSTRAINT fk_camp_grille_activite_camp FOREIGN KEY (id_camp) REFERENCES camp (id);
ALTER TABLE camp_grille_activite
    ADD CONSTRAINT fk_camp_grille_activite_camp_adherent_staff FOREIGN KEY (id_staff_responsable) REFERENCES camp_adherent_staff (id);
ALTER TABLE type_camp_numero_utile
    ADD CONSTRAINT fk_type_camp_numero_utile_type_camp FOREIGN KEY (code_type_camp) REFERENCES type_camp (code);
ALTER TABLE type_camp_numero_utile
    ADD CONSTRAINT fk_type_camp_numero_utile_numero_utile FOREIGN KEY (id_numero_utile) REFERENCES numero_utile (id);
ALTER TABLE camp_numero_utile
    ADD CONSTRAINT fk_camp_numero_utile_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_numero_utile
    ADD CONSTRAINT fk_camp_numero_utile_numero_utile FOREIGN KEY (id_numero_utile) REFERENCES numero_utile (id);
ALTER TABLE camp_historique_modification
    ADD CONSTRAINT fk_camp_historique_modification_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_historique_modification
    ADD CONSTRAINT fk_camp_historique_modification_adherent FOREIGN KEY (numero_adherent) REFERENCES adherent (numero);
ALTER TABLE camp_discussion_sujet
    ADD CONSTRAINT fk_camp_sujet_discution_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_discussion_echange
    ADD CONSTRAINT fk_camp_discussion_echange_camp_discussion_subjet FOREIGN KEY (id_camp_discussion_sujet) REFERENCES camp_discussion_sujet (id) ON DELETE CASCADE;
ALTER TABLE camp_verrou
    ADD CONSTRAINT fk_camp_verrou_adherent FOREIGN KEY (adherent_proprietaire) REFERENCES adherent (numero);
ALTER TABLE camp_verrou
    ADD CONSTRAINT fk_camp_verrou_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE module
    ADD CONSTRAINT fk_module_type_module FOREIGN KEY (code_type_module) REFERENCES type_module (code);
ALTER TABLE camp_discussion_sujet
    ADD CONSTRAINT fk_camp_discussion_sujet_adherent_createur FOREIGN KEY (numero_adherent_createur) REFERENCES adherent (numero);
ALTER TABLE camp_discussion_sujet
    ADD CONSTRAINT fk_camp_discussion_sujet_adherent_destinataire FOREIGN KEY (numero_adherent_destinataire) REFERENCES adherent (numero);
ALTER TABLE camp_discussion_echange
    ADD CONSTRAINT fk_camp_discussion_echange_adherent_echange FOREIGN KEY (numero_adherent_echange) REFERENCES adherent (numero);
ALTER TABLE camp_avis
    ADD CONSTRAINT fk_camp_avis_camp FOREIGN KEY (id_camp) REFERENCES camp (id) ON DELETE CASCADE;
ALTER TABLE camp_avis
    ADD CONSTRAINT fk_camp_avis_adherent FOREIGN KEY (numero_adherent_dernier_avis) REFERENCES adherent (numero);
ALTER TABLE camp
    ADD CONSTRAINT fk_camp_camp_historique_modification_creation FOREIGN KEY (id_histo_creation) REFERENCES camp_historique_modification (id);
ALTER TABLE camp
    ADD CONSTRAINT fk_camp_camp_historique_modification_derniere_modif FOREIGN KEY (id_histo_derniere_modification) REFERENCES camp_historique_modification (id);

