<?php
// Enqueue styles and scripts
function my_custom_theme_enqueue_scripts() {
  
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap', false);
    wp_enqueue_script('real-estate-script', get_template_directory_uri() . '/assets/js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_theme_enqueue_scripts');

// Theme support features
function my_custom_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'real-estate'),
    ));
}
add_action('after_setup_theme', 'my_custom_theme_setup');

//** *Enable upload for webp image files.*/
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');
//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

 

add_filter('upload_mimes', 'svg_upload_allow');

// Add SVG format to allowed upload types
function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml'; // Allow SVG uploads
    return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

// Fix MIME types for SVG uploads
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{
    // For WP 5.1+ check real MIME type, otherwise check file extension
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }

    if ($dosvg) {
        // Allow only admins to upload SVG
        if (current_user_can('manage_options')) {

            $data['ext'] = 'svg';
            $data['type'] = 'image/svg+xml';
        } else {
            $data['ext'] = false;
            $data['type'] = false;
        }

    }

    return $data;
}

add_filter('wp_prepare_attachment_for_js', 'show_svg_in_media_library');

// Show SVG preview in the media library
function show_svg_in_media_library($response)
{

    if ($response['mime'] === 'image/svg+xml') {

       
        $response['image'] = [
            'src' => $response['url'],
        ];
    }

    return $response;
}

//Registrated block for ACF
if( function_exists('acf_register_block_type') ) {
    function register_acf_hero_section_block() {
        acf_register_block_type(array(
            'name'              => 'hero-section',
            'title'             => __('Hero Section', 'real-estate'),
            'description'       => __('Hero section block.'),
            'render_template'   => 'template-parts/blocks/hero-section.php',
            'category'          => 'layout',
            'icon'              => 'cover-image',
            'keywords'          => array( 'hero', 'banner', 'section' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
            ),
        ));
    }
    add_action('acf/init', 'register_acf_hero_section_block');
}

