<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m200119_215730_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->text(),
            'priority' => $this->tinyInteger(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->bigInteger(),
            'updated_at' => $this->bigInteger(),
        ]);

        $this->addColumn('tasks', 'project_id', $this->integer());
        $this->addForeignKey('fk-task-project_id', 'tasks', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task-project_id', 'tasks');
        $this->dropColumn('tasks', 'project_id' );
        $this->dropTable('{{%project}}');
    }
}
