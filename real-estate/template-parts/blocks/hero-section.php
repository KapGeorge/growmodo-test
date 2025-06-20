<?php
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$image = get_field('hero_image');

$image_url = '';
if (is_array($image) && isset($image['url'])) {
    $image_url = $image['url'];
} elseif (is_string($image)) {
    $image_url = $image;
}
?>
<section class="hero-section">
    <?php
    // Show hero background only on non-mobile devices
    $is_mobile = wp_is_mobile();
    if (!$is_mobile && $image_url): ?>
        <div class="hero-bg" style="background-image: url('<?php echo esc_url($image_url); ?>');">
        <?php else: ?>
            <div class="hero-bg">
            <?php endif; ?>
            <div class="container">
                <div class="hero-content">
                    <?php if (wp_is_mobile() && $image_url): ?>
                        <!-- Show image on mobile devices -->
                        <?php
                        if (is_array($image)) {
                            $medium_url = isset($image['sizes']['medium']) ? $image['sizes']['medium'] : $image['url'];
                            $alt = !empty($image['alt']) ? $image['alt'] : (!empty($image['title']) ? $image['title'] : '');
                        } else {
                            $medium_url = $image_url;
                            $alt = '';
                        }
                        ?>
                        <img src="<?php echo esc_url($medium_url); ?>" alt="<?php echo esc_attr($alt); ?>" class="hero-mobile-image" style="width:100%;height:auto;">
                    <?php endif; ?>
                    <?php if ($title): ?>
                        <h1><?php echo esc_html($title); ?></h1>
                    <?php endif; ?>
                    <?php if ($subtitle): ?>
                        <div class="subtitle"><?php echo wp_kses_post($subtitle); ?></div>
                    <?php endif; ?>

                    <?php if (have_rows('hero_buttons')): ?>
                        <div class="hero-buttons">
                            <?php while (have_rows('hero_buttons')): the_row();
                                $btn_text = get_sub_field('button_text');
                                $btn_url = get_sub_field('button_url');
                                $btn_class = get_sub_field('button_class');
                            ?>
                                <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn <?php echo esc_attr($btn_class); ?>">
                                    <?php echo esc_html($btn_text); ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('hero_text_blocks')): ?>
                        <div class="hero-text-blocks">
                            <?php while (have_rows('hero_text_blocks')): the_row();
                                $text_number = get_sub_field('text_number');
                                $text_content = get_sub_field('text_content');
                            ?>
                                <div class="hero-text-block">
                                    <span class="statistic-number"><?php echo wp_kses_post($text_number); ?></span>
                                    <span class="statistic-text"><?php echo wp_kses_post($text_content); ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>


            </div>

            </div>
            <?php if (have_rows('features_blocks')): ?>
                <div class="features-wrap">
                    <div class="features-blocks">
                        <?php while (have_rows('features_blocks')): the_row();
                            $icon = get_sub_field('icon');
                            $feature_text = get_sub_field('feature_text');
                            $feature_link = get_sub_field('feature_link');
                        ?>
                            <a href="<?php echo esc_url($feature_link); ?>" class="features-block">
                                <?php if ($icon && is_array($icon) && isset($icon['url'])): ?>
                                    <div class="features">
                                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_html($feature_text); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if ($feature_text): ?>
                                    <div class="features-text">
                                        <?php echo esc_html($feature_text); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($feature_link): ?>

                                <?php endif; ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
</section>