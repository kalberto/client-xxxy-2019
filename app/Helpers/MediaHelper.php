<?php

namespace App\Helpers;

use ErrorException;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\File;

class MediaHelper {

	/**
	 * @param File $file
	 * @param string $path
	 * @param string $name
	 *
	 * @return string nome do arquivo
	 */
	public static function upload($file, $path, $name){
		if(!file_exists($path))
			mkdir($path,0755,true);
		$ext = $file->getClientOriginalExtension();
		$name = str_replace($ext,'',$name);
		$name = Str::slug($name);
		if(strlen($name) > 100)
			$name = substr($name,0,10);
		$file_name = Str::slug($name).'-'.date('d-m-y-his').'-'.Str::random(4).'.'.$ext;
		$file->move($path,$file_name);
		return $file_name;
	}

	/**
	 * @param string $old_path
	 * @param string $new_path
	 * @param string $file_name
	 * @param array $options
	 * @return string
	 * @return boolean
	 */
	public static function move_file($old_path, $new_path, $file_name,$options = []){
		if(!file_exists($old_path.$file_name))
			return false;
		if(!file_exists($new_path)){
			if(isset($options['permission']))
				mkdir($new_path, $options['permission'],true);
			else
				mkdir($new_path, 0775,true);
		}
		try{
			rename($old_path.$file_name,$new_path.$file_name);
		}catch (ErrorException $e){
			return false;
		}
		return true;
	}


	/**
	 * @param string $file_name
	 * @param string $path
	 *
	 * array['width'] width of the image
	 * array['height'] height of the image
	 * array['x'] top-left x for the crop
	 * array['y'] top-left y for the crop
	 * array['action'] crop or resize
	 *
	 * @param array $options (See above)
	 *
	 * @return boolean
	 */
	public static function resize_image($file_name, $path, $options){
		if(isset($options['action']) && $options['action'] == 'crop'){
			if(isset($options['width']) && isset($options['height']))
				Image::make($path.$file_name)->crop($options['width'],$options['height'],isset($options['x']) ? $options['x']: 0,isset($options['y']) ? $options['y']: 0)->save($path.$file_name);
			else
				return false;
		}else{
			if(isset($options['width']) && isset($options['height']))
				Image::make($path.$file_name)->fit($options['width'],$options['height'])->save($path.$file_name);
			else
				return false;
		}
		return true;
	}

	/**
	 * @param string $old_path
	 * @param string $new_path
	 * @param string $old_name
	 * @param string $new_name
	 * @param array $options
	 * @return string
	 * @return boolean
	 */
	public static function copy_file($old_path, $new_path, $old_name,$new_name, $options = null){
		if(!file_exists($old_path.$old_name))
			return false;
		if(!file_exists($new_path)){
			if(isset($options['permission']))
				mkdir($new_path, $options['permission'],true);
			else
				mkdir($new_path, 0775,true);
		}
		try{
			copy($old_path.$old_name,$new_path.$new_name);
		}catch (Exception $e){
			return false;
		}
		return true;
	}


	/**
	 * @param string $path
	 * @param string $nome
	 *
	 * @return bool
	 */
	public static function delete_file($path, $nome){
		if(file_exists($path.$nome))
			return unlink($path.$nome);
		else
			return false;
	}
}
