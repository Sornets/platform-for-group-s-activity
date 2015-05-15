<?php
// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
    public function index(){//登录页面
		$this->display();
    }

	public function checkLogin(){//检查用户名&密码
		$email = $_POST['email'];
		$password = $_POST['password'];

	}
}