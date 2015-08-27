<?php

/**
* 	Call Controller
*  Handles all call-related actions, e.g. send invitations, handle notifications (in DB)
**/

Class CallController extends Controller 
{
	public function actionMarkNotAsCompleted() {
		if(!empty($_GET['notID'])) {

			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $_GET['notID']);
				
			$notification = UserNotifications::model()->find($criteria);

			$notification->notCompleted = true;
			$notification->save();
			echo $notification->notID;
			
		} else {
			echo "Could not mark Notification as Completed";
		}
	}
	
	public function actionSetInvitationToRejected() {
		if(!empty($_GET['notID'])) {
			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $_GET['notID']);
				
			$notification = UserNotifications::model()->find($criteria);

			$notification->notAnswer = 'no';
			$notification->save();

			echo $notification->notID;

		} else {
			echo "Could not mark Notification as Answered";
		}
	}
	
	public function actionSetInvitationToAccepted() {
		if(!empty($_GET['notID'])) {
			$criteria = new CDbCriteria();
			$criteria->condition = 'notID=:notificationID';
			$criteria->params = array('notificationID' => $_GET['notID']);
				
			$notification = UserNotifications::model()->find($criteria);
			$notification->notAnswer = 'yes';
			$notification->save();

			echo $notification->notID;

		} else {
			echo "Could not mark Notification as Answered";
		}
	}
		
		
	/**
	* pollForNotifications
	* checks for unread invitations by username
	**/
	public function actionPollNotificationsInvitee () 
	{			
			//TODO: move to model
			$result = Yii::app()->db->createCommand()
				->select('u.userID')
				->from('users u')
				->where('u.username=:username', array(':username'=>Yii::app()->user->name))
				->queryRow();
						
			if(!empty($result['userID'])) {
				
				$criteria = new CDbCriteria();
				$criteria->condition = 'userID=:currentUserID AND notAnswer = "unread" AND notCompleted = 0';
				$criteria->params = array('currentUserID' => $result['userID']);
				
				$notification = UserNotifications::model()->find($criteria);
					
				if(!empty($notification)) {
					$notJSON = CJSON::encode($notification);
					//echo "<a id='invitationLink' href='".$notification->notLink."'>".$notification->notText."</a>";
					echo $notJSON;
				} else {
					echo "no notifications";
					//var_dump($notification);
				}
			
			} else {
				echo "Error reading Notifications";
			}	
	}
	
	/**
	* pollForNotifications
	* checks for unread invitations by username
	**/
	public function actionPollNotificationsInviter () 
	{			
		if(!empty($_GET['inviteeID'])) {
			$inviteeID = $_GET['inviteeID'];
			//echo $inviteeID;
		
			$criteria = new CDbCriteria();
			$criteria->condition = 'userID=:inviteeID AND notAnswer != "unread" AND notCompleted = 0';
			$criteria->params = array('inviteeID' => $inviteeID);
				
			$notification = UserNotifications::model()->find($criteria);
					
			if(!empty($notification)) {
				$notJSON = CJSON::encode($notification);
					//echo "<a id='invitationLink' href='".$notification->notLink."'>".$notification->notText."</a>";
				echo $notJSON;
			} else {
				echo "no notifications";
					//var_dump($notification);
			}
			
		} else {
				echo "Error reading Notifications";
		}	
	}

	/**
	* Sends an invitation to user by userID
	* Shows user's details while waiting for user to answer
	* when answering --> callback and establish connection
	* BASICALLY: I INVITE YOU TO MY ROOM
	 */
	public function actionInvite()
	{
		$inviteeID = Yii::app()->getRequest()->getParam('contactID');	
		//$notification = UserNotifications::model()->find(array('condition'=>'userID=:inviteeID', 'params'=>array(':inviteeID'=>$inviteeID)));

		$userName = Yii::app()->user->name;
		$criteria = new CDbCriteria();
		$criteria->condition = 't.username=:currentUserName';
		$criteria->params = array(':currentUserName' => $userName);
		$currentUser = Users::model()->with(
					'ownUserStories'
			)->find($criteria);

		
		$notification = new UserNotifications;
		$notification->userID = $inviteeID;
		$notification->notText = 'You are invited to answer the call by '.Yii::app()->user->name;
		$notification->notLink = Yii::app()->createUrl('call/room', array('host'=> $currentUser->userID, 'guest' => $inviteeID));
		$notification->inviterID = $currentUser->userID;
		$notification->save();
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'userID=:inviteeID';
		$criteria->params = array('inviteeID' => $inviteeID);
					
		$invitee = Users::model()->find($criteria);
				
		$this->render('//site/calling', array('invitee'=>$invitee, 'notification' => $notification));			
	}
	
	/**
	* Establishes room for actual conversation using WebRTC
	*/
	public function actionRoom () {
		if(isset($_GET['host']) && isset($_GET['guest'])) {
			$guestID = htmlspecialchars($_GET['guest']);
			$hostID = htmlspecialchars($_GET['host']);

			$criteria = new CDbCriteria();
			$criteria->condition = 't.userID=:guestID OR t.userID=:hostID';
			$criteria->params = array(':guestID' => $guestID, ':hostID'=>$hostID);
			
			$conversationPartners = Users::model()->with('ownUserStories')->findAll($criteria);
			
			if(!empty($conversationPartners)) {
				$this->render('room', array('conversationPartners' => $conversationPartners));
			} else {
				echo "No results from DB";
			}
		} else {
			echo "GET NOT SET";
			$this->render('room');//, array('conversationPartners' => $conversationPartners));
		}
	}

}
?>