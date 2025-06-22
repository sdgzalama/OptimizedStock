<?php
use yii\bootstrap5\Html;  // Import the Html class

/** @var \yii\web\View $this */

/** 
 * @var string $content 
 */
?>


<header class="app-header flex items-center px-4 gap-3.5">

    <!-- App Logo -->
    <a href="index.html" class="logo-box">
        <!-- Light Logo -->
        <div class="logo-light">
            <strong>
                <h1>OptimizedStock</h1>
            </strong>
        </div>

        <!-- Dark Logo -->
        <div class="logo-dark">
            <strong>
                <h1>OptimizedStock</h1>
            </strong>
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-toggle-menu" class="nav-link p-2">
        <span class="sr-only">Menu Toggle Button</span>
        <span class="flex items-center justify-center">
            <i class="ri-menu-2-fill text-2xl"></i>
        </span>
    </button>

    <!-- Topbar Search Input -->
    <div class="relative hidden lg:block">

        <form data-fc-type="dropdown" type="button">
            <input type="search" class="form-input bg-black/5 border-none ps-8 relative" placeholder="Search...">
            <span class="ri-search-line text-base z-10 absolute start-2 top-1/2 -translate-y-1/2"></span>
        </form>


    </div>

    <!-- Language Dropdown Button -->
    <div class="relative ms-auto">
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link p-2 fc-dropdown">
            <span class="flex items-center gap-2">
                <!-- <img src="assets/images/flags/us.jpg" alt="flag-image" class="h-3"> -->
                 <img src="<?= Yii::getAlias('@web')?>/assets/images/flags/tz-flag.png" width="20px" height="20px" class="h-3" alt="">
                <div class="lg:block hidden">
                    <span>English</span>
                    <i class="ri-arrow-down-s-line"></i>
                </div>
            </span>
        </button>



    </div>

    <!-- Notification Bell Button -->
    <div class="relative lg:flex hidden">
        <button  type="button" class="nav-link p-2">
            <span class="sr-only">View notifications</span>
            <span class="flex items-center justify-center">
                <i class="ri-notification-3-line text-2xl"></i>
                <span class="absolute top-5 end-2.5 w-2 h-2 rounded-full bg-danger"></span>
            </span>
        </button>

    </div>

    <!-- Apps Dropdown -->
    <div class="relative lg:flex hidden">
        <button  type="button" class="nav-link p-2">
            <span class="sr-only">Apps</span>
            <span class="flex items-center justify-center">
                <i class="ri-apps-2-line text-2xl"></i>
            </span>
        </button>

    </div>

    <!-- Theme Setting Button -->
    <div class="flex">
        <button  type="button" class="nav-link p-2">
            <span class="sr-only">Customization</span>
            <span class="flex items-center justify-center">
                <i class="ri-settings-3-line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Light/Dark Toggle Button -->
    <div class="lg:flex hidden">
        <button id="light-dark-mode" type="button" class="nav-link p-2">
            <span class="sr-only">Light/Dark Mode</span>
            <span class="flex items-center justify-center">
                <i class="ri-moon-line text-2xl block dark:hidden"></i>
                <i class="ri-sun-line text-2xl hidden dark:block"></i>
            </span>
        </button>
    </div>

    <!-- Fullscreen Toggle Button -->
    <div class="md:flex hidden">
        <button data-toggle="fullscreen" type="button" class="nav-link p-2">
            <span class="sr-only">Fullscreen Mode</span>
            <span class="flex items-center justify-center">
                <i class="ri-fullscreen-line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Profile Dropdown Button -->
    <div class="relative">
        <!-- Dropdown toggle button -->
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button"
            class="nav-link flex items-center gap-2.5 px-3 bg-black/5 border-x border-black/10">
            <img src="<?= Yii::getAlias('@web')?>/assets/images/users/funny.png" alt="user-image" class="rounded-full h-12">

        <!-- IF THERE IS NO USER LOGGED IN IT RETURN ERROR I HAVE TO SOLVE THE ISSUE -->
            <span class="md:flex flex-col gap-0.5 text-start hidden">
                <?php if(!Yii::$app->user->isGuest): ?>
                
                <h5 class="text-sm"><?= Yii::$app->user->identity->username ?></h5>
                <span class="text-xs">
                    <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'w-full', 'id' => 'logout-form']) ?>
                    <a href="javascript:void(0)" class="w-full"
                        onclick="document.getElementById('logout-form').submit();">Logout</a>
                    <?= Html::endForm() ?>
                </span>
                <?php else: ?>
                    <h5 class="text-sm">Guest</h5>
                    <span>
                        <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="text-blue-600 hover:underline">Login</a>
                    </span>
                <?php endif;?>
            </span>


        </button>

        <!-- Dropdown menu -->

    </div>

</header>
<!-- Topbar End -->

