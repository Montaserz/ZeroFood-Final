## **Zero Waste Food**

Deployment Documentation

## API

#### Requirements

`PHP >= 7.2.0
`
`BCMath PHP Extension
`
`Ctype PHP Extension
`
`JSON PHP Extension
`
`Mbstring PHP Extension
`
`OpenSSL PHP Extension
`
`PDO PHP Extension
`
`Tokenizer PHP Extension
`
`XML PHP Extension`
`Mysql database
`
####Endpoints
API endpoints are all documented under this link

`https://documenter.getpostman.com/view/10096617/SWLk4m25
`

####Deployment
**this documentation is adapted for linux system**

clone this repository to the location where it needs to be installed.

`git clone ...git`

enter the directory of the api

`cd api`

install composer if needed

`apt-get install composer`

install dependency packages through composer

`composer install`

copy .env.example file to .env

`cp .env.example .env`

edit .env parameters and change database connections credentials

`vi .env`

`DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=homestead
 DB_USERNAME=homestead
 DB_PASSWORD=secret`
 
 sqlite database can work but it will not
 allow concurrent connections, use it only for testing
 
 
create keys and also generate JWT key
 
 `php artisan key:generate`
`php artisan jwt:secret -f`

migrate database

`php artisan migrate`

if it's not running behind a webserver serve using

`php artisan serve`

if it's running behind a webserver you need to point the virtual host
to the /public folder

Enjoy!

## Frontend Applications

**This works for both applications including the admin app.**

####Building/compiling requirements

`npm tool`

####Building documentation

Install npm if not installed

`apt-get install npm`

install npm dependencies that are in package.json

`npm install`

to build into compiled files

`npm run build`

to serve use

`npm run serve`

####Deployment documentation

change the base url of the API in your main.js and store/index.js files

`base_url=https://example.com/api
`

build the project

`npm run build`

upload the content of the generated /dist folder to the server/medium

add this into .htaccess

`
<ifModule mod_rewrite.c>
    RewriteEngine On
  RewriteBase /
  RewriteRule ^index\.html$ - [L]
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . /index.html [L]
</ifModule>
`

## Load balancing

if load balancing is needed for any of the components then you need to install it on different servers(nodes),
and then configure a master node(server) to work as a load balancer to these nodes, the change your DNS records to forward the traffic to the master node, I suggest using NGINX
later on this component can be scaled horizontally by just adding more nodes.

`sudo apt-get install nginx`

## SEO

There's nothing that can be done on server side for SEO other than mod_rewrite for the URLs to function correctly but in our case, the routes are handled by the client-side application and for better SEO 
metas are added for different components like products to help search engines index the website correctly.
