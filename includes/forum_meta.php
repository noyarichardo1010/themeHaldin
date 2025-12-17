<?php

function forum_attachment_metabox()
{
	add_meta_box(
		'forum_attachment',
		'Forum Attachment',
		'forum_attachment_callback',
		'forum',
		'normal',
		'default'
	);
}

add_action('add_meta_boxes', 'forum_attachment_metabox');

function forum_attachment_callback()
{
	global $post;
	$id = $post->ID;
	$media = get_attached_media('', $id);
	echo '<div>';
	foreach ($media as $item):
		$images = wp_get_attachment_url($item->ID);
		?>
    <div style="width: 100%; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #ccc;">
      <div
        style="width: 150px; height: 150px; background-image: url(<?php echo $images; ?>); background-size: cover; background-position: center; float: left; margin-right: 1rem">
      </div>
      <div>
        <p>
					<?php echo $item->post_title; ?>
        </p>
        <div data-id="<?php echo $item->ID; ?>" class=" remove_forum_attachment button button-small"> Remove</div>
      </div>
      <div style="clear:both"></div>
    </div>
    <script>
      jQuery(function ($) {
        $('.remove_forum_attachment').each(function() {
          var id = $(this).attr('data-id')
          $(this).on('click', function () {
            var el = $(this)
            if(id) {
              $.ajax({
                method: 'POST',
                url: ajaxurl,
                data: {
                  action: `delete_forum_attachment`,
                  id
                },
                error: function(e) {
                  console.log('error', e)
                },
                success: function(e) {
                  console.log('success')
                  el.parent().parent().remove()
                }
              })
            }
          })
        })
      })
    </script>
	<?php

	endforeach;
	echo '</div>';
}

function addLoadScript()
{
	wp_localize_script('site', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('admin_enqueue_scripts', 'addLoadScript');

function delete_forum_attachment() {
  if(isset($_POST['id'])) wp_delete_post($_POST['id'], true);
  echo 'success';
  die();
}

add_action('wp_ajax_nopriv_delete_forum_attachment', 'delete_forum_attachment');
add_action('wp_ajax_delete_forum_attachment', 'delete_forum_attachment');
