<?php
	namespace spotifake\V1\Rest\User;
	
	use Zend\Db\Sql\Insert;
	use Zend\Db\Sql\Predicate\PredicateSet;
	use Zend\Db\TableGateway\TableGateway;
	use Zend\Db\Sql\Select;
	use Zend\Db\Adapter\AdapterInterface;
	
	class UserTable extends TableGateway {
		
		public function __construct(AdapterInterface $adapter) {
			parent::__construct('user', $adapter);
		}
		
		public function postOne (array $infosUser) {
			
			$request =  (new Select())
					->from('user')
					->columns(['id'])
					->where(array('id'=> $infosUser['id']));
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			if (! $result->current()) {
				$request = (new Insert())
						->into('user')
						->values([
								'id'			=> $infosUser['id'],
								'username'		=> $infosUser['display_name'] ?? $infosUser['id'],
								'avatar_url'	=> array_values($infosUser['images'])[0]['url'],
						]);
				$this->sql->prepareStatementForSqlObject($request)->execute();
			}
		}
		
		public function fetchAll ($name = null) {
			
			$request =  (new Select())
					->from('user')
					->columns(['id',
							   'username',
							   'avatar_url']);
			if (! empty($name)) {
				$request->where(['id LIKE ?' => '%' . $name . '%' ,
								 'username LIKE ?' => '%' . $name . '%'],PredicateSet::COMBINED_BY_OR);
			}
			
			$result = $this->sql->prepareStatementForSqlObject($request)->execute();
			
			$retour= array();
			foreach ($result as $ligne) {
				$retour[] = $ligne;
			}
			return $retour;
		}
		
	}
