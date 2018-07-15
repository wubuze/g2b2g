<?php
namespace G2B2G\File;

use App\Model\File\File;

/**
 * 附件Model扩展
 * 打包文件上传、删除以及对应的model变更的方法；输出存储路径、文件名等。
 *
 * */

class Counter
{

	private static $file = [];

	/**
	 * 添加使用文件
	 * @param $id int|array 文件的id
	 * @param $val int 使用的次数 通常为1或者-1 1表示使用增加1次 -1表示使用较少1次
	 * */
	static function useFile ($id , $val=1)
	{
		if (!$id) return;

		if (is_array($id)) {
			foreach ($id as $v) {
				self::useFile($v, $val);
			}
		} else {
			self::$file[$id] = @self::$file[$id] ? self::$file[$id]+$val : $val;
		}
	}



	static function checkUse ()
	{
		if ( !self::$file) return;
		foreach ( self::$file as $id=>$val) {
			if ( $val) {
				File::using($id, $val);
			}
		}
	}

}
