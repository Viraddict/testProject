<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 */
class Books extends \yii\db\ActiveRecord
{
	public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',  'date', 'author_id'], 'required'],
            [['preview','date_create', 'date_update', 'date', 'imageFile','date_ot','date_do'], 'safe'],
            [['author_id'], 'integer'],
            [['date'], 'date'],			
            [['name', 'preview'], 'string', 'max' => 255],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Date Update',
            'preview' => 'Обложка',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор',
			'date_ot' => 'Дата выхода от:',
			'date_do' => ' до ',
        ];
    }
	
    public function upload()
    {	
		$time = time();
		$img = 'uploads/books/' . $time . '.' . $this->imageFile->extension;
        if($this->imageFile->saveAs($img)){
			$this->preview = $time . '.' . $this->imageFile->extension;
            return true;
		}else{
            return false;
		}	
    }	
	
    public function getAuthors()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }	
	
	

	
	
}
