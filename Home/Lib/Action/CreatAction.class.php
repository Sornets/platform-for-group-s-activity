<?php
// 本类由系统自动生成，仅供测试用途
class CreatAction extends Action {
	public function _initialize(){
		login();
	}
    public function index(){//渲染创建活动页面
		$config_model = M('config');
		$place_model = M('place');
		
		//$pageTitle
		$pageTitle = "创建新活动";
		$this->assign('pageTitle', $pageTitle);

		//$rule
		$config = $config_model->find(1);
		$rule_name = $config['rule_name'];
		$rule_content = $config['rule_content'];

		$this->assign('rule_name', $rule_name);
		$this->assign('rule_content', $rule_content);
		
		//$siteName
		$siteName = $config['site_name'];
		$this->assign('siteName', $siteName);

		//places
		$places = $place_model->select();
		$this->assign('places', $places);

		$this->display();
	}

	public function creatActivity(){//创建活动
		$act_model = M('activity');
		$user_model = M('users');

		$uid = session('uid');
		$act = array();
		$act = $_POST;
		$act['uid'] = $uid;
		
		//$start_time & $end_time
		$start_time_str = $_POST['start_date'] . ' ' . $_POST['start_time'] . ':00';
		$end_time_str = $_POST['end_date'] . ' ' . $_POST['end_time'] . ':00';
		$act['start_time'] = strtotime($start_time_str);
		$act['end_time'] = strtotime($end_time_str);

		//$creat_time
		$act['creat_time'] = time();
		
		//$state
		$user = $user_model->find($uid);
		if($user['level'] == 1){
			$act['state'] = 1;
		}
		else{
			$act['state'] = 0;
		}

		if($act_model->add($act)){
			$this->success("创建活动成功");
		}
		else{
			$this->error("创建活动失败");
		}
	}
}