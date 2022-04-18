<h5>Комментарии</h5>
<ol class="list-group list-group-numbered col-sm-6">
    <?php foreach ($comments as $comment){?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">
                    <?php echo $comment['commenter']?>
                </div>
                <?php echo $comment['text'] ?>
            </div>
        </li>
    <?php }?>
</ol>


