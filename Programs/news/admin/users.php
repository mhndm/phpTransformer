<?php

if (isset($_GET['term'])) {
    if (strlen($_GET['term'])>2) {
        
        include_once '../../../includes.php';

        $Nick= InputFilter($_GET['term']);
        
        $db = new db();
        $users = $db->get_results(" select `NickName` from `users` 
                                    where `NickName` like '%".$Nick."%' limit 0,100; ");
        foreach ($users as $user) {
            $NickName[] = $user->NickName;
        }

        header("Content-Type: text/plain");
        echo json_encode($NickName);
        
        
        
    }
}
?>