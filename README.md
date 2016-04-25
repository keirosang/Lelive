# Lelive

### 安装说明

项目依赖
```
PHP >= 5.5.9
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
```
并且需要安装[Composer](https://getcomposer.org/download/)

1) 通过git clone获得本项目源码：

运行命令
```
git clone https://github.com/volio/Lelive.git
```

2) 安装composer依赖

在clone下来的`Lelive`文件夹中运行命令

```
cp .env.example .env
```
创建项目.env文件（如果处于windows环境下可利用git bash执行上述命令）

随后编辑.env文件进行环境配置

示例结果如下
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=SomeRandomString

DB_HOST=127.0.0.1
DB_DATABASE=homestead （请先建立数据库）
DB_USERNAME=homestead
DB_PASSWORD=secret

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

//后台邀请码
INVITECODE=example
```
之后执行
```
composer install
```
这条命令将安装项目的composer依赖，为提升composer包安装速度建议使用composer中国全量镜像，

相关信息如下：http://pkg.phpcomposer.com/

然后运行命令
```
php artisan key:generate
```

设定laravel应用所需的key

上述命令执行完成后,请在`Lelive`文件夹中使用命令

如仅需表结构，可在composer依赖安装完毕后运行命令
```
php artisan migrate
```
进行数据库初始化

5）运行应用
根目录下执行命令
```
php artisan serve
```
然后通过浏览器访问地址`http://localhost:8000`即可

部署时注意权限问题
```
chmod -R 775 /var/www/laravel/storage
```

这两个是申请完乐视和leancloud得到API KEY、Secret后填写。
```
Lelive/app/Services/Leancloud.php
Lelive/app/Services/Lecloud.php
```

nginx.conf
```
server {
    listen       80;
    server_name  xxx.xxx;
    root         你的目录/public;
    index        index.php index.html;


    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php7-fpm.sock;   //改成你的PHP-FPM
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```
