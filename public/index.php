<?php

// Include router class
include('../routes/Route.php');

##.......WEB Routes.........
Route::add('/',function(){
    require '../views/edit.html';
});

Route::add('/customer/login',function(){
    require '../views/login.html';
});

Route::add('/customer/registration',function(){
    require '../views/registration.html';
});

Route::add('/customer/edit',function(){
    require '../views/edit.html';
});

Route::add('/customer/address/create',function(){
    require '../views/create-address.html';
});

Route::add('/customer/address/edit',function(){
    require '../views/edit-address.html';
});

Route::add('/registration',function(){
    require '../php/CreateRegistration.php';
    new CreateRegistration($_POST);
},'post');

Route::add('/create-address',function(){
    require '../php/CreateCustomerAddress.php';
    new CreateCustomerAddress($_POST);
},'post');




##.......API Routes.........
Route::add('/api/customer',function(){
    require '../api/CreateCustomer.php';
    new CreateCustomer();
},'post');

Route::add('/api/customer',function(){
    require '../api/CustomerEdit.php';
    new CustomerEdit();
},'get');

Route::add('/api/customer',function(){
    require '../api/CustomerUpdate.php';
    new CustomerUpdate();
},'put');

Route::add('/api/customer/address',function(){
    require '../api/CustomerAddressCreation.php';
    new CustomerAddressCreation();
},'post');

Route::add('/api/customer/address',function(){
    require '../api/CustomerAddressEdit.php';
    new CustomerAddressEdit();
},'get');

Route::add('/api/customer/address',function(){
    require '../api/CustomerAddressUpdate.php';
    new CustomerAddressUpdate();
},'put');

Route::add('/api/customer/address',function(){
    require '../api/CustomerAddressDelete.php';
    new CustomerAddressDelete();
},'delete');

Route::run('/');

