<?php
$test_mode = true;
if ($test_mode == true) {
    include "../Config/config.php";
    include Config_Path . "bds-data.php";
    include Lib_Path . "/data-utils.php";
}
# 获取下载源 // 临时写法
// 智能选源
function get_Source($source)
{
    # 获取源信息
    # 智能取源
    # 开始选源
    switch ($source) {
        // 临时写法
        case "mojang":
            return $domain = 'https://minecraft.azureedge.net/';
            break;
        case "test":
            return $domain = 'http://39.106.117.100/';
            break;
        case "localhost":
            return $domain = 'http://localhost/bds/';
            break;
    }
}
# 获取版本号
// 获取版本库
function get_BDS_Version($num)
{
    return $GLOBALS['ver'][$num];
}
# 获取下载地址
function get_Url($bds_ver, $source = 'mojang')
{
    # 准备下载地址
    # 获取下载服务器
    $domain = Get_Source($source);
    # 选择下载类型版本:PHP自适应
    $os_ver = PHP_OS === 'Linux' ? '/bin-linux' : '/bin-win';
    # 下载文件前缀
    $file_prefix = '/bedrock-server-';
    # 下载文件后缀
    $file_type = '.zip';
    # 下载地址准备就绪
    return $url = $domain . $os_ver . $file_prefix . $bds_ver . $file_type;
}
# 校验下载地址
function checkDownload($bds_ver, $source = 'mojang')
{
    # 准备开始检查链接有效性
    # 链接已准备就绪
    $url = Get_Url($bds_ver, $source);
    # 初始化一个cURL会话
    $ch = curl_init();
    # 载入URL地址
    curl_setopt($ch, CURLOPT_URL, $url);
    # 获取Header信息
    curl_setopt($ch, CURLOPT_HEADER, 1);
    # 丢弃无用数据:Body
    curl_setopt($ch, CURLOPT_NOBODY, true);
    # 将以文件流的形式返回获取的信息
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # 执行一个cURL会话
    $data = curl_exec($ch);
    # 输出HTTP状态码
    return $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    # 关闭一个cURL会话并且释放所有资源
    curl_close($ch);
}
# 开始下载
function download_BDS($bds_ver, $source)
{
    if (checkDownload($bds_ver) == '200') {
        # 准备开始下载
        # 链接已准备就绪
        $url = get_Url($bds_ver, $source);
        # 默认保存地址
        $server_path = Download_Path . 'bds';
        # 选择下载类型版本:PHP自适应
        $os_ver = PHP_OS === 'Linux' ? '/bin-linux' : '/bin-win';
        # 下载文件前缀
        $file_prefix = '/bedrock-server-';
        # 选择下载后缀
        $file_type = '.zip';
      
        switch ($action) {
            case 'prepare-download':
                // 下载缓存文件夹
                $download_cache = __DIR__ . "/download_cache";
                if (!is_dir($download_cache)) {
                    if (false === mkdir($download_cache)) {
                        exit('创建下载缓存文件夹失败，请检查目录权限。');
                    }
                }
                $tmp_path = $download_cache . "/update_" . time() . ".zip";
                save_tmp_path();
                // 这里保存临时文件地址
                return json(compact('remote_url', 'tmp_path', 'file_size'));
                break;
            case 'start-download':
                // 这里检测下 tmp_path 是否存在
                try {
                    set_time_limit(0);
                    touch($tmp_path);
                    // 做些日志处理
                    if ($fp = fopen($remote_url, "rb")) {
                        if (!($download_fp = fopen($tmp_path, "wb"))) {
                            exit;
                        }
                        while (!feof($fp)) {
                            if (!file_exists($tmp_path)) {
                                // 如果临时文件被删除就取消下载
                                fclose($download_fp);
                                exit;
                            }
                            fwrite($download_fp, fread($fp, 1024 * 8), 1024 * 8);
                        }
                        fclose($download_fp);
                        fclose($fp);
                    } else {
                        exit;
                    }
                } catch (Exception $e) {
                    Storage::remove($tmp_path);
                    exit('发生错误：' . $e->getMessage());
                }
                return json(compact('tmp_path'));
                break;
            case 'get-file-size':
                // 这里检测下 tmp_path 是否存在
                if (file_exists($tmp_path)) {
                    // 返回 JSON 格式的响应
                    return json(['size' => filesize($tmp_path)]);
                }
                break;
            default:
                # code...
                break;
        }
        # 初始化一个cURL会话
        $ch = curl_init();
        # 载入URL地址
        curl_setopt($ch, CURLOPT_URL, $url);
        # 将以文件流的形式返回获取的信息
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # 设置SSL版本：当前PHP自适应
        curl_setopt($ch, CURLOPT_SSLVERSION);
        # 执行一个cURL会话
        $data = curl_exec($ch);
        # 正在将文件流写入文件
        $download = fputs(fopen($server_path . $os_ver . $file_prefix . $bds_ver . $file_type, "w+"), $data);
        # 输出执行结果
        return $code = $download ? 200 : 403;
    } else {
        # 输出执行结果
        return 404;
    }
    # 关闭一个cURL会话并且释放所有资源
    curl_close($ch);
}
# 校验下载结果
function check_BDS($bds_ver)
{
    // 获取版本的校验码
    $num = $GLOBALS['ver_flip'][$bds_ver];
    $md5 = $GLOBALS['md5'][$num];
    // 计算下载版本的校验码
    # 下载文件前缀
    $file_prefix = '/bedrock-server-';
    # 下载文件后缀
    $file_type = '.zip';
    # 默认保存地址
    $server_path = Download_Path . 'bds';
    # 选择下载类型版本:PHP自适应
    $os_ver = PHP_OS === 'Linux' ? '/bin-linux' : '/bin-win';
    $file_path = $server_path . $os_ver . $file_prefix . $bds_ver . $file_type;
    return $code = $md5 === md5_file($file_path) ? 200 : 202;
}
//[A-Za-z0-9][-A-Za-z0-9]{1,32}
//
# 准备BDS文件
function get_BDS($bds_ver, $source)
{
    # 下载文件前缀
    $file_prefix = '/bedrock-server-';
    # 下载文件后缀
    $file_type = '.zip';
    # 默认保存地址
    $server_path = Download_Path . 'bds';
    # 选择下载类型版本:PHP自适应
    $os_ver = PHP_OS === 'Linux' ? '/bin-linux' : '/bin-win';
    $file_path = $server_path . $os_ver . $file_prefix . $bds_ver . $file_type;
    # 检查文件是否存在
    if (!file_exists($file_path)) {
        switch (download_BDS($bds_ver, $source)) {
            case "200":
                break;
            case "403":
                return 403;
                break;
            case "404":
                return 404;
                break;
        }
    }
    # 检查文件完整性
    if (check_BDS($bds_ver) == '202') {
        unlink($file_path);
        return 202;
    } else {
        return 200;
    }
}
# 调用安装程序
function bds_Deploy($bds_ver, $source)
{
    # 下载结果判断
    switch (get_BDS($bds_ver, $source)) {
        case "202":
            while (get_BDS($bds_ver, $source) != '200') {
                get_BDS($bds_ver, $source);
            }
            $code = '200';
            break;
        case "403":
            return 403;
            break;
        case "404":
            return 404;
            break;
        case "200":
            $code = '200';
            break;
    }
    # 安装准备
    if ($code == '200') {
        echo 'install';
    }
}
echo bds_Deploy('1.14.30.2', 'mojang');