<?php

class Bairro extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'bairro':
	 * @var integer $idbairro
	 * @var integer $idmunicipio
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
		return 'bairro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome','length','max'=>20),
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
			'idmunicipio0' => array(self::BELONGS_TO, 'municipio', 'idmunicipio'),
			'instituicaos' => array(self::HAS_MANY, 'instituicao', 'idbairro'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idbairro' => 'Idbairro',
			'idmunicipio' => 'Idmunicipio',
			'nome' => 'Nome',
		);
	}
}