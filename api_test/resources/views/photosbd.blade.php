<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API test</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container my-5">
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                @foreach($photos as $photo)
                <div class="col">
                    <div class="card">
                    <img src="{{$photo['url']}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{$photo['title']}}</p>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $photos->links() !!}
            </div>
        </div>
    </body>
</html>