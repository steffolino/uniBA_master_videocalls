<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ContactsForm extends CFormModel
{
	public $username;
	public $userID;
	public $userContacts;
	
	public function getAllContacts ($userID = NULL, $userName = NULL) {
				
				// Get userID if only UserName has been set
				if(isset($userName)) {
					$userID = Yii::app()->db->createCommand()
						->select('userID')
						->from('videocalls.users')
						->where('userName=:userName', array(':userName'=>$userName))
						->queryRow();
				}

				//UserID set?
				if(isset($userID)) {
					/* GOOD ONE
					$userContacts = Yii::app()->db->createCommand()
						->select('u.userName, uc.contactID, ud.userStory')
						->from('videocalls.usercontacts uc')
						->join('videocalls.userdescriptions ud', 'uc.contactID = ud.userID')
						->join('videocalls.users u', 'u.userID = uc.contactID')
						->where('uc.userID=:userID', array(':userID'=>$userID))
						->queryAll();
					*/
					
					//Get all contacts from current user
					$userContacts = Yii::app()->db->createCommand()
						->select('u.userName, uc.contactID')
						->from('videocalls.usercontacts uc')
						->join('videocalls.users u', 'u.userID = uc.contactID')
						->where('uc.userID=:userID', array(':userID'=>$userID))
						->queryAll();
					

					if(!empty($userContacts)) {

						$this->userContacts = $userContacts;

						//Array to store all stories from a contact
						$userStoryArr = array();
						
						//var_dump($userContacts);
					}

			}
	}
}
