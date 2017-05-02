<?php include_once(ROOT.'/template/layouts/header.php'); ?>
    <body>
        <div class="container">
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <ul class="list-inline text-center">
                        <li><a href="/" class="btn btn-primary">Сообщения</a></li>
                        <li><span class="btn btn-primary disabled">Админпанель</span></li>
                        <?php if(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true): ?>
                            <li><a href="/admin/logout/" class="btn btn-primary">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <span>Сообщений: <?php echo $total; ?></span>
                </div>
            </div>
            <?php if(isset($MessageList) && !empty($MessageList)): ?>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <table class="table">
                        <?php foreach ($MessageList as $list): ?>
                            <tr>
                                <td><?php echo $list['id']; ?></td>
                                <td><?php echo $list['username']; ?></td>
                                <td><?php echo $list['message']; ?></td>
                                <td><?php echo $list['email']; ?></td>
                                <td><?php echo $list['createdate']; ?></td>
                                <td><a class="btn btn-primary" href="/admin/delete/<?php echo $list['id']; ?>" role="button">Удалить</a><td>
                                <?php if($list['status'] == 1): ?>
                                    <td><a class="btn btn-primary" href="/admin/edit/<?php echo $list['id']; ?>/0" role="button">Скрыть</a><td>
                                <?php else: ?>
                                    <td><a class="btn btn-primary" href="/admin/edit/<?php echo $list['id']; ?>/1" role="button">Опубликовать</a><td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            <div  class = 'row'>
                <div class = 'col-md-12 text-center'>
                    <?php echo $pagination->get(); ?>
                </div>
            </div>
        </div>
    </body>
</html>