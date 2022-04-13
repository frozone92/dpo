<?php

global $pdo;
$pdo = new \PDO(
    'mysql:host=localhost:3306;dbname=php_beginners',
    "php_beginner",
    "test123"
);

$res = $pdo->query('select * from news;');

$newsList = [];
while($news = $res->fetch()){
    $newsList[] = $news;
}

function getNews($id){
    if(!isset($id)){
        return false;
    }

    global $pdo;
    $res = $pdo->query('select * from news where `id` = '.$id.';');

    return $res->fetch();
}

function search($searchString){
    global $pdo;

    $res = $pdo->query('select * from news where `title` LIKE "%'.$searchString.'%" OR `preview_text` LIKE "%'.$searchString.'%";');

    $searchResults = [];
    while($news = $res->fetch()){
        $searchResults[] = $news;
    }

    return $searchResults;
}


function create($fields){
    global $pdo;

    $sql = 'INSERT INTO news (';

    $values = 'VALUES (';

    $i = 0;
    foreach ($fields as $key => $value){
        if($i!=0){
            $sql.=',';
            $values.=',';
        }
        $sql.= $key;
        $values.='"'.$value.'"';

        $i++;
    }

    if(isAuthorized()){
        $sql.= ',author';
        $values.= ',"'.authUser()['login'].'"';
    }


    $values.= ')';

    $sql.= ') '.$values;

    return $pdo->exec($sql);
}

function getUser($login){
    if(!isset($login)){
        return false;
    }

    global $pdo;
    $query = "select * from users where `login` = '$login';";
    $res = $pdo->query($query);

    if($res) {
        return $res->fetch();
    }else{
        return false;
    }
}

function getUsers(){

    global $pdo;
    $res = $pdo->query('select * from users ;');

    $users = [];
    while ($user = $res->fetch()){
        $users[] = $user;
    }

    return $users;
}

function saveUser($login,$pass){
    global $pdo;

    $sqlString = "INSERT INTO users (login,password) VALUES ('$login','$pass')";

    return $pdo->exec($sqlString);
}


//function saveBird($name,$birdType,$img = '',$text=''){
//    global $pdo;
//
//    $sqlString = "INSERT INTO birds (name,bird_type,img,short_desc) VALUES ('$name','$birdType','$img','$text')";
//
//    return $pdo->exec($sqlString);
//}
//
//function deleteBird($id){
//    global $pdo;
//
//    $sqlString = "DELETE FROM birds WHERE id = '$id'";
//
//    return $pdo->exec($sqlString);
//}
