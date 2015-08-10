<?php
/***

ActiveRecord Class to represent Users in DB

***/

class Users extends CActiveRecord {

	//MUST HAVE
	public static function model($className=__CLASS__) {
			return parent::model($className);
		}

	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
			'userContacts' => array(self::HAS_MANY, 'UserContacts', 'userID'),
			'userDescriptions' => array(self::HAS_MANY, 'UserDescriptions', 'userID'),
        );
    }
		
}

?>