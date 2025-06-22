<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    // 'defaultRoute' => 'site/login',
    'defaultRoute' => 'site/index',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                'class' => 'yii\authclient\clients\Google',
                'clientId' => '361519540419-dr6ae190iviess4scsrckl930qivnv1m.apps.googleusercontent.com',  // Your Google Client ID
                'clientSecret' => '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',  // Replace with your Client Secret
                'returnUrl' => 'http://localhost:8080/site/auth?authclient=google',  // Match with Google Console
                  
                    'scope'        => 'email profile',
                ],
            ],
        ],

        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            // 'enableAutoLogin' => true,
            'enableAutoLogin' => false, // Disable auto-login for security
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'authTimeout' => 1000, // 1 hour
            'loginUrl' => ['site/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'class' => 'yii\web\DBSession',
            'timeout' => 1000, // 24 minutes
            
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' =>[
            'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        'useFileTransport' => false,
        // 'useFileTransport' => YII_ENV_DEV,
        'transport'=>[
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'sidagawazirikihongo@gmail.com',
            'password' => 'lmti ljcy xrra iwwa', // use that 16-letter app password
            'port' => '587',
            'encryption' => 'tls',
        ],

    ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];
