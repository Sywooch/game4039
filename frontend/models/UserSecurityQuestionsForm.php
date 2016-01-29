<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/25
 * Time: 10:42
 * Desc:
 */

namespace frontend\models;

use common\models\UserSecurityQuestions;
use Yii;
use yii\base\Model;

class UserSecurityQuestionsForm extends Model
{

	public $question_one;
	public $question_one_answer;
	public $question_two;
	public $question_two_answer;

	//identity user
	private $_user;

	//table for class UserSecurityQuestion
	private $userSecurityQustions;

	public function __construct($config = [])
	{
		if ($this->getUserSecurityQusetions() != null)
		{
			$this->setAttributes([
				'question_one' => $this->getUserSecurityQusetions()->security_question_one_id,
				'question_one_answer' => $this->getUserSecurityQusetions()->security_question_one_answer,
				'question_two' => $this->getUserSecurityQusetions()->security_question_two_id,
				'question_two_answer' => $this->getUserSecurityQusetions()->security_question_two_answer,
			], false);
		}

		parent::__construct($config);
	}


	public function rules()
	{
		return [
			[['question_one', 'question_two', 'question_one_answer', 'question_two_answer'], 'required'],
			[['question_one', 'question_two'], 'integer'],
			[['question_one_answer', 'question_two_answer'], 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'question_one' => Yii::t('common', 'Question One'),
			'question_two' => Yii::t('common', 'Questions Two'),
			'question_one_answer' => Yii::t('common', 'Question One Answer'),
			'question_two_answer' => Yii::t('common', 'Question Two Answer'),
		];
	}

	public function save()
	{
		$model = new UserSecurityQuestions();
		if ($this->validate())
		{
			$model->user_id = $this->getUser()->getId();
			$model->security_question_one_id = $this->question_one;
			$model->security_question_one_answer = $this->question_one_answer;
			$model->security_question_two_id = $this->question_two;
			$model->security_question_two_answer = $this->question_two_answer;
			$model->status = UserSecurityQuestions::STATUS_IN_USE;

			return $model->save();
		}
		return false;
	}

	protected function getUser()
	{
		if ($this->_user == null)
		{
			$this->_user = Yii::$app->user->identity;
		}
		return $this->_user;
	}

	protected function getUserSecurityQusetions()
	{
		return UserSecurityQuestions::findOne(['user_id' => $this->getUser()->getId()]);
	}

}