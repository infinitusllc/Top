<main class="page-content" style="margin-top: 30px">
    <section>
        <!-- Swiper -->
        <div class="swiper-container swiper-slider" data-height="853px" data-min-height="500px" data-autoplay="false">
            <div class="swiper-wrapper">
                <?php
                require_once "includes/slides.inc.php";
                $slides = getSlides($lang);
                $i = 1;
                foreach ($slides as $slide) {
                    $img = $slide['image_url']; ?>
                    <div class="swiper-slide" data-slide-bg="<?php echo $img; ?>" style="background-image: url('<?php echo $img; ?>');">
                        <div class="swiper-slide-caption">
                            <div class="container">
                                <div class="text-center text-lg-left">
                                    <div class="col-lg-3 col-md-12">
                                        <!-- <h2 class="text-bold"> <?php echo $i++; ?> </h2> -->
                                        <a href="<?php echo $slide['tour_url']; ?>"> <?php echo $slide['intro']; ?> </a>
                                    </div>
                                    <?php echo $slide['description']; ?>
                                    <!-- <div class="col-lg-4 col-md-12 offset-1 display_none">
                                        <h3 class="text-bold">ღირებულება 899 USD-დან</h3>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!-- Slider Navigation -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <!-- END Swiper -->
        <div id="sc_down">
            <a href="#ex1"><div class="mouse"></div></a>
            <a href="#ex1" class="mouse-hover"><div class="mouse"></div></a>
        </div>
    </section>