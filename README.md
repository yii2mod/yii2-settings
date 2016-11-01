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

**Database Migrations**

Before usage this extension, we'll also need to prepare the database.

```
php yii migrate --migrationPath=@vendor/yii2mod/yii2-settings/migrations
```

**Module Setup**

To access the module, you need to configure the modules array in your application configuration:
```php
'admin' => [
    'modules' => [
        'settings' => [
            'class' => 'yii2mod\settings\Module',
        ],
    ],
]
```    
> You can then access settings page by the following URL:
http://localhost/path/to/index.php?r=admin/settings/

**Component Setup**

To use the Setting Component, you need to configure the components array in your application configuration:
```php
'components' => [
    'settings' => [
        'class' => 'yii2mod\settings\components\Settings',
    ],
]
```
    
Usage:
---------
```php
$settings = Yii::$app->settings;

$value = $settings->get('section', 'key');

$settings->set('section', 'key', 125.5);

$settings->set('section', 'key', 'false', SettingType::BOOLEAN_TYPE);

// Checking existence of setting
$settings->has('section', 'key');

// Activates a setting
$settings->activate('section', 'key');

// Deactivates a setting
$settings->deactivate('section', 'key');

// Removes a setting
$settings->remove('section', 'key');

// Removes all settings
$settings->removeAll();

$settings->invalidateCache(); // automatically called on set(), remove();  
```

Internationalization
----------------------

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




