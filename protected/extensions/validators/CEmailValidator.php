<?php
/**
 * CEmailValidator class file.
 *
 */

/**
 * CEmailValidator validates CPF.
 *
 * @author Ricardo Granae <rickgrana@yahoo.com.br>
  * @package system.validators
 * @since 1.0
 */
class CEmailValidator extends CValidator
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
		if((strlen($value) > 0) and (!$this->validarEmail($value)))
		{
			$message=$this->message!==null?$this->message:Yii::t('yii','{attribute} is invalid.');
			$this->addError($object,$attribute,$message);
		}
	}
	
	protected function validarEmail($email){
	    $mail_correcto = 0; 
	   //verifico umas coisas 
	   if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
	      if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
	         //vejo se tem caracter . (ponto)
	         if (substr_count($email,".")>= 1){ 
	            //obtenho a terminaÃ§Ã£o do dominio 
	            $term_dom = substr(strrchr ($email, '.'),1); 
	            //verifico que a terminaÃ§Ã£o do dominio seja correcta 
		         if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
		            //verifico que o de antes do dominio seja correcto 
		            $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
		            $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
		            if ($caracter_ult != "@" && $caracter_ult != "."){ 
		               $mail_correcto = 1; 
		            } 
		         } 
	      	 } 
	   	  } 
	   }
	
	   return $mail_correcto;
		
	} 
	
}
