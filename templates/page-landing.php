<?php
/**
* Template Name: My Landing Page
**/
?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( oceanwp_html_classes() ); ?>" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<!-- Begin Body -->
	<body <?php body_class(); ?> <?php oceanwp_schema_markup( 'html' ); ?>>

		<?php wp_body_open(); ?>

		<?php do_action( 'ocean_before_outer_wrap' ); ?>

		<div id="outer-wrap" class="site clr">

		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'oceanwp' ); ?></a>

			<?php do_action( 'ocean_before_wrap' ); ?>

			<div id="wrap" class="clr">

            <!-- Custom landing page content starts here -->
                <?php get_header();?>

                <!-- ======= Hero Section ======= -->
                <section id="hero" 
                    style="background: url(
                            <?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) ?>
                                            ) top center;">
                    <div class="hero-container">
                        <h1><?php the_field('landing_page_subtitle') ?></h1>
                        <div class="wrap-cap">
                            <h3 class="cap-1"><?php the_field('landing_page_caption_1') ?></h3>
                            <h3 class="cap-2"><?php the_field('landing_page_caption_2') ?></h3>
                            <h3 class="cap-3"><?php the_field('landing_page_caption_3') ?></h3>
                            <h3 class="cap-4"><?php the_field('landing_page_caption_4') ?></h3>
                        </div>
                        <a href="<?php echo get_permalink(19) ?>" class="btn-get-started"><?php the_field('landing_page_shop_page_button_text') ?></a>
                    </div>
                </section>
                <!-- End Hero Section -->

                <main id="main">

                    <!-- ======= Services Section ======= -->
                    <section id="services">
                        <div class="container wow fadeIn">
                            <div class="section-header">
                                <h3 class="section-title"><?php the_field('services_heading') ?></h3>
                                <p class="section-description"><?php the_field('services_description') ?></p>
                            </div>
                            <div class="services-grid-container">
                            <?php
                                $services = new WP_Query(
                                        array(
                                            'post_type' => 'service'
                                        )
                                    );
                                while($services->have_posts()){
                                    $services->the_post();
                                    ?>
                                    <div class="box">
                                        <img class="product img-responsive" src="<?php echo get_field('service_image') ?>" alt="">
                                        <div class="middle">
                                            <div class="text"><?php echo get_field('service_description') ?></div>
                                        </div>
                                        <a href="<?php echo (get_site_url() . get_field('service_page_link')) ?>"><h6 class="product-title"><?php the_title() ?></h6></a>
                                    </div>

                                    <?php

                                }
                            ?>                      
                            </div>
                        </div>
                    </section>
                    <!-- End Services Section -->

                    <div id="landing3" style="background-image: url(<?php echo get_theme_file_uri('assets/img/landing3.jpg') ?>)">
                    </div>

                    <!-- ======= Popular Products Section ======= -->
                    <section id="popular-products">
                        <div class="container">
                            <div class="section-header">
                                <h3 class="section-title">Art Showcase</h3>
                                <p class="section-description">Few art works from my Portfolio</p>
                            </div>
                            <div id="popular-products-wrapper">
                                <?php
                                    $products = wc_get_products(array() );
                                    foreach ($products as $product) {
                                        if(421 == $product->get_id()){
                                            continue;
                                        }
                                        ?>
                                        <div class="popular-products-item">
                                             <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                <?php echo $product->get_image() ?>
                                                <div class="details">
                                                    <h4><?php echo $product->get_name() ?></h4>
                                                    <span><?php echo $product->get_short_description() ?></span>                                    
                                                </div>
                                             </a>
                                        </div>
                                    <?php
                                        }
                                    ?>
                            </div>

                        </div>
                    </section>
                    <!-- End Popular Products Section -->

                    <!-- Advertisements Section -->

                    <div id="advertisement-landing" style="background-image: url(<?php echo get_theme_file_uri('assets/img/advertisement-landing.jpg') ?>)">
                        <section id="advertisements">
                            <div class="container">
                                <div class="section-header advertisements-header">
                                    <h3 class="section-title">Advertisements</h3>
                                    <p class="section-description">We can advertise your BRAND in every corner of <span style="color:yellow">Punjab</span>, <span style="color:yellow">Haryana</span> and <span style="color:yellow">Himachal Pradesh</span></p>
                                </div>
                                <div class="advertisements-wrapper">
                                    <div class="advertisement-desc-1">
                                        <p>Our <span style="color:yellow">Colors</span>, Your <span style="color:yellow">Brand</span> </p>
                                        <p>Let The World know that <span style="color:yellow">Your Brand</span> exists</p>
                                    </div>
                                    <div class="advertisement-desc-2">
                                        <p class="details">Our colors make the walls speak your BRAND and expand your customer base. We advertise brands by painting walls at public places. Huge experience of the artists and businessmen brings unique expertise which help brands to
                                            grab attention of potential customers.
                                        </p>
                                    </div>
                                </div>
                                <div class="advertisement-actions">
                                    <a href="<?php echo site_url() . '/order/advertisements' ?>"><button>Get Quote</button></a>
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- End Advertisements Section -->

                    <!-- ======= Our Clients Section ======= -->
                    <section id="clients">
                        <div class="container">
                            <div class="section-header">
                                <h3 class="section-title">Our Advertising Clients</h3>
                                <p class="section-description">We took these Businesses to remote corners of <span style="color:#2dc997">Punjab</span>, <span style="color:#2dc997">Haryana</span> and <span style="color:#2dc997">Himachal Pradesh</span></p>
                            </div>
                            <div id="clients-wrapper">
                                <?php 
                                    $clients = new WP_Query(
                                        array(
                                            'post_type'=> 'client'
                                        )
                                        );
                                    while($clients->have_posts()){
                                        $clients->the_post();
                                        ?>
                                            <img class="clientLogo" src="<?php echo get_field('client_logo') ?>">
                                        <?php
                                    }
                                    
                                ?>
                            </div>
                        </div>
                    </section>
                    <!-- End Our Clients Section -->

                    <div id="landing2" style="background-image: url(<?php echo get_theme_file_uri('assets/img/landing2.jpg') ?>)">
                    </div>

                    <!-- ======= Contact Section ======= -->
                    <section id="contact">
                        <div class="container wow fadeInUp">
                            <div class="section-header">
                                <h3 class="section-title">Contact Us</h3>
                                <p class="section-description">We are all ears..</p>
                            </div>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3429.752845104816!2d76.63815221497535!3d30.725347881639696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fe5602dcb8079%3A0x5b78b638d2df428f!2s1138%2C%20JTPL%20City%20Main%20Rd%2C%20Sector%20115%2C%20Khuni%20Majra%2C%20Punjab%20140307!5e0!3m2!1sen!2sin!4v1589612121587!5m2!1sen!2sin"
                            width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
                            
                        <div class="container">
                            <h1 id="advertisement-form-heading">Write to us and we will get back to you in 24 hours...</h1>
                            <div class="contact-details-section">
                                <div class="info">
                                    <!-- <div>
                                        <i class="fa fa-map-marker"></i>
                                        <p>A108 Adam Street, New York, NY 535022</p>
                                    </div>

                                    <div>
                                        <i class="fa fa-envelope"></i>
                                        <p>info@example.com</p>
                                    </div>

                                    <div>
                                        <i class="fa fa-phone"></i>
                                        <p>+1 5589 55488 55s</p>
                                    </div> -->
                                    <?php dynamic_sidebar( 'contact-us-landing-page' ); ?>
                                </div>

                                <div class='contact-form'>
                                    <?php echo do_shortcode('[wpforms id="246"]') ?> 
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Contact Section -->

                </main>
                <!-- End #main -->
        
            <!-- Custom landing page content ends here -->

				<?php do_action( 'ocean_before_main' ); ?>

				<main id="main" class="site-main clr"<?php oceanwp_schema_markup( 'main' ); ?> role="main">

					<?php do_action( 'ocean_before_content_wrap' ); ?>

					<div id="content-wrap" class="container clr">

						<?php do_action( 'ocean_before_primary' ); ?>

						<section id="primary" class="content-area clr">

							<?php do_action( 'ocean_before_content' ); ?>

							<div id="content" class="site-content clr">

								<?php do_action( 'ocean_before_content_inner' ); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<div class="entry-content entry clr">
										<?php the_content(); ?>
									</div><!-- .entry-content -->

								<?php endwhile; ?>

								<?php do_action( 'ocean_after_content_inner' ); ?>

							</div><!-- #content -->

							<?php do_action( 'ocean_after_content' ); ?>

						</section><!-- #primary -->

						<?php do_action( 'ocean_after_primary' ); ?>

					</div><!-- #content-wrap -->

					<?php do_action( 'ocean_after_content_wrap' ); ?>

		        </main><!-- #main-content -->

		        <?php do_action( 'ocean_after_main' ); ?>

		    </div><!-- #wrap -->

		    <?php do_action( 'ocean_after_wrap' ); ?>

		</div><!-- .outer-wrap -->

		<?php do_action( 'ocean_after_outer_wrap' ); ?>

        <?php wp_footer(); ?>
        
        <?php get_footer() ?>   

	</body>
</html>