<?php

/** Implementa o algoritmo de verificação de e-mail.
 *  @author Felipe André <felipeandresouza@hotmail.com>
 *  @package system.validators
 *  @version 1.0, 26/01/2022 */
class EmailValidator extends CValidator {

	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel the object being validated
	 * @param string the attribute being validated
	 */
	protected function validateAttribute($object,$attribute) {

		$value = $object->$attribute;
		
		if ((strlen($value) > 0) and (!$this->validaEmail($value))) {

			$message = $this->message !== null ? $this->message : Yii::t('yii','{attribute} is invalid.');
			$this->addError($object,$attribute,$message);

		}

	}
	
	/** Verifica se um e-mail é válido. */
	private function validaEmail($email) {
	    return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
}