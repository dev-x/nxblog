<?php

namespace app\models;

class Image extends \yii\db\ActiveRecord
{

	public static function tableName()
    {
        return 'images';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent Id',
            'parent_type' => 'Parent Type',
            'user_id' => 'User Id',
            'file_name' => 'File name',
             );
    }
    
    function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    function getParentObject()
		{
			switch ($this->parent_type) {
			case 'post': return $this->hasOne(Post::className(), ['id' => 'parent_id']); break;
			case 'user': return $this->hasOne(User::className(), ['id' => 'parent_id']); break;
			}
		}

    public function rules()
    {
		return [
			['parent_id', 'required'],
                    ['parent_type', 'required'],
                    ['user_id', 'required'],
			// email has to be a valid email address
//			['email', 'email'],
			// verifyCode needs to be entered correctly
//			['verifyCode', 'captcha'],
		];
	}

    public function getImageUrl($format = NULL){
        if (($format != NULL) && isset(\Yii::$app->params['thumbnails'][$this->parent_type][$format]))
            $suffix = \Yii::$app->params['thumbnails'][$this->parent_type][$format]['suffix'];

        return \Yii::$app->homeUrl.'content/'.$this->file_name.$suffix.$this->file_ext;
    }
}
