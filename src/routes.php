<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    ''               => ['HomeController', 'index',],
    'instructions'   => ['HomeController', 'instructions'],
    'accessory/add'  => ['AccessoryController', 'add'],
    'accessory/list' => ['AccessoryController', 'list'],
    'cupcake/add'    => ['CupcakeController', 'add'],
    'cupcake/list'    => ['CupcakeController', 'list'],
    'logistics'    => ['LogisticController', 'index'],
    'cupcake/show'    => ['CupcakeController', 'show', ['id']],
    //TODO add a cupcake/show route with a query param id
];
