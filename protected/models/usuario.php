<?php

class usuario extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'usuario':
	 * @var integer $idUsuario
	 * @var integer $idgrupo
	 * @var string $situacao
	 * @var string $usuario
	 * @var string $nome_usuario
	 * @var string $senha_usuario
	 * @var string $email_usuario
	 * @var string $data_cadastro
	 * @var integer $idColaborador
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
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('situacao','length','max'=>1),
			array('usuario','length','max'=>20),
			array('nome_usuario','length','max'=>40),
			array('senha_usuario','length','max'=>100),
			array('email_usuario','length','max'=>60),
			array('situacao', 'required'),
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
			'colaborador' => array(self::BELONGS_TO, 'colaborador', 'idColaborador'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUsuario' => 'Id Usuario',
			'situacao' => 'Situacao',
			'usuario' => 'Usuario',
			'nome_usuario' => 'Nome Usuario',
			'senha_usuario' => 'Senha Usuario',
			'email_usuario' => 'Email Usuario',
			'data_cadastro' => 'Data Cadastro',
			'idColaborador' => 'Id Colaborador',
		);
	}
	
}