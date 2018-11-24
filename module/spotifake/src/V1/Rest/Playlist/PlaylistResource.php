<?php
namespace spotifake\V1\Rest\Playlist;

use Zend\Db\TableGateway\TableGateway;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class PlaylistResource extends AbstractResourceListener
{
	protected $mapper;
	
	public function __construct(TableGateway $mapper)
	{
		$this->mapper = $mapper;
	}
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->mapper->getPlaylist($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
		\Requests::register_autoloader();
		$request = \Requests::get("https://api.spotify.com/v1" . "/me/playlists?limit=50&offset=0", array('authorization'=> 'Bearer '
				. $_SERVER['HTTP_TOKEN']));
		if ($request->status_code == 200) {
			$infosPlaylists = json_decode($request->body, true);
			$listePlaylist = array();
			$listeIdPLaylist = array();
			$listeIdUSer = array();
			foreach ($infosPlaylists['items'] as $playlist){
				
				$listePlaylist[$playlist['id']] = array(
						'id'		=> $playlist['id'],
						'title'		=> $playlist['name'],
						'url_Image'	=> $playlist['images'][0]['url'] ?? null,
						'id_user'	=> $playlist['owner']['id'],
						'nb_track'	=> ($playlist['tracks']['total'] > 100 ? 100 : $playlist['tracks']['total'])
				);
				$listeIdPLaylist[] = $playlist['id'];
				$listeIdUSer[] = $playlist['owner']['id'];
			}
			$this->mapper->createAllPlaylist($listePlaylist, $listeIdPLaylist, $listeIdUSer);
			
			return $listePlaylist;
		} else{
		
			return new ApiProblem($request->status_code, json_decode($request->body));
		}
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
