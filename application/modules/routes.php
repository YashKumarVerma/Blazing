<?php 

// Routes are defined here

Route::set('','home@cover');
Route::set('blazer','home@blazer');
Route::set('mail','home@workspaceMail');
Route::set('post','home@form');
Route::post('post','home@post');