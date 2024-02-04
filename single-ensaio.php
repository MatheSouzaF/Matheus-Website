<?php
get_header();
the_post();
?>
<main>
    
<section class="banner-single-ensaio">
    <?php $nameTest = get_field('nome_ensaio'); ?>
    <?php $linkInsta = get_field('link_instagram'); ?>
    <div class="wrapper">
        <div class="img-podium-test d-flex flex-row">
            <?php
            if (have_rows('banner_imagens')) :
                while (have_rows('banner_imagens')) : the_row();
                    $image = get_sub_field('imagem');
            ?>
                    <div class="box-img">
                        <img class="img-podium" src="<?php echo $image ?>" alt="">
                    </div>
            <?php endwhile;
            endif;
            ?>
            <div class="social">
                <div class="group1">
                    <a href="<?php echo $linkInsta ?>" target="_blank" class="instagram" src="https://via.placeholder.com/20x20">
                        <i> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="25px" height="25px">
                                <g fill-opacity="0" fill="#000000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <path d="M0,256v-256h256v256z" id="bgRectangle"></path>
                                </g>
                                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path d="M16,3c-7.16752,0 -13,5.83248 -13,13v18c0,7.16752 5.83248,13 13,13h18c7.16752,0 13,-5.83248 13,-13v-18c0,-7.16752 -5.83248,-13 -13,-13zM16,5h18c6.08648,0 11,4.91352 11,11v18c0,6.08648 -4.91352,11 -11,11h-18c-6.08648,0 -11,-4.91352 -11,-11v-18c0,-6.08648 4.91352,-11 11,-11zM37,11c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c0,-1.10457 -0.89543,-2 -2,-2zM25,14c-6.06329,0 -11,4.93671 -11,11c0,6.06329 4.93671,11 11,11c6.06329,0 11,-4.93671 11,-11c0,-6.06329 -4.93671,-11 -11,-11zM25,16c4.98241,0 9,4.01759 9,9c0,4.98241 -4.01759,9 -9,9c-4.98241,0 -9,-4.01759 -9,-9c0,-4.98241 4.01759,-9 9,-9z"></path>
                                    </g>
                                </g>
                            </svg>
                        </i>
                    </a>
                </div>
                <div class="group2">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <p class="name-test color-primary"><?php echo $nameTest ?></p>
    </div>
</section>

<?php
$descricao = get_field('descricao')
?>
<section class="description-test">
    <div class="wrapper">
        <div class="description">
            <?php echo $descricao ?>
        </div>
    </div>
</section>


<section class="gallery">

    <div class="f-carousel" id="myCarousel">
        <?php
        if (have_rows('galeria_ensaio')) :
            while (have_rows('galeria_ensaio')) : the_row();
                $ensaioImage = get_sub_field('ensaio_imagem');
        ?>
                <div class="f-carousel__slide">
                    <a href="<?php echo $ensaioImage ?>" data-fancybox="gallery"><img alt="" data-lazy-src="<?php echo $ensaioImage ?>" /></a>
                </div>
               
        <?php endwhile;
        endif;
        ?>
          </div>
</section>
</main>

<?php


get_footer(); ?>