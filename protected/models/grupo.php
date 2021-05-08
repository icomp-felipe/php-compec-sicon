<?php

class grupo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'grupo':
	 * @var integer $idgrupo
	 * @var string $descricao
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
		return 'grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('descricao','length','max'=>40),
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
			'acessos' => array(self::HAS_MANY, 'acesso', 'idgrupo'),
			'usuarios' => array(self::HAS_MANY, 'usuario', 'idgrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idgrupo' => 'Idgrupo',
			'descricao' => 'Descricao',
		);
	}
}