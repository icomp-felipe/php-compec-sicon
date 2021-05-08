<?php

class Menu extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'menu':
	 * @var integer $idMenu
	 * @var string $Descricao
	 * @var integer $Ordem
	 * @var string $Orientacao
	 * @var integer $Largura
	 * @var integer $Altura
	 * @var integer $PosVertical
	 * @var integer $PosHorizontal
	 * @var integer $Menu_idMenu
	 * @var integer $Funcionalidades_idFuncionalidade
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
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('Descricao','length','max'=>60),
			array('Orientacao','length','max'=>1),
			array('Orientacao, Largura, Altura, PosVertical, PosHorizontal', 'required'),
			array('Ordem, Largura, Altura, PosVertical, PosHorizontal, Menu_idMenu, Funcionalidades_idFuncionalidade', 'numerical', 'integerOnly'=>true),
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
			'idMenu' => 'Id Menu',
			'Descricao' => 'Descricao',
			'Ordem' => 'Ordem',
			'Orientacao' => 'Orientacao',
			'Largura' => 'Largura',
			'Altura' => 'Altura',
			'PosVertical' => 'Pos Vertical',
			'PosHorizontal' => 'Pos Horizontal',
			'Menu_idMenu' => 'Menu Id Menu',
			'Funcionalidades_idFuncionalidade' => 'Funcionalidades Id Funcionalidade',
		);
	}
}