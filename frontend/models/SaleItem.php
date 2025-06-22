<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class SaleItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%sale_item}}';
    }

    public function rules()
    {
        return [
            [['sale_id', 'stock_id', 'quantity', 'price', 'amount'], 'required'],
            [['sale_id', 'stock_id', 'quantity'], 'integer'],
            [['price', 'amount', 'discount'], 'number'],
        ];
    }

    public function getSale()
    {
        return $this->hasOne(Sale::class, ['id' => 'sale_id']);
    }

    public function getStock()
    {
        return $this->hasOne(Stock::class, ['id' => 'stock_id']);
    }
}
