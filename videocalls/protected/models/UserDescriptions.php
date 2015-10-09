<?php
/**
 * ActiveRecord Class to represent Table UserDescriptions in DB
 * @author stefan
 * @version 1.0
 * @package application.models.activeRecords
**/
class UserDescriptions extends CActiveRecord {


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
			//'currentUserStories' => array(self::BELONGS_TO, 'Users', 'userID'),
			'user' => array(self::HAS_ONE, 'Users', 'userID'),
        );
    }
		
}

?>