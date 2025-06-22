<?php

use common\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AddStockForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="">

    <div class="p-6">
        <div class="flex justify-between items-center">
            <h4 class="card-title mb-1">Add Stock Item</h4>
        </div>
        <?= Alert::widget() ?>

        <?php $form = ActiveForm::begin([
        'options' => ['class' =>
         'grid lg:grid-cols-3 sm:grid-cols-2 gap-6'],
        'id' => 'stock-form',
        'enableAjaxValidation' => true,
        'action' => ['site/add-stock'], // Specific action for form submission
    ]); ?>
        <div>

            <?= $form->field($model, 'item_name')->textInput([
        'class' => 'form-input',
        'maxlength' => true,
        
        ])->label('Item Name', ['class'=>'mb-2 block']) ?>
        </div>

        <div>
            <?= $form->field($model, 'quantity')->textInput(['number',
            'min' => 1,
            'class' => 'form-input'
            ])->label('Quantity', ['class'=>'mb-2 block']) ?>

        </div>
        <div>
            <?= $form->field($model, 'buying_price')->textInput([
                'placeholder' => '@0.00',
                'number', 
                'step' => '0.01', 'min' => 0, 'class'=> 'form-input'
                ])->label('Buying Price', ['class'=>'mb-2 block']) ?>
        </div>
        <div>
            <?= $form->field($model, 'selling_price')->textInput(['number', 
            'placeholder' => '@0.00',
            'step' => '0.01', 'min' => 0,
            'class'=> 'form-input'
            ])->label('Selling Price', ['class'=>'mb-2 block']) ?>

        </div>
    </div>

    <div class="lg:col-span-3">
        <?= Html::submitButton('Add Stock Item', ['class' => 'btn bg-success text-white']) ?>
        <?= Html::button('Cancel', ['class' => 'btn bg-danger text-white', 'onclick' => 'hideAddStockForm()']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
function hideAddStockForm() {
    window.location.href = '<?= Yii::$app->urlManager->createUrl(['site/index']) ?>';
}
</script>