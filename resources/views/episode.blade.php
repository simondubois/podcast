<div class="card ">

    <div class="card-header d-flex flex-wrap justify-content-between align-items-end">

        <div>
            {{ $episode->title }}
        </div>

        <small class="text-muted flex-wrap">
            @lang('podcast.published') {{ $episode->date->locale(env('APP_LOCALE'))->diffForHumans() }}
        </small>

    </div>

    <div class="card-body">
        <audio preload="none" controls class="w-100">
            <source src="{{ $episode->url }}" type="audio/mpeg">
        </audio>
    </div>

</div>
