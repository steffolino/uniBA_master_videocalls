<?php
/***
ActiveRecord Class to represent Users in DB
 * @author stefan
 * @version 0.9
 * @package application.models.activeRecords
 * @todo implement method to create new invitations
**/
class Users extends CActiveRecord {

	/**
	* default ctor for ActiveRecords
	* @param string $className default param Class Name
	*/	
	public static function model($className=__CLASS__) {
			return parent::model($className);
	}

	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			'ownUserStories' => array(self::HAS_MANY, 'UserDescriptions', array('userID'=>'userID')),
			'contacts' => array(self::HAS_MANY, 'UserContacts', array('userID'=>'userID')),
			'userMusic' => array(self::HAS_ONE, 'UserMusic', array('userID' => 'userID')),
			'userImages' => array(self::HAS_ONE, 'UserImages', array('userID' => 'userID')),
        );
    }
	
	/*
	* search for a user's contacts
	* retrieves username from application
	*/
	public function searchForContacts () {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.username=:currentUserName';
		$criteria->params = array(':currentUserName' => $userName);
		
			return $this->with(
					'contacts.contactStories',
					'contacts.contactName',
					'ownUserStories'
			)->findAll($criteria);

	}

	/*
	* retreives all users from DB
	* @return user AR objects
	*/
	public function getAllUsers () {
		
		return $this->findAll();
			
	}

	/**
	* @param string $userName user Name
	* @return integer userID user ID
	*/
	public function getUserIDByName ($userName) {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.username=:currentUserName';
		$criteria->params = array(':currentUserName' => $userName);
		
		$result =	$this->find($criteria);
			
		return $result->userID;

	}
	
	/**
	* @return  string $userName user Name
	* @param integer userID user ID
	*/	
	public function getUserNameByID ($userID) {

		$criteria = new CDbCriteria();
		$criteria->condition = 't.userID=:userID';
		$criteria->params = array(':userID' => $userID);
		
		$result =	$this->find($criteria);
			
		return $result->username;

	}

	/**
	* @param string $userName user Name
	* @return array $result a user's userstories
	*/	
	public function getUserStoriesByName ($userName) {

		$criteria = new CDbCriteria();
		$criteria->condition = 't.username=:currentUserName';
		$criteria->params = array(':currentUserName' => $userName);
		
		$result =	$this->with('ownUserStories')->find($criteria);
			
		return $result;

	}

	/**
	* @param integer $userID userID
	* @return array $result a user's userstories
	*/
	public function getUserStoriesByID ($userID) {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.userID=:userID';
		$criteria->params = array(':userID' => $userID);
		
		$result =	$this->with('ownUserStories')->find($criteria);
			
		return $result;

	}

	/**
	* @param integer $userID userID
	* @return array $result a user's music and stories
	*/
	public function getUserStoriesAndMusicByID ($userID) {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.userID=:userID';
		$criteria->params = array(':userID' => $userID);
		
		$result =	$this->with(
			array(
				'ownUserStories',
				'userMusic',
				)
		)->find($criteria);
			
		return $result;

	}
	
	/**
	* @param integer $userID userID
	* @return array $result a user's music, stories and imagelinks
	*/
	public function getUserStoriesAndMusicAndImagesByID ($userID, $inviteeID) {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.userID=:userID OR t.userID=:inviteeID';
		$criteria->params = array(':userID' => $userID, ':inviteeID' => $inviteeID);
		
		$result =	$this->with(
			array(
				'ownUserStories',
				'userMusic',
				'userImages',
				)
		)->findAll($criteria);
			
		return $result;

	}

	/**
	* @param $guestID userID of invitee
	* @param $hostID userID of inviting user
	* @return array of calling users including their userstories
	*/
	public function gatherCallPartnersStories ($guestID, $hostID) {
			$criteria = new CDbCriteria();
			$criteria->condition = 't.userID=:guestID OR t.userID=:hostID';
			$criteria->params = array(':guestID' => $guestID, ':hostID'=>$hostID);
			
			return $this->with('ownUserStories')->findAll($criteria);

	}
	
	/**
	* @param $inviterName, 
	* @param $inviterID
	* @param $inviteeID
	* @todo implement completely
	*/
	public function createNewInvitation ($inviterName, $inviterID, $inviteeID) {		
	}
		
}

?>