<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layouts.app');
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


