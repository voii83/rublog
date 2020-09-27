<?php

namespace app\modules\blog\models;

use yii\data\ActiveDataProvider;

class BlogPostSearch extends BlogPost
{
    public function rules()
    {
        return [
            [['title'], 'string'],
            ['created_at', 'safe'],
        ];
    }

    public function search($params)
    {
        $query = BlogPost::query()->where(['published' => true]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
