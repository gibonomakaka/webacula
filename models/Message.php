<?php

/**
 * Description of getMessageList
 *
 * @author vega
 */
class Message {
    
    const limit = 10;
    
    public static function getMessageList($page = 1, $flag = false){
        $db = Db::getConnection();
        $limit = self::limit;
        $offset = ($page - 1) * $limit;
        if(!$flag){
            $query = "SELECT * FROM message WHERE status = 1 ORDER BY id DESC LIMIT $limit OFFSET $offset";
        }
        else{
            $query = "SELECT * FROM message ORDER BY id DESC LIMIT $limit OFFSET $offset";
        }
        $answer = $db->query($query, PDO::FETCH_ASSOC);
        $MessageList = array();
        $i = 0;
        while($row = $answer->fetch()){
            $MessageList[$i]['id'] = $row['id'];
            $MessageList[$i]['username'] = $row['username'];
            $MessageList[$i]['message'] = $row['message'];
            $MessageList[$i]['email'] = $row['email'];
            $MessageList[$i]['pathavatar'] = $row['pathavatar'];
            $MessageList[$i]['createdate'] = $row['createdate'];
            $MessageList[$i]['status'] = $row['status'];
            $i++;
        }
        return $MessageList;
    }
    
    public static function check(){
    // Проверка корректности введенных данных средствами php
        $errors = false;
        if(isset($_POST['submit'])){
            /*
             *  получение данных из формы, обрезка пробельных символов,
             * преобразование html кода в строку
             */
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $message = htmlspecialchars(trim($_POST['message']));

            // Очищенные данные записываются в сессию
            //$_SESSION['name'] = $name;
            //$_SESSION['email'] = $email;
            //$_SESSION['message'] = $message;

            if($name == ''){
                $errors['name'] = 'Введите имя пользователя';
            }
            // Проверка валидности введенного tmail
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email = '') {
                $errors['email'] = 'Некорректный e-mail';
            }
            // Проверка заполнения текстового поля
            if($message == ''){
                $errors['message'] = 'Введите текст сообщения';
            }
                return $errors;
        }
    }
    
    public static function addMessage(){
        // Проверка наличия post-запроса
        if(isset($_POST['submit'])){
            /*
             *  получение данных из формы, обрезка пробельных символов,
             * преобразование html кода в строку
             */
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $message = htmlspecialchars(trim($_POST['message']));
            $status = 1;

            $db = Db::getConnection();

            $query = "INSERT INTO `message`(`username`, `message`, `email`, `status`) VALUES (:name, :message, :email, :status)";
            
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($query);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':message', $message, PDO::PARAM_STR);
            $result->bindParam(':status', $status, PDO::PARAM_INT);
            return $result->execute();
        }
    }
    
    // Получение общего количества записей в таблице
    public static function getTotalLine($flag = false){
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        if(!$flag){
            $sql = "SELECT count(id) AS count FROM message WHERE status = 1";
        }
        else{
            $sql = "SELECT count(id) AS count FROM message";
        }

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        // Выполнение коменды
        $result->execute();
        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    
    public static function getLastMessageAjax(){
        $db = Db::getConnection();
        
        $query = "SELECT * FROM message WHERE status = 1 ORDER BY id DESC LIMIT 1";

        $answer = $db->query($query, PDO::FETCH_ASSOC);
        $MessageList = array();
        
        $row = $answer->fetch();
        $MessageList[] = $row['id'];
        $MessageList[] = $row['username'];
        $MessageList[] = $row['message'];
        $MessageList[] = $row['email'];
        $MessageList[] = $row['pathavatar'];
        $MessageList[] = $row['createdate'];
        $MessageList[] = $row['status'];
        
        return $MessageList;
    }
}
