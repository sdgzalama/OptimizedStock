<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>

<div class="flex items-stretch h-screen bg-cover bg-center relative bg-no-repeat bg-[url('../images/bg-auth.jpg')]">
    <div class="bg-white lg:max-w-[480px] z-10 p-12 relative w-full h-full border-t-[3px] border-primary">
        <div class="flex flex-col h-full gap-4">
            <div class="mb-8 text-center lg:text-start">
                <b><h1><a href="<?= Yii::$app->homeUrl ?>"><?= Html::encode(Yii::$app->params['appName']) ?></a></h1></b>
            </div>
            <div class="my-auto">
                <h4 class="text-dark/70 text-lg font-semibold dark:text-light/80 mb-2">Sign Up</h4>
                <p class="text-gray-400 mb-9">Enter your details below to register</p>

                <?php $form = ActiveForm::begin(['id'=>'signup-form']) ?>

                <div class="mb-6 space-y-2">
                    <?= $form->field($model, 'username')->textInput([
                        'class'=>'form-input',
                        'placeholder'=>'Enter your username'
                    ])->label('Username',['class'=>'font-semibold text-gray-500']) ?>
                </div>

                <div class="mb-6 space-y-2">
                    <?= $form->field($model, 'email')->textInput([
                        'class'=>'form-input',
                        'placeholder'=>'Enter your email'
                    ])->label('Email',['class'=>'font-semibold text-gray-500']) ?>
                </div>

                <div class="mb-6 space-y-2">
                    <?= $form->field($model, 'password')->passwordInput([
                        'class'=>'form-input rounded-e-none',
                        'placeholder'=>'Enter your password'
                    ])->label('Password', ['class' => 'font-semibold text-gray-500']) ?>
                </div>

                <div class="text-center">
                    <?= Html::submitButton('<i class="ri-login-box-line me-1"></i> Sign Up', [
                        'class' => 'btn bg-primary text-white w-full'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
