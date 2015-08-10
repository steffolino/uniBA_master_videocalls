<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$userName = Yii::app()->user->name;

		//YESSSSS!
		$currentUser = Users::model()->with(
					'contacts.contactStories',
					'contacts.contactName',
					'ownUserStories'
			)->findAll(array('condition'=>'t.username=:currentUserName', 'params'=>array(':currentUserName'=>Yii::app()->user->name)));;

		
		//$contacts = UserContacts::model()->findAll(array('order'=>'userID', 'condition'=>'userID=:userID', 'params'=>array(':userID'=>1)));;

		
		//var_dump($currentUser);
/*
		$contactsModel = new ContactsForm();
		$contactsModel->getAllContacts(1, NULL);
*/
		$this->render('index', array('currentUser'=>$currentUser));
		
		
		
	}
	
	public function actionMarkNotAsRead() {
		if(!empty($_GET['notID'])) {
				$notID = $_GET['notID'];
				$notification = UserNotifications::model()
					->find(array(
								'condition'=>
									't.notID=:notID',
								'params'=>array(
									':notID'=>$notID
								)
						)
					);
				$notification->notRead = true;
				$notification->save();
				echo $notification->notID;
		} else {
			echo "Could not mark Notification as Read";
		}
	}
	
	/**
	* pollForNotifications
	* checks for unread invitations by username
	**/
	public function actionPollNotifications () 
	{			
			//TODO: move to model
			$result = Yii::app()->db->createCommand()
				->select('u.userID')
				->from('users u')
				->where('u.username=:username', array(':username'=>Yii::app()->user->name))
				->queryRow();
			
			if(!empty($result['userID'])) {
				$notification = UserNotifications::model()
					->find(array(
								'condition'=>
									't.userID=:userID',
								'condition' => 
									't.notRead = 0',								
								'params'=>array(
									':userID'=>$result['userID']
								)
						)
					);
					
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
		
		$notification = new UserNotifications;
		$notification->userID = $inviteeID;
		$notification->notText = 'You are invited to answer the call by '.Yii::app()->user->name;
		$notification->notLink = Yii::app()->createUrl('site/room', array('roomId'=> Yii::app()->user->name));
		$notification->notRead = false;
		$notification->save();
		
		//TODO: move to model
		$result = Yii::app()->db->createCommand()
				->select('u.userID')
				->from('users u')
				->where('u.username=:username', array(':username'=>Yii::app()->user->name))
				->queryRow();

		$invitee = Users::model()
				->with('ownUserStories')
				->find(array(
							'condition'=>'t.userID=:userID', 
							'params'=>array(':userID'=>$inviteeID)
					)
		);
		
		//TODO: send invitation link to invitee --> Plugin PM?
		
		$this->render('calling', array('invitee'=>$invitee));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			/**
			* Modified: redirecting to "Home"
			*/
			if($model->validate() && $model->login()) {	
				//$this->redirect(Yii::app()->user->returnUrl);
				$this->redirect(Yii::app()->createUrl('site/index'));
			}
		} else {
			// display the login form
			$this->render('login',array('model'=>$model));
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/*** added by stef
	***/
	public function actionPrepareCall() {

			$userStories;
			$userHandler = New UserHandlerForm;
			
			$userHandler->getUserStories(5, NULL);
			$this->render('calling',array('userModel'=>$userHandler));
			
	}
	
}