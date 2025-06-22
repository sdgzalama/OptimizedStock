<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>

<div class="flex items-stretch h-screen bg-cover bg-center relative bg-no-repeat bg-[url('../images/bg-auth.jpg')]" >
    <div class="bg-white lg:max-w-[480px] z-10 p-12 relative w-full h-full border-t-[3px] border-primary" >
        <!-- div for form  -->
        <div class="flex flex-col h-full gap-4"  style="background-color:rgb(11, 12, 12);">

            <div class="mb-8 text-center lg:text-start">
                <b><h1 class="text-white/70 text-lg font-semibold dark:text-light/80 mb-2"><a href="<?= Yii::$app->homeUrl ?>" ><?= Html::encode(Yii::$app->params['appName']) ?></a> Sign In</h1></b>
            </div>

            <div class="my-auto">
                
                <p class="font-semibold text-gray-400 mb-9 ">Enter your username and password to access account!</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <div class="mb-6 space-y-2">
                        <?= $form->field($model, 'username')->textInput([
                            'class' => 'form-input',
                            'placeholder' => 'Enter your email'
                        ])->label('Email address', ['class' => 'font-semibold text-gray-500']) ?>
                    </div>

                    <div class="mb-6 space-y-2">
                        <div class="flex justify-between items-center mb-2">
                            <?= Html::label('Password', 'password', ['class' => 'font-semibold text-gray-500']) ?>
                            <a href="<?= \yii\helpers\Url::to(['site/request-password-reset']) ?>" class="text-muted text-xs">Forgot your password?</a>
                        </div>
                        <div class="flex items-center">
                            <?= Html::activePasswordInput($model, 'password', [
                                'class' => 'form-input rounded-e-none',
                                'placeholder' => 'Enter your password',
                            ]) ?>
                            <span class="px-3 py-1 border rounded-e-md -ms-px"><i class="ri-eye-line text-lg"></i></span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center">
                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => "{input} <label class='ms-2 text-sm font-medium' for='loginform-rememberme'>{labelTitle}</label>\n{error}",
                                'label' => 'Remember me',
                                'labelOptions' => ['class' => 'text-sm font-medium'],
                                'checkboxTemplate' => '<input type="checkbox" class="form-checkbox rounded text-primary" {input}>'
                            ]) ?>
                        </div>
                    </div>

                    <div class="text-center">
                        <?= Html::submitButton('<i class="ri-login-box-line me-1"></i> Log In', ['class' => 'btn bg-primary text-white w-full']) ?>
                    </div>
                <?php ActiveForm::end(); ?>

                <!-- Optional: Social login buttons -->
                 <!-- social-->
                 <div class="text-center mt-9">
                            <p class="text-gray-400 text-base mb-6">Sign in with</p>
                            <ul class="inline-flex gap-2">
                                <li class="">
                                    <a href="javascript: void(0);" class="rounded-full border-2 border-primary text-primary w-8 h-8 inline-flex items-center justify-center"><i class="ri-facebook-circle-fill"></i></a>
                                </li>
                                <li class="">
                        <?php
                        use yii\authclient\widgets\AuthChoice;
                        $authAuthChoice = AuthChoice::begin([
                            'baseAuthUrl' => ['site/auth'],
                            'popupMode' => false, // Optional: Use redirect instead of popup
                        ]);

                        foreach ($authAuthChoice->getClients() as $client) {
                            if ($client->getName() === 'google') {
                                echo $authAuthChoice->clientLink($client, 
                                    '<i class="ri-google-fill"></i>', 
                                    [
                                        'class' => 'rounded-full border-2 border-danger text-danger w-8 h-8 inline-flex items-center justify-center',
                                        'title' => 'Login with Google',
                                    ]
                                );
                            }
                        }

                        AuthChoice::end();
                        ?>
                    </li>

                                <li class="">
                                    <a href="javascript: void(0);" class="rounded-full border-2 border-info text-info w-8 h-8 inline-flex items-center justify-center"><i class="ri-twitter-fill"></i></a>
                                </li>
                                <li class="">
                                    <a href="javascript: void(0);" class="rounded-full border-2 border-secondary text-secondary w-8 h-8 inline-flex items-center justify-center"><i class="ri-github-fill"></i></a>
                                </li>
                            </ul>
                        </div>
            </div>

            <footer class="text-center justify-center h-14 -mb-12">
                <p class="text-gray-400">Don't have an account? <a href="<?= \yii\helpers\Url::to(['site/signup']) ?>" class="text-gray-500 ms-1"><b>Sign Up</b></a></p>
            </footer>
        </div>
    </div>

    <div class="bg-black/30 w-full h-full relative hidden lg:block">
        <div class="absolute start-0 end-0 bottom-0 flex mt-auto justify-center text-center">
                <div class="xl:w-1/2 w-full mx-auto">
                    <div class="swiper mt-auto cursor-col-resize" id="swiper_one">
                        <div class="swiper-wrapper mb-12">
                            <div class="swiper-slide">
                                <div class="swiper-slide-content">
                                    <h2 class="text-3xl text-white mb-6"><b>Warmly Welcome!</b></h2>
                                    <p class="text-lg text-white mb-5"><i class="ri-double-quotes-l"></i> Here in OptiStock, there is optimized and neat performance, seamlessly transfer of stock's products<i class="ri-double-quotes-r"></i></p>
                                    <p class="text-white mx-auto">
                                        - Admin
                                    </p>
                                </div>
                            </div>
                            <!-- swiper-slide End -->
                            </div>
                        <!-- swiper-wrapper End -->

                    </div>
                </div>
            </div>
    </div>
</div>
