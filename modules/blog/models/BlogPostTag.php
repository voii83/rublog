<?php

namespace app\modules\blog\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_post_tag".
 * @package app\modules\blog\models
 * @property integer $tag_id
 * @property integer $post_id
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
}