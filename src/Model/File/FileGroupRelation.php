<?php

namespace App\Model\File;

use G2B2G\Contracts\Eloquent\Translate\Base;

trait FileGroupRelation
{

	public function fileGroup ()
	{
		$qry = $this->hasMany('App\Model\File\FileGroup', 'id', 'id');
		if ( $qry ) {
			return $qry->where('model', Base::getClassName());
		}
	}

}
