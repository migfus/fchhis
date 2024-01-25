<?php

use Illuminate\Support\Facades\Route;

Route::get('{any}', fn () => view('vue-app'))->where('any', '.*');
