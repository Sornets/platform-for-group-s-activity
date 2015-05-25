<?php
// 本类由系统自动生成，仅供测试用途
class ActivityListAction extends Action {
    public function index($state, $time, $id){//渲染活动列表页面
		//state:0/null all, 1 future, 2 current, 3 end
		//time :0/null all, 1 today, 2 tomorrow, 3 week
		$place_model = M('place'); //获取中文地点用
		$user_model = M('users');  //用户昵称用
		$act_model = M('activity');//活动信息用
		$act_agree_model = M('agree');//活动感兴趣数用
		$com_model = M('comment'); //获取评论、评论数用
		$com_agree_model = M('comment_agree');//评论点赞
		$com_disagree_model = M('comment_disagree');//评论反对
		$config_model = M('config');//获取网站配置

		//$pageTitle string
		$pageTitle = "活动列表";
		$this->assign('pageTitle', $pageTitle);

		//$id
		if($id){
			$this->assign('id', $id);
		}
		//$time int 时间工具按钮变量
		//$state int 状态工具按钮变量
		/*if($time >= 1 && $time <= 3){
			$this->assign('time', $time);
		}
		else{
			$this->assign('time', 0);
		}
		if($state >= 1 && $state <= 3){
			$this->assign('state', $state);
		}
		else{
			$this->assign('state', 0);
		}*/
		//$siteName
		$config = $config_model->find(1);
		$site_name = $config['site_name'];
		$this->assign('siteName', $site_name);

		//$newComments
		$newComments = $com_model->order('id desc')->limit('0, 10')->select();
		//重构评论数据结构 rebuild comments struct
		foreach($newComments as &$comment){
			$user = $user_model->find($comment['uid']);
			$comment['header'] = $user['header'];
			$comment['nickname'] = $user['nickname'];
			$comment['agree_num'] = count($com_agree_model->where("cid=" . $comment['id'])->select());
			$comment['disagree_num'] = count($com_disagree_model->where("cid=" . $comment['id'])->select());
		}
		$this->assign('newComments', $newComments);

		//$act array
		import('ORG.Util.Page');// 导入分页类
		if($id){
			$count      = $act_model->where("uid=$id")->count();// 查询满足要求的总记录数
			$Page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$acts = $act_model->where("uid=$id")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('acts',$acts);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
		}
		else{
			$count      = $act_model->where("uid=$id")->count();// 查询满足要求的总记录数
			$Page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$acts = $act_model->where("uid=$id")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('acts',$acts);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
		}


	}

	public function hotActs(){//热门活动列表
		
	}

	public function newActs(){//最新活动列表
	
	}
}