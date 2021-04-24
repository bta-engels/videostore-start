<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class RoutesController extends Controller
{
    public function index()
    {
        return view('routes', ['routes' => Route::getRoutes()]);
    }
}
