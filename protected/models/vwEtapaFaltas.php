<?php

class VwEtapaFaltas extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'vw_etapa_faltas':
	 * @var integer $idcolaborador
	 * @var string $nome
	 * @var integer $idconcurso
	 * @var integer $idinscricao
	 * @var integer $idetapa
	 * @var integer $idinstituicao
	 * @var string $nome_instituicao
	 * @var integer $cod_interno
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
		return 'vw_etapa_faltas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome','length','max'=>60),
			array('nome_instituicao','length','max'=>100),
			array('idinscricao, idetapa', 'required'),
			array('idcolaborador, idconcurso, idinscricao, idetapa, idinstituicao, cod_interno', 'numerical', 'integerOnly'=>true),
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
			'idcolaborador' => 'Idcolaborador',
			'nome' => 'Nome',
			'idconcurso' => 'Idconcurso',
			'idinscricao' => 'Idinscricao',
			'idetapa' => 'Idetapa',
			'idinstituicao' => 'Idinstituicao',
			'nome_instituicao' => 'Nome Instituicao',
			'cod_interno' => 'Cod Interno',
		);
	}
}