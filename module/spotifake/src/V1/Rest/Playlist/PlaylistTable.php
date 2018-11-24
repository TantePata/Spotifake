<?php
	namespace spotifake\V1\Rest\Playlist;
	
	use spotifake\V1\Rest\PlaylistTrack\PlaylistTrackTable;
	use spotifake\V1\Rest\Track\TrackTable;
	use spotifake\V1\Rest\User\UserTable;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class PlaylistTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('playlist', $adapter);
		}
		
		public function getPlaylist($id){
			$request = (new Select())
					->from('track')
					->columns(['id',
							   'title',
							   'artist',
							   'album',
							   'cover_url',
							   'sample_url'])
					->join(['pt' => (new PlaylistTrackTable($this->adapter))->getTable()],
							'pt.id_track = track.id',
							[],
							Select::JOIN_LEFT)
					->where(array('pt.id_playlist = ?'=> $id));
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			$retour= array();
			foreach ($result as $ligne) {
				$retour[] = $ligne;
			}
			return $retour;
		}
		
		public function createAllPlaylist(array $listePlaylist, $listeIdPlaylist, $listeIdUser){
			// Récuperation des Playlist
			$request =  (new Select())
					->from('playlist')
					->columns(['id'])
					->where(array('id'=> $listeIdPlaylist));
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			$listeIdPlaylistBase= array();
			foreach ($result as $ligne) {
				$listeIdPlaylistBase[] = $ligne['id'];
			}
			$idPlylistToAdd = array_diff($listeIdPlaylist, $listeIdPlaylistBase);
			
			// Récuperation des user
			$request =  (new Select())
					->from('user')
					->columns(['id'])
					->where(array('id'=> $listeIdUser));
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			$listeIdUserBase= array();
			foreach ($result as $ligne) {
				$listeIdUserBase[] = $ligne['id'];
			}
			$idUserToAdd = array_diff(array_unique($listeIdUser), $listeIdUserBase);
			
			if (! empty($idUserToAdd)) {
				$userTable = new UserTable($this->getAdapter());
				foreach ($idUserToAdd as $id){
					
					$request = \Requests::get("https://api.spotify.com/v1"
							. "/users/" . $id,
							array('authorization'=> 'Bearer '
									. $_SERVER['HTTP_TOKEN']));
					if ($request->status_code == 200) {
						$infosUser = json_decode($request->body, true);
						
						$userTable->insert([
								'id' => $infosUser['id'],
								'username' => $infosUser['display_name'] ?? $infosUser['id'],
								'avatar_url' => $infosUser['images'][0]['url'] ?? null
						]);
					}
					
				}
			}
			
			if (! empty($idPlylistToAdd)) {
				$trackTable = new TrackTable($this->getAdapter());
				$playlistTrackTable = new PlaylistTrackTable($this->getAdapter());
				
				foreach ($idPlylistToAdd as $id){
					
					// on ajoute la playlist
					$this->insert($listePlaylist[$id]);
					
					// on add les musique
					$request = \Requests::get("https://api.spotify.com/v1" . "/playlists/" . $id . "/tracks"
							. "?fields=items(track(id,name,artists,album(name,images),preview_url))&imit=100&offset=0",
							array('authorization'=> 'Bearer '
									. $_SERVER['HTTP_TOKEN']));
					if ($request->status_code == 200) {
						$infostrack = json_decode($request->body, true);
						$trackToAdd = array();
						$playlistTrackToAdd = array();
						foreach ($infostrack['items'] as $track) {
							$track = $track['track'];
							$trackToAdd[$track['id']] = [
									'id' => $track['id'],
									'title' => $track['name'],
									'artist' => $track['artists'][0]['name'] ?? null,
									'album' => $track['album']['name'] ?? null,
									'cover_url' => $track['album']['images'][0]['url'] ?? null,
									'sample_url' => $track['preview_url']
							];
							$playlistTrackToAdd[] = [
								'id_playlist' => $id,
								'id_track'	=> $track['id']
							];
						}
						
						// Récuperation des track
						$request =  (new Select())
								->from('track')
								->columns(['id'])
								->where(array('id'=> array_keys($trackToAdd)));
						$result = $this->sql->prepareStatementForSqlObject($request)->execute();
						$listeIdTrackBase= array();
						foreach ($result as $ligne) {
							$listeIdTrackBase[] = $ligne['id'];
						}
						$idTrackToAdd = array_diff(array_unique(array_keys($trackToAdd)), $listeIdTrackBase);
						foreach ($idTrackToAdd as $idTrack){
							$trackTable->insert($trackToAdd[$idTrack]);
						}
						foreach ($playlistTrackToAdd as $item){
							$playlistTrackTable->insert($item);
						}
						
					}
				}
			}
		}
		
	}
