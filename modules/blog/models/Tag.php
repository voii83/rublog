<?php

namespace app\modules\blog\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag".
 * @package app\modules\blog\models
 * @property integer $id
 * @property string $name
 */
class Tag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * Save unique tags
     * @param array $tags
     * @return array
     */
    public static function saveTags($tags) {

        $result = [];
        $tagName = [];

        $tagsArray = array_filter(array_map('trim',explode(',',$tags)));
        $tagsArray = array_unique($tagsArray);

        $blogTag = Tag::find()->where(['name' => $tagsArray])->all();

        foreach ($blogTag as $item) {
            $tagName[] = $item->name;
            $result[] = $item->id;
        }

        $blogPostTags = array_diff($tagsArray, $tagName);

        foreach ($blogPostTags as $item) {
            $blogTag = new Tag();
            $blogTag->name = $item;
            $blogTag->save();
            $result[] = $blogTag->id;
        }

        return $result;
    }
}