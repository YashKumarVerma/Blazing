<?php 

Route::set('users','home@homepage');
Route::post('users','home@post_controller','name');
Route::set('database','home@database');