<?php

    require_once 'create_token.php';

    function check_csrf($csrf_token=null) {
        if ((!array_key_exists('csrf', $_POST) or $_POST['csrf'] !== $_SESSION['csrf']) and $csrf_token != $_SESSION['csrf']) {
            return false;
        }
        return true;
    }

    function csrf_html() {
        echo '<input type="hidden" name="csrf" value="'.$_SESSION['csrf'].'" />';
    }

    function get_csrf(){
        return $_SESSION['csrf'];
    }

    function gen_csrf($replace = false) {
        if ($replace or !array_key_exists('csrf', $_SESSION)) {
            $_SESSION['csrf'] = touch_letter_token(128);
        }
    }

    gen_csrf();