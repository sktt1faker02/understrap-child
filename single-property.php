<?php
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <?php
            // Do the left sidebar check and open div#primary.
            get_template_part('global-templates/left-sidebar-check');
            ?>

            <main class="site-main" id="main">

                <?php
                while (have_posts()) {
                    the_post();
                ?>

                    <?php
                    // Get the property terms using the correct function and format output
                    $property_terms = get_the_terms($post->ID, 'property-type');
                    if ($property_terms) {
                        $terms_list = '';
                        foreach ($property_terms as $term) {
                            $terms_list .= $term->name . ', ';
                        }
                        $terms_list = rtrim($terms_list, ', '); // Remove trailing comma
                    } else {
                        $terms_list = ''; // Handle cases where no terms are assigned
                    }
                    ?>

                    <div class="card mb-3">
                        <?php the_post_thumbnail(); ?>
                       
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center gap-2">

                                <h4>$<?php echo number_format(get_field('price'), 0); ?></h4>
                                <h5><?php echo number_format(get_field('square_footage'), 0); ?> sqft</h5>

                            </div>
                            <h5 class="fw-normal"><?php the_title(); ?></h5>
                            <hr>
                            <p class="card-text"><?php the_content(); ?></p>
                            
                            <span class="fs-6 badge bg-primary rounded-pill"><?php echo $terms_list; ?></span>

                        </div>
                    </div>

                <?php
                } // end while loop
                ?>

                <?php //understrap_post_nav(); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>

            </main>

            <?php
            // Do the right sidebar check and close div#primary.
            get_template_part('global-templates/right-sidebar-check');
            ?>

        </div>
    </div>
</div><?php get_footer(); ?>