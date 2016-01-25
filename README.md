
# symfonyBlogSearch
Sample App for a blog with search content

## Requirements
1. PHP v5.4+.
2. Web Server (Apache, NGINX).
3. Composer.
4. Node.js and Bower to install dependences.
5. A google developer key (if is online) or elasticsearch v1.7 installed and running

## Up and running instructions
1. Clone this Repository.
2. Configure your Web Server as indicates the  [Symfony Documentation] (http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html)
3. Inside the project root folder run:  ` $ composer install`
4. Edit the file app/config/parameters.yml with your host information.
5. If database does not exist create it with: ` $ php app/console doctrine:database:create`.
6. Create the database schema with: ` $ php app/console doctrine:migrations:migrate`.
7. Fill the database with some sample data: ` $ php app/console doctrine:fixtures:load`.
8. If you plane to use google configure LiipSearchBundle as indicates in their [README.md] (https://github.com/liip/LiipSearchBundle/tree/1.0)
    You will need to have hired the google site search and have a google api key.
9. For Elasticsearch configure FOSElasticaBundle as indicates in the [DOC] (https://github.com/FriendsOfSymfony/FOSElasticaBundle/blob/3.0.x/Resources/doc/setup.md). Default              values are already configured in this Repository. Also you will need populate the elasticsearch index with ` $ php app/console fos:elastica:populate`
10. Set the search engine to use.
    For google search engine:
    ```yaml
        #app/config/config.yml
        jonafrank_search:
            search_engine: google
    ```
    For Elasticsearch search engine:
    ```yaml
        #app/config/config.yml
        jonafrank_search:
            search_engine: elasticsearch
    ```
11. Install Assets third party libraries: ` $ bower install`
