<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
		
		$usuario = usuario::model()->findByAttributes(array('usuario' => $this->username));
		
		if($usuario == null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else {
			//$command = Yii::app()->db->createCommand("select password('{$this->password}') as senha");
			$command = Yii::app()->db->createCommand("select password(:senha) as senha");
			$command->bindValue(":senha", $this->password);
			$row = $command->queryRow();

			if($row['senha'] !== $usuario->senha_usuario)
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else
			{
				$this->errorCode=self::ERROR_NONE;
				$session=Yii::app()->getSession();
				$session["usuario"] = $usuario;
			}
		}
		
		return !$this->errorCode;
	}
	
	public function IsUsuarioInterno()
	{
		$user = Yii::app()->user;
		return ($user->getName() == "felipe" || $user->getName() == "romulo098" || $user->getName() == "romulo001");
	
	}
}