<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 /**
	 * Modified: disabled passwords, added test-user "irma"
	 *
	 */
	 
	private $_id;
	 
	public function authenticate()
	{
	$usersAR = Users::model()->getAllUsers();
//		var_dump ($usersAR);
		$Users = array();
		foreach ($usersAR as $user) {
			$Users[$user->username] = '';
		}/*
		$Users=array(
			// username => password
			'irma'=>'',
			'robert'=>'',
			'geli'=>'',
			'georg'=>'',
			'theresia'=>'',
			'josef'=>'',
			'admin'=>'',
		);
*/		
		if(!isset($Users[strToLower($this->username)])) {
			echo "Username is not set: " . strToLower($this->username);
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			//elseif($Users[$this->username]!==$this->password)
			//	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
			$this->errorCode=self::ERROR_NONE;
			$userID = Yii::app()->db->createCommand()
						->select('u.userID')
						->from('Users u')
						->where('u.username=:username', array(':username'=>strToLower($this->name)))
						->queryRow();
			$this->_id = $userID;
		}
		return !$this->errorCode;
	}
	
}