<?php
	namespace spotifake\V1\Rest\Party;
	
	use spotifake\V1\Rest\Playlist\PlaylistTable;
	use spotifake\V1\Rest\PlaylistTrack\PlaylistTrackTable;
	use spotifake\V1\Rest\User\UserTable;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class PartyTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('party', $adapter);
		}
		
		public function getParty($id = null){
			$request = (new Select())
					->from('party')
					->columns(['id',
							   'id_playlist',
							   'difficulty',
							   'auto_generated',
							   'direct',
							   'finished',
							   'owner',
							   'nb_track'])
					->join(['pus' => (new PartyUserStateTable($this->adapter))->getTable()],
							'pus.id_party = party.id',
							['score',
							 'finished',
							 'current_track_number'],
							Select::JOIN_LEFT)
					->join(['user' => (new UserTable($this->adapter))->getTable()],
							'user.id = pus.id_user',
							['id_user' => 'id',
							 'username',
							 'avatar_url'],
							Select::JOIN_LEFT);
			if (! is_null($id)) {
				$request->where(array('id = ?'=> $id));
				$result = $this->sql->prepareStatementForSqlObject($request)->execute();
				
				$retour = array();
				if (! $result->current()) {
					return false;
				}
				
				foreach ($result as $ligne) {
					if (empty($retour[$ligne['id']])) {
						$retour[$ligne['id']] = [
								'id'             => $ligne['id'],
								'id_playlist'    => $ligne['id_playlist'],
								'difficulty'     => $ligne['difficulty'],
								'auto_generated' => $ligne['auto_generated'],
								'direct'         => $ligne['direct'],
								'finished'       => $ligne['finished'],
								'owner'          => $ligne['owner'],
								'nb_track'       => $ligne['nb_track']
						];
					}
					$retour[$ligne['id']]['user'][] = [
						'id' 					=> $ligne['id_user'],
						'username'				=> $ligne['username'],
						'avatar_url'			=> $ligne['avatar_url'],
						'score'					=> $ligne['score'],
						'finished'				=> $ligne['finished'],
						'current_track_number'	=> $ligne['current_track_number']
					];
				}
				
				return array_keys($retour)[0];
			}
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			$retour = array();
			foreach ($result as $ligne) {
				if (empty($retour[$ligne['id']])) {
					$retour[$ligne['id']] = [
							'id'			=> $ligne['id'],
							'id_playlist'	=> $ligne['id_playlist'],
							'difficulty'		=> $ligne['difficulty'],
							'auto_generated'	=> $ligne['auto_generated'],
							'direct'			=> $ligne['direct'],
							'finished'			=> $ligne['finished'],
							'owner'				=> $ligne['owner'],
							'nb_track'			=> $ligne['nb_track']
					];
					
				}
				$retour[$ligne['id']]['user'][] = [
						'id' 					=> $ligne['id_user'],
						'username'				=> $ligne['username'],
						'avatar_url'			=> $ligne['avatar_url'],
						'score'					=> $ligne['score'],
						'finished'				=> $ligne['finished'],
						'current_track_number'	=> $ligne['current_track_number']
				];
				
			}
			
			return $retour;
		}
		
		public function updateScore($idParty, $data){
			return (new PartyUserStateTable($this->getAdapter()))->update(
					[
							'score'					=> $data->score,
							'finished'				=> $data->finished,
							'current_track_number'	=> $data->current_track_number
					],
					['id_party' => $idParty, 'id_user' => $data->id_user]
			);
		
		}
		
		public function createParty($data){
			
			$listePlaylist = $data->id_playlist;
			
			// Récupération des musiques
			$request = (new Select())
					->from('track')
					->columns(['id'])
					->join(['pt' => (new PlaylistTrackTable($this->adapter))->getTable()],
							'pt.id_track = track.id',
							[],
							Select::JOIN_LEFT)
					->where(['pt.id_playlist' => $listePlaylist])
					->order(['track.id']);
			
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			$listeIdTrack = array();
			
			
			// Création de la
			
			$idPlaylist = uniqid();
			(new PlaylistTable($this->getAdapter()))
					->insert([
							'id'	=> $idPlaylist,
							'title' => 'Blindtest : ' . uniqid(),
							'id_user' => $data->owner,
							'url_image' => 'https://yt3.ggpht.com/a-/ACSszfGHRUbcOqBsbhgYXkXHnVw2kPiQr9ibDj0bRQ=s900-mo-c-c0xffffffff-rj-k-no',
							'nb_track' => $data->nb_track
					]);
			
			foreach ($result as $ligne) {
				if (count($listeIdTrack) < $data->nb_track){
					(new PlaylistTrackTable($this->getAdapter()))->insert([
							'id_playlist' => $idPlaylist,
							'id_track' => $ligne['id']
					]);
					$listeIdTrack[] = $ligne['id'];
				} else {
					break;
				}
			}
			$party = [
					'difficulty' => $data->difficulty,
					'auto_generated' => false,
					'direct' => false,
					'finished' => false,
					'owner' => $data->owner,
					'nb_track' => $data->nb_track,
					'id_playlist' => $idPlaylist
			
			];
			$this->insert($party);
			$party['id'] = $this->lastInsertValue;
			
			foreach ($data->id_user as $user){
				(new PartyUserStateTable($this->getAdapter()))->insert([
					'id_party' => $this->lastInsertValue,
					'id_user'	=> $user
				]);
			}
			
			return $party;
		}
		
	}
