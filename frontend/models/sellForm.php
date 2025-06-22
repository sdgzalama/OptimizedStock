<?php
namespace frontend\models;

use yii\base\Model;

class SellForm extends Model
{
    public $stock_id;
    public $quantity;

    public function rules()
    {
        return [
            [['stock_id', 'quantity'], 'required'],
            [['stock_id'], 'integer'],
            [['quantity'], 'integer', 'min' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'stock_id' => 'Item to Sell',
            'quantity' => 'Quantity',
        ];
    }
}
