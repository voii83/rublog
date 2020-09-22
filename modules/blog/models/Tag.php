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
}