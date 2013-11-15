<?php

namespace app\models;

class Comment extends \yii\db\ActiveRecord
{

	
	public static function tableName()
    {
        return 'comment';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }
        public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent_id',
            'parent_type' => 'Parent_type',
            'user_id' => 'user_id',
            'content' => 'Content',
             );
    }

    public function rules()
    {
		return [
			['content', 'required'],
			// email has to be a valid email address
//			['email', 'email'],
			// verifyCode needs to be entered correctly
//			['verifyCode', 'captcha'],
		];
	}

}
