<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sale}}` and `{{%sale_item}}`.
 */
class m250622_090404_create_sale_tables extends Migration
{
    public function safeUp()
    {
        // Sales table
        $this->createTable('{{%sale}}', [
            'id' => $this->primaryKey(),
            'customer_name' => $this->string(255),
            'total_amount' => $this->decimal(10,2)->notNull(),
            'payment_method' => $this->string(50),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Sale Items table
        $this->createTable('{{%sale_item}}', [
            'id' => $this->primaryKey(),
            'sale_id' => $this->integer()->notNull(),
            'stock_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'discount' => $this->decimal(10,2)->defaultValue(0),
            'amount' => $this->decimal(10,2)->notNull(),
        ]);

        $this->addForeignKey('fk-sale_item-sale_id', '{{%sale_item}}', 'sale_id', '{{%sale}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-sale_item-stock_id', '{{%sale_item}}', 'stock_id', '{{%stock}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-sale_item-sale_id', '{{%sale_item}}');
        $this->dropForeignKey('fk-sale_item-stock_id', '{{%sale_item}}');
        $this->dropTable('{{%sale_item}}');
        $this->dropTable('{{%sale}}');
    }
}
