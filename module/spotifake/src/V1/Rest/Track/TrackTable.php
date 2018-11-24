<?php
	namespace spotifake\V1\Rest\Track;
	
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Adapter\AdapterInterface;
	
	class TrackTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('track', $adapter);
		}
		
	}
