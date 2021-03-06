<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 8/17/15
 * Time: 17:12
 */
function sms_send($template = 1, $mobile, $content_arr)
{
    switch(intval($template))
    {
        case 1:
            $content = "【{title}】您的验证码为{code}，在{time}分钟内有效。";
            break;
        default:
            $content = "【{title}】您的验证码为{code}，在{time}分钟内有效。";
            break;
    }
    if (isset($content_arr['title']))
        $content = str_replace('{title}', $content_arr['title'], $content);
    if (isset($content_arr['code']))
        $content = str_replace('{code}', $content_arr['code'], $content);
    if (isset($content_arr['time']))
        $content = str_replace('{time}', $content_arr['time'], $content);
    $api_url = "http://api.smsbao.com/sms?u=chezone&p=PASSWORD&m=".$mobile."&c=".$content;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$api_url);
    /*curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "postvar1=value1&postvar2=value2&postvar3=value3");*/

    // in real life you should use something like:
    // curl_setopt($ch, CURLOPT_POSTFIELDS,
    //          http_build_query(array('postvar1' => 'value1')));

    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec ($ch);

    curl_close ($ch);

// further processing ....
    if ($server_output == '0') {
        return true;
    } else {
        return $server_output;
    }
}
