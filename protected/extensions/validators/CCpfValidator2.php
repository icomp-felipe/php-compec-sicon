<?php
/**
 * CCpfValidator class file.
 *
 */

/**
 * CCpfValidator validates CPF.
 *
 * @author Ricardo Granae <rickgrana@yahoo.com.br>
  * @package system.validators
 * @since 1.0
 */
class CCpfValidator2 extends CValidator
{
	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel the object being validated
	 * @param string the attribute being validated
	 */
	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
		
		if ((strlen($value) > 0) and (!$this->validarCPF($value)))
		{
			$message=$this->message!==null?$this->message:Yii::t('yii','{attribute} is invalid.');
			$this->addError($object,$attribute,$message);
		}
	}
	
	function validarCPF($cpf) {
 
		// Extrai somente os números
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
		 
		// Verifica se foi informado todos os digitos corretamente
		if (strlen($cpf) != 11) {
			return false;
		}
	
		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}
	
		// Faz o calculo para validar o CPF
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
			}
		}
		return true;
	
	
	}
	
}
