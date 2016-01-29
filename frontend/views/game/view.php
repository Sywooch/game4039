<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/27
 * Time: 13:55
 * Desc:
 */
use yii\helpers\Url;

$this->title = $model->name;

//获得该游戏下的所有服务器
$gameServers = \common\models\GameServer::find()->statusInUse()->where(['game_id' => $model->id])->all();

?>
<div class="content game-view"
	 style="background: url(<?= $model->getBgUrl()?>) no-repeat">
	<div class="header"><!--头部-->
		<div class="container">
			<div class="row  to-top">
				<div class="col-md-12">
					<div class="nav center">
						<a href="#" target="_blank">官网首页</a>
						<a href="#" target="_blank">新闻资讯</a>
						<a href="#" target="_blank">视听奖赏</a>
						<a href="#">游戏下载</a>
						<a href="#" target="_blank">官方论坛</a>
					</div>
				</div>
			</div>

			<div class="row to-top">
				<div class="col-md-12">
					<div class="zi center">
						<h2><?= $model->name ?></h2>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="container">
		<div class="row">
			<div class="col-log-12">

				<div class="server">
					<div class="servercon">
						<p><img src="/img/server-status.jpg"></p>
						<h4>我的服务器</h4>

						<div id="myserver" class="zonelist">

						</div>
						<h4>推荐服务器</h4>

						<div id="recommendserver" class="zonelist">
							<?php foreach ($gameServers as $server): ?>
								<a href="#" target="_blank"><span
										class="green"></span><?= '(' . $server->server_id . ') ' . $server->server_name ?>
								</a>
							<?php endforeach; ?>
						</div>

						<h4>全部服务器</h4>

						<div id="allserver" class="zonelist">
							<!--通过设置 class=green/gray/red/yellow 来改变服务器的颜色状态-->

							<?php foreach ($gameServers as $server): ?>
								<a style="display: block;" href="#" target="_blank"><span
										class="green"></span><?= '(' . $server->server_id . ') ' . $server->server_name ?>
								</a>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

