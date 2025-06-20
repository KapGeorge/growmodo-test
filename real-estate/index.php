<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <main>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <div><?php the_content(); ?></div>
            </article>
        <?php endwhile; else : ?>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </main>

    <?php get_footer(); ?>