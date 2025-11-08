<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class APIController extends Controller
{
    function getPhotosFromAPI() {
        $photos = HTTP::get('https://jsonplaceholder.typicode.com/albums/1/photos');
        $photosArray = $photos->json();

        return view('main', compact('photosArray'));
    }

    function saveDataFromAPI()
    {
        $photos = Http::get('https://jsonplaceholder.typicode.com/photos');
        $photosArray = $photos->json();

        foreach ($photosArray as $elem) {
            // Generar la URL de la imatge
            $url = "https://picsum.photos/id/{$elem['id']}/600/400";

            // Descarregar la imatge
            $imageContents = Http::get($url)->body();

            // Generar un nom d'arxiu únic
            $fileName = $elem['id'] . ".jpg";

            // Desa l’arxiu a la carpeta "public/photos"
            Storage::disk('public')->put("photos/{$fileName}", $imageContents);

            // Desa a la BD (pots posar el camp title com l’autor)
            Photo::create([
                'title' => $elem['title'],
                'url' => "storage/photos/{$fileName}"
            ]);
        }

        return "Dades carregades a la BD.";
    }

    function getPhotosFromBD() {
        $photos = Photo::paginate(12);
        return view("photosbd", compact("photos"));
    }
}