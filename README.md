## Information
This is an example laravel application to show base of importing documents in laravel with field mapping.

## Installation
- The first step is to install docker and docker-compose - https://docs.docker.com/get-docker/
- The second step is to copy .env.bak to .env and run following commands:
    - ```
      docker run --rm \
           -v $(pwd):/opt \
           -w /opt \
           laravelsail/php80-composer:latest \
           composer install
      ```
    - ```
      ./vendor/bin/sail up
      ```
    - ```
      ./vendor/bin/sail artisan migrate      
      ```
    - ```
      ./vendor/bin/sail npm install
      ```
    - ```
      ./vendor/bin/sail npm run prod
       or
      ./vendor/bin/sail npm run dev
      ```
- The third step is to [register](http://localhost/register) user and go to [contacts](http://localhost/contacts) page and try to upload CSV. 
