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
			'inscricao' => array(self::BELONGS_TO, 'inscricao', 'insc_id_pk'),
			'instituicao' => array(self::BELONGS_TO, 'instituicao', 'mapa_inst_id'),
			'concurso' => array(self::BELONGS_TO, 'concurso', 'fconc_conc_id'),
            'colaborador' => array(self::BELONGS_TO, 'colaborador', 'colab_id_pk')
		);
	}

    /** @return array validation rules for model attributes. */
	public function rules()	{

		/*return array(
			array('idColaborador, idinscricao, idinstituicao, idconcurso', 'numerical', 'integerOnly' => true)
		);*/
	}

    /** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

            'insc_id_pk'      => '#',
            'colab_cpf'              => 'CPF' ,            
            'colab_nome'             => 'Nome',
            'func_apelido'           => 'Função',

			'colab_id_pk'    => 'Nº da Ficha'
			
		);
	}

    // Retorna o CPF com a sua devida máscara (apenas se o CPF tiver exatamente 11 dígitos)
	public function getCpfFormatado() {
		return (strlen($this->colab_cpf) == 11) ? vsprintf("%s%s%s.%s%s%s.%s%s%s-%s%s", str_split($this->colab_cpf)) : $this->colab_cpf;
	}

	// Retorna o nome do colaborador com apenas a primeira letra maiúscula
	public function getNomeProprio() {

		if ($this->colab_nome == null)
			return null;
		
		$string = mb_strtolower(trim(preg_replace("/\s+/", " ", $this->colab_nome)));
		$palavras = explode(" ", $string);

		$t = count($palavras);

		for ($i=0; $i < $t; $i++) {

            $retorno[$i] = ucfirst($palavras[$i]);

            if ($retorno[$i] == "Dos" || $retorno[$i] == "De" || $retorno[$i] == "Do" || $retorno[$i] == "Da" || $retorno[$i] == "E" || $retorno[$i] == "Das"):
                $retorno[$i] = mb_strtolower($retorno[$i]);
            endif;

        }
        return implode(" ", $retorno);
	}

}