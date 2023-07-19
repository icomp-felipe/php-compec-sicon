<?php

class FormInscricaoConsulta extends CFormModel {

    public $colab_cpf;
    public $colaborador = null;
    public $concurso    = null;

    public function rules() {

		return array(

			// CPF é um campo obrigatório no cenário 'identificacao'
			array('colab_cpf', 'required','on' => 'identificacao'),

			// Validação (externa) dos dígitos do CPF, no cenário 'identificacao'
			array('colab_cpf', 'ext.validators.CPFValidator','message' => 'O CPF informado é inválido!','on' => 'identificacao'),

            // Validação (interna) do colaborador, no cenário 'identificacao':
			// 1. verifica se o mesmo possui cadastro;
			array('colab_cpf', 'validarColaborador', 'on' => 'identificacao'),

            // 2. verifica ainda se o colaborador possui inscrição em algum concurso, como colaborador.
            array('colab_cpf', 'verificaInscricoes', 'on' => 'identificacao')

		);
	}

	public function attributeLabels() {
		return array(

			'colab_cpf' => 'CPF'

		);
	}

    /** Verifica se o colaborador, identificado por seu CPF, possui cadastro na base de dados. */
	public function validarColaborador($attribute, $params) {

		if (!$this->hasErrors()) {

            // Extrai apenas os dígitos do CPF
	        $colab_cpf = preg_replace( '/[^0-9]/is', '', $this->colab_cpf);
		
		    // Recuperando o colaborador da base de dados
		    $this->colaborador = colaborador::model()->findByAttributes(array('colab_cpf' => $colab_cpf));

			// Verifica se o colaborador possui cadastro
		    if ($this->colaborador == null)
				$this->addError('colab_cpf','Colaborador sem cadastrado na Base de Dados da COMPEC.');


		}

	}

    /** Verifica se o colaborador possui inscrição em algum concurso da COMPEC. */
	public function verificaInscricoes($attribute, $params) {
	
		if (!$this->hasErrors()) {
			
			// Recupera a quantidade de inscrições de um colaborador
			$inscricoes = inscricao::model()->count('insc_colab_id = :colab_id_pk', array(':colab_id_pk' => $this->colaborador->colab_id_pk));
			
			// Se não existe inscrição, um erro é gerado
			if ($inscricoes == 0)
				$this->addError('colab_cpf','Colaborador não possui nenhuma inscrição em nenhum concurso da COMPEC!');

		}

	}

}