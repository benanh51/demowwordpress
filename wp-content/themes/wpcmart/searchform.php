<form class='relative' method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class='search-field w-full field text-gray-500' type="search" name="s" id="s" placeholder="<?php esc_attr_e( 'Search products', 'wpcmart' ); ?>"/>
	<i class='icon-search text-gray-500 absolute top-3 right-3'></i>
	<input type="hidden" name="post_type" value="product"/>
	<button class='search-submit screen-reader-text top-0 left-0' type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wpcmart' ); ?>">
</form>
