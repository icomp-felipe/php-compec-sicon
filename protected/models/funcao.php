<?php

class funcao extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'funcao':
	 * @var integer $idFuncao
	 * @var string $nome
	 * @var string $descricao
	 * @var integer $idEscolaridade
	 * @var integer $anominimograduacao
	 * @var integer $inclui_internet
	 * @var string $atividade
	 * @var string $cargahoraria
	 * @var string $valorhora
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
		return 'funcao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome','length','max'=>20),
			array('descricao','length','max'=>50),
			array('atividade','length','max'=>45),
			array('cargahoraria','length','max'=>5),
			array('valorhora','length','max'=>5),
			array('atividade, valorhora', 'required'),
			array('anominimograduacao, inclui_internet', 'numerical', 'integerOnly'=>true),
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
			'config_concursos' => array(self::HAS_MANY, 'configConcurso', 'idFuncao'),
			'idEscolaridade0' => array(self::BELONGS_TO, 'escolaridade', 'idEscolaridade'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idFuncao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idFuncao' => 'Id Funcao',
			'nome' => 'Nome',
			'descricao' => 'Descricao',
			'idEscolaridade' => 'Id Escolaridade',
			'anominimograduacao' => 'Anominimograduacao',
			'inclui_internet' => 'Inclui Internet',
			'atividade' => 'Atividade',
			'cargahoraria' => 'Cargahoraria',
			'valorhora' => 'Valorhora',
		);
	}
}