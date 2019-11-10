# FlixShort - A URL Shortener
This project is built with Symfony 4. It allows to shorten long URLs to short. 

# Setup
* Run composer install
* Install Xammp.
* Update MySQL user name, password and database in .env (DATABASE_URL)
* Create database. php bin/console doctrine:database:create
* Create migration. php bin/console make:migration
* Create tables. php bin/console doctrine:migrations:migrate
* Install Symfony.  https://symfony.com/download
* Run symfony server:start
* Open http://127.0.0.1:8000/ to view URL shortner


# Time Estimates
|  Story |  Estimate | Actual  
|--------|-----------|-------|
|  Code Setup |  2h |   3h
|  Database Design |  1h | 1h   
|  Shorten Page |  2h | 5h
|  Shortened Page |  2h | 3h   

# Built With
* Symfony 4,
* Doctrine ORM,
* MySQL,
* jQuery,
* Twig,