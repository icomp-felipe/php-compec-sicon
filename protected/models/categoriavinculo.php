<?php

class Categoriavinculo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'categoriavinculo':
	 * @var integer $idCategoriaVinculo
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
		return 'categoriavinculo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCategoriaVinculo' => 'Id Categoria Vinculo',
			'descricao' => 'Descricao',
		);
	}
}