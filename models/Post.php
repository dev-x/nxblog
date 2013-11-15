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
