<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/2/1
 * Time: 16:46
 * Desc:
 */
use yii\bootstrap\Modal;

$this->title = "我的消息";


//myVarDump(\common\models\Message::deleteMessageByUserId(8, 2));
//myVarDump($dataProvider->getModels());
?>

<!--frofile-->
<div class="container content">
	<div class="profile">
		<div class="row">
			<!--Left Sidebar-->
			<div class="col-md-3 md-margin-bottom-40 margin-bottom-40">
				<?= $this->render('../_userLeftSideBar'); ?>
			</div>
			<!--End Left Sidebar-->

			<!-- Profile Content -->
			<div class="col-md-9">
				<div class="profile-body">
					<div class="panel panel-profile">
						<div class="panel-heading overflow-h">
							<h2 class="panel-title heading-sm pull-left"><i class="fa fa-comments"></i>我的消息</h2>
							<a href="#"><i class="fa fa-cog pull-right"></i></a>
						</div>
						<div class="panel-body margin-bottom-50">
							<?php foreach ($dataProvider->models as $model): ?>
								<div class="media media-v2">
									<div class="close" style="margin-right: 1px;margin-top: -25px;">
										<a href=<?= "javascript:deleteMessage(".$model->id.")"?>><i
												class="fa fa-close" id="<?= $model->id ?>"></i></a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">
											<strong><a href="#"><?= $model->title ?></a></strong>
											<small><?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></small>
										</h4>
										<p>
											<?= $model->content; ?>
										</p>
									</div>
								</div>
								<!--/end media media v2-->
							<?php endforeach; ?>
							<div class="text-center">
								<?= \yii\widgets\LinkPager::widget([
									'pagination' => $dataProvider->pagination
								]) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--/container-->
	</div>
</div>
<!--end profile-->

<?php
$deleteUrl=\yii\helpers\Url::to(['/user/profile/delete-user-message-by-user-id']);
$js = <<<JS
//make user-nav active
$('.index-nav').removeClass('active');
$('.user-nav').addClass('active');

//make user-history sidebar nav active
$('.user-message').addClass('active');

App.init();
//App.initCounter();
//App.initScrollBar();
//Datepicker.initDatepicker();

//ajax删除用户的系统消息
deleteMessage=function(args){
	var messageId=args;
	layer.confirm("你确定要删除该条消息?",{btn:['确定','取消']},
		function(){
       			$.ajax({
       				url:"{$deleteUrl}",
       				type:'post',
       				data:{
       					messageId:messageId
       				},
       				success:function(data){
       					var obj=$.parseJSON(data);
       					console.log(obj);
       					layer.msg(obj.msg);
       					window.location.reload(5);
       				}
       			});
       	},
       	function(){
       		//layer.msg('que')
       	}
    );
};
JS;
$this->registerJs($js);
?>
