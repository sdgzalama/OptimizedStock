<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Sale extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%sale}}';
    }

    public function rules()
    {
        return [
            [['customer_name', 'total_amount', 'payment_method'], 'required'],
            ['total_amount', 'number'],
            ['payment_method', 'string', 'max' => 20],
            ['customer_name', 'string', 'max' => 255],
        ];
    }
}
