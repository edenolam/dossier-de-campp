#!/bin/bash

set -e
set -x

# ls -d => affichage des dossiers également dans le résultat, merci à https://stackoverflow.com/a/16768547/535203
# ls -v => pour trier les fichiers par nom de fichier, merci à https://stackoverflow.com/a/7992921/535203
for SQL_FILE in $(ls -dv /tmp/initdb-sql/init-scripts/*) $(ls -dv /tmp/initdb-sql/dev-datas/*); do
  psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" -f "$SQL_FILE"
done