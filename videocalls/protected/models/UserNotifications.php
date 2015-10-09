<?php
/**
* ActiveRecord Class to represent Table UserNotifications in DB
 * @author stefan
 * @version 0.9
 * @package application.models.activeRecords
 * @todo implement 2 more methods to accept & reject invitations
**/
class UserNotifications extends CActiveRecord {

	/**
	* default ctor for ActiveRecords
	* @param string $className default param classname
	*/
	public static function model($className=__CLASS__) {
			return parent::model($className);
		}

		
	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			//'currentUserStories' => array(self::BELONGS_TO, 'Users', 'userID'),
			//'userNotifications' => array(self::HAS_ONE, '', 'userID'),
        );
    }
	
	/**
	* Takes notificationID and returns Notification Active Record Object
	* @param integer $notID Notification ID
	* @return Notification Active Record Object
	*/
	public function getNotificationByID($notID) {

			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $notID);
				
			return $this->find($criteria);
	
	}

	/**
	* Takes NotificationID and marks it as completed
	* doc eror:__@param integer $notID Notification ID
	*/	
	public function notificationCompleted ($notID) {
			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $notID);
				
			$notification = $this->find($criteria);

			$this->notCompleted = true;
			$this->save();
			
			return;
	}
	
	
	/**
	* Queries DB for unread notifications
	* doc error: cannot find param currentUserID
	* @param string $currentUserID current Users id
	* @return $notification returns notification AR Object
	*/		
	public function pollForUnreadNots($currentUserID) {
		$criteria = new CDbCriteria();
		$criteria->condition = 'userID=:currentUserID AND notAnswer = "unread" AND notCompleted = 0';
		$criteria->params = array(':currentUserID' => $currentUserID);
				
		$notification = $this->find($criteria);
		
		return $notification;
	}

	/*
	* Queries DB for answered notifications / invitations
	* @param integer $inviteeID ID of invited user
	* @return $notification returns notification AR Object
	*/		
	public function pollForAnsweredNots($inviteeID) {
		$criteria = new CDbCriteria();
			$criteria->condition = 'userID=:inviteeID AND notAnswer != "unread" AND notCompleted = 0';
			$criteria->params = array('inviteeID' => $inviteeID);
				
		$notification = $this->find($criteria);
		
		return $notification;
	}


/*	
	public function notificationInvitationRejected ($notID) {

			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $notID);
				
			$this->find($criteria);

			$this->notAnswer = 'no';
			$this->save();
	}

	public function notificationInvitationAccepted ($notID) {

			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $notID);
				
			$this->find($criteria);

			$this->notAnswer = 'yes';
			$this->save();
	}
	*/	
}

?>