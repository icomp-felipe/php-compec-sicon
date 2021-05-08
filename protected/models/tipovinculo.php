<?php

class Tipovinculo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tipovinculo':
	 * @var integer $idtipovinculo
	 * @var string $nome
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipovinculo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome','length','max'=>100),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'vinculopreferencials' => array(self::HAS_MANY, 'Vinculopreferencial', 'idtipovinculo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtipovinculo' => 'Idtipovinculo',
			'nome' => 'Nome',
		);
	}
}