<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Stock extends ActiveRecord
{
    public static function tableName()
    {
        return 'stock';  // or your actual DB table name
    }
}
