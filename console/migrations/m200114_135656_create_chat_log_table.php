<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_log}}`.
 */
class m200114_135656_create_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat_log}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'type' => $this->tinyInteger(),
            'created_at' => $this->bigInteger(),
            'updated_at' => $this->bigInteger(),
            'message' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat_log}}');
    }
}
