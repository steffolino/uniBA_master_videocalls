<?php
/***

ActiveRecord Class to represent UserDescriptions in DB

***/

class UserDescriptions extends CActiveRecord {


	//MUST HAVE
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