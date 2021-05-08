<?php

class Municipio extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'municipio':
	 * @var integer $idmunicipio
	 * @var integer $iduf
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
		return 'municipio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome','length','max'=>80),
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
			'bairros' => array(self::HAS_MANY, 'Bairro', 'idmunicipio'),
			'colaboradors' => array(self::HAS_MANY, 'colaborador', 'idmunicipio'),
			'iduf0' => array(self::BELONGS_TO, 'Uf', 'iduf'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmunicipio' => 'Idmunicipio',
			'iduf' => 'Iduf',
			'nome' => 'Nome',
		);
	}
}