<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bakery_tag".
 *
 * @property int $id
 * @property int $bakery_id
 * @property int $tag_id
 */
class BakeryTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bakery_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bakery_id', 'tag_id'], 'required'],
            [['bakery_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bakery_id' => 'Bakery ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
