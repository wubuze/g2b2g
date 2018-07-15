<?php

namespace G2B2G\Contracts\Eloquent\Translate ;

/* Model 模块的底层函数
 *
 * */

trait Base {

	/**
	 * [level-1] 获取全局的属性参数
	 * @key model的属性名称，支持链式调用，分隔符为“.”
	 * @toArr 进队数组有效，将所得到值以数组形式输出，每个元素key（原key的值）和val两字段，分别对应
	 * */
	public static function getProperty($key='')
	{
		return config('model.'.$key);
	}


	public static function getPropertyInGroup ($key='')
	{
		$arr = self::getProperty($key);
		if (!$arr) return;
		foreach ( $arr as $key=>&$val ) {
			$val = [
				'key' => $key,
				'val' => $val,
			];
		}
		return array_values($arr);
	}

	/**
	 * [level-1] 获取全局的属性参数值所对应的key
	 * @key 属性key 支持链式调用，分隔符为“.”
	 * @val 属性值
	 * @return 属性值对应的key
	 * */
	public function getKeyOfProperty($key=null, $val=null) {
		if (!$key) return;
		$arr = $this->getProperty($key);
		$key = array_search($val, $arr);
		return $key===false ? null : $key ;
	}





	/**
	 * 获取Model的class名称
	 * */
	public static function getClassName()
	{
		$arr = explode('\\', __CLASS__);
		return $arr[count($arr)-1];
	}


}
