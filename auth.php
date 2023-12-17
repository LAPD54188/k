<?php
error_reporting(E_ERROR);
ini_set("display_errors", "Off");

require_once('RNCryptor.class.php');

// 获取POST请求的数据
$data = file_get_contents("php://input");
// 设置密码，这里使用了文件路径的MD5值
$password = md5('https://raw.githubusercontent.com/LAPD54188/k/main/yuan_encrypted.json');

// 使用RNCryptor类进行解密
$cryptor = new RNCryptor\Decryptor();
$strParams = $cryptor->decrypt($data, $password);
$params = json_decode($strParams, true);

$udid = $params['udid'];
$pwd = $params['pwd'];
$timestamp = $params['timestamp'];

$status = false;
if ($status == false) {
    // 具体的条件判断和操作
    if ($pwd == '123456') {
        $status = true;
    }
    $message = '解锁码错误，解锁失败';
}

if ($status) {
    // 如果条件满足，返回成功的JSON响应
    $path = './Source_kvp.json';
    $text = file_get_contents($path);

    $json = array(
        'success' => true,
        'data' => json_decode($text, true),
    );
    echo json_encode($json);
} else {
    // 如果条件不满足，返回失败的JSON响应
    $json = array(
        'success' => false,
        'message' => $message
    );

    echo json_encode($json);
}
