<?php
/*
 * return int
 * para $start_time timestamp
 *		$current_time timestamp
 *		$end_time timestamp
 *
 * ��������ʱ������ػ��״̬
 */
function act_state($start_time, $end_time){
	//$start_time = strtotime($start_time_str);
	//$end_time = strtotime($end_time_str);
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