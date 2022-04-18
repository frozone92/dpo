<?php
$fields = [
    'commenter' => [
        'label' => 'Представьтесь',
        'type' => 'input'
    ],
    'text' => [
        'label' => 'Ваше мнение',
        'type' => 'textarea'
    ]
];

$errors = [];
foreach ($fields as $key => $field){
    if(isset($_POST[$key]) && $_POST[$key]==''){
        $errors[] = $key;
    }
}

include_once "core/db.php";

if(!$errors && $_POST){
    $result = createComment($newsDetailed['id'],$_POST);
}


?>

<h5>Добавить комментарий</h5>
<form method="post" enctype="multipart/form-data">
    <?php foreach ($fields as $key => $field) {?>
        <?php if($field['type'] == 'input'){?>
            <div class="mb-3">
                <label class="form-label"><?php echo $field['label'] ?? ''?></label>
                <input name="<?php echo $key ?? ''?>" value="<?php echo htmlspecialchars($_REQUEST[$key] ?? '')?>" type="text" class="form-control <?php if(in_array($key,$errors)){echo 'is-invalid';}elseif(isset($_REQUEST[$key])){echo 'is-valid';}?>">
            </div>
        <?php }elseif($field['type'] == 'textarea'){?>
            <div class="mb-3">
                <label class="form-label"><?php echo $field['label'] ?? ''?></label>
                <textarea name="<?php echo $key ?? ''?>" class="form-control <?php if(in_array($key,$errors)){echo 'is-invalid';}elseif(isset($_REQUEST[$key])){echo 'is-valid';}?>" rows="3"><?php echo htmlspecialchars($_REQUEST[$key] ?? '')?></textarea>
            </div>
        <?php }elseif($field['type'] == 'file'){?>
            <div class="mb-3">
                <label class="form-label"><?php echo $field['label'] ?? ''?></label>
                <input name="<?php echo $key ?? ''?>" class="form-control <?php if(in_array($key,$errors)){echo 'is-invalid';}elseif(isset($_REQUEST[$key])){echo 'is-valid';}?>" type="file"/>
            </div>
        <?php }?>
    <?php }?>

    <button type="submit" class="btn btn-primary">Комментировать</button>
</form>

<?php if(isset($result) && $result == true){?>
    <div class="alert alert-success" role="alert">
        Комментарий добавлен!
    </div>
<?php }?>

<?php if(count($errors)>0){?>
    <div class="alert alert-danger" role="alert">
        Заполните все поля!
    </div>
<?php }?>
