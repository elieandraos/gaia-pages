# gaia-pages packages
Pages admin module for the Gaia CMS project. 
The package will publish the following:
* views
* model repositories (PSR4 autoloaded and binded)
* migrations and seeds (in database folder)
* models

The controller, (validation) request and the routes will be autoloaded from the package itself.

#### Installation
Run the following command in your terminal 
```
composer require eandraos/gaia-pages
```

Then register this service provider with Laravel in config/app.php
```
Gaia\Pages\GaiaPagesServiceProvider
```

Publish the different files
```
php artisan vendor:publish
```

#### Usage
Add PSR-4 autoload in the composer.json 
```
"Gaia\\": "app/Gaia"
```

Dump the class autoload in the terminal 
```
composer dump-autoload -o
```

Create the tables and seeds
```
php artisan migrate
php artisan db:seed --class=ComponentTypeTableSeeder
php artisan db:seed --class=TemplateTableSeeder
