<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cookies;

/**
 * CookiesSearch represents the model behind the search form of `common\models\Cookies`.
 */
class CookiesSearch extends Cookies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'category_id', 'status_id', 'user_id'], 'integer'],
            [['title', 'lead_photo', 'lead_text', 
            'content', 'created_at', 'updated_at','author.username',
             'ingredient','created_by'], 'safe'],
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
        $query = Cookies::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'lead_photo', $this->lead_photo])
            ->andFilterWhere(['like', 'lead_text', $this->lead_text])
            ->andFilterWhere(['like', 'content', $this->content]);
            

        return $dataProvider;
    }
}
