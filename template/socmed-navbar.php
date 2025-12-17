<ul class="navbar-nav social-media">
	<li class="nav-item">
		<a class="nav-link nav-cart" href="<?php echo get_site_url();?>/cart">
			<i class="fa fa-shopping-cart"></i>
			<span class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link bg-green" href="<?php echo get_site_url();?>?s=">
			<i class="fa fa-search"></i>
		</a>
	</li>
	<li class="nav-item">
		<?php if (is_user_logged_in()): ?>
			<a class="nav-link bg-blue" href="<?php echo get_site_url();?>/dashboard">
				<i class="fa fa-user"></i>
			</a>
		<?php else: ?>
			<a class="nav-link bg-blue" href="<?php echo get_site_url();?>/login">
				<i class="fa fa-user"></i>
			</a>
		<?php endif; ?>
	</li>
</ul>
