<?php

namespace app\models;

use yii\base\Model;

/**
 * CommentForm is the model  for  the comment adding .
 */
class CommentForm extends Model
{
	//public $parent_id;
	public $content;
	/**
	 * @return array the validation rules.
	 */
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

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return [
			'content' => 'Ваш коментар:',
		];
	}

	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 * @param string $email the target email address
	 * @return boolean whether the model passes validation
	 */
	public function contact($email)
	{
		if ($this->validate()) {
			return true;
		} else {
			return false;
		}
	}
}
