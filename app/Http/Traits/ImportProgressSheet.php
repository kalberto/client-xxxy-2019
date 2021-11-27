<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 01/08/2019
 * Time: 11:37
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 05/08/2019
 * Time: 09:00
 */


namespace App\Http\Traits;

use Illuminate\Support\Facades\Session;

/**
 * Trait ImportProgressSheet
 * @package App\Http\Traits
 */
trait ImportProgressSheet {

	protected function SendProgress(){
		if(Session::has('current_upload_size')){
			if(Session::has('current_insert') && Session::has('current_count')){
				$i = Session::get('current_count');
				$key = Session::get('current_insert');
				if($i == 50){
					echo "|=".number_format(($key/Session::get("current_upload_size"))*100,2,'.','');
					ob_flush();
					flush();
					$i = 0;
					$key++;
				}else{
					$i++;
					$key++;
				}
				Session::put('current_insert',$key);
				Session::put('current_count',$i);
			}else{
				Session::put('current_insert',1);
				Session::put('current_count',1);
			}
		}
	}

}