<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PlayerController;

Route::get('/', function () {
    return view('welcome');
});

