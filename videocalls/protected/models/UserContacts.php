<?php
/**
* ActiveRecord Class to represent Contacts in DB
 * @author stefan
 * @version 1.0
 * @package application.models.activeRecords
**/
class UserContacts extends CActiveRecord {

	/**
	* default ctor for ActiveRecords
	* @param string $className default param classname
	*/
	public static function model($className=__CLASS__) {
			return parent::model($className);
		}

	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			//'currentUser' => array(self::HAS_ONE, 'Users', 'userID'),
			//'contactName' => array(self::HAS_ONE, 'Users', 'userName'),
			'contactStories' => array(self::HAS_MANY, 'UserDescriptions', array('userID'=>'contactID')),
			'contactName' => array(self::HAS_ONE, 'Users', array('userID'=>'contactID')),
			//'userStories' => array(self::MANY_MANY, 'UserDescriptions', array('contactID', 'userID')),
        );
    }
		
}

?>