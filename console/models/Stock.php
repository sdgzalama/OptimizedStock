<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property string $item_name
 * @property int $quantity
 * @property float $buying_price
 * @property float $selling_price
 * @property int $created_by
 * @property string $created_at
 */
class Stock extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'quantity', 'buying_price', 'selling_price', 'created_by', 'created_at'], 'required'],
            [['quantity', 'created_by'], 'integer'],
            [['buying_price', 'selling_price'], 'number'],
            [['created_at'], 'safe'],
            [['item_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Item Name',
            'quantity' => 'Quantity',
            'buying_price' => 'Buying Price',
            'selling_price' => 'Selling Price',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

}
