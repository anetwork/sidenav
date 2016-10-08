# Anetwork SideNav
Sidebar navigation managment

### [Register a new item](#register-a-new-item) | [Define a check status object](#define-a-check-status-object) | [Register a new item with check status](#register-a-new-item-with-check-status) | [Make the SideNav group items](#sidenav-group) 
### [Menu options](#menu-options) | [Render menu](#get-the-return-array-of-menu) | [License](#license)

## Install with composer
* You can install this package with composer
* if you don't have composer on your system , get started with http://getcomposer.org
```
composer require anetwork/sidenav
```

## Register a new item
* Define your all of items

```php
SideNav::register('{item_name}',function($menu){
    
    // configure the item options
    // define the link url
    $menu->link('the_item_url');
    
    // define the title item
    $menu->title('the title');
    
    // define class-attribute
    $menu->className('class-name');
    
    // define icon | use on font-awesome icon
    $menu->icon('fa fa-example');
    
    // define submenu to item
    $menu->sub('{sub_item_name}',function ($menu){
    
        // configure the submenu item options
        $menu->link('the_item_url');
        $menu->title('the submenu title');
        $menu->icon('fa fa-example');
        $menu->className('submenu-class-name');
        
    });
    
    // also you can add multiple submenu for each item
    // and configure it with menu object
    // $menu->sub...
    
});
```

## Define a check status object

* For register the items with checkstatus , you must have a checkStatus object
* Create the checkstatus object , and Define it to SideNav

```php
SideNav::checkStatusObject(The_checkstatus_object_name::class);
```

## Define checkstatus statement
* define the handle method on your checkstatus object
* and make the switch statement for checking status of routes

```php
public function handle($route){

    switch($route){
        case '{item_name}':
        
            if($_SESSION['user_id'] === 2)
                return true;
        
            return false;
        
            break;
    }

}
```


## Register a new item with check status

```php
SideNav::registerWithCheckStatus('{item_name}',function($menu){
  
    // configure the item options
    $menu->link('the_item_url');
    $menu->title('the title');
    $menu->className('class-name');
    $menu->icon('fa fa-example');
    
    // also you can register new submenu with check status
    $menu->subWithCheckStatus('{route_name}',function($menu){
    
      // configure the item options
      // $menu->link ...
      
    });
    
});
```

## SideNav Group
* You can make a group menu with SideNav::group method

```php
SideNav::group('user',function(){

    // Register you items

});
```


### Menu options

| Method  | Parameter | Type of parameter | 
| ------- | --------- | -------- |
| `->icon()` *required | Define icon class | String |
| `->link()` *required | Set link of item | String |
| `->className()` optional | The class of item | String |
| `->newTab()` optional | newTab link target | Boolean : defalt => false |
| `->title()` *required | The title of item | String |
| `->is_new()` optional | Define the item is new | Boolean : default => false |
| `->selected()` optional | item selected status | Boolean : default => false |
| `->openChildOnClick()` optional | the sub menu status | Boolean : default => true |


### Get the return array of menu

```php
$menu = SideNav::render('name_of_your_group');
    
print_r($menu);
```

## License
MIT Licensed, http://www.opensource.org/licenses/MIT
