<?php
// if (!isset($allow_access)) {
//     die("Unauthorized access.");
//     echo "<script>alert('Unauthorized access.')</script>";
// }
function remove_bad_character($string)
{
    $bad_character = ['!', '\'', '"', '#', '$', '%', '^', '&', '*', '(', ')', '\\'];
    return str_replace($bad_character, "", $string);
}
function checkAuthentication()
{
    $secret = "M@inguy&n30";
    $username = $_COOKIE['cookie'];
    $user_agent = getUserAgent();
    $ip_address = getIpAdress();
    $client_stamp = $_COOKIE['stamp'];
    if ((isset($username) && !empty($username)) && (isset($client_stamp) && !empty($client_stamp))) {
        $sever_stamp = generateStamp($username, $secret, $user_agent, $ip_address);
        if ($sever_stamp != $client_stamp) {
            header('location: ?page=./module/user&action=login');
            die();
        }
    } else {
        header('location: ?page=./module/user&action=login');
        die();
    }
}
// echo '2'.$_COOKIE['cookie'].';'.getUserAgent().';'.getIpAdress() ;  
function generateStamp($username, $secret, $user_agent, $ip_address)
{
    return md5($username . $secret . $user_agent . $ip_address);
}

function getUserAgent()
{
    return $_SERVER['HTTP_USER_AGENT'];
}
function getIpAdress()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getUserId()
{
    global $conn;
    $username = isset($_COOKIE['cookie']) ? $_COOKIE['cookie'] : null;
    $query = "SELECT * FROM  users WHERE username = '$username'";
    $result = $conn->query($query);
    $user_id = $result->fetch_assoc()['user_id'];
    return $user_id;
}
