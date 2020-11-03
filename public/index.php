<?php

// Include router class
include('../routes/Route.php');



##.......WEB Routes.........
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



##.......API Routes.........
Route::add('/customer/address/edit',function(){

},'get');

Route::add('/customer/address/edit',function(){

},'post');


Route::run('/');