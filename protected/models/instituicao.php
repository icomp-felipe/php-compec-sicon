<?php

class instituicao extends CActiveRecord {

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
		return 'instituicao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('inst_nome'      ,'length','max' => 100),
			array('inst_apelido'   ,'length','max' =>  45),
			array('inst_logradouro','length','max' =>  50),
			array('inst_numero'    ,'length','max' =>   5),
			array('inst_bairro'    ,'length','max' =>  50),
			array('inst_cep'       ,'length','max' =>   8),
			array('inst_maps'      ,'length','max' =>  40),
			array('inst_telefone'  ,'length','max' =>  15),
			array('inst_celular'   ,'length','max' =>  15),
			array('inst_email'     ,'length','max' =>  60),
			array('inst_codigo, inst_salas, inst_coordenador_id, inst_tipo', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()	{
		
		// 'variável interna' => array(self::HAS_MANY  , 'tabela relacionada', 'indice da tabela relacionada')
		// 'variável interna' => array(self::BELONGS_TO, 'tabela relacionada', 'indice desta tabela')
		return array(
			'concursos'        => array(self::HAS_MANY, 'concurso', 'idinstituicaorealizadora'),
			'config_concursos' => array(self::HAS_MANY, 'configConcurso', 'idinstituicao'),
			'inscricaos'       => array(self::HAS_MANY, 'inscricao', 'idinstituicaoopcao2'),
			'inst_municipio'   => array(self::BELONGS_TO, 'municipio', 'inst_municipio_id'),
			'inst_uf'          => array(self::BELONGS_TO, 'uf', 'inst_uf_id'),
			'responsavel'      => array(self::BELONGS_TO, 'colaborador', 'inst_coordenador_id'),
			'vinculos'         => array(self::HAS_MANY, 'vinculo', 'idinstituicao')
		);
	}

	public function attributeLabels() {
		return array(

			'inst_id_pk'      => '#',
			'inst_codigo'     => 'Código',
			'inst_nome'       => 'Nome',
			'inst_apelido'    => 'Apelido',
			'inst_salas'      => 'Qtd. Salas',
			'inst_logradouro' => 'Rua/Av.',
			'inst_numero'     => 'Número',
			'inst_bairro'     => 'Bairro',
			'inst_cep'        => 'CEP',
			'inst_maps'       => 'Localização (Google)',
			'inst_telefone'   => 'Tel. Fixo',
			'inst_celular'    => 'Cel.',
			'inst_email'      => 'e-mail'

		);
	}
	
	public function getEndereco() {
		return $this->inst_logradouro . ', ' .
					(isset($this->numero) ? $this->numero : 's/n') . ', ' .
					$this->inst_bairro . ', ' .
					$this->inst_municipio->nome . ' - ' .
					$this->inst_uf->sigla;
	}

	public function getEtapasEmQueParticipou($id=null)
	{
	
		$data = array(
				'order'=>'idetapa desc',
				'condition'=>'idinstituicao = '.$id);

		$criteria=new CDbCriteria($data);
		$criteria->distinct = true;
		$criteria->select = array('idetapa');

		return configConcurso::model()->findAll($criteria);
	}	
	

	public function getInstituicao($id=null)
	{
	
		if($id==null)
			$id = $this->inst_id_pk;
			
		return $this->model()->findByPk($id);
	}	
	
	public function getNomeSemId() {
		return $this->inst_nome;
	}
	
}