<DOCTYPE html>
<html>
    <head>
        <title>admin panel</title>
        <link rel="stylesheet" href="/template/css/bootstrap.min.css">
    <body>
        <div class="container">
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <ul class="list-inline text-center">
                        <li><a href="/" class="btn btn-primary">Сообщения</a></li>
                        <li><a href="/admin/" class="btn btn-primary disabled">Админпанель</a></li>
                        <?php if(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true): ?>
                            <li><a href="/admin/logout/" class="btn btn-primary">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <h1>error</h1>
                </div>
            </div>
        </div>
    </body>
    </head>
</html>