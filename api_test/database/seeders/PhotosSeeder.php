<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {          
        $photos = Http::get('https://jsonplaceholder.typicode.com/photos');
        $photosArray = $photos->json();

        foreach ($photosArray as $elem) {
            // Generar la URL de la imatge
            $url = "https://picsum.photos/id/{$elem['id']}/600/400";

            // Descarregar la imatge
            // ->body(); métode de Gazzle per a obtenir el contingut de la url
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
            
            // Perquè no se'ns acumulin les peticions
            // Segons que deixa entre peticio i peticio al servidor, es pot allargar o escurçar depenent del que vulguem
            sleep(2);
        }
    }
}
