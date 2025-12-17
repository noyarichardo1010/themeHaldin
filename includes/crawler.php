<?php

function crawler_menu_options()
{
    global $main_url;
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
    add_menu_page('Crawler', 'Crawler', 'edit_theme_options', 'crawler', 'crawler_functions');
}

add_action('admin_menu', 'crawler_menu_options');

function crawler_functions()
{
    global $main_url;
//    insert_Brand_Image('http://206.189.90.77:8000/asset/image/brand/alfa-romeo.jpg');
//      crawlItem('http://206.189.90.77:8000/migration/6866', 2);
//    crawlItem('http://206.189.90.77:8000/entertainment/2',false, 'entertainment');
//    crawlItem('http://206.189.90.77:8000/slider/78','', 'slider');
//    crawlItem('http://206.189.90.77:8000/they-say/3','', 'they_say');
//    crawlItem('http://206.189.90.77:8000/clubgallery/1127', '', 'club');
//    crawlItem('http://206.189.90.77:8000/clubvideo/245', '', 'club');
//    crawlBrands('http://206.189.90.77:8000/club/1', 'club_category', false);
    ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"><br/></div>
        <h2><?php _e('Crawler', 'crawler'); ?></h2>
        <h2 class="nav-tab-wrapper">
            <a href="?page=crawler" class="nav-tab">Home</a>
            <a href="?page=crawler&tab=scrape" class="nav-tab">Scrape</a>
            <a href="?page=crawler&tab=scrape-brand" class="nav-tab">Scrape Brand</a>
            <a href="?page=crawler&tab=scrape-brand-detail" class="nav-tab">Scrape Brand Item</a>
        </h2>
        <?php if (!isset($_GET['tab'])): ?>
            <form action="" id="from-crawl" action="GET">
                <input type="text" class="text" name="main_url" id="main_url" value="">
                <?php
                $args = array(
                    'hide_empty' => 0,
                    "hierarchical" => true
                );
                wp_dropdown_categories($args); ?>
                <select name="post_type" id="post_type">
                    <option value="post">post</option>
                    <option value="slider">slider</option>
                    <option value="they_say">they say</option>
                    <option value="buyer_guide">buyers guide</option>
                    <option value="entertainment">Entertainment</option>
                    <option value="club">club</option>
                </select>
                <button class="button button-crawl">
                    Test
                </button>
            </form>
            <div class="content-container">
            </div>
        <?php endif ?>
        <?php if (isset($_GET['tab']) && $_GET['tab'] == 'scrape'): ?>
            <button class="button button-scrape">
                Test
            </button>
            <table>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        URL
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Scrape Status
                    </th>
                </tr>
                <?php
                global $wpdb;
                $results = $wpdb->get_results('SELECT * FROM scrape_master WHERE status = 0 ORDER BY id DESC LIMIT 1000 ', OBJECT);
                if ($results) {
                    foreach ($results as $item) {
                        ?>
                        <tr class="scrape-item" data-url="<?php echo $item->url ?>"
                            data-cat="<?php echo $item->cat; ?>" data-post-type="<?php echo $item->post_type ?>">
                            <td>
                                <?php echo $item->id ?>
                            </td>
                            <td>
                                <?php echo $item->url ?>
                            </td>
                            <td class="scrape-item-status">
                                <?php echo $item->status ?>
                            </td>
                            <td>
                                <?php echo $item->date ?>
                            </td>
                            <td class="scrape-status">

                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        <?php endif ?>
        <?php if (isset($_GET['tab']) && $_GET['tab'] == 'scrape-brand'): ?>
            <form action="" id="from-crawl-brand" action="GET">
                <input type="text" class="text" name="main_url" id="main_url" value="">
                <?php
                $args = array(
                    'hide_empty' => 0,
                    "hierarchical" => true,
                    'taxonomy' => 'club_category'
                );
                wp_dropdown_categories($args);
                ?>
                <select name="term_type" id="term_type">
                    <option value="brand">brand</option>
                    <option value="body_type">body-type</option>
                    <option value="model">model</option>
                    <option value="club_category">Club Category</option>
                </select>
                <button class="button button-crawl">
                    Test
                </button>
            </form>
            <div class="content-container">
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['tab']) && $_GET['tab'] == 'scrape-brand-detail'): ?>
            <button class="button button-scrape-brand">
                Test
            </button>
            <table>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        URL
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Scrape Status
                    </th>
                </tr>
                <?php
                global $wpdb;
                $results = $wpdb->get_results('SELECT * FROM scrape_terms WHERE status = 0 LIMIT 1000', OBJECT);
                if ($results) {
                    foreach ($results as $item) {
                        ?>
                        <tr class="scrape-item" data-url="<?php echo $item->url ?>"
                            data-parent="<?php echo $item->parent; ?>" data-term-type="<?php echo $item->type ?>">
                            <td>
                                <?php echo $item->id ?>
                            </td>
                            <td>
                                <?php echo $item->url ?>
                            </td>
                            <td class="scrape-item-status">
                                <?php echo $item->status ?>
                            </td>
                            <td>
                                <?php echo $item->date ?>
                            </td>
                            <td class="scrape-status">

                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        <?php endif; ?>

    </div>
    <?php
}

function addLoadScript()
{
    wp_enqueue_script('crawl-ajax', get_template_directory_uri() . '/js/crawl.js', array('jquery'));
}

add_action('admin_enqueue_scripts', 'addLoadScript');

function testAjax()
{
    global $main_url;
    if (isset($_POST['value'])) {
        $main_url = $_POST['value'];
        if (isset($_POST['post_type'])) {
            $post_type = $_POST['post_type'];
            $cat = $_POST['cat'];
            scrapeMaster($main_url, $cat, $post_type);
        } else {
            $cat = $_POST['cat'];
            scrapeMasterBrand($main_url, $_POST['term_type'], $cat);
        }
    } else {
        echo 'failed';
    }
    die();
}

add_action('wp_ajax_test_ajax', 'testAjax');

function insertDBterm($url, $term_type, $parent)
{
    global $wpdb;
    $table = 'scrape_terms';
    $data = array(
        'url' => $url,
        'type' => $term_type,
        'parent' => ($parent) ? $parent : null,
        'status' => 0,
        'date' => date('Y-m-d H:i:s')
    );
    $results = $wpdb->get_results('SELECT id FROM scrape_terms WHERE url = "' . $url . '"', OBJECT);
    if ($results) {
        echo 'sudah ada</br>';
    } else {
        $wpdb->insert($table, $data);
        echo $url . ' added to database</br>';
    }
}

function updateDBbrand($url, $term_type)
{
    global $wpdb;
    $table = 'scrape_terms';
    $data = array(
        'status' => 1,
    );
    $results = $wpdb->get_row('SELECT id FROM scrape_terms WHERE url = "' . $url . '"', OBJECT);
    if ($results) {
        $wpdb->update('scrape_terms', $data, array('id' => $results->id));
    }
}

function insertDB($url, $cat, $post_type)
{
    global $wpdb;
    $table = 'scrape_master';
    $data = array(
        'url' => $url,
        'cat' => $cat,
        'post_type' => $post_type,
        'status' => 0,
        'date' => date('Y-m-d H:i:s')
    );
    $results = $wpdb->get_results('SELECT id FROM scrape_master WHERE url = "' . $url . '"', OBJECT);
    if ($results) {
        echo 'sudah ada</br>';
    } else {
        $wpdb->insert($table, $data);
        echo $url . ' added to database</br>';
    }

}

function updateDB($url, $cat)
{
    global $wpdb;
    $table = 'scrape_master';
    $data = array(
        'status' => 1,
        'date' => date('Y-m-d H:i:s')
    );
    $results = $wpdb->get_row('SELECT id FROM scrape_master WHERE url = "' . $url . '"', OBJECT);
    if ($results) {
        $wpdb->update('scrape_master', $data, array('id' => $results->id));
    }
}

function scrapeMasterBrand($url, $term_type, $parent = false)
{
    // Get cURL resource
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    curl_close($curl);

    $item = json_decode($resp);
    foreach ($item as $key => $value) {
        insertDBterm($value, $term_type, $parent);
    }

}

function scrapeMaster($url, $cat = false, $post_type)
{
    // Get cURL resource
    $curl = curl_init();
// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    curl_close($curl);

    $item = json_decode($resp);
    foreach ($item as $key => $value) {
        insertDB($value, $cat, $post_type);
    }

}

function crawlBrands($url = false, $term_type = false, $parent = false)
{

    $url = $_POST['value'];
    $parent = $_POST['parent'];
    $term_type = $_POST['term_type'];
    delete_option("{$term_type}_children");
    if ($url) {
        $html = file_get_contents($url);
        $document = new DOMDocument();
        libxml_use_internal_errors(TRUE); //disable libxml errors
        if (!empty($html)) {
            $document->loadHTML('<meta http-equiv="content-type" content="text/html; charset=utf-8">' . $html);
            libxml_clear_errors(); //remove errors for yucky html
            $document_path = new DOMXPath($document);
            $document_row = $document_path->query('//body');
            if ($document_row->length > 0) {
                foreach ($document_row as $row) {
                    $title = $document_path->query('//h1[@id="title"]', $row)->item(0);
                    if ($title) {
                        $title = wp_strip_all_tags(trim($title->nodeValue));
                    }
                    $mainImage = $document_path->query('//div[@id="main-image"]/img/@src', $row)->item(0);

                    if ($mainImage) {
                        $mainImage = trim('http://206.189.90.77:8000' . $mainImage->nodeValue);
                    }

                    $link = $document_path->query('div[@id="link"]', $row)->item(0);
                    if ($link) {
                        $link = wp_strip_all_tags(trim($link->nodeValue));
                    }

                    $type = $document_path->query('div[@id="type"]', $row)->item(0);
                    if ($type) {
                        $type = wp_strip_all_tags(trim($type->nodeValue));
                    }

                    $parent_cat = $document_path->query('div[@id="parent"]', $row)->item(0);
                    if ($parent_cat) {
                        $parent_cat = wp_strip_all_tags(trim($parent_cat->nodeValue));
                    }

                    $aboutus = $document_path->query('div[@id="aboutus"]', $row)->item(0);
                    if ($aboutus) {
                        $aboutus = $document->saveHTML($document_path->query('$div[@id="aboutus"]', $row)->item(0));
                    } else {
                        $aboutus = '<p></p>';
                    }

                    $membership = $document_path->query('div[@id="membership"]', $row)->item(0);
                    if ($membership) {
                        $membership = $document->saveHTML($document_path->query('$div[@id="membership"]', $row)->item(0));
                    } else {
                        $membership = '<p></p>';
                    }

                    $contact = $document_path->query('div[@id="contact"]', $row)->item(0);
                    if ($contact) {
                        $contact = $document->saveHTML($document_path->query('$div[@id="contact"]', $row)->item(0));
                    } else {
                        $contact = '<p></p>';
                    }

                    $youtube = $document_path->query('div[@id="youtube"]', $row)->item(0);
                    if ($youtube) {
                        $youtube = wp_strip_all_tags(trim($youtube->nodeValue));
                    }

                    $twitter = $document_path->query('div[@id="twitter"]', $row)->item(0);
                    if ($twitter) {
                        $twitter = wp_strip_all_tags(trim($twitter->nodeValue));
                    }

                    $instagram = $document_path->query('div[@id="instagram"]', $row)->item(0);
                    if ($instagram) {
                        $instagram = wp_strip_all_tags(trim($instagram->nodeValue));
                    }

                    $facebook = $document_path->query('div[@id="facebook"]', $row)->item(0);
                    if ($facebook) {
                        $facebook = wp_strip_all_tags(trim($facebook->nodeValue));
                    }

                    $term = term_exists($title, $term_type);

                    $data = [
                        'title' => $title,
                        'type' => $type,
                        'link' => $link,
                        'image' => $mainImage,
                        'aboutus' => $aboutus,
                        'membership' => $membership,
                        'contact' => $contact,
                        'facebook' => $facebook,
                        'youtube' => $youtube,
                        'twitter' => $twitter,
                        'instagram' => $instagram,
                        'parent' => $parent_cat
                    ];

//                    echo '<pre>';
//                    print_r($data);
//                    echo '</pre>';
                    if ($term !== 0 && $term !== null) {
                        echo "Terms exists!";
                    } else {
                        $id = null;
                        if (!$parent_cat) {
                            if (!$parent) {
                                $id = wp_insert_term(
                                    $title,
                                    $term_type
                                );
                            } else {
                                $parent_id = ["parent" => $parent];
                                $id = wp_insert_term(
                                    $title,
                                    $term_type,
                                    $parent_id
                                );
                            }
                        } else {
                            $parent_id = get_term_by('name', $parent_cat, $term_type);
                            if ($parent_id) {
                                $parent_id = ["parent" => $parent_id->term_id];
                                $id = wp_insert_term(
                                    $title,
                                    $term_type,
                                    $parent_id
                                );
                            }
                        }

                        if ($id) {
                            if ($mainImage) {
                                $image_url = insert_Brand_Image($mainImage);
                                if ($term_type == 'body_type') {
                                    update_field('image', $image_url, $term_type . '_' . $id['term_id']);
                                } else {
                                    update_field('logo', $image_url, $term_type . '_' . $id['term_id']);
                                }
                            }
                            $cat = [];
                            if ($type) {
                                if ($type == 'car') {
                                    $cat = [56];
                                } else if ($type == 'motorcycle') {
                                    $cat = [57];
                                } else if ($type == 'truck') {
                                    $cat = [204];
                                }
                                update_field('type', $cat, $term_type . '_' . $id['term_id']);
                            }
                            if ($link) {
                                update_field('link', wp_strip_all_tags(trim($link)), $term_type . '_' . $id['term_id']);
                            }

                            $data = [
                                'aboutus' => $aboutus,
                                'membership' => $membership,
                                'contact' => $contact,
                                'facebook' => $facebook,
                                'youtube' => $youtube,
                                'twitter' => $twitter,
                                'instagram' => $instagram,
                            ];

                            foreach ($data as $key => $value) {
                                if ($value) {
                                    if($key == 'membership' || $key == 'contact' || $key == 'aboutus'){
                                        update_field($key, trim($value), $term_type . '_' . $id['term_id']);
                                    }else{
                                        update_field($key, wp_strip_all_tags(trim($value)), $term_type . '_' . $id['term_id']);
                                    }
                                }
                            }

                            updateDBbrand($url, $term_type);
                            echo 'true';
                        } else {
                            var_dump('salah disini');
                            echo 'false';
                        }

                    }
                }
            }
        }
    } else {
        echo 'false';
    }

    die();
}

add_action('wp_ajax_scrape_terms', 'crawlBrands');

function crawlItem($url = false, $cat = false, $post_type = false)
{

    $url = $_POST['value'];
    $cat = $_POST['cat'];
    $post_type = $_POST['post_type'];

    if ($url) {
        $html = file_get_contents($url);
        $document = new DOMDocument();
        libxml_use_internal_errors(TRUE); //disable libxml errors
        if (!empty($html)) { //if any html is actually returned
            $document->loadHTML('<meta http-equiv="content-type" content="text/html; charset=utf-8">' . $html);
            libxml_clear_errors(); //remove errors for yucky html
            $document_path = new DOMXPath($document);
            $document_row = $document_path->query('//body');
            if ($document_row->length > 0) {
                foreach ($document_row as $row) {
                    $title = $document_path->query('//h1[@id="title"]', $row)->item(0);
                    if ($title) {
                        $title = wp_strip_all_tags(trim($title->nodeValue));
                    }
                    $tanggal = $document_path->query('//div[@id="date"]', $row)->item(0)->nodeValue;
                    $mainImage = $document_path->query('//div[@id="main-image"]/img/@src', $row)->item(0);

                    if ($mainImage) {
                        $mainImage = 'http://206.189.90.77:8000' . $mainImage->nodeValue;
                    }
                    $content = $document_path->query('div[@id="content"]', $row)->item(0);
                    if ($content) {
                        $content = $document->saveHTML($document_path->query('div[@id="content"]', $row)->item(0));
                    } else {
                        $content = '<p></p>';
                    }

                    $author = $document_path->query('div[@id="author"]', $row)->item(0);
                    if ($author) {
                        $author = wp_strip_all_tags(trim($author->nodeValue));
                    }
                    $images = $document_path->query("//div[@id='content']//img/@src", $row);

                    $video = $document_path->query('div[@id="video"]', $row)->item(0);
                    if ($video) {
                        $video = wp_strip_all_tags(trim($video->nodeValue));
                    }

                    $link = $document_path->query('div[@id="link"]', $row)->item(0);
                    if ($link) {
                        $link = wp_strip_all_tags(trim($link->nodeValue));
                    }

                    $price = $document_path->query('div[@id="price"]', $row)->item(0);
                    if ($price) {
                        $price = wp_strip_all_tags(trim($price->nodeValue));
                    }

                    $sender = $document_path->query('div[@id="sender"]', $row)->item(0);
                    if ($sender) {
                        $sender = wp_strip_all_tags(trim($sender->nodeValue));
                    }

                    $type = $document_path->query('div[@id="type"]', $row)->item(0);
                    if ($type) {
                        $type = wp_strip_all_tags(trim($type->nodeValue));
                    }

                    $post_status = $document_path->query('div[@id="status"]', $row)->item(0);
                    if ($post_status) {
                        $post_status = wp_strip_all_tags(trim($post_status->nodeValue));
                    }

                    $model = $document_path->query('div[@id="model"]', $row)->item(0);
                    if ($model) {
                        $model = wp_strip_all_tags(trim($model->nodeValue));
                    }

                    $submodel = $document_path->query('div[@id="submodel"]', $row)->item(0);
                    if ($submodel) {
                        $submodel = wp_strip_all_tags(trim($submodel->nodeValue));
                    }

                    $brand = $document_path->query('div[@id="brands"]', $row)->item(0);
                    if ($brand) {
                        $brand = wp_strip_all_tags(trim($brand->nodeValue));
                    }

                    $year = $document_path->query('div[@id="year"]', $row)->item(0);
                    if ($year) {
                        $year = wp_strip_all_tags(trim($year->nodeValue));
                    }

                    $entertainment_category = $document_path->query('div[@id="entertainment"]', $row)->item(0);
                    if ($entertainment_category) {
                        $entertainment_category = wp_strip_all_tags(trim($entertainment_category->nodeValue));
                    }

                    $song = $document_path->query('div[@id="song"]', $row)->item(0);
                    if ($song) {
                        $song = wp_strip_all_tags(trim($song->nodeValue));
                    }

                    $artist = $document_path->query('div[@id="artist"]', $row)->item(0);
                    if ($artist) {
                        $artist = wp_strip_all_tags(trim($artist->nodeValue));
                    }

                    $parent = $document_path->query('div[@id="parent"]', $row)->item(0);
                    if ($parent) {
                        $parent = wp_strip_all_tags(trim($parent->nodeValue));
                    }

                    $gallery = $document_path->query('div[@id="gallery"]', $row)->item(0);
                    if ($gallery) {
                        $images = $document_path->query("//div[@id='gallery']//img/@src", $row);
                    }

                    $imagesArrayFullUri = [];
                    $imagesArray = [];
                    foreach ($images as $image) {
                        $imagesArrayFullUri[] = 'http://206.189.90.77:8000' . $image->nodeValue;
                        $imagesArray[] = $image->nodeValue;
                    }
                    $authorNames = [
                        "Djoened" => 3,
                        "Pandhu" => 2,
                        "Okie" => 4,
                        "Miko" => 5,
                        "Agus" => 6,
                        "Putro" => 7,
                        "Husein" => 8,
                        "Ajie" => 9,
                        "Ismet" => 10,
                        "Kusnadi" => 11,
                        "Henry" => 12,
                        "Motor Trend" => 13
                    ];
                    $my_post = array(
                        'post_title' => wp_strip_all_tags($title),
                        'post_content' => $content,
                        'post_status' => 'publish',
                        'post_date' => date('Y-m-d H:i:s', strtotime($tanggal)),
                        'post_category' => array($cat),
                        'post_type' => 'post'
                    );

                    if (isset($post_type) && !empty($post_type) && $post_type != 'post') {
                        $my_post['post_type'] = $post_type;
                        $my_post['post_category'] = array();
                        $my_post['post_status'] = ($post_status) ? $post_status : 'publish';
                    }
                    if ($author) {
                        foreach ($authorNames as $key => $value) {
                            if (strpos($author, $key) !== false) {
                                $my_post['post_author'] = $value;
                            }
                        }
                    } else {
                        $my_post['post_author'] = 1;
                    }
                    $data = [
                        'title' => $title,
                        'content' => $content,
                        'tanggal' => $tanggal,
                        'category' => $parent
                    ];
                    if($post_type == 'club'){
                        if($video){
                            $dataVideo = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$video.'&key=AIzaSyA0KTLOZ4ZPka45r1BLSYnvupr17xFXzN8';
                            $respond = json_decode(curl($dataVideo));
                            $title = $respond->items[0]->snippet->title;
                            $content = $respond->items[0]->snippet->description;
                            $mainImage = $respond->items[0]->snippet->thumbnails->maxres->url;
                            $my_post['post_title'] = $title;
                            $my_post['post_content'] = $content;

                        }
                    }
                    $postExist = post_exists(wp_strip_all_tags($title));
                    $gallIds = [];
                    if (!$postExist) {
                        $post_id = wp_insert_post($my_post, true);
                        if ($post_id) {
                            if ($mainImage) {
                                $imageUploaded = insert_Image($mainImage, $post_id, true);
                            }
                            $i = 1;
                            $setFeatured = false;
                            foreach ($imagesArray as $key => $value) {
                                if (!$mainImage) {
                                    if ($i == 1) {
                                        $setFeatured = true;
                                    } else {
                                        $i++;
                                        $setFeatured = false;
                                    }
                                }
                                if ($gallery) {
                                    $imageId = insert_Image('http://206.189.90.77:8000' . $value, $post_id, $setFeatured, true);
                                    $gallIds[] = $imageId;
                                } else {
                                    $newUrl = insert_Image('http://206.189.90.77:8000' . $value, $post_id, $setFeatured, false);
                                    if (strpos($content, $value) !== false) {
                                        $content = str_replace($value, $newUrl, $content);
                                    }
                                }
                            }

                            if (!empty($gallIds)) {
                                $content = '[gallery ids="' . implode(',', $gallIds) . '"]';
                            }

                            $newPostData = [
                                'ID' => $post_id,
                                'post_content' => $content,
                            ];
                            $update_post = wp_update_post($newPostData);

                            if ($video) {
                                add_post_meta($post_id, 'youtube', trim($video));
                            }
                            if ($link) {
                                add_post_meta($post_id, 'link', trim($link));
                            }
                            if ($sender) {
                                add_post_meta($post_id, 'sender', trim($sender));
                            }
                            if ($post_type == 'entertainment') {
                                if ($entertainment_category) {
                                    $term = get_term_by('name', $entertainment_category, 'entertainment_category');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'entertainment_category');
                                }

                                if ($song) {
                                    add_post_meta($post_id, 'song', trim($song));
                                }

                                if ($artist) {
                                    add_post_meta($post_id, 'artist', trim($artist));
                                }

                            }

                            if ($post_type == 'club') {
                                if ($parent) {
                                    $term = get_term_by('name', $parent, 'club_category');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'club_category');
                                    if ($gallery) {
                                        $article_cat = [592];
                                    } else if ($video) {
                                        $article_cat = [593];
                                    } else {
                                        $article_cat = [591];
                                    }
                                    wp_set_object_terms($post_id, $article_cat, 'club_post');
                                }

                            }

                            if ($post_type == 'buyer_guide') {
                                if ($price) {
                                    add_post_meta($post_id, 'price', trim($price));
                                }
                                if ($brand) {
                                    $term = get_term_by('name', $brand, 'brand');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'brand');
                                }
                                if ($model) {
                                    $term = get_term_by('name', $model, 'body_type');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'body_type');
                                }
                                if ($submodel) {
                                    $term = get_term_by('name', $submodel, 'model');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'model');
                                }
                                if ($year) {
                                    $term = get_term_by('name', $year, 'year_release');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'year_release');
                                }
                                if ($type) {
                                    $term = get_term_by('name', $type, 'vehicle_type');
                                    $term = [$term->term_id];
                                    wp_set_object_terms($post_id, $term, 'vehicle_type');
                                }
                            }
                            if ($post_type != 'buyer_guide') {
                                if ($type) {
                                    add_post_meta($post_id, 'type', trim($type));
                                }
                            }

                            updateDB($url, $cat);
                            echo 'true';

                        }
                    } else {
                        updateDB($url, $cat);
                        echo 'false';
                    }
                }
            }
        }
    } else {
        echo 'false';
    }

    die();
}

add_action('wp_ajax_scrape_item', 'crawlItem');

function insert_Brand_Image($image_url)
{
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = sanitize_file_name(basename($image_url));
    if (wp_mkdir_p($upload_dir['path'])) $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $file);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    $res1 = wp_update_attachment_metadata($attach_id, $attach_data);
    return $attach_id;
}

function insert_Image($image_url, $post_id, $featured = false, $getId = false)
{
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = sanitize_file_name(basename($image_url));
    if (wp_mkdir_p($upload_dir['path'])) $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    $res1 = wp_update_attachment_metadata($attach_id, $attach_data);
    if ($getId) {
        return $attach_id;
    } else {
        if ($featured) {
            $res2 = set_post_thumbnail($post_id, $attach_id);
            return wp_get_attachment_url($attach_id);
        } else {
            return wp_get_attachment_url($attach_id);
        }
    }

}

?>