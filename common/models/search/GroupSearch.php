<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Group;

/**
* GroupSearch represents the model behind the search form about `common\models\Group`.
*/
class GroupSearch extends Group
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
    return [
        [['id', 'subject_id', 'teacher_id', 'level', 'action', 'type', 'price', 'duration', 'status', 'is_deleted', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
                [['name', 'period_start', 'start_hour', 'end_hour'], 'safe'],
        ];
    }

    /**
    * @inheritdoc
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
        $query = Group::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
        // uncomment the following line if you do not want to any records when validation fails
        // $query->where('0=1');
        return $dataProvider;
        }

        $query->andFilterWhere([
                    'id' => $this->id,
                    'subject_id' => $this->subject_id,
                    'teacher_id' => $this->teacher_id,
                    'level' => $this->level,
                    'action' => $this->action,
                    'type' => $this->type,
                    'price' => $this->price,
                    'duration' => $this->duration,
                    'status' => $this->status,
                    'is_deleted' => $this->is_deleted,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                    'created_by' => $this->created_by,
                    'updated_by' => $this->updated_by,
                ]);

                $query->andFilterWhere(['like', 'name', $this->name])
                    ->andFilterWhere(['like', 'period_start', $this->period_start])
                    ->andFilterWhere(['like', 'start_hour', $this->start_hour])
                    ->andFilterWhere(['like', 'end_hour', $this->end_hour]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchPending($params)
    {
        $query = Group::find()->andWhere(['action' => Group::ACTION_PENDING]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
            'level' => $this->level,
            'action' => $this->action,
            'type' => $this->type,
            'duration' => $this->duration,
            'status' => $this->status,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'period_start', $this->period_start])
            ->andFilterWhere(['like', 'start_hour', $this->start_hour])
            ->andFilterWhere(['like', 'end_hour', $this->end_hour]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchInProcess($params)
    {
        $query = Group::find()->andWhere(['action' => Group::ACTION_IN_PROCESS]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
            'level' => $this->level,
            'action' => $this->action,
            'type' => $this->type,
            'duration' => $this->duration,
            'status' => $this->status,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'period_start', $this->period_start])
            ->andFilterWhere(['like', 'start_hour', $this->start_hour])
            ->andFilterWhere(['like', 'end_hour', $this->end_hour]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchFinished($params)
    {
        $query = Group::find()->andWhere(['action' => Group::ACTION_FINISHED]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
            'level' => $this->level,
            'action' => $this->action,
            'type' => $this->type,
            'duration' => $this->duration,
            'status' => $this->status,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'period_start', $this->period_start])
            ->andFilterWhere(['like', 'start_hour', $this->start_hour])
            ->andFilterWhere(['like', 'end_hour', $this->end_hour]);

        return $dataProvider;
    }
}