<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model \frontend\models\AddStockForm */
/* @var $this yii\web\View */
?>


<div class="card">
    <div class="p-6">
        <div class="flex justify-between items-center">
            <h4 class="card-title mb-1">Add Stock Item</h4>
        </div>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success my-3">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'grid lg:grid-cols-3 sm:grid-cols-2 gap-6'],]); ?>

        <?= $form->errorSummary($model) ?>

        <div>
            <?= $form->field($model, 'item_name')->textInput([
                'class' => 'form-input', 
                'maxlength' => true
            ])->label('Item Name', ['class' => 'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($model, 'quantity')->input('number', [
                'min' => 1, 
                'class' => 'form-input'
            ])->label('Quantity', ['class' => 'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($model, 'buying_price')->input('number', [
                'step' => '0.01', 
                'class' => 'form-input'
            ])->label('Buying Price', ['class' => 'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($model, 'selling_price')->input('number', [
                'step' => '0.01', 
                'class' => 'form-input'
            ])->label('Selling Price', ['class' => 'mb-2 block']) ?>
        </div>

        <div class="lg:col-span-3">
            <?= Html::submitButton('Add Stock', [
                'class' => 'btn bg-primary text-white'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
