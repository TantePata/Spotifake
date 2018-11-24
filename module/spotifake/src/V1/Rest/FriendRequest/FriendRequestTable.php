<?php
	namespace spotifake\V1\Rest\FriendRequest;
	
	use spotifake\V1\Rest\PlaylistTrack\PlaylistTrackTable;
	use spotifake\V1\Rest\Track\TrackTable;
	use spotifake\V1\Rest\User\UserTable;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class FriendRequestTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('friend', $adapter);
		}
		
		public function updateFriendRequest($id, $data){
			if ($data->state == 'no'){
				$this->delete(['id' => $id]);
			} else {
				$this->update(['state' => $data->state],['id' => $id]);
			}
		}
		public function getAllFriendInPending($myId) {
			$request =  (new Select())
					->from('friend')
					->columns(['id','user_1', 'user_2', 'state', 'username', 'avatar_url'])
					->where(['user_2' => $myId, 'state' => 'pending']);
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			$retour = array();
			foreach ($result as $ligne) {
				$retour[] = $ligne;
			}
			
			return $retour;
		}
		
	}
