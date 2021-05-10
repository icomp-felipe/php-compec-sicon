<?php

/** Implementa o algoritmo de verificação de PIS/PASEP/NIS/NIT.
 *  @author Felipe André <felipeandresouza@hotmail.com>
 *  @package system.validators
 *  @version 1.0, 09/05/2021 */
class PISValidator extends CValidator {

	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel the object being validated
	 * @param string the attribute being validated
	 */
	protected function validateAttribute($object,$attribute) {

		$value = $object->$attribute;
		
		if ((strlen($value) > 0) and (!$this->validaPIS($value))) {

			$message = $this->message !== null ? $this->message : Yii::t('yii','{attribute} is invalid.');
			$this->addError($object,$attribute,$message);

		}

	}
	
	/** Verifica se um número de PIS/PASEP/NIS/NIT é válido. */
	function validaPIS($pis) {

		// Se o pis recebido for nulo, encerro o código aqui
		if ($pis == null)
			return false;
 
		// Extraindo apenas os números do PIS
		$pis = preg_replace('/[^0-9]/is', '', $pis);

		// Verifica se o PIS tem 11 dígitos
		if (strlen($pis) != 11)
			return false;

		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $pis))
			return false;
		
		/**************** Cálculo propriamente dito ****************/
       
		// Criando o vetor de pesos
		$pesos = [3,2,9,8,7,6,5,4,3,2];
		
		// Soma de produtos dos vetores
		$soma_prod = 0;

		for ($i=0; $i<10; $i++)
			$soma_prod += ($pis[$i] * $pesos[$i]);
		
		// Cálculo do dígito verificador
		$resto_divs  = ($soma_prod  % 11);
		$verificador = ($resto_divs < 2 ) ? 0 : (11 - $resto_divs);

		// Validação do dígito verificador
		return ($verificador == $pis[10]);
	
	}
	
}