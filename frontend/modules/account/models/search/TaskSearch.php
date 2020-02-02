<?php

namespace frontend\modules\account\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Task;

/**
 * TaskSearch represents the model behind the search form of `frontend\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'priority_id', 'author_id', 'user_responsible_id', 'is_template', 'template_id', 'created_at', 'updated_at', 'project_id'], 'integer'],
            [['name', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Task::find()->where([
            'or',
            ['author_id' => \Yii::$app->user->identity->id],
            ['user_responsible_id' => \Yii::$app->user->identity->id],
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'priority_id' => $this->priority_id,
            'author_id' => $this->author_id,
            'user_responsible_id' => $this->user_responsible_id,
            'is_template' => $this->is_template,
            'template_id' => $this->template_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
