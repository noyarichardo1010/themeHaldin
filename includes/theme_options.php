<?php
/*
NOTE: this file requires WordPress 2.7+ to function
*/
$settings = 'theme_mods_' . wp_get_theme(); // do not change!

$defaults = array( // define our defaults
	'linkedin_code' => '',
);

add_option($settings, $defaults, '', 'yes');

add_action('admin_init', 'register_theme_settings');
function register_theme_settings()
{
	global $settings;
	register_setting($settings, $settings);
}

//  this function adds the settings page to the Appearance tab
add_action('admin_menu', 'add_theme_options_menu');
function add_theme_options_menu()
{
	add_menu_page(__('Theme Options', 'zlip2x'), __('Theme Options', 'zlip2x'), 'edit_pages', 'theme-options', 'theme_settings_admin');;
}

function theme_settings_admin()
{ ?>
	<?php theme_options_css_js(); ?>

  <div class="wrap">
		<?php
		global $settings, $defaults;
		if (get_theme_mod('reset')) {
			echo '<div class="updated fade" id="message"><p>' . __('Theme Options', 'themejunkie') . ' <strong>' . __('Reset to defaults', 'themejunkie') . '</strong></p></div>';
			update_option($settings, $defaults);
		} elseif ($_REQUEST['updated'] == 'true') {
			echo '<div class="updated fade" id="message"><p>' . __('Theme Options', 'themejunkie') . ' <strong>' . __('Saved', 'themejunkie') . '</strong></p></div>';
		}
		screen_icon('options-general');
		?>
    <h2><?php echo wp_get_theme() . ' ';
			_e('Theme Options', 'themejunkie'); ?></h2>
    <form method="post" action="options.php">
			<?php settings_fields($settings); // important! ?>
			<?php // begin first column ?>
      <div class="metabox-holder">
        <div class="postbox">
          <h3>Add linkedin embed code</h3>
          <div class="inside">
            <p>
              <textarea cols="50" rows="5" name="<?php echo $settings; ?>[linkedin_code]"><?php echo get_theme_mod('linkedin_code'); ?></textarea>
            </p>
          </div>
        </div>
        <!--end: content-->

        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e('Save Settings', 'themejunkie') ?>"/>
        </p>
      </div>
			<?php // end first column ?>
			<?php // begin second column ?>
    </form>
  </div>
<?php }

// add CSS and JS if necessary
function theme_options_css_js()
{
	echo <<<CSS

<style type="text/css">
  input, textarea, select {
    margin: 5px 0 5px 0;
    padding: 1px;
  }
</style>

CSS;
	echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($){
$(".fade").fadeIn(1000).fadeTo(1000, 1).fadeOut(1000);
});
</script>

JS;
}

?>
