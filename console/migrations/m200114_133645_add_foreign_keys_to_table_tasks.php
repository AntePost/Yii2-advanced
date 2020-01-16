<?php

use yii\db\Migration;

/**
 * Class m200114_133645_add_foreign_keys_to_table_tasks
 */
class m200114_133645_add_foreign_keys_to_table_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-tasks-author_id',
            'tasks',
            'author_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-tasks-user_responsible_id',
            'tasks',
            'user_responsible_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-tasks-author_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-user_responsible_id',
            'tasks'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200114_133645_add_foreign_keys_to_table_tasks cannot be reverted.\n";

        return false;
    }
    */
}
