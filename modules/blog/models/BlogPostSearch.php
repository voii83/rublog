<?php

namespace app\modules\blog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\blog\models\BlogPost;

class BlogPostSearch extends BlogPost
{
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
