
<div id="comments" class="comments-area my-10" style="font-family: 'Skolar Sans', sans-serif;">

<?php if ( comments_open() ) : ?>
    <?php 
    comment_form(array(
        'title_reply' => pll__('Leave a comment'),
        'label_submit' => pll__('Comment'),

        // START OF FIX: Explicitly define the textarea and its label
        'comment_field' => '<p class="comment-form-comment">
            <label for="comment">' . pll__('Leave a comment') . ' <span class="required">*</span></label>
            <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>
        </p>',
        // END OF FIX
    ));
    ?>
<?php else : ?>
    <p class="no-comments text-gray-500 bg-white rounded-lg shadow !p-6 text-responsive-sm"><?php echo esc_html(pll__('Comments are closed')); ?></p>
<?php endif; ?>


<?php if ( have_comments() ) : ?>
    <h2 class="comments-title text-responsive-md text-[#1C3361] !mb-6"><?php echo esc_html(pll__('Comments')); ?></h2>
    <ul class="comment-list space-y-8">
        <?php wp_list_comments(); ?>
    </ul>
    <?php if (get_comments_number() > 1) : ?>
        <button class="see-all-comments-btn text-[#1D1D1D] !px-5 !py-2 underline cursor-pointer !mt-4 text-responsive-sm"><?php echo esc_html(pll__('See all comments')); ?></button>
    <?php endif; ?>
    <?php the_comments_navigation(); ?> 
<?php endif; ?>

</div>