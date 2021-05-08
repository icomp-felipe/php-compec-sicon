<?php

class etapa extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'etapa':
	 * @var integer $idetapa
	 * @var integer $idconcurso
	 * @var integer $numero
	 * @var integer $status_etapa
	 * @var string $data_realizacao
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
		return 'etapa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('numero, status_etapa', 'numerical', 'integerOnly'=>true),
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
			'config_concursos' => array(self::HAS_MANY, 'configConcurso', 'idetapa'),
			'concurso' => array(self::BELONGS_TO, 'concurso', 'idconcurso'),
			'inscricaos' => array(self::MANY_MANY, 'inscricao', 'etapa_faltas(idinscricao, idetapa)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idetapa' => 'Idetapa',
			'idconcurso' => 'Idconcurso',
			'numero' => 'Numero',
			'status_etapa' => 'Status Etapa',
			'data_realizacao' => 'Data Realizacao',
		);
	}
	
	public function getEtapa($id=null)
	{
	
		if($id==null)
			$id = $this->idetapa;
			
		return $this->model()->findbyPk($id);
	}	
		
}