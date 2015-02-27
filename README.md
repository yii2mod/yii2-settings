Simple Yii2 settings extension
=============

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2mod/yii2-settings "*"
```

or add

```json
"yii2mod/yii2-settings": "*"
```

to the require section of your composer.json.

Usage
------------
Before usage this extension, run init migration.

./yii migrate/up --migrationPath=@vendor/yii2mod/yii2-settings/migrations

To use this extension, you have to configure the modules array in your application configuration:
```php
  'admin' => [
    'modules' => [
         'settings' => [
                 'class' => 'yii2mod\settings\Module',
         ],
        ...
    ],
  ]
```    
You can then access settings page by the following URL:

http://localhost/path/to/index.php?r=admin/settings/

Usage Setting Component
------------
To use the Setting Component, you have to configure the components array in your application configuration:
```php
    'components' => [
         'settings' => [
                'class' => 'yii2mod\settings\components\Settings',
          ],
        ...
    ]
```    
Usage component:

$settings = Yii::$app->settings;

$value = $settings->get('section', 'key');

$settings->set('section', 'key', 125.5);

$settings->set('section', 'key', 'false', 'bool');

$settings->remove('section', 'key');

//Remove cache,  automatically called on set(), remove();
$settings->invalidateCache();




