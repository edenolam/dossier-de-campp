# Projet *Scouts & Guides de France - Dossier de Camp*

## Développement
### Lancement du projet
```bash
./docker/run-dev-env.sh
```
Pour pouvoir ecraser toutes les données (de la base, du cache etc) du dev et relancer l'environnement de dev :
```bash
./docker/run-dev-env.sh --clean
```

### Pour obtenir une ligne de commande côté `api-server` PHP
```bash
docker exec -it ddc-api-server bash
```

### Pour obtenir une ligne de commande côté `client-app` Angular
```bash
docker exec -it ddc-client-app sh
```

### Pour forcer le build des Docker (en cas de mauvaise version de PHP par exemple)
```bash
docker-compose -f ./docker/docker-compose.yml build
```
Ou si des problèmes persistent, tenter la commande plus lente suivante :
```bash
docker-compose -f ./docker/docker-compose.yml build --no-cache --pull
```