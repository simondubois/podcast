<div class="jumbotron mb-0">
    <div class="container d-md-flex align-items-center text-center text-md-left">

        @if (env('PODCAST_IMAGE'))
            <div class="flex-shrink-0 mr-md-4 mb-4 mb-md-0">
                <img src="{{ env('PODCAST_IMAGE') }}" class="img-fluid">
            </div>
        @endif

        <div>

            <h1>
                {{ env('PODCAST_TITLE') }}
            </h1>

            <p class="lead">
                {{ env('PODCAST_DESCRIPTION') }}
            </p>

        </div>

    </div>
</div>
