<?php
	namespace spotifake\V1\Rest\Friend;
	
	use spotifake\V1\Rest\PlaylistTrack\PlaylistTrackTable;
	use spotifake\V1\Rest\Track\TrackTable;
	use spotifake\V1\Rest\User\UserTable;
	use Zend\Db\Sql\Predicate\PredicateSet;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class FriendTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('friend', $adapter);
		}
		
		public function createFriendRequest($data) {
			$this->insert(array(
					'user_1' => $data->user1,
					'user_2' => $data->user2,
					'username' => $data->username,
					'avatar_url' => $data->avatarUrl
			));
		}
		public function getFriend($idUser) {
			$request =  (new Select())
					->from('user')
					->columns(['id','username', 'avatar_url'])
					->join(['f1' => (new FriendTable($this->adapter))->getTable()],
							'f1.user_1 = user.id',
							[],
							Select::JOIN_LEFT)
					->join(['f2' => (new FriendTable($this->adapter))->getTable()],
							'f2.user_2 = user.id',
							[],
							Select::JOIN_LEFT)
					->where(['f1.user_1' => $idUser, 'f1.user_2' => $idUser,
							 'f2.user_1' => $idUser, 'f2.user_2' => $idUser],PredicateSet::COMBINED_BY_OR)
					->group(array('user.id'));
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			$retour = array();
			foreach ($result as $ligne) {
				if ($ligne['id'] != $idUser){
					$retour[] = $ligne;
				}
			}
			
			return $retour;
		}
		
	}
