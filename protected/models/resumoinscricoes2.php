<?php

class Resumoinscricoes2 extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'resumoinscricoes2':
	 * @var integer $idconcurso
	 * @var integer $idetapa
	 * @var integer $idinstituicao
	 * @var integer $cod_interno
	 * @var string $escola
	 * @var integer $idfuncao
	 * @var string $funcao
	 * @var string $tipoinscricao
	 * @var double $inscritos
	 * @var string $candidatoscientes
	 * @var string $candidatosselecionados
	 * @var double $vagasofertadas
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
		return 'resumoinscricoes2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('escola','length','max'=>100),
			array('funcao','length','max'=>20),
			array('tipoinscricao','length','max'=>13),
			array('candidatoscientes','length','max'=>23),
			array('candidatosselecionados','length','max'=>23),
			array('idconcurso, idetapa, idinstituicao, cod_interno, idfuncao', 'numerical', 'integerOnly'=>true),
			array('inscritos, vagasofertadas', 'numerical'),
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
			'idconcurso' => 'Idconcurso',
			'idetapa' => 'Idetapa',
			'idinstituicao' => 'Idinstituicao',
			'cod_interno' => 'Cod Interno',
			'escola' => 'Escola',
			'idfuncao' => 'Idfuncao',
			'funcao' => 'Funcao',
			'tipoinscricao' => 'Tipoinscricao',
			'inscritos' => 'Inscritos',
			'candidatoscientes' => 'Candidatoscientes',
			'candidatosselecionados' => 'Candidatosselecionados',
			'vagasofertadas' => 'Vagasofertadas',
		);
	}
}