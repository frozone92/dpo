<?php
    session_start();

    include 'core/utils.php';

    $menuItems = [
        [
            'url' => '/',
            'title' => 'Главная'
        ],
        [
            'url' => '/news.php',
            'title' => 'Новости'
        ],
        [
            'url' => '/about.php',
            'title' => 'О компании'
        ]
    ];


?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title><?php echo $pageTitle ?? 'Новостной сайт'?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">News site</a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($menuItems as $item){?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($_SERVER['REQUEST_URI'] == $item['url']){?>active<?php }?>" href="<?php echo $item['url']?>"><?php echo $item['title'] ?></a>
                        </li>
                    <?php }?>
                    <li class="nav-item">
                        <a href="/create.php" class="nav-link <?php if(!isAuthorized()){?>disabled<?php }?>">Добавить новость</a>
                    </li>
                    <li class="nav-item">
                        <a href="/auth.php" class="btn btn-outline-success me-2">Вход</a>
                    </li>
                </ul>
                <form action="/search.php" method="get" class="d-flex">
                    <input name="search" value="<?php echo $_REQUEST['search'] ?? ''?>" class="form-control me-2" type="search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
