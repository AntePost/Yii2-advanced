<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "priority".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $order
 * @property int|null $type
 */
class Priority extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'priority';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order', 'type'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'order' => 'Order',
            'type' => 'Type',
        ];
    }

    /**
     * @return Priority[]
     * @param int 0 for tasks, 1 for projects
     */
    public static function getPriorities($type)
    {
        return ArrayHelper::map(
            self::find()
                ->where([
                    'type' => $type
                ])
                ->asArray()
                ->orderBy('order')
                ->all(),
            'id',
            'title');
    }
}
