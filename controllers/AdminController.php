<?php
/**
 * Description of AdminController
 *
 * @author vega
 */
class AdminController {
    
    public function actionIndex($page = 1){
        
        $_SESSION['isLogin'] = Admin::login();
        
        //if($isLogin){
        if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']){
            
            $MessageList = Message::getMessageList($page, $flag = true);

            $total = Message::getTotalLine($flag = true);

            // Создаем объект Pagination - постраничная навигация
            $pagination = new Pagination($total, $page, Message::limit, 'page-');

            require_once ROOT.'/views/admin/index.php';
        
        }
        else{
            
            require_once ROOT.'/views/admin/error.php';
            
        }
        
        return true;
        
    }
    
    public function actionLogout(){
        header("Location: /");
    }
    
    public function actionDelete($id){
        // Сохраняем адрес с которого пришли
        $ref = $_SERVER['HTTP_REFERER'];
        Admin::delMessage($id);
        // Возвращается на предыдущую страницу
        header("Location: $ref");
    }
    
    public function actionEdit($id, $status){
        // Сохраняем адрес с которого пришли
        $ref = $_SERVER['HTTP_REFERER'];
        Admin::edit($id, $status);
        // Возвращается на предыдущую страницу
        header("Location: $ref");
    }
}
