<?php

/** Modelagem do colaborador.
 *  Atualizada em: 17/07/2026
 *  @author Felipe André <felipeandre.eng@gmail.com>
 */
class colaborador extends CActiveRecord {

	var $inscPublico = null;

	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'colaborador';
	}

	/** @return array relational rules. */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'banco' => array(self::BELONGS_TO, 'banco', 'colab_banco_id'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'insc_colab_id'),
			'instituicoesDirigidas' => array(self::HAS_MANY, 'instituicao', 'inst_coordenador_id'),
			'usuarios' => array(self::HAS_MANY, 'usuario', 'user_colab_id'),
			'categoria' => array(self::BELONGS_TO, 'categoria', 'colab_categoria_id')
		);
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{

		return array(

			// Identificação
			array('colab_nome','length','max'=>60),
			array('colab_cpf', 'ext.validators.CPFValidator','message'=>'O número de CPF informado é inválido!'),
			array('colab_cpf', 'unique',"allowEmpty"=>false, 'attributeName'=>'colab_cpf','className'=>'colaborador', 'message'=>'O {attribute} "{value}" já foi cadastrado.','on'=>'create'),
			array('colab_nascimento', 'type', 'type'=>'date',
                'dateFormat'=>Yii::app()->locale->dateFormat,
                'message' => '{attribute} inválida'
            ),
			array('colab_sexo'    ,'length','max' =>  1),

			// Contatos
			array('colab_celular','length','max' => 18),
			array('colab_email'  ,'length','max' => 60),

			// Informações Bancárias
			array('colab_agencia' ,'length','max' =>  4),
			array('colab_conta'   ,'length','max' => 20),
			array('colab_conta_dv','length','max' =>  1),
            
			// Campos Obrigatórios
			array('colab_nome, colab_cpf, colab_nascimento, colab_sexo, colab_banco_id, colab_celular, colab_agencia, colab_conta, colab_conta_dv, colab_categoria_id', 'required'),
			array('colab_cpf','required', 'on'=>'formCPF'),
			array('colab_celular, colab_email, colab_nascimento, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv','required', 'on'=>'inscricaoPublico'),
			array('colab_banco_id, colab_categoria_id', 'numerical', 'integerOnly' => true)
		);
	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

			// Identificação
			'colab_id_pk'           => 'Nº da Ficha',
			'colab_nome'            => 'Nome (sem abreviações)',
			'colab_cpf'             => 'CPF' ,
			'colab_nascimento'      => 'Dt. Nascim.',
			'colab_sexo'            => 'Sexo',

			// Contatos
			'colab_celular' => 'Celular',
			'colab_email'   => 'e-mail',
			
			// Informações Bancárias
			'colab_banco_id' => 'Banco',
			'colab_agencia'  => 'Agência',
			'colab_conta'    => 'Nº da Conta',
			'colab_conta_dv' => 'DV da Conta',

			// Informações Cadastrais
			'colab_categoria_id' => 'Categoria',
			'colab_obs'          => 'Observações'
			
		);
	}

	/** Prepara alguns campos antes de serem validados. */
	protected function beforeValidate(){

		$this->colab_cpf = preg_replace( '/[^0-9]/is', '', $this->colab_cpf);

		return true;
	}

	/** Prepara os campos antes de serem salvos no BD. */
	protected function beforeSave(){

		if (!parent::beforeSave())
			return false;

		// Recuperando dados da sessão
		$session = Yii::app()->getSession();	
		$usuario = $session["usuario"];
		
		// Extraindo apenas números dessas Strings
		$this->colab_cpf     = preg_replace( '/[^0-9]/is', '', $this->colab_cpf    );
		$this->colab_celular = preg_replace( '/[^0-9]/is', '', $this->colab_celular);

		// Remove zeros do início da conta
		$this->colab_conta = ltrim($this->colab_conta, "0");

		// Preenche os campos de data
		$this->colab_create_date = date('Y-m-d H:i:s',time());
		$this->colab_update_date = date('Y-m-d H:i:s',time());

		// Vincula no objeto 'colaborador' qual usuário o criou/atualizou
		if (isset($usuario))
			$this->colab_update_id = $usuario->colaborador->colab_id_pk;

		return true;
	}

	// Definição dos Sexos (apenas ajustando os nomes para as views)
	const SEXO_MASCULINO = 'M';
	const SEXO_FEMININO  = 'F';

	public function getSexoOptions() {

		return array(

			self::SEXO_MASCULINO => 'Masculino',
			self::SEXO_FEMININO  => 'Feminino'

		);

	}
	
	public function getSexoText() {

		$options = $this->sexoOptions;
		return isset($options[$this->colab_sexo]) ? $options[$this->colab_sexo] : "desconhecido ({$this->colab_sexo})";

	}
	
	public function behaviors(){
		return array('datetimeI18NBehavior'=>array('class'=>'ext.DateTimeI18NBehavior'));
	}

	// Retorna o CPF com a sua devida máscara (apenas se o CPF tiver exatamente 11 dígitos)
	public function getCpfFormatado() {
		return (strlen($this->colab_cpf) == 11) ? vsprintf("%s%s%s.%s%s%s.%s%s%s-%s%s", str_split($this->colab_cpf)) : $this->colab_cpf;
	}

	public function getCelularFormatado() {
		return (strlen($this->colab_celular) == 11) ? vsprintf("(%s%s) %s%s%s%s%s-%s%s%s%s", str_split($this->colab_celular)) : $this->colab_celular;
	}

	// Retorna o nome do colaborador com apenas a primeira letra maiúscula
	public function getNomeProprio() {
	
		if ($this->colab_nome == null)
			return null;
		
		$retorno = array();
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