<p align="center">
    <img src="https://i.imgur.com/YxC3NpS.png">
</p>




# PowerfulDB
Powerful web app repository for everything music related.
It can store artists, bands and albums infomation. Each can have other properties, for example
albums can have genres assigned.

![MIT](https://img.shields.io/github/license/Akasiek/PowerfulDB?color=%234EFFA6&style=for-the-badge)
![Python](https://img.shields.io/badge/Yii_Framework-3.10-4B8BBE?style=for-the-badge&logoColor=4B8BBE)
![PHP](https://img.shields.io/badge/PHP-8.1.1-44b78b?color=%238993BE&style=for-the-badge&logo=php&logoColor=8993be)




## Features

- Artists, Bands and Albums information pages
- Band's members system
- Album's genres system
- User profiles (list of contributions, points) 
- Edit system


## Roadmap

- More profile stuff (badges, etc.)
- Polish language version


## Demo

[Live website](http://powerfuldb.herokuapp.com/) | [Behance](https://www.behance.net/gallery/148753655/PowerfulDB)


## Run Locally (Windows)

Clone the project in the root of XAMPP ```htdocs``` directory and install dependencies

```bash
  git clone https://github.com/Akasiek/PowerfulDB.git PowerfulDB
  cd PowerfulDB
  composer install
```

Create PostgreSQL database called ```powerfuldb```

Go to this directory

```bash
  cd common\config
```

Here create file ```main-local.php``` with this inside

```php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=localhost;dbname=powerfuldb',
            'username' => 'postgres',
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
            'schemaMap' => [
                'pgsql' => [
                    'class' => 'yii\db\pgsql\Schema',
                    'defaultSchema' => 'public'
                ]
            ],
        ],
    ],
];
```

Go to the root of the project and run

```bash
php yii migrate
```

Go to XAMPP ```httpd-vhosts.conf``` file.
You can probably find it here ```C:\xampp\apache\conf\extra\httpd-vhosts.conf```.
Put this code on the end of this file
```conf
<VirtualHost *:80>
    ServerName powerfuldb.test
    DocumentRoot "C:\xampp\htdocs\PowerfulDB\frontend\web"
    <Directory "C:\xampp\htdocs\PowerfulDB\frontend\web">
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
        DirectoryIndex index.php
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName admin.powerfuldb.test
    DocumentRoot "C:\xampp\htdocs\PowerfulDB\backend\web"
    <Directory "C:\xampp\htdocs\PowerfulDB\backend\web">
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
        DirectoryIndex index.php
        Require all granted
    </Directory>
</VirtualHost>
```

Then change the hosts file to point the domain to your server.
You can find the file here ```C:\Windows\System32\Drivers\etc\hosts```.
Add this to the end of the file.

```
127.0.0.1   powerfuldb.test
127.0.0.1   admin.powerfuldb.test
```

If your XAMPP Apache is running, you should access app in the browser
on [powerfuldb.test](http://powerfuldb.test) and admin panel on [admin.powerfuldb.test](http://admin.powerfuldb.test)

Create new account and go to

```bash
frontend\runtime\mail
```

There should be a file with your signup mail in it. It's a .eml file so the verify link
is formated. If there is "=" before linebreak delete the "=" sign and the break. If there is
"=" without linebreak, delete "3D" after it. So it should look like this:

```
Before:
ht=
tp://powerfuldb.test/site/verify-email?token=3DZTq9pa_gAjC5-t2y1k6IKiQRgNhg=
GmD-_1658784917

After:
http://powerfuldb.test/site/verify-email?token=ZTq9pa_gAjC5-t2y1k6IKiQRgNhgGmD-_1658784917
```

After clicking the correct link your account will be verified and you'll be logged in.

If you encauntered some problems or using other OS try going to
[this guide](https://www.yiiframework.com/extension/yiisoft/yii2-app-advanced/doc/guide/2.0/en)
