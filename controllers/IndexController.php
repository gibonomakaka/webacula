<?php

/**
 * Description of IndexController
 *
 * @author vega
 */
class IndexController {
    
    // 
    public function actionIndex($page = 1){
        Admin::logout();
        if(isset($_POST['submit'])){
            $error = Message::check();
            // Добавление сообщения от пользователя
            if(!$error){
                Message::addMessage();
            }
        }
        $MessageList = Message::getMessageList($page);
        $total = Message::getTotalLine();
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Message::limit, 'page-');
        require_once ROOT.'/views/index/index.php';
        return true;
    }
    
    
    public function actionAjax() {
        Message::addMessage();
        $MessageList = Message::getLastMessageAjax();
        echo json_encode($MessageList);
        return true;
    }
}
