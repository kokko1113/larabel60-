<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SetmenuController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("admin")->group(function () {//認証してない状態で通る
    Route::get("/login", [LoginController::class, "login"])->name("login");
    Route::post("/check", [LoginController::class, "check"])->name("check");
});

Route::prefix("admin")->middleware("auth")->group(function () {//認証した状態なら通れる
    Route::get("/logout", [LoginController::class, "logout"])->name("logout");
    Route::get("/dash", [LoginController::class, "dash"])->name("dash");

    Route::get("/item", [ItemController::class, "index"])->name("item_index");
    Route::get("/item/create", [ItemController::class, "create"])->name("item_create");
    Route::post("/item/store", [ItemController::class, "store"])->name("item_store");
    Route::get("/item/{id}", [ItemController::class, "edit"])->name("item_edit");
    Route::patch("/item/{id}", [ItemController::class, "update"])->name("item_update");
    Route::delete("/item/{id}", [ItemController::class, "destroy"])->name("item_destroy");

    Route::get("/setmenu", [SetmenuController::class, "index"])->name("setmenu_index");
    Route::get("/setmenu/create", [SetmenuController::class, "create"])->name("setmenu_create");
    Route::post("/setmenu/store", [SetmenuController::class, "store"])->name("setmenu_store");
    Route::get("/setmenu/{id}", [SetmenuController::class, "edit"])->name("setmenu_edit");
    Route::patch("/setmenu/{id}", [SetmenuController::class, "update"])->name("setmenu_update");
    Route::delete("/setmenu/{id}", [SetmenuController::class, "destroy"])->name("setmenu_destroy");
});
