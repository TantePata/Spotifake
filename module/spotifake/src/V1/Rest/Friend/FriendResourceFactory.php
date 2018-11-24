<?php
namespace spotifake\V1\Rest\Friend;

class FriendResourceFactory
{
    public function __invoke($services)
    {
        return new FriendResource($services->get('V1\Rest\Friend\FriendTable'));
    }
}
