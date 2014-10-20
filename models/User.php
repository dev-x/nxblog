<?php

namespace app\models;

use \yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
	public static function tableName()
    {
        return 'users';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

	public function scenarios()
    {
        return [
            'login' => ['username', 'password'],
            'register' => ['username', 'email', 'password','mobil','first_name','last_name'],
			'profile' => ['first_name','last_name','email','city','vnz','groupVnz','mobil','skype','myCredo','myInfo']
        ];
    }
	
	public static function findByUsername($username)
	{
		return static::findOne(array('username' => $username));
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey()
	{
		return $this->auth_key;
	}

	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}

	public function validatePassword($password)
	{
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
//		return $this->password === $password;
	}

    public function getUserImages()
    {
        return $this->hasMany(Image::className(), ['parent_id' => 'id'])->where("parent_type = 'user'");
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function getPublishPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->where("status = 'publish'");
    }

    public function getPcount() {
        $command = static::getDb()->createCommand("select count(*) as kilk from post where user_id = {$this->id}")->queryAll();
        return $command[0]['kilk'];
	}
	
	    public function rules()
	{
		return [
                   
			['username', 'required'],
            ['username', 'unique', 'message' => 'This username address has already been taken.'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['email', 'required'],
			['email', 'email'],
			['email', 'unique', 'message' => 'This email address has already been taken.', 'on' => 'signup'],
			
                        ['first_name','required'],
                        ['last_name','required'],


			['password', 'required'],
			['password', 'string', 'min' => 6],
		];
	}
}
