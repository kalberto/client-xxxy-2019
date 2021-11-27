##Client XXY

## Development

**DO NOT LET .env "APP_ENV" = "prod"**

## Tecnology

- PHP 7.1.8
- Framework PHP Laravel 5.8
- POSTGRES Database
- HTML5, CSS3, Javascript
- VueJS
- Java JDK 1.8

## Important work

- PDF generation using JasperReports.
- Integration with OSSAPI - app/Helpers/Connection and app/Helpers/HTTAPI
	- The controllers that most use this is in app/Http/Controller/Clinte
- First time making double authentication - Web and Admin

### Required dependencies

- PHP >= 7.1.8
- Postgres > 9.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Apache Server
- MYSQL Server
- Java JDK 1.8

### Installation Instructions

```
git clone https://<user>@repository.git

cp .env.example .env

Edit database configuration, Smtp configuration and etc.

npm install

composer install

php artisan key:generate

php artisan cache:clear
```

### Database

```
php artisan migrate
php artisan db:seed

On database: CREATE EXTENSION unaccent;
```

### Easy project setup
```
php artisan setupproject

php artisan serve
```

### API Configuration

.env
```
API_HTT_URL= 
API_HTT_LOGIN=
API_HTT_PASS=
```

## Extra Info
	
```
All base sheets have to be saved in public/base-sheets.
The jasper file need permission to be executed
	./vendor/geekcom/phpjasper/bin/jasperstarter/bin/jasperstarter
```

###Task Scheduler
```
execute:
crontab -e
paste:
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

### Authors

* **Alberto de Almeida Guilherme - *Backend Developer***  
* **Marco - *Frontend Developer*** 
