<?php
 
/**
 * Check if current user is logged in
 * Every Request is checked if User is logged in. If not, user is redirected to Login-Screen
 * 
 * @author stefan
 * @version 1.0
 * @package application.components
 */
class RequireLogin extends CBehavior
{
/**
* function to attach the EventHandler handleBeginRequest to the owning object
* @param object $owner instance of user object
*/
public function attach($owner) {
    $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
}

/**
* function to check if user is logged in and redirect to LoginScreen if not logged in
* @param object $event instance of started request event
*/
public function handleBeginRequest($event) {
	if(isset($_GET['r'])) {
		if (Yii::app()->user->isGuest && !in_array($_GET['r'],array('site/login'))) {
			Yii::app()->user->loginRequired();
		}
	}
}

}
?>