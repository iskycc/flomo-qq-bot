# flomo-qq-bot

通过QQ保存文字和图片到flomo

## 已实现的功能

①绑定

②保存文字或图片

③同时保存文字和图片

④解绑

## 声明
本项目依赖[Nodejs原生QQ机器人Http-Api(onebot的实现)](https://github.com/takayama-lily/node-onebot)作为QQ API，仅作为学习和交流。**请不要使用自己常用的QQ！** 感谢原开发者对QQ api的实现。
## 要求
①Windows或者Linux操作系统的主机或服务器

②**有耐心或者态度好**

③操作系统上安装node环境，并安装好Nginx和PHP

(**如果满足①②点并且不想自己动手的可以直接将您的常用联系方式邮件发送到iskycc@hotmail.com，鄙人收到后有时间会联系您亲自帮您部署**)

## 简易教程

#### step1

将本项目所有文件放到您所创建的网站站点根目录(git clone or download zip)，给flomo.db可读写权限。记住，此站点的url不要告诉别人。

#### step2

根据[Nodejs原生QQ机器人Http-Api(onebot的实现)](https://github.com/takayama-lily/node-onebot)项目部署QQ api，config.js配置文件中启用http(use http: true)，填写好access_token(你想填的)和post_url(第一步创建的站点的url，例如http://host:port/index.php)

#### step3

在step1的站点中的index.php文件里第二行填入step2中的access_token，如果站点和api不在同一个主机或服务器，则还需要更改第三行的ip:port。

#### step4

node启动api，enjoy~
