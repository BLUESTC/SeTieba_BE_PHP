# SeTieba_BE_PHP
运行以下命令
```shell
$git clone https://github.com/BLUESTC/SeTieba_BE_PHP
$cd SeTieBa_BE_PHP
$composer install
$mv env.example env
$mv config/database.bak config/database.php
$mkdir storage&& mkdir storage/app && mkdir storage/framework && mkdir storage/logs&&chmod -R 777 storage
```
之后你还需要配置.env和config/database.php中的数据库配置，另外配置httpd开启rewrite 模块
