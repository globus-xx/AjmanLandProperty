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
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin112358',
			'omar'=>'oAiHmH112358',
			'akhalfan'=>'akhalfan',
			'yalshamsi'=>'yalshamsi',
			'akheir'=>'akheir',
			'asalama'=>'asalama',
			'halshaali'=>'halshaali',
			'nbueissa'=>'nbueissa',
			'aamer'=>'aamer',
			'halmehairi'=>'halmehairi',
			'yalmheiri'=>'yalmheiri',
			'aalshamsi'=>'aalshamsi',
			'kbinhendi'=>'kbinhendi',
			'0505792562'=>'0505792562', //tahseen el khateeb
			'aalmatrooshi'=>'aalmatrooshi',
			'maldhahri'=>'maldhahri',
			'nalsuwadi'=>'nalsuwadi',
			'aabushehab'=>'aabushehab',

		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}
