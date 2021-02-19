<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Relation;
use App\Post;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth'])->name('welcome');

Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('auth_user', function () {
        try {
            $user = Auth::user();
        } catch (PDOException $e) {
            $error = ['error' => ['message' => "Unauthorized. You must be authentified"]];
            return response()->json($error, 401);
        }
        return response()->json($user);
    });

    Route::get('/admin/relations', function () {
        try {
            $relation = Relation::where('from',Auth::user()->id)->where('status','F')->get();
            
            foreach($relation as $rel){
                $rel->name = User::find($rel->to)->name;
            }


        } catch (PDOException $e) {
            $error = ['error' => ['message' => "Unauthorized, you must be identhified"]];
            return response()->json($error, 401);
        }
    
        return response()->json($relation);
    });

    
});

Auth::routes();


Route::get('{path}', function ($path) {

    if ($path == 'logout') {
        Auth::logout();
        return redirect()->route('login');
    }
    return view('welcome');
})->where('path', '([A-z\d-/_.]+)?')->middleware(['auth']);
