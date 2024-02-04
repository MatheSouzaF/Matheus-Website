<?php
//Template Name: Homepage
get_header();
wp_enqueue_script('moment', get_template_directory_uri() . "/assets/dist/js/main.min.js", array("jquery"), '1', true);
?>

<main class="d-flex justify-center items-center flex-column">
    <!-- <div class="overlay">
        <div class="animation-home">
            <p class="animation-text">Vini</p>
            <p class="animation-text">Floriani</p>
        </div>
    </div> -->
    <section class="banner-home wrapper d-flex">
        <div class="banner-name">
            <h1 class="color-primary name-main">Vini Floriani</h1>
            <h2 class="color-primary description-name">Conectando pessoas, emoções e conceitos através da fotografia</h2>
            <a href="#" class="btn-read-more">
                <p class="label">Saiba Mais</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none">
                    <path d="M0 7.5H15.6765M15.6765 7.5L9.17647 1M15.6765 7.5L9.17647 14" stroke="#FFF" />
                </svg>
            </a>
        </div>
        <div class="banner-image">
            <div class='container'>
                <div class='reveal'>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-vinifloriani-03.jpg" alt="Vinicius Floriani">
                </div>
            </div>
        </div>
    </section>
    <section class="about-me">
        <div class="box-about-me wrapper d-flex flex-column">
            <div class="color-primary about-me-description">
                <h2 class="text-photograpy" data-aos="fade-left">
                    Como fotógrafo profissional, meu objetivo é capturar a essência e a beleza do mundo ao meu redor por meio das lentes da minha câmera. Com um olhar atento aos detalhes, sou capaz de criar imagens impressionantes que mostram as histórias e personalidades únicas de meus clientes.
                </h2>
            </div>
            <div class="text-image d-flex justify-flex-end items-flex-end">
                <div class="my-image my-image-left" data-aos="fade-right"data-aos-delay="300">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-vinifloriani-02.jpg" alt="Vinicius Floriani">
                </div>
                <h1 class="color-primary name-about-me" data-aos="fade-left" data-aos-delay="500">Vini Floriani</h1>

                <div class="my-image" data-aos="fade-left" data-aos-delay="500">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about-vinifloriani-01.jpg" alt="Vinicius Floriani">
                </div>
            </div>
        </div>
    </section>

    <section class="portfolio wrapper">
        <h1 class="main-title-portfolio color-primary">Portfolio</h1>
        <div class="portfolio-list ">
        <?php
$args = array(
    'post_type' => 'ensaio',
    'posts_per_page' => -1,
    'order' => 'DESC',
);

$ensaio_query = new WP_Query($args);

if ($ensaio_query->have_posts()) :
    echo '<div class="box-portfolio-list">';

    $delay = 200; // Initialize delay variable

    while ($ensaio_query->have_posts()) : $ensaio_query->the_post();

        $post_link = get_permalink();

        echo '<a href="' . esc_url($post_link) . '" class="portfolio-item" data-aos="fade-up" data-aos-duration="1000"  data-aos-offset="-50" data-aos-delay="' . $delay . '">';

        if (has_post_thumbnail()) {
            echo '<div class="thumbnail-ensaios">';
            the_post_thumbnail('full ');
            echo '</div>';
        }
        echo '<div class="portfolio-item-text">';

        echo '<h2 class="title-ensaios color-black">' . get_the_title() . '</h2>';
        echo '<p class="data-ensaios color-black"> ' . get_the_date() . '</p>';
        $terms = get_the_terms(get_the_ID(), 'tipo_ensaio');

        if ($terms && !is_wp_error($terms)) {
            $term_names = array();
            foreach ($terms as $term) {
                $term_names[] = $term->name;
            }
            echo '<p class="type-ensaios color-black">' . implode(', ', $term_names) . '</p>';
        }

        echo '</div>';
        echo '</a>';

        $delay += 100; // Increment delay for the next iteration

    endwhile;

    echo '</div>';
    wp_reset_postdata();

else :
    echo 'Nenhum ensaio encontrado.';

endif; ?>

        </div>

    </section>

</main>
<?php get_footer(); ?>