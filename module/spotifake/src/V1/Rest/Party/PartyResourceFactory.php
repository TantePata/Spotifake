<?php
namespace spotifake\V1\Rest\Party;

class PartyResourceFactory
{
    public function __invoke($services)
    {
        return new PartyResource($services->get('V1\Rest\Party\PartyTable'));
    }
}
