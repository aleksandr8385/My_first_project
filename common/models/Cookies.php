<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cookies".
 *
 * @property int $id
 * @property string $title
 * @property string|null $lead_photo
 * @property string $lead_text
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $category_id
 * @property int|null $status_id
 * @property int $user_id
 * @property string $ingredient
 *
 * @property User $user
 */
class Cookies extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
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
          
        ];
    }

    public static function tableName()
    {
        return 'cookies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'title',  'content',  'category_id','ingredient'], 'required'],
            [['lead_text', 'content', 'ingredient'], 'string'],
            [['created_at', 'updated_at','nameAuthor','ingredient','created_by'], 'safe'],
            [['created_by', 'updated_by', 'category_id', 'status_id', 'user_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['lead_photo'], 'string', 'max' => 160],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['imageFile'],'file','skipOnEmpty' => true,'extensions' => 'png, jpg'],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'lead_photo' => Yii::t('app', 'Фото'),
            'lead_text' => Yii::t('app', 'Краткое описание'),
            'content' => Yii::t('app', 'Рецепт'),
            'created_at' => Yii::t('app', 'Создано'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Автор'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'category_id' => Yii::t('app', 'Виды печенья'),
            'status_id' => Yii::t('app', 'Статус'),
            'user_id' => Yii::t('app', 'User ID'),
            'ingredient' => Yii::t('app', 'Ингредиент'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /*
     * метод получения автора из бд табл.user 
    */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * метод получения массива всех авторов из бд табл. user поле username,id
    */
    public function getAuthorList()
    {
        return  ArrayHelper::map(User::find()->all(),'id','username');
    }

    /**
     * метод получения категории для cookies 
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * метод получения массива всех категорий 
     */
    public function categoryList()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title_cookies');
    }

    /**
     * метод для фото
     */
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
