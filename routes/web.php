<?php

use App\Collections\EpisodeCollection;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function (EpisodeCollection $episodes) {
    return view('layout', ['episodes' => $episodes]);
});

$router->get('feed', function (EpisodeCollection $episodes) {
    return $episodes->publishing()->reverse();
});

$router->get('/download/{id}', function (EpisodeCollection $episodes, string $id) {
    return response()->download(
        optional($episodes->firstWhere('id', $id))->path ?: abort(404)
    );
});
