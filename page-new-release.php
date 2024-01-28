<?php
/** Template Name: New Release */ 

?>

<?php get_header(); ?>

<?php

$args = array(
    'post_type'=> 'movie'
);

$the_query = new WP_Query($args); ?>

<div class="new-release-page">
<?php if ($the_query->have_posts() ) : ?>

    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_post_thumbnail(); ?>
    <h4>Release Date -<?php the_field('release_date'); ?> </h4>
    <h4>Director -<?php the_field('director'); ?> </h4>
    <h4>Budget - $<?php the_field('budget'); ?> million</h4>
    <?php the_excerpt(); ?>


 <!-- Display terms -->
 <p>Genres:
        <?php
                $terms = get_the_terms(get_the_ID(), 'genre');
                foreach ($terms as $term) {
                    echo '<a href="' . get_term_link($term) . '">' . $term->name . '</a> ';
                }
                ?>
            </p>

    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>