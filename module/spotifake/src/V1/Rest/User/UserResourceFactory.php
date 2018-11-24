<?php
namespace spotifake\V1\Rest\User;

class UserResourceFactory
{
    public function __invoke($services)
    {
        return new UserResource($services->get('V1\Rest\User\UserTable'));
    }
}
