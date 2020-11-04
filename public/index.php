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



##.......API Routes.........
Route::add('/customer/address/edit',function(){

},'get');

Route::add('/api/customer',function(){
    require '../api/CreateCustomer.php';
    new CreateCustomer();
},'post');



Route::run('/');

