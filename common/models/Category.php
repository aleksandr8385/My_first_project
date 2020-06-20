<?php

namespace common\models;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $meta_description
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**Добавил поведения */

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                 'value' => new Expression('NOW()'),
            ],
            [   
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_testo',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
            [['created_at', 'updated_at'], 'safe'],
            [['title_testo', 'slug'], 'string', 'max' => 50],
            [['title_cookies'], 'string', 'max' => 160],
            [['title_testo','title_cookies'], 'unique'],
            [['slug'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_testo' => 'Названия категории теста',
            'slug' => 'Slug',
            'title_cookies' => 'Названия категории печенья',
            'created_at' => 'Дата создания',
            'updated_at' => 'Updated At',
        ];
    }

    /**Добавили функцию getBakeries */
    public function getBakeries()
    {
        return $this->hasMany(Bakery::className(), ['category_id' => 'id']);
    }
}
