<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class ShowStock extends ActiveRecord
{
    public static function tableName()
    {
        return 'stock'; //  match your DB table name
    }
}
