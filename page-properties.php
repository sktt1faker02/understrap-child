<?php

/** Template Name: Properties Template */

get_header();

$terms = get_terms(array(
    'taxonomy' => 'property-type',
    'hide_empty' => true,  // Exclude terms with no posts
));

?>
<main>
    <div class="container p-4 d-flex flex-column gap-5">
        <!-- <h1 class="text-capitalize fs-2 mb-5 text-secondary">Properties for you</h1> -->
    

        <?php

        if ($terms) :
            foreach ($terms as $term) :
        ?>

               

                <div class="properties-list">
                <h2 class="fs-4 fw-semibold text-capitalize"><?php echo $term->name;
                                                                ?></h2>
                <hr class="mb-4" />
                <div class="row gy-4">
             
                    <?php
                    $args = array(
                        'post_type' => 'property',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'property-type',
                                'field' => 'term_id',
                                'terms' => $term->term_id,
                            )
                        ),
                        'meta_key' => 'price',
                        'orderby' => 'meta_value_num',
                        'order' => 'ASC',
                    );

                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) : $the_query->the_post(); ?>

                            <div class="property col">
                               
                            <a href="<?php the_permalink(); ?>">
                                <div class="card h-100">
                                   
                                    <span class="badge bg-secondary property-term-type rounded-pill position-absolute"><?php echo $term->name; ?></span>
                                    <?php the_post_thumbnail(); ?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center gap-2">

                                            <h5>$<?php echo number_format(get_field('price'), 0); ?></h5>
                                            <h6><?php echo number_format(get_field('square_footage'), 0); ?> sqft</h6>

                                        </div>
                                        <p class="card-text"><?php the_title(); ?></p>
                                        
                                    </div>
                               
                                </div>
                                </a>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>