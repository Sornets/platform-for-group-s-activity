<?php
/*
 * return int
 * para $start_time timestamp
 *		$current_time timestamp
 *		$end_time timestamp
 *
 * 根据三个时间戳返回活动的状态
 */
function act_state($start_time, $end_time){
	//$start_time = strtotime($start_time_str);
	//$end_time = strtotime($end_time_str);
	$current_time = time();

	if($current_time < $start_time){
		return 0;//未开始
	}
	else if($current_time > $end_time){
		return 2;//已结束
	}
	else{
		return 1;//正在进行！
	}
}
/*
 * return array
 * para $comments array
 *
 * 在评论的二维数组中找出热门评论
 */
function hot_comments($comments){
	return array();
}