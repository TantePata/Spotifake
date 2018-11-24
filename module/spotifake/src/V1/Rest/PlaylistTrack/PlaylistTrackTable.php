<?php
	namespace spotifake\V1\Rest\PlaylistTrack;
	
	use spotifake\V1\Rest\User\UserEntity;
	use spotifake\V1\Rest\User\UserTable;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class PlaylistTrackTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('playlist_track', $adapter);
		}
		
	}
