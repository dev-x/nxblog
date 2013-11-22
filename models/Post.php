<?php

namespace app\models;

class Post extends \yii\db\ActiveRecord
{

	

	public static function tableName()
    {
        return 'post';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }
     public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
             );
    }
      public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }
     public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
        public function rules()
    {
		return [
			['content', 'required'],
                        ['title', 'required' ]
			// email has to be a valid email address
//			['email', 'email'],
			// verifyCode needs to be entered correctly
//			['verifyCode', 'captcha'],
		];
	}
/*
	public function getId()
	{
		return $this->id;
	}

	

	public function getPostContent()
	{
		return $this->post_content;
	}
*/
}
