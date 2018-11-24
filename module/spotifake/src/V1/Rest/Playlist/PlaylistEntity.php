<?php
namespace spotifake\V1\Rest\Playlist;

use Zend\Stdlib\JsonSerializable;

class PlaylistEntity implements JsonSerializable {
	
	
	public $id;
	public $title;
	public $ulrImage;
	public $idUser;
	public $idParty;
	public $nbTrack;
	
	/**
	 * Exchange internal values from provided array
	 *
	 * @param  array $array
	 *
	 * @return PlaylistEntity
	 */
	public function toChange (array $array) {
		
		$this->id		= $array['id'];
		$this->title	= $array['title'];
		$this->ulrImage	= $array['ulrImage'];
		$this->idUser	= $array['idUser'];
		$this->idParty	= $array['idParty'];
		$this->nbTrack	= $array['nbTrack'];
		
		return clone $this;
	}
	
	/**
	 * Specify data which should be serialized to JSON
	 * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize () {
		return [
				
				'id'		=> $this->id,
				'title'		=> $this->title,
				'ulrImage'	=> $this->ulrImage,
				'idUser'	=> $this->idUser,
				'idParty'	=> $this->idParty,
				'nbTrack'	=> $this->nbTrack
		];
	}
}
