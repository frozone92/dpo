<ol class="list-group list-group-numbered col-sm-6">
    <?php foreach ($searchResults as $searchItem){?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">
                    <a href="/news.php?id=<?php echo $searchItem['id']?>">
                        <?php echo $searchItem['title']?>
                    </a>
                </div>
                <?php if($searchItem['preview_text']){?>
                    <?php echo $searchItem['preview_text'] ?>
                <?php }?>
            </div>
        </li>
    <?php }?>
</ol>


