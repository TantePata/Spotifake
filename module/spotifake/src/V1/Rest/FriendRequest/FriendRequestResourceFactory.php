<?php
namespace spotifake\V1\Rest\FriendRequest;

class FriendRequestResourceFactory
{
    public function __invoke($services)
    {
        return new FriendRequestResource($services->get('V1\Rest\FriendRequest\FriendRequestTable'));
    }
}
