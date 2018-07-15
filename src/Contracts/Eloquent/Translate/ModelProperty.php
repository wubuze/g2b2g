<?php

namespace G2B2G\Contracts\Eloquent\Translate ;

/* Process部分应对Model的属性扩展
 *
 * */

trait ModelProperty {


	use Base;


	public static function getClassProperty($key)
	{
		$key = [
			self::getClassName(),
			$key,
		];
		$key = join('.', $key);
		return self::getProperty($key);
	}


	public static function getClassPropertyInGroup ($key)
	{
		$key = [
			self::getClassName(),
			$key,
		];
		$key = join('.', $key);
		return self::getPropertyInGroup($key);
	}


	/**
	 * [level-2] 获取Model的属性参数
	 * @return $key model的属性名称 支持链式调用，分隔符为“.”
	 * @return
	 *
	 * */
	public function getModelProperty($key)
	{
		if (!$key || !isset($this->$key)){
			return;
		}
		$key = [
			self::getClassName(),
			$key,
			$this->$key
		];
		$key = join('.', $key);
		return $this->getProperty($key);
	}




	/**
	 * [level-2] 获取全局的属性参数值所对应的key
	 * @prop 属性名称
	 * 支持链式调用，分隔符为“.”
	 * */
	public function getKeyOfModelProperty($prop) {
		$key = [
			self::getClassName(),
			$prop,
		];
		$key = join('.', $key);
		$key = $this->getProperty($key);
		$key = array_search($this->$prop, $key);
		return $key===false ? null : $key ;
	}



	/**
	 * 模型转化翻译的属性名
	 * */
	static protected $MODEL_TRANSLATE = 'translate';

	/**
	 * 检测model
	 * */
	private static function get_model_translate_property()
	{
		return property_exists(__CLASS__, self::$MODEL_TRANSLATE);
	}

	/**
	 * [level-3] 转化指定的Model属性
	 * 根据prop转化指定属性，prop=空，则转化翻译所有属性；$translate中未指定的属性将被忽略。
	 * @prop 需要被翻译的属性，分隔符为','
	 * @prf 转化属性名前缀，默认为'_'
	 * @ext 转化属性名后缀，默认为''
	 * @return 成功true；如果Model未指定translate属性名，则返回false。
	 * */
	public function translateModelProperty($prop='', $prf='_', $ext='')
	{
		if ( !self::get_model_translate_property() ) {
			return false;
		}

		$prop = $prop ? explode(',', $prop) : $this->translate;
		$prop = array_intersect($prop, $this->translate);
		if ( $prop) {
			foreach ( $prop as $k ) {
				if ( $k ) {
					$this->{$prf.$k.$ext} = $this->getModelProperty($k);
				}
			}
		}

		return true;

	}




}