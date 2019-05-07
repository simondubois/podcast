<?php

namespace App;

use Carbon\Carbon;
use Exception;
use MarcW\RssWriter\Extension\Core\Enclosure;
use MarcW\RssWriter\Extension\Core\Guid;
use MarcW\RssWriter\Extension\Core\Item;

class Episode
{
    /**
     * Create a new Episode instancce from file.
     *
     * @param Carbon $date Date the item was published at.
     * @param string     $path Path relative to the disk root.
     */
    public function __construct(string $path, Carbon $date)
    {
        try {
            $this->title = Carbon::parseFromLocale(pathinfo($path, PATHINFO_FILENAME), env('APP_LOCALE'))
                ->locale(env('APP_LOCALE'))
                ->isoFormat('LL');
        } catch (Exception $exception) {
            $this->title = pathinfo($path, PATHINFO_FILENAME);
        }

        $this->date = $date;
        $this->folder = trim(str_replace(env('PODCAST_ROOT'), '', pathinfo($path, PATHINFO_DIRNAME)), '/');
        $this->id = base64_encode(str_replace(env('PODCAST_ROOT'), '', $path))
            . '.' . pathinfo($path, PATHINFO_EXTENSION);
        $this->path = $path;
        $this->url = url('download/' . $this->id);
    }

    /**
     * Get the RSS representation of the episode.
     *
     * @return MarcW\RssWriter\Extension\Core\Item
     */
    public function toRss() : Item
    {
        return with(new Item())
            ->setTitle($this->title)
            ->setLink($this->url)
            ->setEnclosure(
                with(new Enclosure())->setLength(filesize($this->path))->setUrl($this->url)->setType('audio/mp3')
            )
            ->setPubDate($this->date)
            ->setGuid((new Guid())->setGuid($this->url));
    }
}
