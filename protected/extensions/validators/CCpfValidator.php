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
class CCpfValidator extends CValidator
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
	
	protected function validarCPF($cpf)
	{	// Verifiva se o nÃºmero digitado contÃ©m todos os digitos
//	    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	    $cpf = str_replace('.','',$cpf);
	    $cpf = str_replace('-','',$cpf);		
	    $cpf = str_pad($cpf, STR_PAD_LEFT);		
		
		// Verifica se nenhuma das sequÃªncias abaixo foi digitada, caso seja, retorna falso
	    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
		return false;
	    }
		else
		{   // Calcula os nÃºmeros para verificar se o CPF Ã© verdadeiro
	        for ($t = 9; $t < 11; $t++) {
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	
	            $d = ((10 * $d) % 11) % 10;
	
	            if ($cpf{$c} != $d) {
	                return false;
	            }
	        }
	
	        return true;
	    }
	}
	
}
