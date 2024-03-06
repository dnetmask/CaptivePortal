### 1. Add package to composer.json:  
```
"require": {  
    "netmask/cautiveportal": "dev-master"  
},  
"repositories":[  
    {
        "type": "vcs",
        "url": "https://github.com/dnetmask/CaptivePortalPackage.git"
    }  
]
```
### 2. Run composer update
```bash
composer update
```
### 3. Install package: 
```bash
php artisan cautiveportal:install
```  
You can use --replace to replace publishable files.  
### 4. Add the default widgets to config/voyager.php:  
```
'dashboard' => [  
    'widgets' => [  
        'App\\Widgets\\ConnectionsDimmer',  
        'App\\Widgets\\WifiUsersDimmer',  
    ],  
]
```  
### 5. Add seeder to database/seeds/AfterVoyagerInstallSeeder.php after AppSettingsTableSeeder:  
>$this->seed('\Netmask\CautivePortal\Database\Seeds\DatabaseSeeder');
### 6. Remove default index route in routes/web.php  
### 7. Add jquery-validate to webpack.mix.js:  
```
mix.js([
    'resources/js/app.js',
    'resources/js/jquery-validate/jquery.validate.min.js',
    'resources/js/jquery-validate/additional-methods.min.js',
], 'public/js')
.copy('resources/images', 'public/images')
```  
### 8. Run webpack:  
```bash
npm run dev
```