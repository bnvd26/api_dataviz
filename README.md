# DATAVIZ-API
 Production : <a>dataviz-api.benjaminadida.fr</a>
 
 Pour installer le projet vous devez : 
 * ````composer install````
 * Creez un .env similaire au .env.example
 * ```bin/console doctrine:database:create```
 * ```bin/console doctrine:schema:update --force```
 * `````bin/console doctrine:fixtures:load`````
 
 Un image SQL est disponible dans un docker-compose.yml


 ### MLD

 ![MLD](https://github.com/benads/api_dataviz/blob/master/MLD.png "MLD")

### Explication relation ManyToMany:
Une relation ManyToMany est un type de relation entre 2 entités, par exemple entre les arrondissement de Paris et les lignes de métro/RER. Un arrondissement peut avoir plusieurs ligne de métro et une ligne de métro peut parcourir plusieurs arrondissement. 
La relation ManyToMany va créer une table de jointure qui va nous permettre de faire le lien entre les 2 entités.

### Justifier choix de l’API:
Nous avons choisi de ne pas utiliser ApiPlatform car nous voulions être maître de notre API et pouvoir la configurer exactement comme nous le voulions.
2 controleurs, un qui gère la connexions à l’API et l’autre qui gère nos requêtes.
1 entité qui correspond aux arrondissement, 1 autre qui correspond aux lignes de transports en commun, 1 pour les utilisateurs et la dernière pour les infrastructures.
Système d’authentification via token JWT.

<br>
### Documentation disponible via Swagger.
