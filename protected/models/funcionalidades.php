<?php

class Funcionalidades extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'funcionalidades':
	 * @var integer $idfuncionalidade
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
		return 'funcionalidades';
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
			'acessos' => array(self::HAS_MANY, 'Acesso', 'idfuncionalidade'),
			'logacessos' => array(self::HAS_MANY, 'Logacesso', 'Funcionalidades_idFuncionalidade'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idfuncionalidade' => 'Idfuncionalidade',
			'descricao' => 'Descricao',
		);
	}
}