<?php

namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * AddStockForm model
 *
 * @property string $item_name
 * @property int $quantity
 * @property float $buying_price
 * @property float $selling_price
 */
class AddStockForm extends Model
{
    public $item_name;
    public $quantity;
    public $buying_price;
    public $selling_price;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'quantity', 'buying_price', 'selling_price'], 'required'],
            [['quantity'], 'integer', 'min' => 1],
            [['buying_price', 'selling_price'], 'number', 'min' => 0],
            [['item_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'quantity' => 'Quantity',
            'buying_price' => 'Buying Price',
            'selling_price' => 'Selling Price',
        ];
    }

    /**
     * Saves the form data to database
     * @return bool whether the saving succeeded
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        // Create new Stock record (assuming you have a stock table)
        $stock = new Stock();
        $stock->item_name = $this->item_name;
        $stock->quantity = $this->quantity;
        $stock->buying_price = $this->buying_price;
        $stock->selling_price = $this->selling_price;
        // $stock->created_at = new \yii\db\Expression('NOW()');
        $stock->created_at = new Expression('NOW()');
        $stock->created_by = Yii::$app->user->id;

        return $stock->save();
    }
}