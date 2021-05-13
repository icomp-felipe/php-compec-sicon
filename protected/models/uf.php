<?php

class Uf extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'uf':
	 * @var integer $iduf
	 * @var string $sigla
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
		return 'uf';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('sigla','length','max'=>2),
			array('descricao','length','max'=>20),
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
			'colaboradors' => array(self::HAS_MANY, 'colaborador', 'iduf_identidade'),
			'instituicoes0' => array(self::HAS_MANY, 'instituicao', 'inst_uf_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uf_id_pk' => 'ID',
			'sigla' => 'Sigla',
			'descricao' => 'Descricao',
		);
	}
}