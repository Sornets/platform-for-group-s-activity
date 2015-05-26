<?php
// 本类由系统自动生成，仅供测试用途
class RegisterAction extends Action {
    public function index(){//渲染注册页面
		$ins_model = M('institute');
		
		$institutes = $ins_model->select();
		$this->assign('institutes', $institutes);

		$this->display();
    }

	public function creatUser(){
		$user_model = M('users');
		
		$_POST['create_time'] = time();
		$_POST['header'] = "default.png";

		if($user_model->add($_POST)){
			$this->success("恭喜，注册成功！", "index.php?m=Login&a=index");
		}
		else{
			$this->error("注册失败。");
		}
	}
}