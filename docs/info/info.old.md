
重写了migrate
第一步
php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
php yii migrate/up --migrationPath=@vendor/yiisoft/yii2/rbac/migrations
php yii migrate


#44
+-------------------------------------------------------------------------------------------------------------+
完善了 商品订单部分的,主要是视图方面
修改了 shop_order表,增加了几个字段,详情见m151204_024702_alter_shop_order.php
+-------------------------------------------------------------------------------------------------------------+


#43
+-------------------------------------------------------------------------------------------------------------+
将该应用迁移到vagrant配置的虚拟机中
代码仓库位于github上
clone地址:git clone https://github.com/buuug7/game3049.git
##安装
>
git clone https://github.com/buuug7/game3049.git
>
在common/config/main-local.php中修改你的数据库信息
>
进入项目根目录,依次运行下列命令
>
composer update
>
bower update
>
init
>
yii migrate
+-------------------------------------------------------------------------------------------------------------+

#42
+-------------------------------------------------------------------------------------------------------------+
在本地hosts中加入如下的映射域名
# game4039 domain config
192.168.33.10 game4039.backend.dev
192.168.33.10 game4039.frontend.dev
192.168.33.10 game4039.storage.dev
192.168.33.10 game4039.bbs.dev

apche2的配置,以下为当前目录的game4039.conf文件的内容
<VirtualHost *:80>
    DocumentRoot "/var/www"
    <Directory "/var/www">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "/var/www/game4039/backend/web"
    ServerName game4039.backend.dev
    ServerAlias game4039.backend.dev
    <Directory "/var/www/game4039/backend/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "/var/www/game4039/frontend/web"
    ServerName game4039.frontend.dev
    ServerAlias game4039.frontend.dev
    <Directory "/var/www/game4039/frontend/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "/var/www/game4039/storage/web"
    ServerName game4039.storage.dev
    ServerAlias game4039.storage.dev
    <Directory "/var/www/game4039/storage/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "/var/www/game4039/bbs/web"
    ServerName game4039.bbs.dev
    ServerAlias game4039.bbs.dev
    <Directory "/var/www/game4039/bbs/web">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

加上该内容后在 命令行输入:
sudo a2dissite 000-default.conf
sudo a2ensite game4039.conf
sudo service apache2 restart
来激活该配置

进入phpmyadmin的url:
任何以上的域名后跟/phpmyadmin即可
比如 game4039.frontend.dev/phpmyadmin
用户名:root
密码:root
+-------------------------------------------------------------------------------------------------------------+

#41
+-------------------------------------------------------------------------------------------------------------+
禁止对open-ecommerce这个库进行更新,因为自己做了部分修改

关于用ueditor的图片保存路径的设置,请参考ArticleController里面的配置

{{%file_storage_item}}表为记录用户插入图片的日志表


新添加了extension=php_apcu.dll扩展
+-------------------------------------------------------------------------------------------------------------+


#40
+-------------------------------------------------------------------------------------------------------------+
在 common\config\bootstrap.php增加了如下的配置

新增加了storage模块用来储存文件,比如图片之类的,定义在项目根目录下的storage目录下
Yii::setAlias('storage',dirname(dirname(__DIR__)).'/storage');

// Url Aliases
Yii::setAlias('frontendUrl', 'http://game4039.frontend.dev/');
Yii::setAlias('backendUrl', 'http://game4039.backend.dev/');
Yii::setAlias('storageUrl', 'http://game4039.storage.dev/');
+-------------------------------------------------------------------------------------------------------------+

#39
+-------------------------------------------------------------------------------------------------------------+
在本地host文件中的配置如下:
#game4039项目设置
127.0.0.1 game4039.frontend.dev
127.0.0.1 game4039.backend.dev
127.0.0.1 game4039.storage.dev
+-------------------------------------------------------------------------------------------------------------+

#38
+-------------------------------------------------------------------------------------------------------------+
apache中的config\extra\http-vhosts.conf中增加了如下配置
#game4039.backend.dev
<VirtualHost *:80>
    DocumentRoot "d:/wamp/www/game4039/backend/web"
    ServerName game4039.backend.dev
 <Directory d:/wamp/www/game4039/backend/web>
      Options FollowSymLinks
      AllowOverride None
      Order deny,allow
      Allow from all
 </Directory>
</VirtualHost>

#game4039.frontend.dev
<VirtualHost *:80>
    DocumentRoot "d:/wamp/www/game4039/frontend/web"
    ServerName game4039.frontend.dev
 <Directory d:/wamp/www/game4039/frontend/web>
      Options FollowSymLinks
      AllowOverride None
      Order deny,allow
      Allow from all
 </Directory>
</VirtualHost>

#game4039.storage.dev
<VirtualHost *:80>
    DocumentRoot "d:/wamp/www/game4039/storage/web"
    ServerName game4039.storage.dev
 <Directory d:/wamp/www/game4039/storage/web>
      Options FollowSymLinks
      AllowOverride None
      Order deny,allow
      Allow from all
 </Directory>
</VirtualHost>
+-------------------------------------------------------------------------------------------------------------+




#37
+-------------------------------------------------------------------------------------------------------------+
新引入 "trntv/yii2-file-kit": "*"库文件来进行文件的长传等操作
新引入 "trntv/yii2-glide": "*" 库 用来对长传的图片进行输出
该类库优先用到了 playerAlbulm模型
+-------------------------------------------------------------------------------------------------------------+

#36
+-------------------------------------------------------------------------------------------------------------+
增加seo优化的三个字段在{{%web_config}}表中
sys_seo_description=>4039页游平台
sys_seo_keywords=>4039,页游,网页游戏
sys_seo_title=>4039页游平台
+-------------------------------------------------------------------------------------------------------------+


#35
+-------------------------------------------------------------------------------------------------------------+
重写了登陆界面
+-------------------------------------------------------------------------------------------------------------+


#34
+-------------------------------------------------------------------------------------------------------------+
新增加了一个辅助类
Buuug7Alert用来输入flash中的提示信息
+-------------------------------------------------------------------------------------------------------------+

#33
+-------------------------------------------------------------------------------------------------------------+
用户历史记录
数据表:user_history
对应model:UserHistory
创建方式:yii migrate
功能:
用辅助类Buuug7UserHistory来辅助插入和获取
+-------------------------------------------------------------------------------------------------------------+


#32
+-------------------------------------------------------------------------------------------------------------+
网站配置
数据表:web_config
创建方式:yii migrate
资源位置:
功能:
WebConfigController
页面:r=web-config/index
站点基本配置:r=web-config/config-basic
邮箱配置:r=web-config/config-email
logo配置:
图标配置:
+-------------------------------------------------------------------------------------------------------------+


#31
+-------------------------------------------------------------------------------------------------------------+
更新了登录界面
更新了重置密码的界面
更新了主页

+-------------------------------------------------------------------------------------------------------------+

#30
+-------------------------------------------------------------------------------------------------------------+
由于bootstrap v3.3.5的media-body跟v3.3.1的写法有出入,修复了导致后台模板在引用最新的bootstrap版本的时候部分布局出现错乱,
在ohter.less中加入了
.media-body {
  display: table-cell;
  vertical-align: top;
  width: auto;
}
重写了media-body类
现在前后台统一引用boostrap的最新版本v3.3.5
将npm管理的 node_modules目录删除,以后前段资源包管理就用bower
+-------------------------------------------------------------------------------------------------------------+


#29
+-------------------------------------------------------------------------------------------------------------+
为了在视图中显示数据库中存储图片的地址渲染的时候方便,特意写了工具类Buuug7Util,其中的getImagesHtml方法处理
为了程序相互通用,在上传图片的时候统一用数组方式上传,记着在用的时候分割
+-------------------------------------------------------------------------------------------------------------+

#28
+-------------------------------------------------------------------------------------------------------------+
客服对应的表有6张表
kefu_account_repair
kefu_faq
kefu_faq_category
kefu_qq
kefu_selfservice_category
kefu_selfservice
并关联到6个模型
KefuAccountRepair
KefuFaq
KefuFaqCategory
KefuQq
KefuSelfserviceCategory
KefuSelfservice
backend中对应了该模型的所有controller和modelForm类增加扩展了部分业务处理
+-------------------------------------------------------------------------------------------------------------+

#27
+-------------------------------------------------------------------------------------------------------------+
前台重写了用户消息这一块的视图,控制器,以及模型,其在UserController中添加了对应的
actionMessageUnreadAjax
actionMessageXitongAjax
actionMessageHuodongAjax
actionMessageFuliAjax
四个action来处理用户的消息

视图中user-message中嵌套_userMessage.php,在_userMessage.php又嵌套了_userMessageUnread.pp
最后的一个视图没有命名合理,以后再处理
+-------------------------------------------------------------------------------------------------------------+

#26
+-------------------------------------------------------------------------------------------------------------+
添加了"kartik-v/yii2-tree-manager": "@dev" 树扩展,但是没有使用,在配置文件中使用的配置也没有删除
添加了 "kartik-v/yii2-datecontrol": "*"
添加了composer require kartik-v/yii2-widgets: "@dev"
+-------------------------------------------------------------------------------------------------------------+


#25
+-------------------------------------------------------------------------------------------------------------+
用户消息,用户消息分类,user_message,user_message_category
用户消息管理表:user_message,user_message_category
创建方式:yii migrate
资源位置:'admin.activityImageSaveDir'=>'uploads/activity/',//活动管理图片存储位置
功能:
UserMessageController
添加:r=user-message/create
删除:r=user-message/delete
查看:r=user-message/view
更新:r=user-message/update
管理:r=user-message/index

UserMessageCategoryController
添加:r=user-message-category/create
删除:r=user-message-category/delete
查看:r=user-message-category/view
更新:r=user-message-category/update
管理:r=user-message-category/index
+-------------------------------------------------------------------------------------------------------------+

#024
+-------------------------------------------------------------------------------------------------------------+
'uc_server'=>'http://localhost/game4039/dz/uc_server/',uc_server地址,配置在commom/config/params.php中
Yii::setAlias('ucenter',Yii::getAlias('@frontend').'/web/uc_client/ucenter.php');uc_client的api


论坛昵称插件
+-------------------------------------------------------------------------------------------------------------+

#023
+-------------------------------------------------------------------------------------------------------------+
在game表中增加了三个字段is_new,is_hot,is_recommend
将旧版本中的frontend全部内容迁移过来
+-------------------------------------------------------------------------------------------------------------+

#022
+-------------------------------------------------------------------------------------------------------------+
商城:shop-category,shop_product,shop_order,shop_order_item(订单详情表),shop_image(商品图片表)
商品表:shop_product
创建方式:yii migrate
功能:
ShopCategoryController(商品分类表)
添加:r=shop-category/create
删除:r=shop-category/delete
查看:r=shop-category/view
更新:r=shop-category/update
管理:r=shop-category/index

ShopProcutController(商品表)
添加:r=shop-product/create
删除:r=shop-product/delete
查看:r=shop-product/view
更新:r=shop-product/update
管理:r=shop-product/index

ShopOrderController(订单表)
添加:r=shop-order/create
删除:r=shop-order/delete
查看:r=shop-order/view
更新:r=shop-order/update
管理:r=shop-order/index
+-------------------------------------------------------------------------------------------------------------+


#021
+-------------------------------------------------------------------------------------------------------------+
友情链接:friends_links
数据表:friends_links
创建方式:yii migrate
功能:
FriendsLinksController
添加:r=friends-links/create
删除:r=friends-links/delete
查看:r=friends-links/view
更新:r=friends-links/update
管理:r=friends-links/index
+-------------------------------------------------------------------------------------------------------------+


#020
+-------------------------------------------------------------------------------------------------------------+
活动activity,activity_category
活动管理表:activity,activity_category
创建方式:yii migrate
资源位置:'admin.activityImageSaveDir'=>'uploads/activity/',//活动管理图片存储位置
功能:
ActivityController,ActivityCategoryController
添加:r=activity/create
删除:r=activity/delete
查看:r=activity/view
更新:r=activity/update
管理:r=activity/index

添加:r=activity-category/create
删除:r=activity-category/delete
查看:r=activity-category/view
更新:r=activity-category/update
管理:r=activity-category/index
+-------------------------------------------------------------------------------------------------------------+


#019
+-------------------------------------------------------------------------------------------------------------+
ueditor.savePath路径,配置params.php
\Yii::$app->params['ueditor.savePath'] //上传保存路径,
+-------------------------------------------------------------------------------------------------------------+


#018
+-------------------------------------------------------------------------------------------------------------+
单页管理single_page
数据表:single_page
创建方式:yii migrate
功能:
SinglePageController
添加:r=single_page/create
删除:r=single_page/delete
查看:r=single_page/view
更新:r=single_page/update
管理:r=single_page/index
+-------------------------------------------------------------------------------------------------------------+


#017
+-------------------------------------------------------------------------------------------------------------+
内容article,文章分类article_category
数据表:article
创建方式:yii migrate
'admin.ArticleImagesSaveDir'=>'uploads/article/',//后台文章缩略图存储位置
\Yii::$app->params['admin.ArticleImagesSaveDir'];
功能:
ArticleCategoryController
添加:r=article-category/create
删除:r=article-category/delete
查看:r=article-category/view
更新:r=article-category/update
管理:r=article-category/index

ArticleController
添加:r=article/create
删除:r=article/delete
查看:r=article/view
更新:r=article/update
管理:r=article/index
+-------------------------------------------------------------------------------------------------------------+


#016
+-------------------------------------------------------------------------------------------------------------+
游戏礼包game_gift
数据表:game_gift
创建方式:yii migrate
功能:
GameServerController
添加:r=game-gift/create
删除:r=game-gift/delete
查看:r=game-gift/view
更新:r=game-gift/update
管理:r=game-gift/index
+-------------------------------------------------------------------------------------------------------------+


#015
+-------------------------------------------------------------------------------------------------------------+
'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true,
        ],
由于yii提供的assetManager,即使采用如上的设置,还是不能对付客户端缓存对处于web根目录的资源文件不会加时间戳
所以采用在vendor目录中创建了buuug7目录用来存放前后台自己的资源
back目录对应后台视图的资源文件(css,js),并在对应app的assets目录创建对应的资源管理类来引用,比如BackendAsset
front目录对应前台视图的资源文件(css,js),FrontendAsset
其中的静态资源比如图片等依旧存储在对应app的web根目录,后台对应back,前台对应front
+-------------------------------------------------------------------------------------------------------------+


#014
+-------------------------------------------------------------------------------------------------------------+
刷新架构缓存
一个新的控制台命令添加了，允许您刷新架构缓存。这在更改生产服务器的代码部署导致DB模式是非常有用的。只需运行命令，如下所示：
yii cache/flush-schema
+-------------------------------------------------------------------------------------------------------------+


#013
+-------------------------------------------------------------------------------------------------------------+
游戏服务器game_server
数据表:game_server
创建方式:yii migrate
功能:
GameServerController
添加:r=game-server/create
删除:r=game-server/delete
查看:r=game-server/view
更新:r=game-server/update
管理:r=game-server/index
+-------------------------------------------------------------------------------------------------------------+


#012
+-------------------------------------------------------------------------------------------------------------+
游戏game/游戏分类game_category
数据表:game,game_category
创建方式:yii migrate
对应Controller:GameController,GameCategoryController
资源存储位置:\Yii::$app->params['admin.playerAlbumSaveDir']变量中储存
功能:
GameCategoryController
添加:r=game-category/create
删除:r=game-category/delete
查看:r=game-category/view
更新:r=game-category/update
管理:r=game-category/index

GameController
添加:r=game/create
删除:r=game/delete
查看:r=game/view
更新:r=game/update
管理:r=game/index
+-------------------------------------------------------------------------------------------------------------+


#011(TODO)
+-------------------------------------------------------------------------------------------------------------+
新增加的库文件
composer require "backup-manager/backup-manager": "^1.0"
用来进行数据库备份恢复,由于windows版本的命令行有问题,暂时搁置下

三个类用来处理备份还原
backend/models/DbBootstrap
backend/models/DbBackup
backend/models/DbRestore

配置文件
backend/config/storage.php
backend/config/database.php
+-------------------------------------------------------------------------------------------------------------+


#010
+-------------------------------------------------------------------------------------------------------------+
首页玩家相册
数据表:player_album
创建表方法:yii migrate
对于controller:PlayerAlbumController
资源存储位置:\Yii::$app->params['admin.playerAlbumSaveDir']变量中储存
功能:
添加:r=player-album/create
删除:r=player-album/delete
查看:r=player-album/view
更新:r=player-album/update
管理:r=player-album/index
+-------------------------------------------------------------------------------------------------------------+

#009
+-------------------------------------------------------------------------------------------------------------+
首页幻灯片
数据表:index_slide
创建表的方法:yii migrate
对应controller:IndexSlideController
资源存储位置:\Yii::$app->params['admin.indexSlideSaveDir']变量中储存
功能:
添加:r=index-slide/create
删除:r=index-slide/delete
查看:r=index-slide/view
更新:r=index-slide/update
管理:r=index-slide/index
+-------------------------------------------------------------------------------------------------------------+


#008
+-------------------------------------------------------------------------------------------------------------+
数据表:admin_log_xx
创建表的方法:yii migrate
对应controller:UserLogController
功能:
日志查看:r=user-log/admin-log
删除日志:r=user-log/delete-admin-log

其他:
其中前后台的用户日志采用一个控制器来管理
考虑到后台操作日志单表存储负荷量重,采用5张表结构相同表名不同的数据表来存储,也就是admin_log_0~admin_log_5

adminLog日志表的数量配置在:common/config/params.php中
'admin.adminLogMaxTableNumber'=>5,//后台用户日志表最大个数,从0开始,必须大于等于1

AdminLogUtil是一个辅助向多个日志表中(admin_log_xx)中随机插入日志信息,查询日志信息的辅助模型
例如:
$adminLogUtil=new \common\models\AdminLogUtil();

//会随机向5个日志表中挑选一个插入该条日志,日志的默认级别是4
$adminLogUtil=$adminLogUtil->exportLog('董干散2',__METHOD__);

//查询所有日志,返回yii\db\query对象
$adminLogUtil=$adminLogUtil->queryAll();

//删除日志,以时间戳为identity来删除
$adminLogUtil->deleteLog($logTime);

在AdminLogUtil中增加了获取上次登录时间的方法getLastLoginTime()

完成了管理员日志的基本功能
+-------------------------------------------------------------------------------------------------------------+


#007
+-------------------------------------------------------------------------------------------------------------+
数据表:admin
创建表的方法:yii migrate
对应controller:AdminUserController
实现功能:
添加管理员(r=admin-user/create)
更新管理员(r=admin-user/update)
查看管理员(r=admin-user/index)
删除管理员(r=admin-user/delete)
修改密码(r=admin-user/reset-password)
+-------------------------------------------------------------------------------------------------------------+


#006
+-------------------------------------------------------------------------------------------------------------+
数据库表统一前缀tq为"天奇"的简称
+-------------------------------------------------------------------------------------------------------------+


#005
+-------------------------------------------------------------------------------------------------------------+
yii2-admin
先安装数据表
yii migrate --migrationPath=@yii/rbac/migrations
然后切换,将PhpManager改成DbManager
'authManager' =>
[
    'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
]

有个bug是在用命令行用(yii migrate --migrationPath=@yii/rbac/migrations)的时候虽然在backend里面设置了DbManager
但是不起作用,解决方法是在common的config中在设置一遍
'authManager' =>
[
    'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
]
+-------------------------------------------------------------------------------------------------------------+


#004
+-------------------------------------------------------------------------------------------------------------+
由于后台模板bootstrap的版本为3.3.1,前台用的是最新的3.3.5
由于不会用bower管理一个包的不同版本
所有采用npm来管理bootstrap的3.3.1版本,目录在vendor/node_modules/bootstrap
bower管理的bootstrap为3.3.5,目录为vendor/bower/bootstrap
npm
先cd到vendor下
用npm init创建出package.json用处储存安装的dependencies,
npm install --save bootstrap@3.3.1
+-------------------------------------------------------------------------------------------------------------+


#003
+-------------------------------------------------------------------------------------------------------------+
bower:
bower init
bower install --save cropper
bower install --save font-awesome# --force
bower install --save fullcalendar
bower install --save html5shiv
bower install --svae less
bower install --save metisMenu#2.1.0
bower install --save modernizr#2.8.3
bower install --save OwlCarousel#1.3.2//暂时在项目中没用到该资源
bower install --save respond#*
bower install --save screenfull#2.0.0
+-------------------------------------------------------------------------------------------------------------+


#002
+-------------------------------------------------------------------------------------------------------------+
添加 yii2-shopping-cart:composer require --prefer-dist omnilight/yii2-shopping-cart "*"

添加 yii2-ueditor-widget:composer require kucha/ueditor "*"

添加 yii2-date-time-picker-widget:composer require 2amigos/yii2-date-time-picker-widget:~1.0

添加 yii2-jui:composer require --prefer-dist yiisoft/yii2-jui

添加 yii2-admin:composer require mdmsoft/yii2-admin "~2.0"
+-------------------------------------------------------------------------------------------------------------+


#001
+-------------------------------------------------------------------------------------------------------------+
重构后台
安装 git
安装 composer
安装 composer-asset-plugin: composer require "fxp/composer-asset-plugin:~1.0.3"
安装 yii2-app-advanced:composer create-project --prefer-dist yiisoft/yii2-app-advanced game4039
+-------------------------------------------------------------------------------------------------------------+

