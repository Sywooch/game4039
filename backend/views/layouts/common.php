<?php
/**
 * @var $this yii\web\View
 */
use backend\assets\BackendAsset;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$bundle = BackendAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
	<div class="wrapper">
		<!-- header logo: style can be found in header.less -->
		<header class="main-header">
			<a href="<?php echo Yii::getAlias('@frontendUrl') ?>" class="logo" target="_blank">
				<!-- Add the class icon to your logo image or logo icon to add the margining -->
				<?php echo Yii::$app->keyStorage->get('backend_name') ?>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only"><?php echo Yii::t('backend', 'Toggle navigation') ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li id="timeline-notifications" class="notifications-menu">
							<a href="<?php echo Url::to(['/timeline-event/index']) ?>">
								<i class="fa fa-bell"></i>
                                <span class="label label-success">
                                    <?php echo TimelineEvent::find()->today()->count() ?>
                                </span>
							</a>
						</li>
						<!-- Notifications: style can be found in dropdown.less -->
						<li id="log-dropdown" class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-warning"></i>
                            <span class="label label-danger">
                                <?php echo \backend\models\SystemLog::find()->count() ?>
                            </span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo Yii::t('backend', 'You have {num} log items', ['num' => \backend\models\SystemLog::find()->count()]) ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<?php foreach (\backend\models\SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry): ?>
											<li>
												<a href="<?php echo Yii::$app->urlManager->createUrl(['/log/view', 'id' => $logEntry->id]) ?>">
													<i class="fa fa-warning <?php echo $logEntry->level == \yii\log\Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow' ?>"></i>
													<?php echo $logEntry->category ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</li>
								<li class="footer">
									<?php echo Html::a(Yii::t('backend', 'View all'), ['/log/index']) ?>
								</li>
							</ul>
						</li>
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img
									src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.png')) ?>"
									class="user-image">
								<span><?php echo Yii::$app->user->identity->username ?> <i class="caret"></i></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header light-blue">
									<img
										src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.png')) ?>"
										class="img-circle" alt="User Image"/>

									<p>
										<?php echo Yii::$app->user->identity->username ?>
										<small>
											<?php echo Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
										</small>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<?php echo Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], ['class' => 'btn btn-default btn-flat']) ?>
									</div>
									<div class="pull-left">
										<?php echo Html::a(Yii::t('backend', 'Account'), ['/sign-in/account'], ['class' => 'btn btn-default btn-flat']) ?>
									</div>
									<div class="pull-right">
										<?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
									</div>
								</li>
							</ul>
						</li>
						<li>
							<?php echo Html::a('<i class="fa fa-cogs"></i>', ['/site/settings']) ?>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img
							src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.png')) ?>"
							class="img-circle"/>
					</div>
					<div class="pull-left info">
						<p><?php echo Yii::t('backend', 'Hello, {username}', ['username' => Yii::$app->user->identity->getPublicIdentity()]) ?></p>
						<a href="<?php echo Url::to(['/sign-in/profile']) ?>">
							<i class="fa fa-circle text-success"></i>
							<?php echo Yii::$app->formatter->asDatetime(time()) ?>
						</a>
					</div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<?php echo Menu::widget([
					'options' => ['class' => 'sidebar-menu'],
					'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
					'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
					'activateParents' => true,
					'items' => [
						[
							'label' => Yii::t('backend', 'Main'),
							'options' => ['class' => 'header']
						],
						[
							'label' => Yii::t('backend', 'Timeline'),
							'icon' => '<i class="fa fa-bar-chart-o"></i>',
							'url' => ['/timeline-event/index'],
							'badge' => TimelineEvent::find()->today()->count(),
							'badgeBgClass' => 'label-success',
						],
						[
							'label' => Yii::t('backend', 'Content'),
							'url' => '#',
							'icon' => '<i class="fa fa-edit"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('backend', 'Static pages'), 'url' => ['/page/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'Articles'), 'url' => ['/article/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'Article Categories'), 'url' => ['/article-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'Text Widgets'), 'url' => ['/widget-text/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'Menu Widgets'), 'url' => ['/widget-menu/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'Carousel Widgets'), 'url' => ['/widget-carousel/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							]
						],

						[
							'label' => Yii::t('backend', 'Index'),
							'url' => '#',
							'icon' => '<i class="fa fa-file"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Index Slide'), 'url' => ['/index-slide/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Player Albums'), 'url' => ['/player-album/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Friends Links'), 'url' => ['/friends-links/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							]
						],
						[
							'label' => Yii::t('common', 'Game'),
							'url' => '#',
							'icon' => '<i class="fa fa-desktop"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Game Category'), 'url' => ['/game-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Game'), 'url' => ['/game/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Game Server'), 'url' => ['/game-server/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Game Gift'), 'url' => ['/game-gift/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Recharge'), 'url' => ['/recharge/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							]
						],
						[
							'label' => Yii::t('common', 'Activity'),
							'url' => '#',
							'icon' => '<i class="fa fa-cube"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Activity Category'), 'url' => ['/activity-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Activity'), 'url' => ['/activity/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Site Messages'), 'url' => ['/message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							]
						],
						[
							'label' => Yii::t('common', 'Product'),
							'url' => '#',
							'icon' => '<i class="fa fa-shopping-cart"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Shop Category'), 'url' => ['/shop-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Shop Product'), 'url' => ['/shop-product/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Shop Order'), 'url' => ['/shop-order/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							]
						],

						[
							'label' => Yii::t('common', 'Kefu'),
							'url' => '#',
							'icon' => '<i class="fa fa-android"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Kefu Faq Cat'), 'url' => ['/kefu-faq-cat/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Kefu Faq'), 'url' => ['/kefu-faq/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Kefu Selfservice Cat'), 'url' => ['/kefu-selfservice-cat/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Kefu Selfservice'), 'url' => ['/kefu-selfservice/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Kefu QQ'), 'url' => ['/kefu-qq/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Kefu Account Repair'), 'url' => ['/kefu-account-repair/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Security Questions'), 'url' => ['/security-questions/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							]
						],
						[
							'label' => Yii::t('backend', 'System'),
							'options' => ['class' => 'header']
						],
						/*      [
								  'label'=>Yii::t('backend', 'Users'),
								  'icon'=>'<i class="fa fa-users"></i>',
								  'url'=>['/user/index'],
								  'visible'=>Yii::$app->user->can('administrator')
							  ],*/
						[
							'label' => Yii::t('common', 'Users'),
							'url' => '#',
							'icon' => '<i class="fa fa-users"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Administrator'), 'url' => ['/user/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Admin Login Log'), 'url' => ['/user-logs/admin-login-log'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Admin Log'), 'url' => ['/user-logs/admin-log'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								[
									'label' => Yii::t('backend', ''),
									'options' => ['class' => 'header']
								],
								['label' => Yii::t('common', 'User Login Log'), 'url' => ['/user-logs/user-login-log'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'User Log'), 'url' => ['/user-logs/user-log'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'User History'), 'url' => ['/user-history/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							],
							'visible' => Yii::$app->user->can('administrator')
						],
						[
							'label' => Yii::t('common', 'Settings'),
							'url' => '#',
							'icon' => '<i class="fa fa-pencil"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								['label' => Yii::t('common', 'Application settings'), 'url' => ['/site/settings'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'SEO Settings'), 'url' => ['/site/seo-settings'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Mail Settings'), 'url' => ['/site/mail-settings'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Basic Settings'), 'url' => ['/site/basic-settings'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('common', 'Others Settings'), 'url' => ['/site/others-settings'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
							],
							'visible' => Yii::$app->user->can('administrator')
						],
						[
							'label' => Yii::t('backend', 'Other'),
							'url' => '#',
							'icon' => '<i class="fa fa-cogs"></i>',
							'options' => ['class' => 'treeview'],
							'items' => [
								[
									'label' => Yii::t('backend', 'i18n'),
									'url' => '#',
									'icon' => '<i class="fa fa-flag"></i>',
									'options' => ['class' => 'treeview'],
									'items' => [
										['label' => Yii::t('backend', 'i18n Source Message'), 'url' => ['/i18n/i18n-source-message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
										['label' => Yii::t('backend', 'i18n Message'), 'url' => ['/i18n/i18n-message/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
									]
								],
								['label' => Yii::t('backend', 'Key-Value Storage'), 'url' => ['/key-storage/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'File Storage'), 'url' => ['/file-storage/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'Cache'), 'url' => ['/cache/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								['label' => Yii::t('backend', 'File Manager'), 'url' => ['/file-manager/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
								[
									'label' => Yii::t('backend', 'System Information'),
									'url' => ['/system-information/index'],
									'icon' => '<i class="fa fa-angle-double-right"></i>'
								],
								[
									'label' => Yii::t('backend', 'Logs'),
									'url' => ['/log/index'],
									'icon' => '<i class="fa fa-angle-double-right"></i>',
									'badge' => \backend\models\SystemLog::find()->count(),
									'badgeBgClass' => 'label-danger',
								],
							],
							'visible' => Yii::$app->user->can('administrator')
						]
					]
				]) ?>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?php echo $this->title ?>
					<?php if (isset($this->params['subtitle'])): ?>
						<small><?php echo $this->params['subtitle'] ?></small>
					<?php endif; ?>
				</h1>

				<?php echo Breadcrumbs::widget([
					'tag' => 'ol',
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
			</section>

			<!-- Main content -->
			<section class="content">
				<?php if (Yii::$app->session->hasFlash('alert')): ?>
					<?php echo \yii\bootstrap\Alert::widget([
						'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
						'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
					]) ?>
				<?php endif; ?>
				<?php echo $content ?>
			</section>
			<!-- /.content -->
		</aside>
		<!-- /.right-side -->
	</div><!-- ./wrapper -->

<?php $this->endContent(); ?>