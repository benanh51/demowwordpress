<?php
/**
 * The Header for our theme.
 * @package Shopping Solution
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open(); 
  } else { 
    do_action( 'wp_body_open' ); 
  } ?>
  <?php if(get_theme_mod('ecommerce_solution_preloader',false) != '' || get_theme_mod( 'ecommerce_solution_display_preloader',false) != ''){ ?>
    <div class="frame w-100 h-100">
      <div class="loader">
        <div class="dot-1"></div>
        <div class="dot-2"></div>
        <div class="dot-3"></div>
      </div>
    </div>
  <?php }?>
  <header role="banner">
    <a class="screen-reader-text skip-link" href="#skip_content"><?php esc_html_e( 'Skip to content', 'shopping-solution' ); ?></a>
    <div id="header">
      <div class="topbar text-center py-3">
        <div class="container">
          <?php if ( get_theme_mod('shopping_solution_dicount_text','') != "" ) {?>
            <p class="mb-0"><?php echo esc_html( get_theme_mod('shopping_solution_dicount_text','' )); ?></p>
          <?php }?>
        </div>
      </div>
      <div class="below-topbar py-2">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 align-self-center social-links">
              <?php if ( get_theme_mod('shopping_solution_facebook_link','') != "" || get_theme_mod('shopping_solution_twitter_link','') != "" || get_theme_mod('shopping_solution_linkedin_link','') != "" || get_theme_mod('shopping_solution_instagram_link','') != "") {?>
                <span class="me-3"><?php echo esc_html('Follow Us','shopping-solution'); ?></span>
                <?php if ( get_theme_mod('shopping_solution_facebook_link','') != "" ) {?>
                  <a href="<?php echo esc_url( get_theme_mod('shopping_solution_facebook_link','' )); ?>"><i class="fab fa-facebook-f me-2"></i></a>
                <?php }?>
                <?php if ( get_theme_mod('shopping_solution_twitter_link','') != "" ) {?>
                  <a href="<?php echo esc_url( get_theme_mod('shopping_solution_twitter_link','' )); ?>"><i class="fab fa-twitter me-2"></i></a>
                <?php }?>
                <?php if ( get_theme_mod('shopping_solution_linkedin_link','') != "" ) {?>
                  <a href="<?php echo esc_url( get_theme_mod('shopping_solution_linkedin_link','' )); ?>"><i class="fab fa-linkedin-in me-2"></i></a>
                <?php }?>
                <?php if ( get_theme_mod('shopping_solution_instagram_link','') != "" ) {?>
                  <a href="<?php echo esc_url( get_theme_mod('shopping_solution_instagram_link','' )); ?>"><i class="fab fa-instagram me-2"></i></a>
                <?php }?>
              <?php }?>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-4 align-self-center">
              <?php if ( get_theme_mod('shopping_solution_sale_text','') != "" ) {?>
                <p class="mb-0"><?php echo esc_html( get_theme_mod('shopping_solution_sale_text','' )); ?></p>
              <?php }?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
              <?php if ( get_theme_mod('ecommerce_solution_phone_number','') != "" ) {?>
                <p class="mb-0"><?php echo esc_html_e( 'Need Help? Contact Us: ', 'shopping-solution' ); ?><a class="call1" href="tel:<?php echo esc_attr( get_theme_mod('ecommerce_solution_phone_number','' )); ?>"><?php echo esc_html( get_theme_mod('ecommerce_solution_phone_number','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('ecommerce_solution_phone_number','') ); ?></span></a></p>
              <?php }?>
            </div>
            <div class="col-lg-2 col-md-3 login-box align-self-center">
              <?php if(get_theme_mod('ecommerce_solution_myaccount_enable_disable',true)  != '' || get_theme_mod('ecommerce_solution_display_myaccount',true) != ''){ ?>
              <?php if(class_exists('woocommerce')){ ?>
                <?php if ( is_user_logged_in() ) { ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','shopping-solution'); ?>"><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_myaccount_icon','fas fa-sign-in-alt')); ?> rounded-circle me-2"></i><?php esc_html_e('My Account','shopping-solution'); ?><span class="screen-reader-text"><?php esc_html_e( 'My Account','shopping-solution' );?></span></a>
                <?php } 
                else { ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','shopping-solution'); ?>"><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_login_user_icon','fas fa-user')); ?> rounded-circle me-2"></i><?php esc_html_e('Login / Register','shopping-solution'); ?><span class="screen-reader-text"><?php esc_html_e( 'Login / Register','shopping-solution' );?></span></a>
                <?php } ?>
              <?php }?>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
      <div class="mid-header py-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-12 align-self-center">
              <div class="logo pb-1 align-self-center">
                <div class="row">
                  <div class="<?php if( get_theme_mod( 'ecommerce_solution_site_logo_inline') != '') { ?>col-lg-5 col-md-5 col-5"<?php } else { ?>col-lg-12 col-md-12  <?php } ?>">
                    <?php if ( has_custom_logo() ) : ?>
                      <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="<?php if( get_theme_mod( 'ecommerce_solution_site_logo_inline') != '') { ?>col-lg-7 col-md-7 col-7 site-logo-inline"<?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
                    <?php $blog_info = get_bloginfo( 'name' ); ?>
                    <?php if ( ! empty( $blog_info ) ) : ?>
                      <?php if( get_theme_mod('ecommerce_solution_site_title_enable',true) != ''){ ?>
                        <?php if ( is_front_page() && is_home() ) : ?>
                          <h1 class="site-title px-0 pb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                          <p class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif; ?>
                      <?php }?>
                    <?php endif; ?>
                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                      <?php if( get_theme_mod('ecommerce_solution_site_tagline_enable',true) != ''){ ?>
                        <p class="site-description"><?php echo esc_html($description); ?></p>
                      <?php }?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <?php if(class_exists('woocommerce')){ ?>
              <div class="<?php if( get_theme_mod( 'ecommerce_solution_cart_enable_disable', true) != '') { ?> col-lg-7 col-md-9 align-self-center"<?php } else { ?>col-lg-9 col-md-9 <?php } ?>">
                <?php if(get_theme_mod('ecommerce_solution_search_enable_disable',true) != ''){ ?>
                  <div class="search-cat-box p-2">
                    <?php get_product_search_form()?>
                  </div>
                <?php }?>
              </div>
              <?php if( get_theme_mod( 'ecommerce_solution_cart_enable_disable', true) != '' ) {?>
                <div class="<?php if(get_theme_mod( 'ecommerce_solution_sticky_cart',false) != '') { ?> sticky-cart"<?php } else { ?>col-lg-2 col-md-3 close-cart align-self-center <?php } ?>">
                  <div class="cat-content text-center">
                    <span class="cart_no">
                      <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','shopping-solution' ); ?>"><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_shopping_cart_icon','fas fa-shopping-basket me-3')); ?>"><span class="cart-value"> <?php echo esc_html(wp_kses_data( WC()->cart->get_cart_contents_count() ));?></span></i><?php esc_html_e( 'Cart','shopping-solution' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Cart','shopping-solution' );?></span></a>
                    </span>
                  </div>
                </div>
              <?php }?>
            <?php }?>
          </div>
        </div>
      </div>
      <div class="menu-header py-2 <?php if( get_theme_mod( 'ecommerce_solution_sticky_header', false) != '' || get_theme_mod( 'ecommerce_solution_display_fixed_header', false) != '') { ?> sticky-header"<?php } else { ?>close-sticky <?php } ?>">
        <div class="container">
          <div class="row">
            <?php if( get_theme_mod('ecommerce_solution_display_search_category',true) != ''){ ?>
              <?php if(class_exists('woocommerce')){ ?>
                <div class="col-lg-3 col-md-4 col-9 border-cat align-self-center">
                  <button role="tab" class="product-btn"><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_category_icon','fas fa-bars')); ?> me-2"></i><?php echo esc_html_e('ALL CATEGORIES','shopping-solution'); ?><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_category_show_down_icon','fas fa-sort-down')); ?> ms-4"></i></button>
                  <div class="product-cat py-2 px-3">
                    <?php
                      $args = array(
                        'orderby'    => 'title',
                        'order'      => 'ASC',
                        'hide_empty' => 0,
                        'parent'  => 0
                      );
                      $product_categories = get_terms( 'product_cat', $args );
                      $count = count($product_categories);
                      if ( $count > 0 ){
                          foreach ( $product_categories as $product_category ) {
                            $product_cat_id   = $product_category->term_id;
                            $cat_link = get_category_link( $product_cat_id );
                            if ($product_category->category_parent == 0) { ?>
                          <li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $product_category ) ); ?>">
                          <?php
                        }
                        echo esc_html( $product_category->name ); ?></a><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_category_list_icon','fas fa-chevron-right')); ?>"></i></li>
                        <?php }
                      }
                    ?>
                  </div>
                </div>
              <?php }?>
            <?php }?>
            <div class="<?php if( get_theme_mod( 'ecommerce_solution_cart_enable_disable', true) != '') { ?> col-lg-9 col-md-8 col-3 align-self-center"<?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
              <?php 
              if(has_nav_menu('primary')){ ?>
                <div class="toggle-menu responsive-menu text-start">
                  <button role="tab" onclick="ecommerce_solution_menu_open()" class="mobiletoggle"><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_responsive_menu_open_icon','fas fa-bars')); ?> p-3"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','shopping-solution'); ?></span>
                  </button>
                </div>
              <?php }?>
              <div id="navbar-header text-center" class="menu-brand primary-nav">
                <nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'shopping-solution' ); ?>">
                  <?php
                    if(has_nav_menu('primary')){
                      wp_nav_menu( array( 
                        'theme_location' => 'primary',
                        'container_class' => 'main-menu-navigation clearfix' ,
                        'menu_class' => 'clearfix',
                        'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 ps-0 text-md-end">%3$s</ul>',
                        'fallback_cb' => 'wp_page_menu',
                      ) );
                    } 
                  ?>
                </nav>
                <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="ecommerce_solution_menu_close()"><i class="<?php echo esc_attr(get_theme_mod('ecommerce_solution_responsive_menu_close_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','shopping-solution'); ?></span></a>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
  </header>