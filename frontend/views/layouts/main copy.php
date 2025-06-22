<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Include Tailwind and Attex custom? styles -->
    <link rel="stylesheet" href="/assets/css/app.min.css">
    <link rel="stylesheet" href="/assets/css/icons.min.css">
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
<?php $this->beginBody() ?>

<!-- Header -->
<header class="bg-white shadow dark:bg-gray-800">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-700 dark:text-white">
            <a href="<?= Yii::$app->homeUrl ?>"><?= Html::encode(Yii::$app->name) ?></a>
        </div>

        <nav class="space-x-4">
            <a href="<?= Yii::$app->urlManager->createUrl(['/site/index']) ?>" class="text-gray-600 hover:text-primary">Home</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/site/about']) ?>" class="text-gray-600 hover:text-primary">About</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>" class="text-gray-600 hover:text-primary">Contact</a>

            <?php if (Yii::$app->user->isGuest): ?>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/signup']) ?>" class="text-gray-600 hover:text-primary">Signup</a>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>" class="text-gray-600 hover:text-primary">Login</a>
            <?php else: ?>
                <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'inline']) ?>
                    <?= Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'text-gray-600 hover:text-red-500']
                    ) ?>
                <?= Html::endForm() ?>
            <?php endif; ?>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4 py-6">
    <?= \yii\bootstrap5\Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'] ?? [],
        'options' => ['class' => 'mb-4 text-sm text-gray-500'],
    ]) ?>

    <?= Alert::widget() ?>
    <?= $content ?>
</main>

<!-- Footer -->
<footer class="bg-white dark:bg-gray-800 text-sm text-gray-500 dark:text-gray-400 border-t py-4 mt-10">
    <div class="container mx-auto px-4 flex justify-between">
        <p>&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p><?= Yii::powered() ?></p>
    </div>
</footer>

<!-- Scripts -->
<script src="/assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="/assets/js/app.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
