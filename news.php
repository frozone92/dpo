<?php include "template/header.php"?>
<?php
$pageTitle = 'Новости';
?>
<?php include "components/page_title.php"?>

<?php include "core/db.php";?>

<?php if(isset($_REQUEST['id'])) {
    $newsId = $_REQUEST['id'];


    $newsDetailed = getNews($newsId);

    include "components/newsDetailed.php";
}else{
    include "components/newsList.php";
}?>



<?php include "template/footer.php"?>
