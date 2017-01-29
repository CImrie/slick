# slick
Doctrine ODM Fluent Metadata Class Implementation. Inspired by laravel-doctrine/fluent.
Integrates seamlessly with cimrie/odm.
 
# Laravel Setup

Add `CImrie\Slick\SlickServiceProvider::class` to the 'providers' section of `config/app.php`.
Follow the instructions for cimrie/odm.

In `config/odm.php` set 'meta' to `CImrie\Slick\Mapping\SlickDriver::class`
For each manager in `config/odm.php` specify a `'mappings'` array like so:

```php
<?php

return [
    'managers' => [
       
        'default' => [
            // ...
            
            'meta'      => env('DOCTRINE_METADATA', \CImrie\Slick\Mapping\SlickDriver::class),
            'mappings'  => [
               MyCustomMappingClass::class 
            ]
            
            // ...
        ]
    ]
];
```

### Usage

To set up your mapping files, you should extend one of the following classes:

* Normal Documents: `CImrie\Slick\Mapping\DocumentMapping::class`,
* Embedded Documents: `CImrie\Slick\Mapping\EmbeddedMapping::class`,
* Mapped Superclass Documents: `CImrie\Slick\Mapping\MappedSuperclassMapping::class`

In each of the mapping files you will need to specify a `mapFor` and a `map(Slick $builder)` method implementaton.
`mapFor` should simply return the class name of the document you wish to map.

`map(...)` should make use of the `$builder` variable given in order to specify its mapping.
For example:

```php
<?php

use \Tests\Model\Documents\User;
use CImrie\Slick\Slick;

class CustomMapping extends \CImrie\Slick\Mapping\DocumentMapping
{
    public static function mapFor(){
        return User::class;
    }
    
    public function map(Slick $builder)
    {
        $builder->id();
        $builder->string('name');
        $builder->string('email')->unique();
        // alternatively add the unique constraint manually
        //... $builder->index()->key('email')->unique();
        
        $builder->date('joinedAt');
    }
}
```