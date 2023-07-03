<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//company registration page view
Route::get('/', function () {
    return view('welcome');
});

//congrats page view 
Route::get("/congrats",function(){
    return view("congrats");
});

//not found page view
Route::get("/404",function(){
    return view("notfound");
});

//user email route match this query string url that was send during company registration
Route::get("/{query}/{string}",function($query,$string){
    if($query =="erp")
    {
        $query = array(
            "query"=>$query,
            "string"=>$string
        );
       $query =  json_encode($query);
      $query =  base64_encode($query);
        return redirect("/api/company/".$query);
    }
});

/* Start admin panel routing */
Route::get("/admin",function(){
    return view('adminpanelView.teamDesign');
});

Route::get("/teamdesign",function(){
    return view('adminpanelView.teamDesign');
});


Route::get("/addemployee",function(){
    return view('adminpanelView.addEmployee');
});

