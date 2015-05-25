<?php
// 本类由系统自动生成，仅供测试用途
class ActivityAction extends Action {
    public function index($id){//渲染活动详情页
		$user_model = M('users');
		$com_model = M('comment');
		$com_agree_model = M('comment_agree');
		$com_disagree_model = M('comment_disagree');
		$act_model = M('acticity');
		$act_agree_model = M('agree');
		$act_join_model = M('join');
		$config_model = M('config');
		$place_model = M('place');

		//$act
		$act = $act_model->find($id);
		if($act && $act['state'] == 1){//活动存在并且状态可用
			//$siteName
			$config = $config_model->find(1);
			$site_name = $config['site_name'];
			$this->assign('siteName', $site_name);
			
			//$pageTitle
			$page_title = "活动详情页";
			$this->assign('pageTitle', $page_title);

			//$act['state']
			//$start_time_str = $act['start_date'] . ' ' . $act['start_time'];
			//$end_time_str = $act['end_date'] . ' ' . $act['end_time'];
			$act['state'] = act_state($act['start_time'], $act['end_time']);
			
			//$act['nickname']
			$user = $user_model->find($act['uid']);
			$act['nickname'] = $user['nickname'];

			//$act['pname]
			$place = $place_model->where("code='" . $act['place_code'] . "'")->find();
			$act['pname'] = $place['name'];

			//$act['agree_num']
			$act['agree_num'] = count($act_agree_model->where("aid=$id")->select());
			
			//$act['join_num']
			$act['join_num'] = count($act_join_model->where("aid=$id")->select());

			//$act['comment_num']
			$comments = $com_model->where("aid=$id")->select();
			$act['comment_num'] = count($comments);
			
			$this->assign('act', $act);

			//重构评论数据结构 rebuild comments struct
			foreach($comments as &$comment){
				$user = $user_model->find($comment['uid']);
				$comment['header'] = $user['header'];
				$comment['nickname'] = $user['nickname'];
				$comment['agree_num'] = count($com_agree_model-where("cid=" . $comment['id'])->select());
				$comment['disagree_num'] = count($com_disagree_model-where("cid=" . $comment['id'])->select());
			}
			//$hotComments
			$hotComments = hot_comments($comments);
			
			$this->assign('hotComments', $hotComments);

			//$newComments
			//数据分页
			import('ORG.Util.Page');// 导入分页类
			$count      = $act['comment_num'];
			$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			
			$newComments = $com_model->where("aid=$id")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			//重构评论数据结构 rebuild comments struct
			foreach($newComments as &$comment){
				$user = $user_model->find($comment['uid']);
				$comment['header'] = $user['header'];
				$comment['nickname'] = $user['nickname'];
				$comment['agree_num'] = count($com_agree_model->where("cid=" . $comment['id'])->select());
				$comment['disagree_num'] = count($com_disagree_model->where("cid=" . $comment['id'])->select());
			}
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('newComments', $newComments);

			//$theirActs
			$theirActs = $act_model->where("uid=" . $act['uid'])->order('id desc')->limit('0,5')->select();
			///act数据重构
			foreach($theirActs as &$theirAct){
				//$start_time_str = $theirAct['start_date'] . ' ' . $theirAct['start_time'];
				//$end_time_str = $theirAct['end_date'] . ' ' . $theirAct['end_time'];
				$theirAct['state'] = act_state($theirAct['start_time'], $theirAct['end_time']);

				$user = $user_model->find($theirAct['uid']);
				$theirAct['nickname'] = $user['nickname'];

				$place = $place_model->where("code='" . $theirAct['place_code'] . "'")->find();
				$theirAct['pname'] = $place['name'];

				$theirAct['comment_num'] = count($com_model->where("aid=$id")->select());
			}
			$this->assign('theirActs', $theirActs);

			//$best
			//计算太复杂，需要用ajax做

			$this->display();
		}
		else{
			$this->error('并没有这个活动:<');
		}

	}

	public function iInterest(){
		$uid = session("userid");
	}

	public function iJoin(){
		$uid = session("userid");
	}
}