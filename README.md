# Region of China for Laravel
The package to create regions of china for Laravel or Lumen.
适用于Laravel，用于生成中国省市区数据拓展包。

## Install
### Install via compser

Run the following command to pull in the lastest version:

`composer require xiaofengit/region-of-china-laravel`


### Add service provider (Laravel 5.4 or below):

Add the service provider to the providers array in the config/app.php config file as follows:

```
    'providers' => [

        ...

        Xiaofengit\RegionOfChina\Providers\LaravelServiceProvider::class,
    ]
```

if you using Laravel 5.5 or higher, the provider will auto load.

### Publish the files

Run the following command to publish the package config file:

`php artisan vendor:publish --provider="Xiaofengit\RegionOfChina\Providers\LaravelServiceProvider"`

### Create the table if you needs
Run the following command to create regions table:

`php artisan migreate`

### Seed data
Run the following command to seed data:

`php artisan db:seed --class="Database\Seeders\RegionSeeder"`


## License
It's open-sourced software licensed under the MIT license.
