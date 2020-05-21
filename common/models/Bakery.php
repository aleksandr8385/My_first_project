<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\Category;

use Yii;

/**
 * This is the model class for table "bakery".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $lead_photo
 * @property string $lead_text
 * @property string $content
 * @property string $meta_description
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $category_id
 */
class Bakery extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bakery';
    }

    /** Описал поведения */

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
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
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
            [[ 'title',  'content',  'category_id'], 'required'],
            [['id', 'created_by', 'updated_by', 'category_id'], 'integer'],
            [['lead_text', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status_id'],'integer'],
            [['title', 'slug'], 'string', 'max' => 50],
            [['lead_photo', 'meta_description'], 'string', 'max' => 160],
            [            
                ['imageFile'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg',
                
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Выпечка',
            'status_id' => 'Статус',
            'slug' => 'Slug',
            'lead_photo' => 'Картинка',
            'lead_text' => 'Lead Text',
            'content' => 'Content',
            'meta_description' => 'Meta Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'category_id' => 'Category ID',
            'author.username' =>'Автор',
        ];
    }

    public function getAuthor(){
        return $this->hasOne(User::className(),['id'=>'user_id']);//выборка из модели User по id равен в модели Bakery по user_id
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
   
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
   
    public function getBakeryTags()
    {
        return $this->hasMany(BakeryTag::className(), ['bakery_id' => 'id']);
    }

    public function categoryList()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'name');
    }

    public function upload()   
    {
        if ($this->validate()) {
            $filePath = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($filePath);
            $this->imageFile = null;
            $this->lead_photo = $filePath;
            return true;
        } else {
            return false;
        }
    
    }

}
