<?php
    $errors = [];
    if(isset($_REQUEST['register'])){
        if(!$_REQUEST['login']){
            $errors[] = 'login';
        }
        if(!$_REQUEST['password'] || strlen($_REQUEST['password'])<8){
            $errors[] = 'password';
        }
        if(!$_REQUEST['repeat_password'] || $_REQUEST['repeat_password']!=$_REQUEST['password']){
            $errors[] = 'repeat_password';
        }

        if(count($errors)==0){
            include "core/db.php";

            $userExists = getUser(htmlspecialchars($_REQUEST['login']));
            if($userExists){
                $errors[] = 'login';
                $errors[] = 'user_exists';
            }else{
                $passHash = md5(md5('newsportal').htmlspecialchars($_REQUEST['password']));

                $result = saveUser(htmlspecialchars($_REQUEST['login']),$passHash);
            }
        }
    }
?>

<div class="col-sm-5">
    <form method="post">
        <input type="hidden" name="register" value="Y"/>
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
                        Укажите пароль не менее 8 символов
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Повторите пароль</label>
            <div class="col-sm-10 has-validation">
                <input type="password" name="repeat_password" value="<?php echo htmlspecialchars($_REQUEST['repeat_password'] ?? '')?>" class="form-control <?php if(in_array('repeat_password',$errors)){echo 'is-invalid';}elseif(isset($_REQUEST['repeat_password'])){echo 'is-valid';}?>" id="inputPassword3">
                <?php if(in_array('repeat_password',$errors)){?>
                    <div class="invalid-feedback">
                        Пароль не совпадает
                    </div>
                <?php }?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
        <?php if(in_array('user_exists',$errors)){?>
            <div class="alert alert-danger" role="alert">
                Пользователь с таким логином уже зарегистрирован
            </div>
        <?php }?>
        <?php if(isset($result) && $result == true){?>
            <div class="alert alert-success" role="alert">
                Пользователь успешно зарегистрирован
            </div>
        <?php }?>
    </form>
</div>
