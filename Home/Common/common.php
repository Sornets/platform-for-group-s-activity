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

/*
 * return array
 * para $arrays array
 *
 * 将$arrays中的数组根据数组的$item元素进行排序，如果有$n，则结果数组长度为$n的值
 */
function bubbleSort($arrays, $item /*,$n*/){
	$paras = func_num_args();
	$n = $paras[2];

	$cnt=count($arrays);
	for($i = 0; $i < $cnt - 1; $i++){//循环比较
		for($j = $i + 1; $j < $cnt; $j++){
			if($arrays[ $j ][$item] > $arrays[ $i ][$item]){//执行交换
				$temp = $arrays[ $i ];
				$arrays[ $i ] = $arrays[ $j ];
				$arrays[ $j ] = $temp;
			}
		}
	}
	if($n && $n > $cnt){
		$result = array();
		for($i = 0; $i < $n; $i++){
			$result[$i] = $arrays[$i];
		}
		return $result;
	}

	return $arrays;
}