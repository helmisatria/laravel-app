<?php

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
  // concurrent fetch get request to jsonplaceholder using Illuminate\Http\Client\Pool and Illuminate\Http\Client\Http

  $responses = Http::pool(fn (Pool $pool) => [
    $pool->as('posts')->get('https://jsonplaceholder.typicode.com/posts'),
    $pool->as('comments')->get('https://jsonplaceholder.typicode.com/comments'),
    $pool->as('albums')->get('https://jsonplaceholder.typicode.com/albums'),
    $pool->as('photos')->get('https://jsonplaceholder.typicode.com/photos'),
    $pool->as('todos')->get('https://jsonplaceholder.typicode.com/todos'),
    $pool->as('users')->get('https://jsonplaceholder.typicode.com/users'),
  ]);

  // return response posts json
  return $responses['posts']->json();
});
