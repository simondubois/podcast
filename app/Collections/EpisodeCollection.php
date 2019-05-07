<?php

namespace App\Collections;

use App\Episode;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MarcW\RssWriter\Bridge\Symfony\HttpFoundation\RssStreamedResponse;
use MarcW\RssWriter\Extension\Atom\AtomLink;
use MarcW\RssWriter\Extension\Atom\AtomWriter;
use MarcW\RssWriter\Extension\Core\Channel;
use MarcW\RssWriter\Extension\Core\CoreWriter;
use MarcW\RssWriter\Extension\Core\Image;
use MarcW\RssWriter\RssWriter;

class EpisodeCollection extends Collection implements Responsable
{
    /**
     * Merge the current collection with new episodes from the specified path.
     *
     * @param string|null $path Folder to load the episodes from.
     * @return void
     */
    public function fromPath(string $root, CarbonPeriod $publicationDate)
    {
        return $this->merge(
            collect(scandir($root))
                ->reject(function (string $path) : bool {
                    return Str::startsWith($path, '.');
                })
                ->map(function (string $path) use ($root) : string {
                    return Str::finish($root, '/') . $path;
                })
                ->flatMap(function (string $path) use ($publicationDate) : EpisodeCollection {
                    if (is_null($publicationDate->current())) {
                        return EpisodeCollection::make();
                    }
                    if (is_dir($path)) {
                        return EpisodeCollection::make()->fromPath($path, $publicationDate);
                    }
                    return tap(
                        EpisodeCollection::make([new Episode($path, $publicationDate->current())]),
                        function () use ($publicationDate) {
                            $publicationDate->next();
                        }
                    );
                })
        );
    }

    /**
     * Filter the collection to only include publishing episodes.
     *
     * @return void
     */
    public function publishing()
    {
        return $this->slice(-env('PODCAST_LENGTH'));
    }

    /**
     * Get an HTTP response containing the episodes.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param  \Illuminate\Http\Request  $request Current HTTP request.
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $rssWriter = new RssWriter(null, [], true);
        $rssWriter->registerWriter(new AtomWriter());
        $rssWriter->registerWriter(new CoreWriter());

        $channel = new Channel();
        $channel->setTitle(env('PODCAST_TITLE'));
        $channel->setLink(url());
        $channel->setDescription(env('PODCAST_DESCRIPTION'));
        $channel->setWebMaster('simon@dubandubois.com (Simon Dubois)');
        $channel->setLastBuildDate(optional($this->last())->date);
        $channel->addExtension(
            with(new AtomLink())->setRel('self')->setHref(url('feed'))->setType('application/rss+xml')
        );

        if (env('PODCAST_IMAGE')) {
            $channel->setImage(
                with(new Image())
                    ->setTitle(env('PODCAST_TITLE'))
                    ->setUrl(env('PODCAST_IMAGE'))
                    ->setLink(url())
            );
        }

        $this
            ->map(function (Episode $episode) {
                return $episode->toRss();
            })
            ->each([$channel, 'addItem']);

        return new RssStreamedResponse($channel, $rssWriter);
    }
}
