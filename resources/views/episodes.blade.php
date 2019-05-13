<div class="container my-5">

    @if ($episodes->isNotEmpty())

        <div class="tab-content" id="episode-tab">

            <div class="tab-pane fade show active" id="episode-publishing" role="tabpanel" aria-labelledby="episode-publishing-tab">
                <div class="card-columns">
                    @each('episode', $episodes->publishing()->reverse(), 'episode')
                </div>
            </div>

            @foreach ($episodes->pluck('folder')->unique() as $folder)
                <div class="tab-pane fade" id="episode-folder-{{ Illuminate\Support\Str::slug($folder) }}" role="tabpanel" aria-labelledby="episode-folder-{{ Illuminate\Support\Str::slug($folder) }}-tab">
                    <div class="card-columns">
                        @each('episode', $episodes->where('folder', $folder), 'episode')
                    </div>
                </div>
            @endforeach

        </div>

    @else

        <div class="alert alert-warning" role="alert">
            @lang('podcast.empty')
        </div>

    @endif

</div>
