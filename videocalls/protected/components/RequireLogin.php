<?php
/***
* Class added by stef
* Does: check if user is logged-in when calling a page
* 
*
***/


class RequireLogin extends CBehavior
{
public function attach($owner)
{
    $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
}

public function handleBeginRequest($event)
{
	if(isset($_GET['r'])) {
		if (Yii::app()->user->isGuest && !in_array($_GET['r'],array('site/login'))) {
			Yii::app()->user->loginRequired();
		}
	}
}

}
?>