<?php


use frontend\assets\AppAsset;  //These one is a custom asset bundle
use common\widgets\Alert;
use yii\bootstrap5\Html;

/** @var \yii\web\View $this */

/**
 * @var string $content
 */


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


    <!-- Theme Config Js -->
    <link href="/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/assets/css/app.min.css">
    <link rel="stylesheet" href="/assets/css/icons.min.css">
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css">

    <script src="/assets/js/config.js"></script>
</head>

<body class="">
    <?php $this->beginBody() ?>



    <!-- Main Content -->
    <main>
        <?= \yii\bootstrap5\Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'] ?? [],
        'options' => ['class' => 'mb-4 text-sm text-gray-500'],
        ]) ?>
        <?= $content ?>
    </main>
    <!-- end main content  -->

    <!-- Scripts -->


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- jQuery (should load early if other scripts depend on it) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Third-party libraries FIRST -->
    <script src="/assets/libs/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/libs/lucide/umd/lucide.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/@frostui/tailwindcss/frostui.js"></script>
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Apex Charts js -->
    <!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script> -->

    <!-- Vector Map Js -->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/libs/jsvectormap/maps/world.js"></script>

    <!-- Dashboard App js -->
    <script src="assets/js/pages/dashboard-analytics.js"></script>


    <!-- project scripts AFTER libraries -->
    <script src="/assets/js/pages/auth-swiper.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/pages/dashboard.js"></script>


    <!-- <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> -->


    <!-- Plugin Js -->
    <!-- <script src="assets/libs/simplebar/simplebar./min.js"></script> -->
    <!-- <script src="assets/libs/lucide/umd/lucide.min.js"></script> -->
    <!-- <script src="assets/libs/@frostui/tailwindcss/frostui.js"></script> -->

    <!-- App Js -->
    <!-- <script src="/assets/js/app.js"></script> -->

    <!-- Swiper Plugin Js -->
    <!-- <script src="/assets/libs/swiper/swiper-bundle.min.js"></script> -->

    <!-- Swiper Auth Demo Js -->


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>