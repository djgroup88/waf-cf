<?php
    function dd(...$data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }

    function check($agent) {
        if (strpos($agent, 'Google-InspectionTool') !== false) {
            return false;
        }
        if (strpos($agent, 'googlebot') !== false) {
            return false;
        }
        return true;
    }

    if(!check($_SERVER['HTTP_USER_AGENT'])) {
        $content = file_get_contents('index-origin.html');
    } else {
        if ($token = $_GET['token']) {
            setcookie('token', $token, time() + (86400 * 30), "/");
            header("Location: /");
        } else {
            if(!isset($_COOKIE['token'])) {
                $content = file_get_contents('verify.html');
            } else {
                $content = file_get_contents('index-origin.html');
            }
        }
    }

    echo $content;
?>