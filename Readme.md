[![Build Status](https://travis-ci.org/anetwork/sidenav.svg?branch=master)](https://travis-ci.org/anetwork/sidenav)
[![Latest Stable Version](https://poser.pugx.org/anetwork/sidenav/v/stable)](https://packagist.org/packages/anetwork/sidenav)
[![Total Downloads](https://poser.pugx.org/anetwork/sidenav/downloads)](https://packagist.org/packages/anetwork/sidenav)
[![Latest Unstable Version](https://poser.pugx.org/anetwork/sidenav/v/unstable)](//packagist.org/packages/anetwork/sidenav)
[![License](https://poser.pugx.org/anetwork/sidenav/license)](https://packagist.org/packages/anetwork/sidenav)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/anetwork/sidenav/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/anetwork/sidenav/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/anetwork/sidenav/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/anetwork/sidenav/?branch=master)

# Anetwork SideNav
SideNav is a PHP package which helps you generate powerful sidebar navigation.

# Features

* Sub Menu
* Grouping 
* Define dynamic menues with if statement support

# Introduction
* A php component that makes it easier to build vertical nav menus
* The sidenav package can manage your sidebar navigations items on your project
* you can install this package with composer and config your sidebar navigations items

## Requirement
* php 5.5>=
* HHVM

## Install with composer

You can install this package throw the [Composer](http://getcomposer.org) by running:

```
composer require anetwork/sidenav
```

## Register a new item
* you should use the register method of sidenav object
* the method wants 2 arguments
* the first one should be a string of your item name
* the second one must be a function literal to use Menu Object for define all of menu options

```php
SideNav::register('{item_name}',function($menu){
    $menu->link('the_item_url');
    $menu->title('the title');
    $menu->className('class-name'); // Item css class attribute
    $menu->icon('fa fa-example'); //  use on font-awesome icon
    
    // define submenu to item
    $menu->sub('{sub_item_name}',function ($menu){
        $menu->link('the_item_url');
        $menu->title('the submenu title');
        $menu->icon('fa fa-example');
        $menu->className('submenu-class-name');
    });
    
    /**
     * 
     * Register another one ...
     *
     */
    
});
```

## If statement

* For register the items with checkstatus , you must have a checkStatus object
* Create the checkstatus object , and Define it to SideNav

```php
SideNav::if(The_checkstatus_object_name::class);
SideNav::if(The_checkstatus_object_name::class);
```

## Register If statement
If you want register a item with if statement, you should use registerWithIf method of SideNav Object
* the method , accepts 2 arguments
* the first one must be a string of your item name and ** checkstatus name **
* the second one must be function literal to use Menu Object for define all of menu options

```php
SideNav::registerWithIf('{item_name}',function($menu){
    $menu->link('the_item_url');
    $menu->title('the title');
    $menu->className('class-name');
    $menu->icon('fa fa-example');    
});
```

## Group
* You can make a group menu with SideNav::group method

```php
SideNav::group('user',function(){

    // Registering Items

});
```

### Render
return array of menu

```php
$menu = SideNav::render('name_of_your_group');
    
print_r($menu);
```

### Menu options

| Method  | status | Parameter | Type of parameter | 
| ------- | ------ | --------- | -------- |
| `->icon()` | required | Define icon class | String |
| `->link()` | required | Set link of item | String |
| `->className()` | optional | The class of item | String |
| `->newTab()` | optional | newTab link target | Boolean : defalt => false |
| `->title()` | required | The title of item | String |
| `->isNew()` | optional | Define the item is new | Boolean : default => false |
| `->selected()` | optional | item selected status | Boolean : default => false |
| `->openChildOnClick()` | optional | the sub menu status | Boolean : default => true |
