<?php

/** Modelagem do colaborador.
 *  Criada em: 11/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class inscritos extends CActiveRecord {

    /** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'inscritos';
	}

    /** @return array relational rules. */
	public function relations()	{
		return array(
			'idinscricao' => array(self::BELONGS_TO, 'inscricao', 'idinscricao'),
			'idinstituicao' => array(self::BELONGS_TO, 'instituicao', 'idinstituicao'),
			'idetapa' => array(self::BELONGS_TO, 'etapa', 'idetapa'),
            'idColaborador' => array(self::BELONGS_TO, 'colaborador', 'idColaborador')
		);
	}

    /** @return array validation rules for model attributes. */
	public function rules()	{

		return array(
			array('idColaborador, idinscricao, idinstituicao, idetapa', 'numerical', 'integerOnly' => true)
		);
	}

    /** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

            'idinscricao'      => '#',
            'cpf'              => 'CPF' ,            
            'nome'             => 'Nome',
            'funcao'           => 'Função',

			'idColaborador'    => 'Nº da Ficha'
			
		);
	}

    // Retorna o CPF com a sua devida máscara (apenas se o CPF tiver exatamente 11 dígitos)
	public function getCpfFormatado() {
		return (strlen($this->cpf) == 11) ? vsprintf("%s%s%s.%s%s%s.%s%s%s-%s%s", str_split($this->cpf)) : $this->cpf;
	}

}