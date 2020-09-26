<?php

namespace app\modules\blog\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_post".
 * @package app\modules\blog\models
 * @property integer $id
 * @property DateTime $created_at
 * @property integer $created_by
 * @property boolean $published
 * @property string $title
 * @property string $text
 * @property Author $author
 * @property Tag $tag
 */
class BlogPost extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blog_post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => false,

                ],
                'value' => function(){
                    return gmdate("Y-m-d H:i:s");
                },
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('blog_post_tag', ['blog_post_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getPostAuthor()
    {
        return $this->author;
    }

    /**
     * @param  array $value
     */
    public function setPostAuthor($value)
    {
        $this->postAuthor = $value;
    }

    /**
     * @return array
     */
    public function getPostTags()
    {
        return ArrayHelper::getColumn($this->tags, function($item) {
            return $item->name;
        });
    }

    /**
     * @param  array $value
     */
    public function setPostTags($value)
    {
        $this->postTags = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'postAuthor', 'postTags'], 'string'],
            [['title', 'text', 'postTags'], 'required'],
            [['published'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'created_at' => 'Дата создания',
            'author' => 'Автор',
            'postAuthor' => 'Автор',
            'postTags' => 'Теги',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'published' => 'Опубликовать',
        ];
    }

    /**
     * Query model BlogPost
     * @return \yii\db\ActiveQuery
     */
    public static function query()
    {
        return $model = BlogPost::find()
            ->with([
                'author',
                'tags'
            ]);
    }

    /**
     *  Save post, author, post tags
     * @return bool|int
     */
    public function savePost()
    {
        if (!$this->validate()) {
            return false;
        }

        $author = Author::saveAuthor($this->postAuthor);
        $this->created_by = $author;

        if ($this->save()) {
            BlogPostTag::deleteAll(['blog_post_id' => $this->id]);
            $tags = Tag::saveTags($this->postTags);
            BlogPostTag::saveBlogPostTags($this->id, $tags);

            return $this->id;
        }


        return false;
    }

}