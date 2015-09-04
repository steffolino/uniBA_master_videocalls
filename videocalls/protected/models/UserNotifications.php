<?php
/***

ActiveRecord Class to represent UserDescriptions in DB

***/

class UserNotifications extends CActiveRecord {


	//MUST HAVE
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
	
	public function getNotificationByID($notID) {

			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $notID);
				
			return $this->find($criteria);
	
	}
	
	public function notificationCompleted ($notID) {
			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $notID);
				
			$notification = $this->find($criteria);

			/*
			$notification->notCompleted = true;
			$notification->save();
			*/
			$this->notCompleted = true;
			$this->save();
			
			return;
	}
	
	
	
	public function pollForUnreadNots($currentUserID) {
		$criteria = new CDbCriteria();
		$criteria->condition = 'userID=:currentUserID AND notAnswer = "unread" AND notCompleted = 0';
		$criteria->params = array(':currentUserID' => $currentUserID);
				
		$notification = $this->find($criteria);
		
		return $notification;
	}

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