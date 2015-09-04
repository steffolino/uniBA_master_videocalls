<?php

/**
* 	Call Controller
*  Handles all call-related actions, e.g. send invitations, handle notifications (in DB)
**/

Class CallController extends Controller 
{
	public function actionMarkNotAsCompleted() {
		if(!empty($_GET['notID'])) {
			
			$notID = htmlspecialchars($_GET['notID']);
			
			$notification = UserNotifications::model()->getNotificationByID($notID);

			$notification->notCompleted = true;
			$notification->save();

			echo $notification->notID;
			
		} else {
			echo "Could not mark Notification as Completed";
		}
	}
	
	public function actionSetInvitationToRejected() {
		if(!empty($_GET['notID'])) {
			
			$notID = htmlspecialchars($_GET['notID']);

			$notification = UserNotifications::model()->getNotificationByID($notID);
			$notification->notAnswer = 'no';
			$notification->save();
			echo $notification->notID;

		} else {
			echo "Could not mark Notification as Answered";
		}
	}
	
	public function actionSetInvitationToAccepted() {
		if(!empty($_GET['notID'])) {

			$notID = htmlspecialchars($_GET['notID']);

			$notification = UserNotifications::model()->getNotificationByID($notID);
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
			$currentUserID = Users::model()->getUserIDByName(Yii::app()->user->name);
			
			
/*			$result = Yii::app()->db->createCommand()
				->select('u.userID')
				->from('users u')
				->where('u.username=:username', array(':username'=>Yii::app()->user->name))
				->queryRow();
*/						
			if(!empty($currentUserID)) {
				
				$notification = UserNotifications::model()->pollForUnreadNots($currentUserID);				
					
				if(!empty($notification)) {
					$notJSON = CJSON::encode($notification);
					//$notResponseTimeout = CJSON::encode($responseTimeout);
					//echo "<a id='invitationLink' href='".$notification->notLink."'>".$notification->notText."</a>";
					echo $notJSON; //+ $notResponseTimeout;
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
				
			$notification = UserNotifications::model()->pollForAnsweredNots($inviteeID);
					
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

		$currentUser = Users::model()->getUserStoriesByName(Yii::app()->user->name);
		
		//TODO: move to model
		$notification = new UserNotifications;
		$notification->userID = $inviteeID;
		$notification->notText = 'Sie werden von '.Yii::app()->user->name . 'angerufen';
		$notification->notLink = Yii::app()->createUrl('call/room', array('host'=> $currentUser->userID, 'guest' => $inviteeID));
		$notification->inviterID = $currentUser->userID;
		$notification->save();
							
		$invitee = Users::model()->getUserStoriesByID($inviteeID);
				
		$this->render('//site/calling', array('invitee'=>$invitee, 'notification' => $notification));			
	}
	
	/**
	* Establishes room for actual conversation using WebRTC
	*/
	public function actionRoom () {
		if(isset($_GET['host']) && isset($_GET['guest'])) {

			$guestID = htmlspecialchars($_GET['guest']);
			$hostID = htmlspecialchars($_GET['host']);

			$conversationPartners = Users::model()->gatherCallPartnersStories($guestID, $hostID);
			
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
	
	public function actionCleanupOldNots () {

		$currentTime = time();
		$timeDiff = 600; //10 minutes in seconds
		$responseTimeout = $currentTime - $timeDiff;
		
		//echo $responseTimeout;
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'notCompleted = 0';
		
		$notificationArray = UserNotifications::model()->findAll($criteria);

		$cleanupCounter = 0;
		
		foreach($notificationArray as $notification) {
			
			if(strtotime($notification->notTimeCreated) < $responseTimeout) {
				$notification->notCompleted = true;
				$cleanupCounter++;
				$notification->save();
			}

			
		}
		
		echo "Cleaned ".$cleanupCounter . " notifications"; 

	}

}
?>