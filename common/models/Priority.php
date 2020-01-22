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
    const TYPE_PROJECT = 1;
    const TYPE_TASK = 0;

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
     */
    public static function getTaskPriorities()
    {
        return ArrayHelper::map(
            self::find()
                ->where([
                    'type' => self::TYPE_TASK
                ])
                ->asArray()
                ->orderBy('order')
                ->all(),
            'id',
            'title');
    }
}
