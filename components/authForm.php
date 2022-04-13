<?php
$errors = [];
if(isset($_REQUEST['auth'])){
    if(!$_REQUEST['login']){
        $errors[] = 'login';
    }
    if(!$_REQUEST['password']){
        $errors[] = 'password';
    }

    if(count($errors)==0){
        include "core/db.php";

        $user = getUser(htmlspecialchars($_REQUEST['login']));
        if($user){
            $passHash = md5(md5('newsportal').htmlspecialchars($_REQUEST['password']));

            if($user['password'] == $passHash){
                $_SESSION['auth_user'] = $user;
                $result = true;
            }else{
                $errors[] = 'not_found';
            }
        }else{
            $errors[] = 'not_found';
        }
    }
}
?>


<div class="col-sm-5">
<form method="post">
    <input type="hidden" name="auth" value="Y"/>
    <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Логин</label>
        <div class="col-sm-10 has-validation">
            <input type="text" name="login" value="<?php echo htmlspecialchars($_REQUEST['login'] ?? '')?>" class="form-control <?php if(in_array('login',$errors)){echo 'is-invalid';}elseif(isset($_REQUEST['login'])){echo 'is-valid';}?>" id="inputEmail3">
            <?php if(in_array('login',$errors)){?>
                <div class="invalid-feedback">
                    Укажите логин
                </div>
            <?php }?>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
        <div class="col-sm-10 has-validation">
            <input type="password" name="password" value="<?php echo htmlspecialchars($_REQUEST['password'] ?? '')?>" class="form-control <?php if(in_array('password',$errors)){echo 'is-invalid';}elseif(isset($_REQUEST['password'])){echo 'is-valid';}?>" id="inputPassword3">
            <?php if(in_array('password',$errors)){?>
                <div class="invalid-feedback">
                    Укажите пароль
                </div>
            <?php }?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
    <a href="/register.php" class="btn btn-default">Регистрация</a>
    <?php if(in_array('not_found',$errors)){?>
        <div class="alert alert-danger" role="alert">
            Пользователь с таким логином и паролем не найден
        </div>
    <?php }?>
    <?php if(isset($result) && $result == true){?>
        <div class="alert alert-success" role="alert">
            Пользователь успешно авторизован
        </div>
    <?php }?>
</form>
</div>
