<?php namespace App\Services;


class CustomValidator extends \Illuminate\Validation\Validator
{

	/**
	 * 制御文字を省く
	 *
	 */
	public function validateCntrl($attribute,$value,$parameters){
		if (preg_match('/\A[[:^cntrl:]]+\z/u' , $value) == 0){
			return false;
		}
		return true;
	}

	/**
	 * タブ、改行を除いた制御文字を省く
	 *
	 */
	public function validateCntrlnrt($attribute,$value,$parameters){
		if (preg_match('/\A[\n\r\t[:^cntrl:]]{1,1000}\z/u' , $value) == 0){
	        return false;
	    }
		return true;
	}

	/**
	 * 半角のアルファベットのみ
	 *
	 */
	public function validateFixedalpha($attribute,$value,$parameters){
		if (preg_match('/\A[a-zA-Z]+\z/u' , $value) == 0){
	        return false;
	    }
		return true;
	}

	/**
	 * 半角のアルファベットと数字のみ
	 *
	 */
	public function validateFixedalphanum($attribute,$value,$parameters){
		if (preg_match('/\A[a-zA-Z0-9]+\z/u' , $value) == 0){
	       return false;
	    }
		return true;
	}

}
