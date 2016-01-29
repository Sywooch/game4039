<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/24
 * Time: 18:05
 * Desc:
 */

namespace frontend\models;

use common\util\UcenterUtil;
use dektrium\user\Module;


class SettingsForm extends \dektrium\user\models\SettingsForm
{

	public function save()
	{
		if ($this->validate())
		{
			$this->user->scenario = 'settings';
			$this->user->username = $this->username;
			$this->user->password = $this->new_password;
			if ($this->email == $this->user->email && $this->user->unconfirmed_email != null)
			{
				$this->user->unconfirmed_email = null;
			} elseif ($this->email != $this->user->email)
			{
				switch ($this->module->emailChangeStrategy)
				{
					case Module::STRATEGY_INSECURE:
						$this->insecureEmailChange();
						break;
					case Module::STRATEGY_DEFAULT:
						$this->defaultEmailChange();
						break;
					case Module::STRATEGY_SECURE:
						$this->secureEmailChange();
						break;
					default:
						throw new \OutOfBoundsException('Invalid email changing strategy');
				}
			}

			//同步修改ucenter密码
			$flag = UcenterUtil::userEditWithoutEmail($this->username, $this->current_password, $this->new_password, $this->email);
			if ($flag >= 0 || $flag == -7)
			{
				return $this->user->save();
			}
		}

		return false;
	}


}