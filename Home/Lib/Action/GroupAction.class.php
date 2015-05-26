<?php
// 本类由系统自动生成，仅供测试用途
class GroupAction extends Action {
    public function index($id){//渲染社团详情页
		$user_model = M('users');
		$com_model = M('comment');
		$com_agree_model = M('comment_agree');
		$com_disagree_model = M('comment_disagree');
		$coll_model = M('collect');
		$act_model = M('activity');
		$act_agree_model = M('agree');
		$act_join_model = M('join');
		$config_model = M('config');
		$place_model = M('place');
		$uid = session('uid');

		//$siteName
		$config = $config_model->find(1);
		$site_name = $config['site_name'];
		$this->assign('siteName', $site_name);
		
		//$group
		$group = $user_model->find($id);
			//isCollected
		if($coll_model->where("collected=$id AND collecter=$uid")->find()){
			$group['isCollected'] = 1;
		}
		else{
			$group['isCollected'] = 0;
		}
			//agree_num
		$group['agree_num'] = count($act_agree_model->where("gid=$id")->select());
		$group['collect_num'] = count($coll_model->where("collected=$id")->select());
		
		$this->assign("group", $group);

		//$pageTitle
		$page_title = $group['nickname'];
		$this->assign('pageTitle', $page_title);

		//historyActs
		$historyActs = $act_model->where("uid=$id")->order('id desc')->limit('0,5')->select();
				//act数据重构
		foreach($historyActs as &$act){
			$act['state'] = act_state($act['start_timestamp'], $act['end_timestamp']);
			$act['start_time'] = date("Y-m-d H:i:s", $act['start_timestamp']);
			$act['end_time'] = date("Y-m-d H:i:s", $act['end_timestamp']);

			$user = $user_model->find($act['uid']);
			$act['nickname'] = $user['nickname'];

			$place = $place_model->where("code='" . $act['place_code'] . "'")->find();
			$act['pname'] = $place['name'];

			$act['comment_num'] = count($com_model->where("aid=$id")->select());
		}
		$this->assign('theirActs', $theirActs);

		//hotActs
		$acts = $act_model->where("uid=$id")->select();
		foreach($acts as &$act){
			$act['agree_num'] = count($act_agree_model->where("aid=" . $act['id'])->select());
		}
		$hotActs = bubbleSort($acts, 'agree_num', 4);
		foreach($hotActs as $act){
			$act['state'] = act_state($act['start_timestamp'], $act['end_timestamp']);
		}
		$this->assign('hotActs', $hotActs);

		$this->display();
	}

	public function iCollect($id){//收藏社团接口
		login();
		
		$coll_model = M('collect');
		$uid = session('uid');
		if($coll_model->where("collected=$id AND collecter=$uid")->find()){
			$this->error("你已经收藏过了！");
		}
		else{
			$collect['collecter'] = $uid;
			$collect['collected'] = $id;
			$collect['create_time'] = time();
			if($coll_model->add($collect)){
				$this->success("收藏成功 :>");
			}
			else{
				$this->error("收藏失败 :<");
			}
		}
	}
}