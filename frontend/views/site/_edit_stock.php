<?php

use common\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $stock frontend\models\Stock */

?>

<div class="">
    <div class="p-6">
        <div class="flex justify-between items-center">
            <h4 class="card-title mb-1">Edit Stock Item</h4>
        </div>

        <?= Alert::widget() ?>

        <?php $form = ActiveForm::begin([
            'id' => 'stock-form',
            'enableAjaxValidation' => true,
            'action' => ['site/update-stock', 'id' => $stock->id],
            'method' => 'post',
            'options' => ['class' => 'grid lg:grid-cols-3 sm:grid-cols-2 gap-6']
        ]); ?>

        <div>
            <?= $form->field($stock, 'item_name')->textInput([
                'class' => 'form-input',
                'maxlength' => true
            ])->label('Item Name', ['class'=>'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($stock, 'quantity')->textInput([
                'type' => 'number',
                'min' => 1,
                'class' => 'form-input'
            ])->label('Quantity', ['class'=>'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($stock, 'buying_price')->textInput([
                'type' => 'number',
                'step' => '0.01',
                'min' => 0,
                'class'=> 'form-input'
            ])->label('Buying Price', ['class'=>'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($stock, 'selling_price')->textInput([
                'type' => 'number',
                'step' => '0.01',
                'min' => 0,
                'class'=> 'form-input'
            ])->label('Selling Price', ['class'=>'mb-2 block']) ?>
        </div>

        <div class="lg:col-span-3">
            <?= Html::submitButton('Update', ['class' => 'btn bg-success text-white']) ?>
            <?= Html::button('Cancel', ['class' => 'btn bg-danger text-white', 'onclick' => 'hideAddStockForm()']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
function hideAddStockForm() {
    window.location.href = '<?= Yii::$app->urlManager->createUrl(['site/index']) ?>';
}
</script>
