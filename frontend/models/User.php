<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/24
 * Time: 11:10
 * Desc:
 */

namespace frontend\models;


use common\util\UcenterUtil;

use dektrium\user\Finder;
use dektrium\user\helpers\Password;
use dektrium\user\Mailer;
use dektrium\user\Module;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\Application as WebApplication;
use yii\web\IdentityInterface;
use dektrium\user\models\Token;

class User extends \dektrium\user\models\User
{

	/*
	 * 同步注册到ucenter,附加在afterSave事件后面
	 * */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		if ($insert)
		{
			UcenterUtil::register($this->username, $this->password, $this->email);
		}
	}


	/**
	 * This method attempts changing user email. If user's "unconfirmed_email" field is empty is returns false, else if
	 * somebody already has email that equals user's "unconfirmed_email" it returns false, otherwise returns true and
	 * updates user's password.
	 *
	 * @param string $code
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function attemptEmailChange($code)
	{
		// TODO refactor method

		/** @var Token $token */
		$token = $this->finder->findToken([
			'user_id' => $this->id,
			'code' => $code,
		])->andWhere(['in', 'type', [Token::TYPE_CONFIRM_NEW_EMAIL, Token::TYPE_CONFIRM_OLD_EMAIL]])->one();

		if (empty($this->unconfirmed_email) || $token === null || $token->isExpired)
		{
			Yii::$app->session->setFlash('danger', Yii::t('user', 'Your confirmation token is invalid or expired'));
		} else
		{
			$token->delete();

			if (empty($this->unconfirmed_email))
			{
				Yii::$app->session->setFlash('danger', Yii::t('user', 'An error occurred processing your request'));
			} elseif ($this->finder->findUser(['email' => $this->unconfirmed_email])->exists() == false)
			{
				if ($this->module->emailChangeStrategy == Module::STRATEGY_SECURE)
				{
					switch ($token->type)
					{
						case Token::TYPE_CONFIRM_NEW_EMAIL:
							$this->flags |= self::NEW_EMAIL_CONFIRMED;
							Yii::$app->session->setFlash('success', Yii::t('user', 'Awesome, almost there. Now you need to click the confirmation link sent to your old email address'));
							break;
						case Token::TYPE_CONFIRM_OLD_EMAIL:
							$this->flags |= self::OLD_EMAIL_CONFIRMED;
							Yii::$app->session->setFlash('success', Yii::t('user', 'Awesome, almost there. Now you need to click the confirmation link sent to your new email address'));
							break;
					}
				}
				if ($this->module->emailChangeStrategy == Module::STRATEGY_DEFAULT || ($this->flags & self::NEW_EMAIL_CONFIRMED && $this->flags & self::OLD_EMAIL_CONFIRMED))
				{
					$this->email = $this->unconfirmed_email;
					$this->unconfirmed_email = null;
					Yii::$app->session->setFlash('success', Yii::t('user', 'Your email address has been changed'));
				}
				$this->save(false);
				//edit ucenter user email
				UcenterUtil::userEditEmail($this->username, $this->email);
			}
		}
	}


}