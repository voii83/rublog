<?php

namespace app\modules\blog\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 * @package app\modules\blog\comment
 * @property integer $id
 * @property integer $post_id
 * @property string $text
 */
class Comment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['text'], 'required', 'message' => 'Оставьте комментарий'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Добавить комментарий',
        ];
    }

    /**
     * Save post comment
     * @param $post_id
     * @return bool
     */
    public function saveComment($post_id)
    {
        if (!$this->validate()) {
            return false;
        }

        $this->post_id = $post_id;
        if ($this->save()) {
            return $this->id;
        }

        return false;
    }


}