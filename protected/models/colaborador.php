<?php

/** Modelagem do colaborador.
 *  Atualizada em: 13/09/2021
 *  @author Felipe André <felipeandresouza@hotmail.com>
 */
class colaborador extends CActiveRecord {

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
			'municipio' => array(self::BELONGS_TO, 'municipio', 'colab_municipio_id'),
			'banco' => array(self::BELONGS_TO, 'banco', 'colab_banco_id'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idColaborador'),
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
			array('colab_pis', 'ext.validators.PISValidator','message'=>'O número de PIS | PASEP | NIS | NIT informado é inválido!'),
			array('colab_cpf', 'unique',"allowEmpty"=>false, 'attributeName'=>'colab_cpf','className'=>'colaborador', 'message'=>'O {attribute} "{value}" já foi cadastrado.','on'=>'create'),
			array('colab_nascimento', 'type', 'type'=>'date',
                'dateFormat'=>Yii::app()->locale->dateFormat,
                'message' => '{attribute} inválida'
            ),
			array('colab_sexo'    ,'length','max' =>  1),
			array('colab_pis'     ,'length','max' => 18),
			array('colab_rg'      ,'length','max' => 20),
			array('colab_rg_orgao','length','max' => 15),
			
			// Endereço
			array('colab_logradouro'       ,'length','max' => 100),
			array('colab_logradouro_numero','length','max' =>  10),
			array('colab_bairro'           ,'length','max' =>  80),
			array('colab_cep'              ,'length','max' =>   9),
			array('colab_complemento'      ,'length','max' =>  75),

			// Contatos
			array('colab_celular_1','length','max' => 18),
			array('colab_email'    ,'length','max' => 60),

			// Informações Bancárias
			array('colab_agencia' ,'length','max' =>  4),
			array('colab_conta'   ,'length','max' => 20),
			array('colab_conta_dv','length','max' =>  1),
            
			// Campos Obrigatórios
			array('colab_nome, colab_cpf, colab_sexo, colab_pis, colab_rg, colab_rg_orgao, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv, colab_categoria_id', 'required'),
			array('colab_cpf','required', 'on'=>'formCPF'),
			array('colab_pis, colab_rg, colab_email, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv','required', 'on'=>'inscricaoPublico'),
			array('colab_status, colab_banco_id, colab_categoria_id', 'numerical', 'integerOnly' => true)
		);
	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

			// Identificação
			'colab_id_pk'           => 'Nº da Ficha',
			'colab_nome'            => 'Nome',
			'colab_cpf'             => 'CPF' ,
			'colab_nascimento'      => 'Data de Nascimento',
			'colab_sexo'            => 'Sexo',
			'colab_pis'             => 'PIS/PASEP',
			'colab_rg'              => 'Nº do RG',
			'colab_rg_orgao'        => 'Órgão',

			// Endereço
			'colab_logradouro'        => 'Rua/Av',	
			'colab_logradouro_numero' => 'Número',
			'colab_bairro'            => 'Bairro',
			'colab_municipio_id'      => 'Município',
			'colab_cep'               => 'CEP',
			'colab_complemento'       => 'Complemento',

			// Contatos
			'colab_celular_1' => 'Celular',
			'colab_email'     => 'e-mail',
			
			// Informações Bancárias
			'colab_banco_id' => 'Banco',
			'colab_agencia'  => 'Agência',
			'colab_conta'    => 'Nº da Conta',
			'colab_conta_dv' => 'DV da Conta',

			// Informações Cadastrais
			'colab_categoria_id' => 'Categoria',
			'colab_status'       => 'Status Cadastro',
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
		$this->colab_cep       = preg_replace( '/[^0-9]/is', '', $this->colab_cep      );
		$this->colab_cpf       = preg_replace( '/[^0-9]/is', '', $this->colab_cpf      );
		$this->colab_pis       = preg_replace( '/[^0-9]/is', '', $this->colab_pis      );
		$this->colab_fixo      = preg_replace( '/[^0-9]/is', '', $this->colab_fixo     );
		$this->colab_celular_1 = preg_replace( '/[^0-9]/is', '', $this->colab_celular_1);
		$this->colab_celular_2 = preg_replace( '/[^0-9]/is', '', $this->colab_celular_2);

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
	
	// Definição dos Status de Cadastro (no código mesmo pq não tem modelo)
	const STATUS_PRE_CADASTRO = 0;
	const STATUS_ATIVADO      = 1;
	const STATUS_REJEITADO    = 2;
	const STATUS_INCOMPLETO   = 3;

	public function getStatusOptions() {

		return array(

			self::STATUS_PRE_CADASTRO => 'Pré-Cadastro',
			self::STATUS_ATIVADO      => 'Ativado',
			self::STATUS_REJEITADO    => 'Bloqueado',
			self::STATUS_INCOMPLETO   => 'Incompleto'

		);

	}

	public function getStatusText() {

		$options = $this->statusOptions;
		return isset($options[$this->colab_status]) ? $options[$this->colab_status] : "desconhecido ({$this->colab_status})";

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

	// Retorna o PIS com a sua devida máscara (apenas se o PIS tiver exatamente 11 dígitos)
	public function getPisFormatado() {
		return (strlen($this->colab_pis) == 11) ? vsprintf("%s%s%s.%s%s%s%s%s.%s%s-%s", str_split($this->colab_pis)) : $this->colab_pis;
	}
	
	// Retorna o CPF com a sua devida máscara (apenas se o CPF tiver exatamente 11 dígitos)
	public function getCpfFormatado() {
		return (strlen($this->colab_cpf) == 11) ? vsprintf("%s%s%s.%s%s%s.%s%s%s-%s%s", str_split($this->colab_cpf)) : $this->colab_cpf;
	}

	public function getCelularFormatado() {
		return (strlen($this->colab_celular_1) == 11) ? vsprintf("(%s%s) %s%s%s%s%s-%s%s%s%s", str_split($this->colab_celular_1)) : $this->colab_celular_1;
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