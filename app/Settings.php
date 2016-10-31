<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

	protected $table = 'settings';
	public $timestamps = true;
    public $fillable = ['name','value'];


    /**
     * @param string $name
     * @return null|string
     */
    public static function getOne($name){
        $data = self::where('name','=',$name)->first();
        if ($data != null){
            return $data->value;
        }
        return null;
    }


}