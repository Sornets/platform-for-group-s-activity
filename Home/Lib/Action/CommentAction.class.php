<?php
// 本类由系统自动生成，仅供测试用途
class CommentAction extends Action {
    public function hotComments($aid){//输出活动热门评论
	
	}

	public function actComments($aid){//输出活动全部评论
	
	}

	public function newComments(){//最新的评论
	
	}

	public function iAgree($cid){//评论点赞接口
		$uid = session("userid");

	}

	public function iDisagree($cid){//评论反对接口
		$uid = session("userid");

	}

	public function creatComment($aid){//创建新评论
		$uid = session("userid");
	}
}