<?php

/**
 * Description of Admin
 *
 * @author vega
 */
class Admin {
    
    public static function login(){
        
        $admin_name = 'admin';
        $admin_psw = 'admin';

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SESSION['isLogin'])){
            if($_SERVER['PHP_AUTH_USER'] == $admin_name && $_SERVER['PHP_AUTH_PW'] == $admin_psw){
                return true;
            }
        }
        else{
            header('WWW-Authenticate: Basic realm="Login"');
            header('HTTP/1.0 401 Unauthorized');
        }
        return false;
    }
    
    public static function logout(){
        unset($_SESSION['isLogin']);
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);
    }
    
    public static function delMessage($id){
        $id = intval($id);
        $db = Db::getConnection();
        $query = "DELETE FROM `message` WHERE id = :id";
        
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function edit($id, $status){
        $id = intval($id);
        $status = intval($status);
        $db = Db::getConnection();
        $query = "UPDATE `message` SET status = :status WHERE id = :id";
        
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($query);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}
