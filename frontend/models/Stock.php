<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Stock model for database table
 */
class Stock extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stock}}';
    }

    public function rules()
    {
        return[
            [['item_name', 'quantity', 'buying_price', 'selling_price'], 'required'],
            [['item_name'], 'string', 'max' => 255],
            [['quantity'], 'integer'],
            [['buying_price', 'selling_price'], 'number'],
            [['item_name', 'quantity', 'buying_price', 'selling_price'], 'safe'],

        ];
    }
}