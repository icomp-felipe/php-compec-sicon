<?php

class Servidoresufam extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'servidoresufam':
	 * @var string $cpf
	 * @var string $nome
	 * @var string $Situacao
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
		return 'servidoresufam';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('cpf','length','max'=>15),
			array('nome','length','max'=>200),
			array('Situacao','length','max'=>45),
			array('cpf, nome, Situacao', 'required'),
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
			'cpf' => 'Cpf',
			'nome' => 'Nome',
			'Situacao' => 'Situacao',
		);
	}
}