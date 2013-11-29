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

    public function beforeSave($insert)
    {

        if ($this->isNewRecord)
        {
//            $this->created = new Expression('NOW()');
//            $command = static::getDb()->createCommand("select max(id) as id from posts")->queryAll();
//            $this->id = $command[0]['id'] + 1;
        }

//        $this->updated = new Expression('NOW()');
        return parent::beforeSave($insert);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id'])->where("parent_type = 'post'");
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
