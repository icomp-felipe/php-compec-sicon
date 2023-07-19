<?php

class inscricao extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'inscricao':
	 * @var integer $idinscricao
	 * @var integer $idinstituicaoopcao2
	 * @var integer $idinstituicaoopcao1
	 * @var integer $idconcurso
	 * @var integer $idColaborador
	 * @var string $selecionado
	 * @var integer $codinscricao
	 * @var integer $tipoinscricao
	 * @var string $candidatociente
	 * @var integer $idFuncao
	 * @var string $dt_hr
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
		return 'inscricao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			//array('selecionado','length','max'=>1),
			//array('candidatociente','length','max'=>1),
			//array('dt_hr', 'required'),
			//array('codinscricao, tipoinscricao', 'numerical', 'integerOnly'=>true)
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
			'colaborador' => array(self::BELONGS_TO, 'colaborador', 'insc_colab_id'),
			'mapa' => array(self::BELONGS_TO, 'mapa', 'insc_mapa_id')
			//'instituicao' => array(self::BELONGS_TO, 'instituicao', 'idinstituicaoopcao1'),
			//'idinstituicaoopcao20' => array(self::BELONGS_TO, 'instituicao', 'idinstituicaoopcao2'),
			//'funcao' => array(self::BELONGS_TO, 'funcao', 'idFuncao'),
			//'selecaos' => array(self::HAS_MANY, 'selecao', 'idinscricao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idinscricao' => 'Idinscricao',
			'idinstituicaoopcao2' => 'Idinstituicaoopcao2',
			'idinstituicaoopcao1' => 'Idinstituicaoopcao1',
			'idconcurso' => 'Idconcurso',
			'idColaborador' => 'Id Colaborador',
			'selecionado' => 'Selecionado',
			'codinscricao' => 'Codinscricao',
			'tipoinscricao' => 'Tipoinscricao',
			'candidatociente' => 'Candidatociente',
			'idFuncao' => 'Id Funcao',
			'dt_hr' => 'Dt Hr',
		);
	}
	
	
	public static function verificarDuplicidadeInscricao($idcolaborador, $idconcurso)
	{	

		$data = array(
			'condition'=>'insc_ativa and insc_colab_id = :idcolaborador and fconc_conc_id = :idconcurso',
			'join'=>'join mapa m on inscricao.insc_mapa_id = m.mapa_id_pk
					 join funcao_concurso fc on m.mapa_fconc_id = fc.fconc_id_pk',
			'params'=>array('idconcurso' => $idconcurso, 'idcolaborador' => $idcolaborador)
		 );

		$criteria=new CDbCriteria($data);

		return inscricao::model()->find($criteria);
	}	
	
	public static function load($idcolaborador, $idconcurso)
	{	

		$data = array(
			'condition'=>'insc_ativa and insc_colab_id = :insc_colab_id and fconc_conc_id = :fconc_conc_id',
			'join'=>'join mapa m on inscricao.insc_mapa_id = m.mapa_id_pk
					 join funcao_concurso fc on m.mapa_fconc_id = fc.fconc_id_pk',
			'params'=>array('insc_colab_id' => $idcolaborador, 'fconc_conc_id' => $idconcurso)
		 );

		$criteria=new CDbCriteria($data);

		return inscricao::model()->find($criteria);
	}		
	
	public function getTipoinscricaoOptions(){
		return array("1"=> "Internet", "2" => "Institucional");
	}
	
	public function getTipoinscricaoText(){
		$options = $this->getTipoinscricaoOptions();
		return $options[$this->tipoinscricao];
	}

	public static function getInscricoes($concurso, $instituicao) {

		return inscricao::model()->findAllByAttributes(
			array('idFuncao' => array(1,2,3,5), 'tipoinscricao' => 2, 'idconcurso' => $concurso->idconcurso, 'idinstituicaoopcao1' => $instituicao->idinstituicao));

	}

}