<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
*	@todo 宿舍编号转换为文字
*	@author zhangzhili
*/

class Dormitory {

	public static $_num = array(
						'1'  => '一',
						'2'  => '二',
						'3'  => '三',
						'4'  => '四',
						'5'  => '五',
						'6'  => '六',
						'7'  => '七',
						'8'  => '八',
						'9'  => '九',
						'10' => '十',
						'11' => '十一',
						'12' => '十二',
						'13' => '十三',
						'14' => '十四',
						'15' => '十五',
						'16' => '十六',
						'17' => '十七',
						'18' => '十八',
						'19' => '十九',
						'20' => '二十',
		);

	public static $_area = array(
						'X' => '西',
						'D' => '东'
		);

	/**
	*	@todo 转换方法
	*   @param string 宿舍编号
	*	@return string 宿舍文字
	*/
	public static function TransformID($sid)
	{
		$sid = strtoupper($sid);
		$patten = '/([X,D])(\d){1}R(\d{3})/';
		preg_match($patten, $sid, $matches);
		if($matches) {
			$area = self::$_area[$matches[1]];
			$num  = self::$_num[$matches[2]];
			$room = $matches[3];
			$dormitory = $area . $num . '-' . $room . '宿舍';
		} else {
			return null;
		}
		return $dormitory;
	}
}
