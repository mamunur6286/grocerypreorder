<?php

/** configuration for pre order management package */


return [

    'name' => 'pre order management',

    'description' => 'This package help to take pre order for a grocery shop.',

    'package' => \GroceryStore\PreOrderManagement\Constant\Constant::PACKAGE_NAME,

    'url' => \GroceryStore\PreOrderManagement\Constant\Constant::PACKAGE_NAME,

    'admin_email' => env('MAIL_ADMIN_ADDRESS', 'mamunur6286@gmail.com'),

];