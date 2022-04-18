<?php if(isset($newsDetailed['detail_text'])){?>
    <h4><?php echo $newsDetailed['title']?></h4>
    <?php if($newsDetailed['image_url']){?>
        <img style="max-width: 500px;" src="<?php echo $newsDetailed['image_url']?>"/>
    <?php }?>
    <?php if($newsDetailed['author']){?>
        <br/>
        <i>Автор: <?php echo $newsDetailed['author'] ?></i>
    <?php }?>
    <p><?php echo $newsDetailed['detail_text']?></p>

    <?php

    $comments = getArticleComments($newsDetailed['id']);
    include "components/comments_list.php"?>
    <br/>
    <br/>
    <?php include "commentForm.php" ?>
<?php }?>
