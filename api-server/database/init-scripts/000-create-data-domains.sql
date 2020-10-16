CREATE DOMAIN dom_numero VARCHAR(9) CHECK(VALUE ~ '^[[:digit:]]{9}$');

CREATE DOMAIN dom_structure_code VARCHAR(9) CHECK(VALUE ~ '^[[:digit:]]{9}$');

CREATE DOMAIN dom_heure VARCHAR(5) CHECK(VALUE ~ '^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$');

CREATE DOMAIN dom_genre VARCHAR(1) CHECK(VALUE IN ('H', 'F'));

CREATE DOMAIN dom_code VARCHAR(20);

CREATE DOMAIN dom_type_rattachement VARCHAR(1) NOT NULL CHECK(VALUE IN ('P', 'S'));

CREATE DOMAIN dom_code_groupe_camp VARCHAR(20) NOT NULL CHECK(VALUE IN ('6-8', '8-17', 'COMPAGNON', 'JADE', 'VDL'));
