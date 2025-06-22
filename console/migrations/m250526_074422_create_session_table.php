<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m250526_074422_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->string(128)->notNull(),
            'expire'=>$this->integer()->notNull(),
            'data'=>$this->binary()->notNull(),
            // 'PRIMARY KEY(id)',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
