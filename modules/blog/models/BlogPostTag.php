<?php

namespace app\modules\blog\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_post_tag".
 * @package app\modules\blog\models
 * @property integer $tag_id
 * @property integer $blog_post_id
 */
class BlogPostTag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blog_post_tag}}';
    }

    /**
     * Batch insert tags into table
     * @param integer $post_id
     * @param array $tags
     * @throws \yii\db\Exception
     */
    public static function saveBlogPostTags($post_id, $tags)
    {
        $rows = ArrayHelper::getColumn($tags, function ($item) use ($post_id) {
            return [
                'tag_id' => $item,
                'post_id' => $post_id,
            ];
        });

        \Yii::$app->db->createCommand()->batchInsert(BlogPostTag::tableName(), ['tag_id', 'blog_post_id'], $rows)->execute();
    }
}