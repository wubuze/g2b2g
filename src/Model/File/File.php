<?php

namespace G2B2G\Model\File;

use Illuminate\Database\Eloquent\Model;
use G2B2G\Contracts\Eloquent\Translate\ModelProperty;

class File extends Model
{

	use ModelProperty;

    protected $table = 'file';

    protected $fillable = [
    	'dir',
    	'file',
    	'type',
	    'url',
    ];

    public $timestamps = false;




    public function setUrl ()
    {
        $this->url = $this->url ?: 'storage/'.$this->dir.'/'.$this->get_filename();
        return $this;
    }

    protected function get_filename()
    {
        return $this->file.'.'.$this->type;
    }

	public function getUrlAttribute ($val)
	{
		return $val ?: config('app.url').'storage/'.$this->dir.'/'.$this->file.'.'.$this->type;
	}


	/**
	 * 获取文件路径
	 * @param $relative boolean. 路径类型，true：相对地址，false：绝对地址。
	 * @return string
	 * */
	public function getPath ($relative=true)
	{
		$path = '/'.$this->dir.'/'.$this->file.'.'.$this->type;
		return $relative ? $path : storage_path('app/public/'.$path);
	}


	static function using ($id, $val=1):bool
	{
		if (!$id) return false;
		$id = is_array($id) ?: [$id];
		self::query()->whereIn('id', $id)->increment('using', $val);
		return true;
	}

}
