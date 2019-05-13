<nav class="navbar navbar-expand">

    <div class="container" role="tablist">

        <ul class="nav navbar-nav">
            @if ($episodes->isNotEmpty())

                <li class="nav-item">
                    <a class="nav-link active" id="episode-publishing-tab" data-toggle="tab" href="#episode-publishing" role="tab" aria-controls="episode-publishing" aria-selected="true">
                        @lang('podcast.publishing')
                    </a>
                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbar-content-folders" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('podcast.folders')
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbar-content-folders">
                        @foreach ($episodes->pluck('folder')->reverse()->unique() as $folder)
                            <a class="dropdown-item" aria-labelledby="episode-folder-{{ Illuminate\Support\Str::slug($folder) }}-tab" data-toggle="tab" href="#episode-folder-{{ Illuminate\Support\Str::slug($folder) }}" role="tab" aria-controls="episode-folder-{{ Illuminate\Support\Str::slug($folder) }}" aria-selected="false">
                                {{ $folder }}
                            </a>
                        @endforeach
                    </div>

                </li>

            @endif
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="btn btn-primary btn-sm" href="{{ url('feed') }}">
                    @lang('podcast.feed')
                </a>
            </li>
        </ul>

    </div>

</nav>
