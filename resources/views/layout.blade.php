<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{ env('PODCAST_TITLE') }}</title>
        <meta name="description" content="{{ env('PODCAST_DESCRIPTION') }}">

        @if (env('PODCAST_IMAGE'))
            <link rel="icon" href="{{ env('PODCAST_IMAGE') }}" />
        @endif

        <link rel="alternate" type="application/rss+xml" title="{{ env('PODCAST_TITLE') }}" href="{{ url('feed') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/{{ env('PODCAST_THEME') }}/bootstrap.min.css" crossorigin="anonymous">

    </head>

    <body>

        @include('header')

        @include('navbar')

        @include('episodes')

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>

</html>