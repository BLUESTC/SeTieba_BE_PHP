# SeTieba_BE_PHP
运行以下命令
```shell
$git clone https://github.com/BLUESTC/SeTieba_BE_PHP
$cd SeTieBa_BE_PHP
$composer install
$mv .env.example env
$mv config/database.bak config/database.php
$mkdir -p storage/logs && mkdir storage/logs && mkdir -p storage/framework/cache && mkdir storage/framework/views &&mkdir -p storage/framework/sessions &&chmod -R 777 storage
```
之后你还需要配置.env和config/database.php中的数据库配置，另外配置httpd开启rewrite 模块

如果你的文件夹权限不正确，运行
```shell
$cd SeTieBa_BE_PHP 
$find ./ -type d -exec chmod 755 {} +
$find ./ -type f -exec chmod 644 {} +
$chmod 777 -R storage
```
