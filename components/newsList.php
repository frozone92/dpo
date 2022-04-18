<ol class="list-group list-group-numbered col-sm-6">
    <?php foreach ($newsList as $newsItem){?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <?php if($newsItem['image_url']){?>
                    <img style="max-width: 300px;" src="<?php echo $newsItem['image_url']?>"/>
                <?php }?>
                <div class="fw-bold">
                    <a href="/news.php?id=<?php echo $newsItem['id']?>">
                        <?php echo $newsItem['title']?>
                    </a>
                </div>
                <?php if($newsItem['preview_text']){?>
                    <?php echo $newsItem['preview_text'] ?>
                <?php }?>
                <?php if($newsItem['author']){?>
                    <br/>
                    <i>Автор: <?php echo $newsItem['author'] ?></i>
                <?php }?>
            </div>
        </li>
    <?php }?>
</ol>


