<?php

namespace frontend\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use common\models\Priority;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int|null $template_id
 * @property string $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $project_id
 * @property int|null $priority_id
 * @property int $author_id
 * @property int $user_responsible_id
 * @property int $created_at
 * @property int $updated_at
 * @property boolean $is_template
 *
 * @property Task $template
 * @property User $author
 * @property User $userResponsible
 * @property Priority $priority
 * @property Project $project
 */
class Task extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_DONE = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    public function beforeValidate()
    {
        if (!empty($this->template_id)) {
            $template = $this->template;
            $this->description = $template->description;
            $this->name = $template->name;
        }

        return parent::beforeValidate();
    }

    public function behaviors()
    {
        return [TimestampBehavior::class => ['class' => TimestampBehavior::class]];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_template'], 'boolean'],
            [['name', 'author_id', 'user_responsible_id'], 'required'],
            [['author_id', 'user_responsible_id', 'priority_id', 'status', 'created_at', 'updated_at', 'template_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['user_responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_responsible_id' => 'id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['template_id' => 'id']],
            [['priority_id'], 'exist', 'skipOnError' => false, 'targetClass' => Priority::class, 'targetAttribute' => ['priority_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'author_id' => 'Author ID',
            'user_responsible_id' => 'User Responsible ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserResponsible()
    {
        return $this->hasOne(User::className(), ['id' => 'user_responsible_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Task::class, ['id' => 'template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::class, ['id' => 'priority_id'])->where(['priority.type'=>Priority::TYPE_TASK]);
    }

    public static function getStatusName()
    {
        return [
            static::STATUS_NEW => "New",
            static::STATUS_IN_PROGRESS => "In progress",
            static::STATUS_DONE => "Done",
        ];
    }
}
