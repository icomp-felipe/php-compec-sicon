<?php

/** Implementa o algoritmo de verificação de CPF.
 *  @author Felipe André <felipeandresouza@hotmail.com>
 *  @package system.validators
 *  @version 1.0, 09/05/2021 */
class CPFValidator extends CValidator {

	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel the object being validated
	 * @param string the attribute being validated
	 */
	protected function validateAttribute($object,$attribute) {

		$value = $object->$attribute;
		
		if ((strlen($value) > 0) and (!$this->validaCPF($value))) {

			$message = $this->message !== null ? $this->message : Yii::t('yii','{attribute} is invalid.');
			$this->addError($object,$attribute,$message);

		}

	}
	
	/** Verifica se um número de PIS/PASEP/NIS/NIT é válido. */
	private function validaCPF($cpf) {

		// Se o cpf recebido for nulo, encerro o código aqui
		if ($cpf == null)
			return false;
 
		// Extraindo apenas os números do CPF
		$cpf = preg_replace('/[^0-9]/is', '', $cpf);

		// Verifica se o CPF tem 11 dígitos
		if (strlen($cpf) != 11)
			return false;

		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf))
			return false;
		
		/**************** Cálculo propriamente dito ****************/
 
	    for ($t = 9; $t < 11; $t++) {
	        for ($d = 0, $c = 0; $c < $t; $c++)
	            $d += $cpf[$c] * (($t + 1) - $c);
	        
			$d = ((10 * $d) % 11) % 10;
	
	        if ($cpf[$c] != $d)
	            return false;

	    }
	
	    return true;
	}
	
}