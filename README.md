
# symfonyBlogSearch
Sample App for a blog with search content

## Requirements
1. PHP v5.4+.
2. Web Server (Apache, NGINX).
3. Composer.
4. Node.js and Bower to install dependences.

## Up and running instructions
1. Clone this Repository.
2. Configure your Web Server as indicates the  [Symfony Documentation] (http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html)
3. Inside the project root folder run:  ` $ composer install`
4. Edit the file app/config/parameters.yml with your host information.
5. If database does not exist create it with: ` $ php app/console doctrine:database:create`.
6. Create the database schema with: ` $ php app/console doctrine:migrations:migrate`.
6. Fill the database with some sample data: ` $ php app/console doctrine:fixtures:load`.
8. Install Assets third party libraries: ` $ bower install`
