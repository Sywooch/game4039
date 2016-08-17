## 这里是一些常用的入口地址以及其他有用的信息

### 1
http://game4039.dev/user/admin  前台用户管理(默认账号:buuug7)

uc_server 密码为admin

进入dz后台管理:
http://xxx/admin.php
dz 账号密码 admin/admin

### 2
用户的行为配置在config文件,component->user中

###  3
覆盖引用composer第三方类库中的个别文件的目录为项目根目录下的override-3rd-lib目录

###  4
该项目下运行yii migrate
//创建一个迁移,位于common/migrations/db
php console/yii migrate/create create_table_game_gamecategory
//执行一个迁移
php console/yii

//创建一个rbac迁移,会在common/migrations/rbac目录生成一个新的迁移文件
php console/yii rbac-migrate/create
//执行一个rbac迁移文件
php console/yii rbac-migrate

###  5
由于来自于http://layer.layui.com/官网的layer插件没有对应的bower以及npm资源
并不能用包管理来引用,将其放入项目根目录的overrider-3rd-lib目录中

###  6
记着安装composer-asset-plugin
composer require "fxp/composer-asset-plugin:~1.0.3"

###  7
站内消息设计方案:
方案一:
消息表message:
编号 id
时间 date
标题 title
正文 content
未读用户 unread
接收用户 receive
发送用户 send

字段receive保存消息接收人的ID序列如1,2,3,4(用逗号分隔).
字段unread保存未阅读消息的接收人的ID序列,unread初始值也为所有接收人,阅读过消息的用户则从中删除掉.
可以用MySQL内部函数FIND_IN_SET(返回找到的位置,从1开始)进行查询.

比如,查询编号为2的用户的未读信息:
SELECT * FROM `message` WHERE FIND_IN_SET('2', `unread`);

或者使用全文检索(需要对字段unread建立全文索引,ID序列用空格隔开,如1 2 3 4):
SELECT * FROM `message` WHERE MATCH(`unread`) AGAINST('2');

数据量比较大的话,FIND_IN_SET可能会存在性能问题,建议定时清理消息表过期的已经阅读过的消息.

方案二:
1.tb_message (id,content,fromUid,toUid [0表示全站用户，>0表示发送给某个用户])
2.tb_message_readlog (readLogId,messageId,uid,isread)
如果消息数据量比较大，建议分表处理，可以根据用户的id来分表，比如id=123456的用户发送的消息就放到tb_message6，类似这样的处理

###  8
用户消息需要完善的地方:
增加分类,前台用户删除已阅读的消息

###  9
会员等级	刻度划分
VIP0	0<=成长值<1,000
VIP1	1,000<=成长值<10,000
VIP2	10,000<=成长值<50,000
VIP3	50,000<=成长值<200,000
VIP4	200,000<=成长值<500,000
VIP5	500,000<=成长值<1,000,000
VIP6	1,000,000<=成长值<3,000,000
VIP7	3,000,000<=成长值<10,000,000
VIP8	10,000,000<=成长值<30,000,000
VIP9	成长值>=30,000,000


论坛积分跟成长值兑换比例 1:x
暂时定义为1:10,也就是
credits-growth-value-rate=10


//前台用的到资源文件整理
css文件:
bootstrap.css
unify/assets/css/style.css
unify/assets/css/headers/header-v8.css
unify/assets/css/footers/footer-default.css
unify/assets/plugins/line-icons/line-icons.css
unify/assets/plugins/font-awesome/css/font-awesome.css
unify/assets/css/theme-colors/teal.css
unify/assets/css/custom.css

unify/assets/plugins/revolution-slider/rs-plugin/css/settings.css
unify/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css
unify/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css

### 10
部署到新的服务器上的时候需要注意事项
- frontend/runtime
- backend/runtime
- frontend/web/assets
- backend/web/assets
- storage/
以上目录权限需要777

```
chmod -R 777 /var/www/html/game4039/frontend/runtime
chmod -R 777 /var/www/html/game4039/backend/runtime
chmod -R 777 /var/www/html/game4039/frontend/web/assets
chmod -R 777 /var/www/html/game4039/frontend/web/assets
chmod -R 777 /var/www/html/game4039/storage
```
新服务器apache2比如要
a2enmod rewrite

修改项目根目录的 .env文件,配置你自己的账号密码

修改 frontend/web/config.inc.php中账号密码(ucenter)

修改bbs/config目录下的config_global.php和config_ucenter.php中账号和密码
修改bbs/uc_server/data/config.inc.php中账号和密码

设置 bbs目录中data目录以及子目录 为可读写

### ucenter 通信设置
记着 设置 ucenter_server目录为可读写







