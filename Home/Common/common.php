<?php
/*
 * return int
 * para $start_time datetime
 *		$current_time datetime
 *		$end_time datetime
 *
 * ��������ʱ������ػ��״̬
 */
function act_state($start_time, $current_time, $end_time){
	$start_time = strtotime($start_time_str);
	$end_time = strtotime($end_time_str);
	$current_time = time();

	if($current_time < $start_time){
		return 0;//δ��ʼ
	}
	else if($current_time > $end_time){
		return 2;//�ѽ���
	}
	else{
		return 1;//���ڽ��У�
	}
}
/*
 * return array
 * para $comments array
 *
 * �����۵Ķ�ά�������ҳ���������
 */
function hot_comments($comments){
	return array();
}