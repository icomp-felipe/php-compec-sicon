<?php

/** View do inscriçômetro.
 *  Criada em: 31/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class inscricometro extends CActiveRecord {

    /** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'inscricometro';
	}

}