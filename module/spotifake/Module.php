<?php
namespace spotifake;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
    
	public function getServiceConfig()
	{
		return [
				'factories' => [
						'V1\Rest\User\UserTable' => function ($sm) {
							$adapter = $sm->get('spotifake');
							return new V1\Rest\User\UserTable($adapter);
						},
						'V1\Rest\Playlist\PlaylistTable' => function ($sm) {
							$adapter = $sm->get('spotifake');
							return new V1\Rest\Playlist\PlaylistTable($adapter);
						},
						'V1\Rest\Friend\FriendTable' => function ($sm) {
							$adapter = $sm->get('spotifake');
							return new V1\Rest\Friend\FriendTable($adapter);
						},
						'V1\Rest\FriendRequest\FriendRequestTable' => function ($sm) {
							$adapter = $sm->get('spotifake');
							return new V1\Rest\FriendRequest\FriendRequestTable($adapter);
						},
						'V1\Rest\Party\PartyTable' => function ($sm) {
							$adapter = $sm->get('spotifake');
							return new V1\Rest\Party\PartyTable($adapter);
						}
				]
		];
	}
}
