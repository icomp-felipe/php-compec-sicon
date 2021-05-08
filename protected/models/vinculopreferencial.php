<?php

class Vinculopreferencial extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'vinculopreferencial':
	 * @var integer $idvinculopreferencial
	 * @var integer $idconcurso
	 * @var integer $idtipovinculo
	 * @var integer $nivelpreferencia
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
		return 'vinculopreferencial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nivelpreferencia', 'numerical', 'integerOnly'=>true),
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
			'idtipovinculo0' => array(self::BELONGS_TO, 'Tipovinculo', 'idtipovinculo'),
			'idconcurso0' => array(self::BELONGS_TO, 'Concurso', 'idconcurso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idvinculopreferencial' => 'Idvinculopreferencial',
			'idconcurso' => 'Idconcurso',
			'idtipovinculo' => 'Idtipovinculo',
			'nivelpreferencia' => 'Nivelpreferencia',
		);
	}
}