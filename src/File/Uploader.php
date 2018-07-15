<?php
namespace G2B2G\File;

//use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Model\File\File;

/**
 * 附件Model扩展
 * 打包文件上传、删除以及对应的model变更的方法；输出存储路径、文件名等。
 *
 * */

class Uploader
{

	private static $file = [
		'file' => '',
		'type' => '',
		'dir' => '',
	];

	private static $filename_type;
	private static $req;

	static function init (UploadedFile $req, $autoFilename='datetime with random number')
	{
		self::$req = $req;
		self::$filename_type = $autoFilename;
	}



	private static function make_filename ()
	{
		switch (self::$filename_type) {
			case 'datetime with random number' :
				return date('Ymd-Hi-').random_int(0,999);
		}
	}


	private static function set_filename ($name=null)
	{
		self::$file['file'] = $name ?: self::make_filename();
	}

	private static function set_filetype ()
	{
		self::$file['type'] = self::$req->extension();
	}


	private static function set_filedir ($dir)
	{
		self::$file['dir'] = $dir;
	}

	/**
	 * 存储文件
	 * */
	private static function store_file ($to_public=false)
	{
		$dir = $to_public ? 'public/'.self::$file['dir'] : self::$file['dir'];
		return self::$file['file'] ? self::$req->storeAs($dir, self::$file['file'].'.'.self::$file['type']) : self::$req->store($dir);
	}


	/**
	 * 上传文件
	 * */
	static function upload ($dir, $filename=null, $toPublic=false) :File
	{
		self::set_filedir($dir);
		self::set_filetype();
		self::set_filename($filename);
		$res = self::store_file($toPublic);

		return File::create (self::$file);
//		return $obj->toArray();

	}

}
