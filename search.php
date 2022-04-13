<?php
$pageTitle = 'Поиск';
?>
<?php include "template/header.php"?>
<?php include "components/page_title.php"?>

<?php include "core/db.php";?>

<form action="/search.php" method="get" class="d-flex">
    <input name="search" value="<?php echo $_REQUEST['search'] ?? ''?>" class="form-control me-2" type="search">
    <button class="btn btn-outline-success" type="submit">Поиск</button>
</form>

<?php
    if($_REQUEST['search']) {
        $searchString = htmlspecialchars($_REQUEST['search']);

        $searchResults = search($searchString);

        include "components/searchResults.php";
    }
?>



<?php include "template/footer.php"?>
