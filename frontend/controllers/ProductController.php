<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/11
 * Time: 9:24
 * Desc:
 */

namespace frontend\controllers;


use backend\models\search\ShopOrderSearch;
use backend\models\search\ShopProductSearch;
use common\models\ShopCategory;
use common\models\ShopOrder;
use common\models\ShopOrderItem;
use common\models\ShopProduct;
use common\util\DzHelper;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProductController extends Controller
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					['allow' => true, 'actions' => ['dui-huan','shi-wu-order','my-order','my-order-delete'], 'roles' => ['@']],
					['allow' => true, 'actions' => ['list','index','view'], 'roles' => ['?', '@']],
				],
			],
		];
	}


	/**
	 * 商城首页action
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * 商城商品分类action
	 * @return string
	 */
	public function actionList()
	{
		$searchModel = new ShopProductSearch();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
		$dataProvider->sort = [
			'defaultOrder' => ['created_at' => SORT_DESC]
		];
		$dataProvider->pagination = [
			'pageSize' => 15,
		];
		return $this->render('list', ['dataProvider' => $dataProvider]);
	}


	/**
	 * 商城商品详情action
	 * @param $slug
	 * @return string
	 */
	public function actionView($slug)
	{
		$model = ShopProduct::find()->statusInUseAndOnSale()->andWhere(['slug' => $slug])->one();
		if (!$model)
		{
			throw new NotFoundHttpException;
		}

		return $this->render('view', ['model' => $model]);
	}

	public function actionDuiHuan()
	{

		$post = \Yii::$app->request->post();

		$user = \Yii::$app->user->identity;
		$dzUser = (new DzHelper())->getDzUserByUsername($user->username);

		$data = [];
		$bbsUrl = \ Yii::getAlias('@bbsUrl');
		$model = ShopProduct::findOne($post['dataId']);

		//实体物品
		if ($post['dataType'] == ShopCategory::findOne(['slug' => 'shi-ti-wu-pin'])->id)
		{
			return $this->redirect(['shi-wu-order', 'slug' => $model->slug]);
		}

		//判断积分
		if ($model->jifen > $dzUser['credits'])
		{
			$data['msg'] = '<i class="glyphicon glyphicon-ok"></i> 您当前的积分为 : ' . $dzUser['credits'];
			$data['msg'] .= '<br>';
			$data['msg'] .= '<i class="glyphicon glyphicon-ok"></i> 很遗憾您的积分不够兑换该礼品';
			$data['msg'] .= '<br>';
			$data['msg'] .= "<a href={$bbsUrl} target='_blank'>[去论坛赚积分]</a>";
			return json_encode($data);
		} else
		{
			//实体物品
			if ($post['dataType'] == ShopCategory::findOne(['slug' => 'shi-ti-wu-pin'])->id)
			{
				return $this->redirect(['shi-wu-order', 'slug' => $model->slug]);
			}

			//虚拟物品
			if ($post['dataType'] == ShopCategory::findOne(['slug' => 'xu-ni-wu-pin'])->id)
			{

			}

		}

		$data['msg'] = '<i class="glyphicon glyphicon-ok"></i> 系统异常,请稍后在试!';
		return json_encode($data);
	}


	public function actionShiWuOrder($slug)
	{
		$shopOrder = new ShopOrder();
		$shopProducts = ShopProduct::findOne(['slug' => $slug]);
		//myVarDump($shopOrder->validate());
		if ($shopOrder->load(\Yii::$app->request->post()) && $shopOrder->validate())
		{
			$transaction = $shopOrder->getDb()->beginTransaction();
			$shopOrder->user_id = \Yii::$app->user->getId();
			$shopOrder->setOrderSn();
			$shopOrder->save(false);

			$shopOrderItem = new ShopOrderItem();
			$shopOrderItem->order_id = $shopOrder->id;
			$shopOrderItem->title = $shopProducts['title'];
			$shopOrderItem->price = $shopProducts['price'];
			$shopOrderItem->product_id = $shopProducts['id'];
			$shopOrderItem->quantity = 1;

			if (!$shopOrderItem->save(false))
			{
				$transaction->rollBack();
				\Yii::$app->session->addFlash('error', '暂时不能处理您的订单!');
				return $this->redirect(['catalog/list']);
			}
			$transaction->commit();
			\Yii::$app->cart->removeAll();

			\Yii::$app->session->addFlash('success', '谢谢您的订单,我们会尽快处理!');

			$shopOrder->sendEmail();

			return $this->redirect(['product/my-order']);

		}
		return $this->render('shi-wu-order', [
			'shopOrder' => $shopOrder,
			'shopProducts' => $shopProducts,
		]);
	}


	public function actionMyOrder($status = null)
	{
		$searchModel = new ShopOrderSearch();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

		$dataProvider->query->andFilterWhere(['user_id' => \Yii::$app->user->getId()]);
		$dataProvider->pagination = [
			'pageSize' => 10,
		];
		$dataProvider->sort = [
			'defaultOrder' => [
				'created_at' => SORT_DESC
			]
		];

		return $this->render('my-order', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionMyOrderDelete($id)
	{

		$model = ShopOrder::findOne($id);
		if (!$model)
		{
			throw new NotFoundHttpException('您请求的页面不存在!');
		}

		$model->delete();
		return $this->redirect(['my-order']);
	}

}