<?php
    session_start(); 
    require_once '../../core/urls_conf.php';
    require_once '../../core/db_connect.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
            
        if (array_key_exists('content', $data) and array_key_exists($data['content'], $contents)){
            echo json_encode(['html_file'=> $contents[$data['content']]['file'],
                            'scripts' => $contents[$data['content']]['scripts']]);                
        }

        if (array_key_exists('db-query', $data) and array_key_exists($data['db-query'], $dbQuery)){
            echo $dbQuery[$data['db-query']]();
        }

        if (array_key_exists('set-session-disctionary-id', $data)){
            $_SESSION['dictionary-id'] = $data['set-session-disctionary-id'];
        }
    }
?>
