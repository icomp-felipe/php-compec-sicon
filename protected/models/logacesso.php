<?php

class Logacesso extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'logacesso':
	 * @var integer $idLogAcesso
	 * @var string $usuario
	 * @var integer $Funcionalidades_idFuncionalidade
	 * @var string $DataHoraAcesso
	 * @var string $Conteudo
	 * @var string $AcaoRealizada
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
		return 'logacesso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('usuario','length','max'=>20),
			array('Conteudo','length','max'=>100),
			array('AcaoRealizada','length','max'=>1),
			array('usuario', 'required'),
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
			'funcionalidades_idFuncionalidade' => array(self::BELONGS_TO, 'Funcionalidades', 'Funcionalidades_idFuncionalidade'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idLogAcesso' => 'Id Log Acesso',
			'usuario' => 'Usuário',
			'Funcionalidades_idFuncionalidade' => 'Funcionalidades Id Funcionalidade',
			'DataHoraAcesso' => 'Data Hora Acesso',
			'Conteudo' => 'Conteudo',
			'AcaoRealizada' => 'Ação Realizada',
		);
	}
}
