<?php

namespace G2B2G\Model\File;

use Illuminate\Database\Eloquent\Model;

class FileGroup extends Model
{

    protected $table = 'file_group';

	public $incrementing = false;

    protected $fillable = [
    	'id',
    	'model',
    	'file_id',
    ];

    public $timestamps = false;

	public function file ()
	{
		return $this->hasOne(__NAMESPACE__.'\File', 'id', 'file_id');
	}


}
