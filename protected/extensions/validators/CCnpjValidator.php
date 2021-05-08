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
class CCnpjValidator extends CValidator
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
		
		if ((strlen($value) > 0) and (!$this->validarCnpj($value)))
		{
  			$message=$this->message!==null?$this->message:Yii::t('yii','{attribute} is invalid.');
			$this->addError($object,$attribute,$message);
		}
	}

//protected function validarCnpj($cnpj)
 function validarCnpj($cnpj)
{
	 $cnpj = str_pad(ereg_replace('[^0-9]', '', $cnpj), 14, '0', STR_PAD_LEFT);
     if (strlen($cnpj) != 14) {
        return false;
      } else {
         for ($t = 12; $t < 14; $t++) {
            for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
                $d += $cnpj{$c} * $p;
                $p   = ($p < 3) ? 9 : --$p;
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cnpj{$c} != $d) {
                return false;
            }
        }

        return true;
    }
		
}
	
		
	
	
	
	
	
}
