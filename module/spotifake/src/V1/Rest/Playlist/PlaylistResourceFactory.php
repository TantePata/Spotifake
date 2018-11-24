<?php
namespace spotifake\V1\Rest\Playlist;

class PlaylistResourceFactory
{
    public function __invoke($services)
    {
        return new PlaylistResource($services->get('V1\Rest\Playlist\PlaylistTable'));
    }
}
