<?php

Route::get('/', 'BooksController@index');
Route::post('/import', 'BooksController@import');
Route::get('/listauthors', 'BooksController@listAuthors');
Route::get('/getauthorbyid/{id}', 'BooksController@getAuthorById');
Route::get('/deleteauthors', 'BooksController@deleteAuthors');
Route::get('/deletebooks', 'BooksController@deletebooks');
Route::get('/listbooks', 'BooksController@listBooks');
Route::get('/listbooksandauthors', 'BooksController@listBooksAndAuthors');