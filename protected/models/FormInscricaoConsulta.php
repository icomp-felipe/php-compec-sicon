<?php

class FormInscricaoConsulta extends CFormModel {

    public $cpf;
    public $colaborador = null;
    public $concurso    = null;

    public function rules() {

		return array(

			// CPF é um campo obrigatório no cenário 'identificacao'
			array('cpf', 'required','on' => 'identificacao'),

			// Validação (externa) dos dígitos do CPF, no cenário 'identificacao'
			array('cpf', 'ext.validators.CPFValidator','message' => 'O CPF informado é inválido!','on' => 'identificacao'),

            // Validação (interna) do colaborador, no cenário 'identificacao':
			// 1. verifica se o mesmo possui cadastro;
			array('cpf', 'validarColaborador', 'on' => 'identificacao'),

            // 2. verifica ainda se o colaborador possui inscrição em algum concurso, como colaborador.
            array('cpf', 'verificaInscricoes', 'on' => 'identificacao')

		);
	}

	public function attributeLabels() {
		return array(

			'cpf' => 'CPF'

		);
	}

    /** Verifica se o colaborador, identificado por seu CPF, possui cadastro na base de dados. */
	public function validarColaborador($attribute, $params) {

		if (!$this->hasErrors()) {

            // Extrai apenas os dígitos do CPF
	        $cpf = preg_replace( '/[^0-9]/is', '', $this->cpf);
		
		    // Recuperando o colaborador da base de dados
		    $this->colaborador = colaborador::model()->findByAttributes(array('cpf' => $cpf));

			// Verifica se o colaborador possui cadastro
		    if ($this->colaborador == null)
				$this->addError('cpf','Colaborador sem cadastrado na Base de Dados da COMPEC.');


		}

	}

    /** Verifica se o colaborador possui inscrição em algum concurso da COMPEC. */
	public function verificaInscricoes($attribute, $params) {
	
		if (!$this->hasErrors()) {
			
			// Recupera a quantidade de inscrições de um colaborador
			$inscricoes = inscricao::model()->count('idcolaborador = :idcolaborador', array(':idcolaborador' => $this->colaborador->idColaborador));
			
			// Se não existe inscrição, um erro é gerado
			if ($inscricoes == 0)
				$this->addError('cpf','Colaborador não possui nenhuma inscrição em nenhum concurso da COMPEC!');

		}

	}

}