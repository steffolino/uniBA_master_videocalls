<?php

/**
* 	Site Controller
*  Handles all structural actions, for instance login & logout and displaying home / index
 * @author stefan
 * @version 1.0
 * @package application.controllers
**/
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
		//$userName = Yii::app()->user->name;

		//YESSSSS!		
		$currentUser = Users::model()->searchForContacts();
/*		
		$currentUser = Users::model()->with(
					'contacts.contactStories',
					'contacts.contactName',
					'ownUserStories'
			)->findAll($criteria);
*/
		$this->render('index', array('currentUser'=>$currentUser));		
		
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
				Yii::app()->setGlobalState('slideShow', $_POST['LoginForm']['slideShow']);
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
	
}