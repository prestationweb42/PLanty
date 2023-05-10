<?php

add_filter('wp_nav_menu_items', 'add_admin_link', 10, 2);
function add_admin_link($items, $args)
{
    if (is_user_logged_in() && $args->theme_location === 'primary') {
        $new_item       = array('<li class="menu-item menu-item-32"><a href="' . get_admin_url() . '">Admin</a></li>');
        $items          = preg_replace('/<\/li>\s<li/', '</li>,<li',  $items);

        $array_items    = explode(
            ',',
            $items
        );
        array_splice($array_items, 1, 0, $new_item);
        $items          = implode(
            '',
            $array_items
        );
    }
    return $items;
}


add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_directory_uri() . '/css/theme.css',
        array(),
        filemtime(get_stylesheet_directory() . '/css/theme.css')
    );
    // Chargement du css pour notre shortcode formulaire nous rencontrer
    wp_enqueue_style('formulaire-nousrencontrer-shortcode', get_stylesheet_directory_uri() .
        '/css/shortcodes/formulaire-nousrencontrer.css', array(), filemtime(get_stylesheet_directory() .
        '/css/shortcodes/formulaire-nousrencontrer.css'));
    // Chargement du css pour notre shortcode formulaire commander
    wp_enqueue_style(
        'btns-commander-shortcode',
        get_stylesheet_directory_uri() . '/css/shortcodes/btns-commander.css',
        array(),
        filemtime(get_stylesheet_directory() . '/css/shortcodes/btns-commander.css')
    );
    // Chargement du css pour notre shortcode formulaire information
    wp_enqueue_style('formulaire-commander-shortcode', get_stylesheet_directory_uri() .
        '/css/shortcodes/formulaire-commander.css', array(), filemtime(get_stylesheet_directory() .
        '/css/shortcodes/formulaire-commander.css'));
    // Chargement du css pour notre shortcode footer-canettes
    wp_enqueue_style(
        'footer-canettes-shortcode',
        get_stylesheet_directory_uri() . '/css/shortcodes/footer-canettes.css',
        array(),
        filemtime(get_stylesheet_directory() . '/css/shortcodes/footer-canettes.css')
    );
}


/* SHORTCODE */
// Ajout du shortcode 'btns-commander'
add_shortcode('btns-commander', 'btns_commander_func');
// Je génère le html retourné par mon shortcode
function btns_commander_func()
{

    //Je commence à récupéré le flux d'information
    ob_start();

?>
    <form action="#" method="post" class="btns_container">
        <div class="btns_increment_container">
            <input type="number" id="input_num" min="0" max="10" step="1" value="0" />
            <div class="btns_increment">
                <button id="btn_plus">+</button>
                <button id="btn_moins">-</button>
            </div>
        </div>
        <input id="submit_btn" type="submit" value="Ok">
    </form>
    <?php
    //J'arrête de récupérer le flux d'information et le stock dans la fonction $output
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

// Ajout du shortcode 'footer-canettes'
add_shortcode('footer-canettes', 'footer_canettes_func');
// Je génère le html retourné par mon shortcode
function footer_canettes_func($atts)
{
    //Je récupère les attributs mis sur le shortcode
    $atts = shortcode_atts(array(
        'src' => '',
    ), $atts, 'footer-canettes');

    //Je commence à récupéré le flux d'information
    ob_start();

    if ($atts['src'] != "") {
    ?>
        <div class="div_container">
            <img src=" <?= $atts['src'] ?>" class="canette c01" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c02" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c03" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c04" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c05" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c06" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c07" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c08" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c09" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c10" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c11" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c12" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c13" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c14" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c15" alt="canette">
            <img src=" <?= $atts['src'] ?>" class="canette c16" alt="canette">
        </div>
<?php
    }
    //J'arrête de récupérer le flux d'information et le stock dans la fonction $output
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
