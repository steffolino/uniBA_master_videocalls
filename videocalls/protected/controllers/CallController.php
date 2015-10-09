<?php

/**
* 	Call Controller
*  Handles all call-related actions, e.g. send invitations, handle notifications (in DB)
 * @author stefan
 * @version 0.9
 * @package application.controllers
 * @todo rewrite models and move db-actions from controller to respective models
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
	
	/**
	* sets a notification / invitation status to rejected
	*/
	public function actionSetInvitationToRejected() {
		if(!empty($_GET['notID'])) {
			
			$notID = htmlspecialchars($_GET['notID']);

			$notification = UserNotifications::model()->getNotificationByID($notID);
			$notification->notAnswer = 'no';
			$notification->save();	
		
			$inviterID = $notification->inviterID;
			$inviterName = Users::model()->getUserNameByID($inviterID);

			echo $inviterName;

		} else {
			echo "Could not mark Notification as Answered";
		}
	}

	/**
	* sets a notification / invitation status to accepted
	*/	
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
		if(!empty($_GET['guestID'])) {
			$inviteeID = $_GET['guestID'];
				
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
		/*
		$inviteeID = Yii::app()->getRequest()->getParam('contactID');	
		//$notification = UserNotifications::model()->find(array('condition'=>'userID=:inviteeID', 'params'=>array(':inviteeID'=>$inviteeID)));

		$currentUser = Users::model()->getUserStoriesByName(Yii::app()->user->name);
		*/

		if(isset($_GET['host']) && isset($_GET['guest'])) {

			$guestID = htmlspecialchars($_GET['guest']);
			$hostID = htmlspecialchars($_GET['host']);

			$hostName = Users::model()->getUserNameByID($hostID);
		
			//TODO: move to model
			$notification = new UserNotifications;
			$notification->userID = $guestID;
			$notification->notText = strToUpper($hostName) . ' ruft Sie an';
			$notification->notLink = Yii::app()->createUrl('call/accepted', array('host'=> $hostID, 'guest' => $guestID, 'isInvited'=>'1'));
			$notification->inviterID = $hostID;
			$notification->save();
			/*				
			$invitee = Users::model()->getUserStoriesAndMusicAndImagesByID($inviteeID);
					
			$this->render('//site/calling', array('invitee'=>$invitee, 'notification' => $notification));			
			*/

			$conversationPartners = Users::model()->getUserStoriesAndMusicAndImagesByID($guestID, $hostID);
			
			if(!empty($conversationPartners)) {
				$this->render('calling', array('conversationPartners' => $conversationPartners, 'notification' => $notification));
			} else {
				echo "No results from DB";
			}
		} else {
			echo "GET NOT SET";
			$this->render('room');//, array('conversationPartners' => $conversationPartners));
		}		

	}
	
	/**
	* Establishes room for actual conversation using WebRTC
	*/
	public function actionAccepted () {
		if(isset($_GET['host']) && isset($_GET['guest'])) {

			$guestID = htmlspecialchars($_GET['guest']);
			$hostID = htmlspecialchars($_GET['host']);
		
			$conversationPartners = Users::model()->getUserStoriesAndMusicAndImagesByID($guestID, $hostID);
			
			if(!empty($conversationPartners)) {
				$this->render('calling', array('conversationPartners' => $conversationPartners));
			} else {
				echo "No results from DB";
			}
		} else {
			echo "GET NOT SET";
			$this->render('calling');//, array('conversationPartners' => $conversationPartners));
		}		
	}
	
	/**
	* garbage collection
	* scans db for notifications older than 10 minutes and  sets their status to completed
	* @todo: refine algorithm
	*/
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