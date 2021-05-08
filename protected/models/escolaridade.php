<?php

class Escolaridade extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'escolaridade':
	 * @var integer $idescolaridade
	 * @var string $descricao
	 * @var integer $nivel
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
		return 'escolaridade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('descricao','length','max'=>40),
			array('nivel', 'required'),
			array('nivel', 'numerical', 'integerOnly'=>true),
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
			'colaboradors' => array(self::HAS_MANY, 'colaborador', 'idescolaridade'),
			'funcaos' => array(self::HAS_MANY, 'funcao', 'idEscolaridade'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idescolaridade' => 'Idescolaridade',
			'descricao' => 'Descricao',
			'nivel' => 'Nivel',
		);
	}
}