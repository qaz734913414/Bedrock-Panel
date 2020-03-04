<?php
function login($type, $user, $password)
{
    if ($type === 'web') {
		
        if ($user === $GLOBALS['user'] and md5($password) === $GLOBALS['password']) {
			session_start();
			$_SESSION['user'] = $GLOBALS['user'];
            $ret['code'] = 200;
            $ret['info'] = '您于'.date("Y-m-d").'在'.$type.'登录成功。';
            echo rplyJson($ret);
            exit;
        } else {
			$ret['code'] = 401;
            $ret['info'] = "您的账号或密码有误，请检查后再试";
            echo rplyJson($ret);
            exit;
		}
    } elseif ($type === 'qqbot' and $GLOBALS['api_qqbot'] == true) {
        if ($user === $GLOBALS['user'] and md5($password) === $GLOBALS['password']) {
			$ret['apiKey'] = md5($user);
            $ret['code'] = 200;
            $ret['info'] = '您于'.date("Y-m-d").'在'.$type.'登录成功。';
            echo rplyJson($ret);
            exit;
        } else {
			$ret['code'] = 401;
            $ret['info'] = "您的账号或密码有误，请检查后再试";
            echo rplyJson($ret);
            exit;
		}
    }
}
