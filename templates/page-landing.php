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
                            <h3 class="cap-1">I can help you Artify Yourself</h3>
                            <h3 class="cap-2">I can create High Quality Art Works for your Home or Office</h3>
                            <h3 class="cap-3">I can create Art Works which belong only to You</h3>
                            <h3 class="cap-4">I can help you Promote Your Brand</h3>
                        </div>
                        <a href="<?php echo site_url() . '/shop' ?>" class="btn-get-started">Let Me Show you our Art Gallery</a>
                    </div>
                </section>
                <!-- End Hero Section -->

                <main id="main">

                    <!-- ======= Services Section ======= -->
                    <section id="services">
                        <div class="container wow fadeIn">
                            <div class="section-header">
                                <h3 class="section-title">Services</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                            <div class="services-grid-container">
                                <div class="box">
                                    <img class="product img-responsive" src="<?php echo get_theme_file_uri('assets/img/service1.jpg') ?>" alt="">
                                    <div class="middle">
                                        <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores velit eaque hic est eligendi, veritatis quae illo cumque dolorum! Est saepe nam esse perspiciatis quo illum pariatur a voluptas ab odit excepturi.</div>
                                    </div>
                                    <h6 class="product-title">High Quality Artwork Prints</h6>
                                </div>
                                <div class="box">
                                    <img class="product img-responsive" src="<?php echo get_theme_file_uri('assets/img/service2.jpg') ?>" alt="">
                                    <div class="middle">
                                        <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores velit eaque hic est eligendi, veritatis quae illo cumque dolorum! Est saepe nam esse perspiciatis quo illum pariatur a voluptas ab odit excepturi.</div>
                                    </div>
                                    <h6 class="product-title">Artwork on Demand</h6>
                                </div>
                                <div class="box">
                                    <img class="product img-responsive" src="<?php echo get_theme_file_uri('assets/img/service3.jpg') ?>" alt="">
                                    <div class="middle">
                                        <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores velit eaque hic est eligendi, veritatis quae illo cumque dolorum! Est saepe nam esse perspiciatis quo illum pariatur a voluptas ab odit excepturi.</div>
                                    </div>
                                    <h6 class="product-title">Advertisements</h6>
                                </div>                                
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
                                <h3 class="section-title">Popular Arts</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                            <div id="popular-products-wrapper">
                                <?php
                                    $products = wc_get_products(array() );
                                    foreach ($products as $product) {
                                        ?>
                                        <div class="popular-products-item">
                                             <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                <?php echo $product->get_image() ?>
                                                <div class="details">
                                                    <h4><?php echo $product->get_name() ?></h4>
                                                    <span>Alosdred dono par</span>                                    
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
                                    <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                                </div>
                                <div class="advertisements-wrapper">
                                    <div class="advertisement-desc-1">
                                        <p>Our COLORS, Your BRAND </p>
                                        <p>Let's Conquer The World TOGETHER</p>
                                    </div>
                                    <div class="advertisement-desc-2">
                                        <p class="details"><b>"</b> Our colors make the walls speak your BRAND and expand your customer base. We advertise brands by painting walls at public places. Huge experience of the artists and businessmen brings unique expertise which help brands to
                                            grab attention of potential customers. <b>"</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="advertisement-actions">
                                    <button>Get Quote</button>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- End Advertisements Section -->

                    <!-- ======= Our Clients Section ======= -->
                    <section id="clients">
                        <div class="container">
                            <div class="section-header">
                                <h3 class="section-title">Our Clients</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                            <div id="clients-wrapper">
                                <?php 
                                    for($counter=1; $counter<7; $counter++ ){
                                        ?>
                                            <img class="clientLogo" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/client' . $counter . '.png' ?>">
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
                                <h3 class="section-title">Contact</h3>
                                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
                            </div>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3429.752845104816!2d76.63815221497535!3d30.725347881639696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fe5602dcb8079%3A0x5b78b638d2df428f!2s1138%2C%20JTPL%20City%20Main%20Rd%2C%20Sector%20115%2C%20Khuni%20Majra%2C%20Punjab%20140307!5e0!3m2!1sen!2sin!4v1589612121587!5m2!1sen!2sin"
                            width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
                            
                        <div class="container">
                            <div class="contact-details-section">
                                <div class="info">
                                    <div>
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
                                    </div>
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