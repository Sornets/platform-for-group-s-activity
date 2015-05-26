<?php
// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
    public function index(){//登录页面
		$this->display();
    }

	public function checkLogin(){//检查用户名&密码
		$user_model = M('users');
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$user = $user_model->where("email='" . $email . "'")->find();
		if($user && $user['password'] == $password){
			session('uid', $user['id']);
			$this->success("欢迎，" . $user['nickname'] . "！", "index.php?m=Index&a=index");
		}
		else{
			$this->error("登录失败，请检查用户名或密码");
		}
	}
}