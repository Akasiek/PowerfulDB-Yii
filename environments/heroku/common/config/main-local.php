<?php

$host = $username = $password = $dbname = '';

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
if (isset($url["host"]) && isset($url["user"]) && isset($url["pass"]) && isset($url["path"])) {
    $host = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $dbname = substr($url["path"], 1);
}

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . $host . ';dbname=' . $dbname,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host' => 'powerfuldb.herokuapp.com',
                'port' => getenv('MAILGUN_SMTP_PORT'),
                'username' => getenv('MAILGUN_SMTP_LOGIN'),
                'password' => getenv('MAILGUN_SMTP_PASSWORD'),
            ],
        ],
    ],
];
