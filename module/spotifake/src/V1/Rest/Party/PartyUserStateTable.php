<?php
	namespace spotifake\V1\Rest\Party;
	
	use spotifake\V1\Rest\Playlist\PlaylistTable;
	use spotifake\V1\Rest\PlaylistTrack\PlaylistTrackTable;
	use spotifake\V1\Rest\Track\TrackTable;
	use spotifake\V1\Rest\User\UserTable;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class PartyUserStateTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('party_user_state', $adapter);
		}
		
	}
