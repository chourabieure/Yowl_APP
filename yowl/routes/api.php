<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Post;
use App\Relation;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/posts', function () {
    try {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        foreach($posts as $post){
            $post->owner_name = User::find($post->id_owner)->name;
        }
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

    return response()->json($posts);
});



//ROUTES DE VERIF POUR LE FORMULAIRE--
Route::get('/admin/email/{email}', function ($email) {
    try {
        $user = User::where('email', $email)->get();
        if($user->isEmpty()){

            return response()->json(true,201);
        }else{
            return response()->json(false,201);
        }
    
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

});
Route::get('/admin/name/{name}', function ($name) {
    try {
        $user = User::where('name', $name)->get();
        if($user->isEmpty()){
            return response()->json(true,201);
        }else{
            return response()->json(false,201);
        }
    
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

});
//------------------------------------

//ROUTES CRUD USER--------------------
Route::get('/admin/users', function () {
    try {
        $users = User::orderBy('id', 'ASC')->get();
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

    return response()->json($users);
});
Route::get('/admin/user/{id}', function ($id) {
    try {
        $user = User::find($id);

        if(!$user){
            $error = ['error' => ['message' => "User not found"]];
            return response()->json($error, 401);
        }else{
            return response()->json($user);
        }
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

});
Route::post('/admin/user/add', function (Request $request) {

    try{
        User::create($request->user_info);


    }catch(PDOException $e){
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }
    return response()->json('ok',201);
});
Route::post('/admin/user/edit', function (Request $request) {

    try{
        $user = User::find($request->id);
        $user->update($request->user_info);

    }catch(PDOException $e){
        $error = ['error' => ['message' => "Something went wrong :"+$e]];
        return response()->json($error, 401);
    }
    return response()->json('ok',201);
});
Route::post('/admin/user/delete', function (Request $request) {

    try{
        $user = User::find($request->user_id);
        $user->delete();

    }catch(PDOException $e){
        $error = ['error' => ['message' => "Something went wrong :"+$e]];
        return response()->json($error, 401);
    }
    return response()->json('ok',201);
});
//------------------------------------

//ROUTES CRUD USER--------------------
Route::get('/admin/posts', function () {
    try {
        $posts = Post::orderBy('id', 'ASC')->get();
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

    return response()->json($posts);
});
Route::get('/admin/post/{id}', function ($id) {
    try {
        $post = Post::find($id);

        if(!$post){
            $error = ['error' => ['message' => "Post not found"]];
            return response()->json($error, 401);
        }else{
            return response()->json($post);
        }
    } catch (PDOException $e) {
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }

});
Route::post('/admin/post/add', function (Request $request) {

    try{
        User::create($request->user_info);


    }catch(PDOException $e){
        $error = ['error' => ['message' => "Something went wrong"]];
        return response()->json($error, 401);
    }
    return response()->json('ok',201);
});
Route::post('/admin/post/edit', function (Request $request) {

    try{
        $post = Post::find($request->id);
        $post->update($request->post_info);

    }catch(PDOException $e){
        $error = ['error' => ['message' => "Something went wrong :"+$e]];
        return response()->json($error, 401);
    }
    return response()->json('ok',201);
});
Route::post('/admin/post/delete', function (Request $request) {

    try{
        $post = Post::find($request->post_id);
        $post->delete();

    }catch(PDOException $e){
        $error = ['error' => ['message' => "Something went wrong :"+$e]];
        return response()->json($error, 401);
    }
    return response()->json('ok',201);
});
//------------------------------------


