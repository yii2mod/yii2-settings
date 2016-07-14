Yii2 Settings
=============
Simple Yii2 settings extension

[![Latest Stable Version](https://poser.pugx.org/yii2mod/yii2-settings/v/stable)](https://packagist.org/packages/yii2mod/yii2-settings) [![Total Downloads](https://poser.pugx.org/yii2mod/yii2-settings/downloads)](https://packagist.org/packages/yii2mod/yii2-settings) [![License](https://poser.pugx.org/yii2mod/yii2-settings/license)](https://packagist.org/packages/yii2mod/yii2-settings)
[![Build Status](https://travis-ci.org/yii2mod/yii2-settings.svg?branch=master)](https://travis-ci.org/yii2mod/yii2-settings)

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

Configuration
-------------
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

To use the Setting Component, you have to configure the components array in your application configuration:
```php
    'components' => [
         'settings' => [
                'class' => 'yii2mod\settings\components\Settings',
          ],
        ...
    ]
```    
## Internationalization

All text and messages introduced in this extension are translatable under category 'yii2mod.settings'.
You may use translations provided within this extension, using following application configuration:

```php
return [
    'components' => [
        'i18n' => [
            'translations' => [
                'yii2mod.settings' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/settings/messages',
                ],
                // ...
            ],
        ],
        // ...
    ],
    // ...
];
```

Usage:
--------------
```php
$settings = Yii::$app->settings;

$value = $settings->get('section', 'key');

$settings->set('section', 'key', 125.5);

$settings->set('section', 'key', 'false', SettingType::BOOLEAN_TYPE);

$settings->remove('section', 'key');

$settings->invalidateCache(); // automatically called on set(), remove();  
```




