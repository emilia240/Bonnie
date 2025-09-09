
<div id="comments" class="comments-area">

<?php if ( comments_open() ) : ?>
    <?php 
    comment_form(array(
        'title_reply' => pll__('Leave a comment'),
        'label_submit' => pll__('Comment'),
    ));
    ?>
<?php else : ?>
    <p class="no-comments"><?php echo esc_html(pll__('Comments are closed')); ?></p>
<?php endif; ?>


<?php if ( have_comments() ) : ?>
    <h2 class="comments-title"><?php echo esc_html(pll_e('Comments')); ?></h2>
    <ul class="comment-list">
        <?php wp_list_comments(); ?>
    </ul>
    <?php if (get_comments_number() > 1) : ?>
        <button class="see-all-comments-btn"><?php echo esc_html(pll_e('See all comments')); ?></button>
    <?php endif; ?>
    <?php the_comments_navigation(); ?> 
<?php endif; ?>

</div>