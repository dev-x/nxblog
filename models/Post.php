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
/*
	public function getId()
	{
		return $this->id;
	}

	public function getPostTitle()
	{
		return '11111'; //$this->post_title;
	}

	public function getPostContent()
	{
		return $this->post_content;
	}
*/
}
