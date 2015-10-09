<?php
/**
* ActiveRecord Class to represent Users in DB
 * @author stefan
 * @version 1.0
 * @package application.models.activeRecords
**/
class UserMusic extends CActiveRecord {

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
        );
    }
	
}

?>