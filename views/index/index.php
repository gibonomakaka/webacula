<?php include ROOT.'/template/layouts/header.php'; ?>
    <body>
        <div class="container">
            
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <ul class="list-inline text-center">
                        <li><span class="btn btn-primary disabled">Сообщения</span></li>
                        <li><a href="/admin/" class="btn btn-primary">Админпанель</a></li>
                        <?php if(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true): ?>
                            <li><a href="/admin/logout/" class="btn btn-primary">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class = 'row'>
                <div class = 'col-md-12'>
                    <form action="/" method="POST" class='form' id="userForm" role="form">
                        <div class="form-group">
                            <label for="name">Введите имя</label>
                            <input type="text" id="name" name="name" placeholder="Введите имя" class="form-control">
                            <span><?php echo !empty($error['name']) ? $error['name'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Введите сообщение</label>
                            <textarea id="message" name="message" placeholder="Введите сообщение" class="form-control"></textarea>
                            <span><?php echo !empty($error['message']) ? $error['message'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Введите email</label>
                            <input type="email" value="" id="email" name="email" placeholder="Введите email" class="form-control">
                            <span><?php echo !empty($error['email']) ? $error['email'] : '' ?></span>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Отправить</button>
                        <input type="button" id="submitAjax" class="btn btn-success" value="Отправить Ajax" />
                    </form>
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
                        <tr id="<?php echo $list['id'] ;?>">
                                <td><?php echo $list['username']; ?></td>
                                <td><?php echo $list['message']; ?></td>
                                <td><?php echo $list['email']; ?></td>
                                <td><?php echo $list['createdate']; ?></td>
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
        <!--javascript-->
        <!-- Скрипт валидации формы -->
        <script>
            var validator = $('#userForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    message: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    name: {
                        required: 'Обязательно введите свое имя',
                        minlength: 'Длина имени должна быть не менее 3-х символов'
                        },
                    message: {
                        required: 'Обязательно введите свое сообщение'
                    },
                    email: {
                        required: 'Поле email должно быть заполнено',
                        email: 'Введите корректный email адрес'
                    }
                },
                submitHandler: function(){
                    $(form).submit();
                    alert('Сообщение успешно отправлено и будет показано после модерации');
                }
            });
        </script>
        
        <script>
            $(document).ready(function (){
                $("#submitAjax").bind("click", function (){
                    $.ajax({
                        url: "/index/ajax/",
                        type: "POST",
                        data: ({name: $("#name").val(), message: $("#message").val(), email: $("#email").val(), submit: true}),
                        dataType: "html",
                        success: function(data){
                            alert('Сообщение успешно отправлено и будет показано после модерации');
                            data = JSON.parse(data);
                            $("<tr><td>"+data[1]+"</td><td>"+data[2]+"</td><td>"+data[3]+"</td><td>"+data[5]+"</td></tr>").insertBefore($("tr:first"));
                            // очистка полей формы
                            $("#name").val('');
                            $("#message").val('');
                            $("#email").val('');
                        }
                    });
                });
            });
        </script>
        <div id="information"></div>
    </body>
</html>