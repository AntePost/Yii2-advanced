<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%priority}}`.
 */
class m200119_214713_create_priority_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%priority}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'order' => $this->tinyInteger(),
            'type' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%priority}}');
    }
}
