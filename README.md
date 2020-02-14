# DATAVIZ-API
 Production : <a>dataviz-api.benjaminadida.fr</a>
 
 Pour installer le projet vous devez : 
 * ````composer install````
 * Creez un .env similaire au .env.example
 * ```bin/console doctrine:database:create```
 * ```bin/console doctrine:schema:update --force```
 * `````bin/console doctrine:fixtures:load`````
 
 Un image SQL est disponible dans un docker-compose.yml
