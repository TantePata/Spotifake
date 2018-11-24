<?php
return [
    'service_manager' => [
        'factories' => [
            \spotifake\V1\Rest\User\UserResource::class => \spotifake\V1\Rest\User\UserResourceFactory::class,
            \spotifake\V1\Rest\Playlist\PlaylistResource::class => \spotifake\V1\Rest\Playlist\PlaylistResourceFactory::class,
            \spotifake\V1\Rest\Party\PartyResource::class => \spotifake\V1\Rest\Party\PartyResourceFactory::class,
            \spotifake\V1\Rest\Friend\FriendResource::class => \spotifake\V1\Rest\Friend\FriendResourceFactory::class,
            \spotifake\V1\Rest\FriendRequest\FriendRequestResource::class => \spotifake\V1\Rest\FriendRequest\FriendRequestResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'spotifake.rest.user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user[/:user_id]',
                    'defaults' => [
                        'controller' => 'spotifake\\V1\\Rest\\User\\Controller',
                    ],
                ],
            ],
            'spotifake.rest.playlist' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/playlist[/:playlist_id]',
                    'defaults' => [
                        'controller' => 'spotifake\\V1\\Rest\\Playlist\\Controller',
                    ],
                ],
            ],
            'spotifake.rest.party' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/party[/:party_id]',
                    'defaults' => [
                        'controller' => 'spotifake\\V1\\Rest\\Party\\Controller',
                    ],
                ],
            ],
            'spotifake.rest.friend' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/friend[/:friend_id]',
                    'defaults' => [
                        'controller' => 'spotifake\\V1\\Rest\\Friend\\Controller',
                    ],
                ],
            ],
            'spotifake.rest.friend-request' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/friend/request[/:friend_request_id]',
                    'defaults' => [
                        'controller' => 'spotifake\\V1\\Rest\\FriendRequest\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'spotifake.rest.user',
            1 => 'spotifake.rest.playlist',
            2 => 'spotifake.rest.party',
            3 => 'spotifake.rest.friend',
            4 => 'spotifake.rest.friend-request',
        ],
    ],
    'zf-rest' => [
        'spotifake\\V1\\Rest\\User\\Controller' => [
            'listener' => \spotifake\V1\Rest\User\UserResource::class,
            'route_name' => 'spotifake.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'name',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spotifake\V1\Rest\User\UserEntity::class,
            'collection_class' => \spotifake\V1\Rest\User\UserCollection::class,
            'service_name' => 'User',
        ],
        'spotifake\\V1\\Rest\\Playlist\\Controller' => [
            'listener' => \spotifake\V1\Rest\Playlist\PlaylistResource::class,
            'route_name' => 'spotifake.rest.playlist',
            'route_identifier_name' => 'playlist_id',
            'collection_name' => 'playlist',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spotifake\V1\Rest\Playlist\PlaylistEntity::class,
            'collection_class' => \spotifake\V1\Rest\Playlist\PlaylistCollection::class,
            'service_name' => 'Playlist',
        ],
        'spotifake\\V1\\Rest\\Party\\Controller' => [
            'listener' => \spotifake\V1\Rest\Party\PartyResource::class,
            'route_name' => 'spotifake.rest.party',
            'route_identifier_name' => 'party_id',
            'collection_name' => 'party',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'owner',
                1 => 'difficulty',
                2 => 'nbTracks',
                3 => 'userList',
                4 => 'playlistList',
                5 => 'id_user',
                6 => 'score',
                7 => 'finished',
                8 => 'current_track_number',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spotifake\V1\Rest\Party\PartyEntity::class,
            'collection_class' => \spotifake\V1\Rest\Party\PartyCollection::class,
            'service_name' => 'Party',
        ],
        'spotifake\\V1\\Rest\\Friend\\Controller' => [
            'listener' => \spotifake\V1\Rest\Friend\FriendResource::class,
            'route_name' => 'spotifake.rest.friend',
            'route_identifier_name' => 'friend_id',
            'collection_name' => 'friend',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'user1',
                1 => 'user2',
                2 => 'username',
                3 => 'avatarUrl',
                4 => 'myId',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spotifake\V1\Rest\Friend\FriendEntity::class,
            'collection_class' => \spotifake\V1\Rest\Friend\FriendCollection::class,
            'service_name' => 'Friend',
        ],
        'spotifake\\V1\\Rest\\FriendRequest\\Controller' => [
            'listener' => \spotifake\V1\Rest\FriendRequest\FriendRequestResource::class,
            'route_name' => 'spotifake.rest.friend-request',
            'route_identifier_name' => 'friend_request_id',
            'collection_name' => 'friend_request',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'myId',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spotifake\V1\Rest\FriendRequest\FriendRequestEntity::class,
            'collection_class' => \spotifake\V1\Rest\FriendRequest\FriendRequestCollection::class,
            'service_name' => 'FriendRequest',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'spotifake\\V1\\Rest\\User\\Controller' => 'Json',
            'spotifake\\V1\\Rest\\Playlist\\Controller' => 'Json',
            'spotifake\\V1\\Rest\\Party\\Controller' => 'Json',
            'spotifake\\V1\\Rest\\Friend\\Controller' => 'Json',
            'spotifake\\V1\\Rest\\FriendRequest\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'spotifake\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\Playlist\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\Party\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\Friend\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\FriendRequest\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'spotifake\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\Playlist\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\Party\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\Friend\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/json',
            ],
            'spotifake\\V1\\Rest\\FriendRequest\\Controller' => [
                0 => 'application/vnd.spotifake.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \spotifake\V1\Rest\User\UserEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.user',
                'route_identifier_name' => 'user_id',
            ],
            \spotifake\V1\Rest\User\UserCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ],
            \spotifake\V1\Rest\Playlist\PlaylistEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.playlist',
                'route_identifier_name' => 'playlist_id',
            ],
            \spotifake\V1\Rest\Playlist\PlaylistCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.playlist',
                'route_identifier_name' => 'playlist_id',
                'is_collection' => true,
            ],
            \spotifake\V1\Rest\Party\PartyEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.party',
                'route_identifier_name' => 'party_id',
            ],
            \spotifake\V1\Rest\Party\PartyCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.party',
                'route_identifier_name' => 'party_id',
                'is_collection' => true,
            ],
            \spotifake\V1\Rest\Friend\FriendEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.friend',
                'route_identifier_name' => 'friend_id',
            ],
            \spotifake\V1\Rest\Friend\FriendCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.friend',
                'route_identifier_name' => 'friend_id',
                'is_collection' => true,
            ],
            \spotifake\V1\Rest\FriendRequest\FriendRequestEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.friend-request',
                'route_identifier_name' => 'friend_request_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \spotifake\V1\Rest\FriendRequest\FriendRequestCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spotifake.rest.friend-request',
                'route_identifier_name' => 'friend_request_id',
                'is_collection' => true,
            ],
        ],
    ],
];
