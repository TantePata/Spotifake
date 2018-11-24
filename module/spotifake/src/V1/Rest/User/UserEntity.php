<?php
namespace spotifake\V1\Rest\User;

use Zend\Stdlib\JsonSerializable;

class UserEntity implements JsonSerializable {
	
	
	public $id;
	public $username;
	public $avatarUrl;
	
	/**
	 * Exchange internal values from provided array
	 *
	 * @param  array $array
	 *
	 * @return UserEntity
	 */
	public function toChange (array $array) {
		$this->id			= $array['id'];
		$this->username		= $array['username'];
		$this->avatarUrl	= $array['avatarUrl'];
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
				'username'	=> $this->username,
				'avatarUrl'	=> $this->avatarUrl,
		];
	}
}
