<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m250622_085903_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    if ($this->db->schema->getTableSchema('{{%session}}', true) === null) {
        $this->createTable('{{%session}}', [
            'id' => $this->string(128)->notNull(),
            'expire' => $this->integer()->notNull(),
            'data' => $this->binary()->notNull(),
            'PRIMARY KEY(id)',
        ]);
    }
}


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
