<?php
$articles = $this->articles;

if(!empty($articles)) {
    foreach ($articles as $article) {
        $id = $article['article_id'];
        $date = date_format(date_create($article['date']), 'd-m-y');
        $comments = $this->getComments($id);
        $title = $article['title'];
        $content = $article['content'];
        $author = $article['name'];
        $image = $article['image'];

        ?>
        <article>
        <?php if($this->checkAuth(false)) { ?>
            <span class="clickable delete-article" id="<?= $id ?>">X</span>
        <? } ?>
            <span><?= $date ?></span>
            <span><?= $author ?></span>

            <fieldset>
                <legend class="article-title"><?= $title ?></legend>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" />
                <p><?= $content ?></p>
            </fieldset>
            <?php
                 if(!empty($comments)) {
                     foreach($comments as $comment) {
                         $created = date_format(date_create($comment['created']), 'd-m-y');;

                         echo "<br>
                                <fieldset>
                                    <span id='author_name'>{$comment['name']}</span>
                                    <span id='created_date'>$created</span>
                                    <p>{$comment['content']}</p>
                                 </fieldset>";
                     }
                 }
            ?>
        </article>
        <?php if($this->checkAuth(false)) { ?>
            <form method="post" action="/cooking/articles/comment">
                <label for="content"></label>
                <textarea class="comment" id="content" name="content"></textarea>
                <button name="id" value="<?php echo $id; ?>">Comment</button>
            </form>
         <? }
    }
};

