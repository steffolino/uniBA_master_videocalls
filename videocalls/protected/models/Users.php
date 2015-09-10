<?php
/***

ActiveRecord Class to represent Users in DB

***/

class Users extends CActiveRecord {

	//MUST HAVE
	public static function model($className=__CLASS__) {
			return parent::model($className);
	}

	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			'ownUserStories' => array(self::HAS_MANY, 'UserDescriptions', array('userID'=>'userID')),
			'contacts' => array(self::HAS_MANY, 'UserContacts', array('userID'=>'userID')),
        );
    }
	
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
	
	public function getAllUsers () {
		
		return $this->findAll();
			
	}

	public function getUserIDByName ($userName) {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.username=:currentUserName';
		$criteria->params = array(':currentUserName' => $userName);
		
		$result =	$this->find($criteria);
			
		return $result->userID;

	}
	
	public function getUserStoriesByName ($userName) {

		$criteria = new CDbCriteria();
		$criteria->condition = 't.username=:currentUserName';
		$criteria->params = array(':currentUserName' => $userName);
		
		$result =	$this->with('ownUserStories')->find($criteria);
			
		return $result;

	}

	public function getUserStoriesByID ($userID) {
		$userName = Yii::app()->user->name;

		$criteria = new CDbCriteria();
		$criteria->condition = 't.userID=:userID';
		$criteria->params = array(':userID' => $userID);
		
		$result =	$this->with('ownUserStories')->find($criteria);
			
		return $result;

	}
	
	public function gatherCallPartnersStories ($guestID, $hostID) {
			$criteria = new CDbCriteria();
			$criteria->condition = 't.userID=:guestID OR t.userID=:hostID';
			$criteria->params = array(':guestID' => $guestID, ':hostID'=>$hostID);
			
			return $this->with('ownUserStories')->findAll($criteria);

	}
	
	public function createNewInvitation ($inviterName, $inviterID, $inviteeID) {		
	}
		
}

?>