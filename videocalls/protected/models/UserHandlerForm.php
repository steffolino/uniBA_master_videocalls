<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserHandlerForm extends CFormModel
{
	public $username;
	public $userID;
	public $resultSet;
	public $userStories;

	public function getUserStories ($userID = NULL, $userName = NULL) {
		//TODO: move to model
		if(isset($userName)) {
			$userID = Yii::app()->db->createCommand()
				->select(userID)
				->from('videocalls.users')
				->where('userName=:userName', array(':userName'=>$userName))
				->queryRow();
		}

		if(isset($userID)) {
			$userStories = Yii::app()->db->createCommand()
				->select()
				->from('videocalls.userdescriptions')
				->where('userID=:userID', array(':userID'=>$userID))
				->queryAll();

				if($userStories!=NULL) {
					$this->userStories = $userStories;
				}		
		} else {
			echo "Error: userID is not set";
		}
	}

}
