<div id="comments" class="comments-area">

<?php if ( comments_open() ) : ?>
    <?php comment_form(); ?>
<?php else : ?>
    <p class="no-comments">Comments are closed</p>
<?php endif; ?>

<?php if ( have_comments() ) : ?>
    <h2 class="comments-title">Comments</h2>
    <ul class="commentlist">
        <?php wp_list_comments(); ?>
    </ul>
    <?php the_comments_navigation(); ?> 
<?php endif; ?>

<?php if (get_comments_number() > 1) : ?>
    <button class="see-all-comments-btn">See all comments</button>
<?php endif; ?>

</div>
