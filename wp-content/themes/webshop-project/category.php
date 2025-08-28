<?php get_header(); ?>

<main>
    <h1>Category: <?php single_term_title(); ?></h1>

    <?php if (have_posts()) : ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>No posts found in this category.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
