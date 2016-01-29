<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/31
 * Time: 15:07
 * Desc:
 */

namespace frontend\controllers;


use common\models\KefuAccountRepair;
use common\models\KefuSelfservice;
use common\models\KefuSelfserviceCat;
use frontend\models\KefuAccountRepairApplicantInfoForm;
use frontend\models\KefuAccountRepairBasicInfoForm;
use frontend\models\KefuAccountRepairCheckAccountForm;
use frontend\models\KefuAccountRepairMoreInfoForm;
use frontend\models\KefuAccountRepairReasonForm;
use frontend\models\KefuQqValidateForm;
use frontend\models\User;
use yii\data\ActiveDataProvider;
use yii\validators\NumberValidator;
use yii\web\Controller;

class KefuController extends Controller
{

	public function actionIndex()
	{

		return $this->render('index', []);
	}


	/**
	 * validate official QQ
	 * @return string
	 */
	public function actionKefuQqValidate()
	{
		$model = new KefuQqValidateForm();
		$numberValid = new NumberValidator();
		if ($model->load(\Yii::$app->request->post()) && $model->validate())
		{
			if (!$numberValid->validate($model->qq))
			{

				//$model->addError('qq','输入的QQ号码无效!');
				\Yii::$app->session->setFlash('error', '输入的QQ号码无效!');
				return $this->render('validate-qq', [
					'model' => $model,
				]);
			}
			if ($model->validateQQ())
			{
				//$model->addError('qq','此QQ号码为官方QQ号码,请放心!');
				\Yii::$app->session->setFlash('success', '此QQ号码为官方QQ号码,请放心!');
				return $this->render('validate-qq', [
					'model' => $model,
				]);
			} else
			{
				//$model->addError('qq','该QQ不是官方QQ，请谨防上当受骗！');
				\Yii::$app->session->setFlash('error', '该QQ不是官方QQ，请谨防上当受骗!');
				return $this->render('validate-qq', [
					'model' => $model,
				]);
			}
		}
		return $this->render('validate-qq', [
			'model' => $model,
		]);

	}

	public function actionCheckAccount()
	{
		$model = new KefuAccountRepairCheckAccountForm();
		if ($model->load(\Yii::$app->request->post()) && $model->validate())
		{
			if ($model->checkAccount() != null)
			{
				$session = \Yii::$app->session;
				$session->open();
				$session['kefuAccountRepair.account'] = $model->id;

				return $this->redirect(['second-repair-reason']);
			} else
			{
				$model->addError('account', '账号不存在!');
				\Yii::$app->session->setFlash('error', '账号不存在');
			}
		}

		return $this->render('first-check-account', [
			'model' => $model,
		]);
	}

	public function actionSecondRepairReason()
	{
		$model = new KefuAccountRepairReasonForm();
		if ($model->load(\Yii::$app->request->post()) && $model->validate())
		{

			$session = \Yii::$app->session;
			$session->open();
			$session['kefuAccountRepair.reason'] = $model->reason;
			return $this->redirect(['third-basic-info']);
		}
		return $this->render('second-repair-reason', [
			'model' => $model,
		]);
	}

	public function actionThirdBasicInfo()
	{
		$model = new KefuAccountRepairBasicInfoForm();
		if ($model->load(\Yii::$app->request->post()) && $model->validate())
		{
			$session = \Yii::$app->session;
			$session->open();
			$session['kefuAccountRepair.register_time'] = $model->register_time;
			$session['kefuAccountRepair.register_place'] = $model->register_place;
			$session['kefuAccountRepair.recent_games'] = $model->recent_games;
			$session['kefuAccountRepair.question_desc'] = $model->question_desc;
			return $this->redirect(['fourth-more-info']);
		}
		return $this->render('third-basic-info', [
			'model' => $model,
		]);
	}

	public function actionFourthMoreInfo()
	{
		$model = new KefuAccountRepairMoreInfoForm();
		if ($model->load(\Yii::$app->request->post()) && $model->validate())
		{
			$session = \Yii::$app->session;
			$session->open();
			$session['kefuAccountRepair.bind_email'] = $model->bind_email;
			$session['kefuAccountRepair.security_question_one'] = $model->security_question_one;
			$session['kefuAccountRepair.security_question_one_answer'] = $model->security_question_one_answer;
			$session['kefuAccountRepair.security_question_two'] = $model->security_question_two;
			$session['kefuAccountRepair.security_question_two_answer'] = $model->security_question_two_answer;
			return $this->redirect(['fifth-applicant-info']);
		}
		return $this->render('fourth-more-info', [
			'model' => $model,
		]);
	}

	public function actionFifthApplicantInfo()
	{
		$model = new KefuAccountRepairApplicantInfoForm();
		if ($model->load(\Yii::$app->request->post()) && $model->validate())
		{
			$session = \Yii::$app->session;
			$session->open();
			$session['kefuAccountRepair.applicant_name'] = $model->applicant_name;
			$session['kefuAccountRepair.applicant_phone'] = $model->applicant_phone;
			$session['kefuAccountRepair.applicant_identity'] = $model->applicant_identity;
			$session['kefuAccountRepair.applicant_email'] = $model->applicant_email;
			$session['kefuAccountRepair.applicant_identity_front'] = $model->identity_front;
			$session['kefuAccountRepair.applicant_identity_back'] = $model->identity_back;
			return $this->redirect(['sixth-end']);
		}

		return $this->render('fifth-applicant-info', [
			'model' => $model,
		]);
	}


	public function actionSixthEnd()
	{
		$session = \Yii::$app->session;
		$session->open();

		$model = new KefuAccountRepair();
		$model->progress = KefuAccountRepair::PROGRESS_NEW;
		$model->status = KefuAccountRepair::STATUS_IN_USE;

		if ($session['kefuAccountRepair.account'] != '')
		{
			$model->account = $session['kefuAccountRepair.account'];

			$model->reason = $session['kefuAccountRepair.reason'];

			$model->register_time = $session['kefuAccountRepair.register_time'];
			$model->register_place = $session['kefuAccountRepair.register_place'];
			$model->recent_games = $session['kefuAccountRepair.recent_games'];
			$model->question_desc = $session['kefuAccountRepair.question_desc'];

			$model->bind_email = $session['kefuAccountRepair.bind_email'];
			$model->security_question_one = $session['kefuAccountRepair.security_question_one'];
			$model->security_question_one_answer = $session['kefuAccountRepair.security_question_one_answer'];
			$model->security_question_two = $session['kefuAccountRepair.security_question_two'];
			$model->security_question_two_answer = $session['kefuAccountRepair.security_question_two_answer'];

			$model->applicant_name = $session['kefuAccountRepair.applicant_name'];
			$model->applicant_phone = $session['kefuAccountRepair.applicant_phone'];
			$model->applicant_identity = $session['kefuAccountRepair.applicant_identity'];
			$model->applicant_email = $session['kefuAccountRepair.applicant_email'];

			$model->identity_front = $session['kefuAccountRepair.applicant_identity_front'];
			$model->identity_back = $session['kefuAccountRepair.applicant_identity_back'];

			if ($model->save())
			{
				//清空session中的account
				$session['kefuAccountRepair.account'] = '';
				$session['kefuAccountRepair.*'] = '';
				\Yii::$app->session->setFlash('success', '恭喜你,您的申诉单已经提交成功!');
				$model->sendEmail();
				return $this->render('sixth-end', [
					'model' => $model,
				]);
			} else
			{
				\Yii::$app->session->setFlash('error', '非常抱歉,我们无法处理你提交的信息,请稍后重试!');
				return $this->render('sixth-end-error', [
				]);
			}
		}
		return $this->render('sixth-end-error', []);
	}

	/*
	 * selfservice model for category tou-su
	 * */
	public function actionTouSu(){

		$model = new KefuSelfservice();
		$cat = KefuSelfserviceCat::findOne(['slug' => 'tou-su']);
		$model->setAdditional();
		if ($model->load(\Yii::$app->request->post()) && $model->save())
		{
			\Yii::$app->session->setFlash('success', '您的建议已成功提交,谢谢您在百忙之中抽出时间给我们建议,我们会尽快处理!');
			return $this->redirect(['selfservice-result']);
		} else
		{
			return $this->render('tou-su', [
				'model' => $model,
				'cat' => $cat,
			]);
		}
	}

	/*
	 * selfservice model for category jian-yi
	 * */
	public function actionJianYi(){

		$model = new KefuSelfservice();
		$cat = KefuSelfserviceCat::findOne(['slug' => 'jian-yi']);
		$model->setAdditional();
		if ($model->load(\Yii::$app->request->post()) && $model->save())
		{
			\Yii::$app->session->setFlash('success', '您的建议已成功提交,谢谢您在百忙之中抽出时间给我们建议,我们会尽快处理!');
			return $this->redirect(['selfservice-result']);
		} else
		{
			return $this->render('jian-yi', [
				'model' => $model,
				'cat' => $cat,
			]);
		}
	}


	/*
	 * selfservice model for category bug-fan-kui
	 * */
	public function actionBugFanKui(){

		$model = new KefuSelfservice();
		$cat = KefuSelfserviceCat::findOne(['slug' => 'bug-fan-kui']);
		$model->setAdditional();
		if ($model->load(\Yii::$app->request->post()) && $model->save())
		{
			\Yii::$app->session->setFlash('success', '您的建议已成功提交,谢谢您在百忙之中抽出时间给我们建议,我们会尽快处理!');
			return $this->redirect(['selfservice-result']);
		} else
		{
			return $this->render('bug-fan-kui', [
				'model' => $model,
				'cat' => $cat,
			]);
		}
	}


	/*
	 * list selfservice modes by user id
	 * */
	public function actionSelfserviceResult(){
		$userId = \Yii::$app->user->getId();

		if ($userId != null)
		{
			$dataProvider = new ActiveDataProvider([
				'query' => KefuSelfservice::find()->where(['user_id' => $userId])->orderBy('id desc'),
				'pagination' => [
					'pageSize' => 10,
				]
			]);
			return $this->render('selfservice-result', [
				'dataProvider' => $dataProvider,
			]);
		}
		return $this->render('selfservice-result');
	}

	/*
	 * view single selfservice model
	 * */
	public function actionView($id)
	{
		return $this->render('selfservice-view', [
			'model' => KefuSelfservice::findOne(['id' => $id]),
		]);
	}

}