<?php
    // =================  ヘッダー用関数  =================
    function get_header_logo(){
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( has_custom_logo() ) {
            echo '<img id="headerLogo" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
        } else {
            echo '<h1>' . get_bloginfo( 'name' ) .'</h1>';
        }
    }
    
    // =================  カテゴリ取得関数  =================
    function get_all_categories(){
        $categories = get_categories();
        if(!empty($categories)){
            $category_tag = '';
            foreach($categories as $category){
                $parent_cat = $category -> parent;
                if($parent_cat != 0) continue;
                $category_name = $category -> cat_name;
                //カテゴリに子カテゴリが存在する場合
                $child_cat_id_array = get_term_children($category->cat_ID,'category');
                if($category_name == 'about') continue;
                if(!empty($child_cat_id_array)){
                    $category_tag .= '<li class="parent_cat"><a href="' . esc_url(get_category_link($category->cat_ID)).'">' . $category_name . '  <i class="fas fa-chevron-down" style="vertical-align:-10%;"></i></a>';
                    foreach($child_cat_id_array as $each_cat_id){
                        $category_tag .= '<ul><li class="child_cat" style="display:none;"><a href="'. esc_url(get_category_link($each_cat_id)) .'">'. get_the_category_by_ID($each_cat_id) .'</a></ul>' ;
                    }
                    $category_tag .= '</li>';
                }else{
                    $category_tag .= '<li><a href="' . esc_url(get_category_link($category->cat_ID)).'">'. $category_name . '</a></li>';
                }
            }
            echo $category_tag;
        }else{
            echo '<p>カテゴリが設定されていません</p>';
        }
    }

    function get_current_cat_name(){
        $current_cat = get_the_category();
        echo '<pre style="color:white;">';
        //var_dump($current_cat);
        echo '</pre>';
        $current_cat_name = $current_cat[0] -> cat_name;
        foreach($current_cat as $each_cat){
            $current_cat_name = $each_cat -> cat_name;
            $current_cat_id = $each_cat -> cat_ID;
            echo '<p class="singlePostCat">' . '<a href="'. esc_url(get_category_link($current_cat_id)) .'">' . $current_cat_name . '</a>' . '</p>';
        }
    }

    // =================  コンテンツ用  =================
    // ==========  全コンテンツ取得  ==========
    function get_all_posts(){
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $posts_Object = new WP_Query(array(
            'paged' => $paged,
            'category__not_in' => get_cat_ID('pickup'),
            'post_per_page' => 5,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        $posts_array = $posts_Object -> posts;
        if(!empty($posts_array)){
            $post_tag = '';
            $output = '';
            echo '<div class = "row">';
            foreach($posts_array as $post){
                $post_id = $post -> ID;
                //var_dump($post);
                if(has_post_thumbnail($post_id)){
                    $post_tag .= '<div class="col-6 col-md-4"><a href="' . get_permalink($post -> ID) . '"><img src="'. wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'large')[0]. '">' .'<h2>' . $post -> post_title . '</h2></a></div>';
                }else{
                    $post_tag .= '<div class="col-6 col-md-4"><a href="' . get_permalink($post -> ID) . '"><img src="'. get_theme_file_uri("screenshot.png") . '">' .'<h2>' . $post -> post_title . '</h2></a></div>';
                }
            }
            echo $post_tag . '</div>';
        }else{
            echo '<h2>投稿が見つかりませんでした</h2>';
        }
        
    }
    // ==========  カテゴリごとのコンテンツ取得  ==========
    function get_cat_posts(){
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $current_page_category_name = single_cat_title('',false);
        $current_page_category_id = 0;
        $current_page_categories_parents = get_the_category();
        $raw_slug =  rtrim($_SERVER['REQUEST_URI'],'/');
        $current_page_cat_slug = substr($raw_slug, strrpos($raw_slug, '/') + 1);
        foreach($current_page_categories_parents as $each_cat){
            $each_cat_name = $each_cat -> slug;
            $each_cat_ID = $each_cat -> cat_ID;
            if($each_cat_name == $current_page_cat_slug){
                $current_page_category_id = $each_cat_ID;
            }
        }
        $posts_Object = new WP_Query(array(
            'paged' => $paged,
            'cat' => $current_page_category_id,
            'post_per_page' => 5,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        $posts_array = $posts_Object -> posts;
        if(!empty($posts_array)){
            $post_tag = '';
            $output = '';
            echo '<div class = "row">';
            foreach($posts_array as $post){
                $post_id = $post -> ID;
                //var_dump($post);
                if(has_post_thumbnail($post_id)){
                    $post_tag .= '<div class="col-6 col-md-4"><a href="' . get_permalink($post -> ID) . '"><img src="'. wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'large')[0]. '">' .'<h2>' . $post -> post_title . '</h2></a></div>';
                }else{
                    $post_tag .= '<div class="col-6 col-md-4"><a href="' . get_permalink($post -> ID) . '"><img src="'. get_theme_file_uri("screenshot.png") . '">' .'<h2>' . $post -> post_title . '</h2></a></div>';
                }
            }
            echo $post_tag . '</div>';
        }else{
            echo '<h2>投稿が見つかりませんでした</h2>';
        }
    }
    // ==========  フッター部分関連記事表示  ==========
    function get_related_post(){
        $category = get_the_category();
        $category_name = $category[0] -> name;
        $category_ID = $category[0] -> cat_ID;
        $get_posts_args = array(
            'posts_per_page' => 4,
            'category'         => $category_ID,
            'orderby'          => 'date',
        );
        $related_category_posts_array = get_posts($get_posts_args);
        echo '<h5 class="relatedPostTitle">' . '<a href="' . esc_url(get_category_link($category_ID)).'">' . $category_name . '</a>' . '</h5>';
        echo '<div class="row relatedPostsArea">';
        foreach($related_category_posts_array as $each_post){
            $post_id = $each_post -> ID;
            if(has_post_thumbnail($post_id)){
                $post_tag .= '<div class="col-3 relatedPostDiv"><a href="' . get_permalink($post_id) . '"><img src="'. wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'large')[0]. '">' .'<p>' . $each_post -> post_title . '</p></a></div>';
            }else{
                $post_tag .= '<div class="col-3 relatedPostDiv"><a href="' . get_permalink($post_id) . '"><img src="'. get_theme_file_uri("screenshot.png") . '">' .'<p>' . $each_post -> post_title . '</p></a></div>';
            }
        }
        echo $post_tag . '</div>';
    }

    // ==========  ピックアップ投稿取得  ==========
    // この関数を使うには、投稿カテゴリに「pickup」を追加する必要があります。
    function get_pickup_posts(){
        $output = '';
        $get_pickup_posts_arg = array(
            'category_name' => 'pickup'
        );
        $pickup_posts_array = get_posts($get_pickup_posts_arg);
        if(!term_exists("pickup",$parent = null ) or count($pickup_posts_array) == 0){
            //echo '<p>「pickup」カテゴリを設定してください</p>';
        }
        if(term_exists("pickup",$parent = null) or count($pickup_posts_array) > 0){
            //echo '<i class="fas fa-chevron-left fa-2x faicon"></i><i class="fas fa-chevron-right fa-2x faicon"></i>';
            for($i = 0; $i < count($pickup_posts_array); $i++){
                $post_id = $pickup_posts_array[$i] -> ID;
                $post_content_summary = mb_substr(wp_strip_all_tags(get_post_field('post_content', $pickup_posts_array[0] -> ID)),0,60,'utf8');
                if(has_post_thumbnail($post_id)){
                    $output .= '<div class="pickupPost col-12"><a href="' . get_permalink($post_id) . '"><img class="pickupImage" src="'. wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'large')[0]. '">' .'<h2>' . $pickup_posts_array[$i] -> post_title . '</h2></a></div>';
                }else{
                    $output .= '<div class="pickupPost col-12"><a href="' . get_permalink($post_id) . '"><img class="pickupImage" src="'. get_theme_file_uri("screenshot.png") . '">' .'<h2>' . $pickup_posts_array[$i] -> post_title . '</h2></a></div>';
                }
            }
        }
        echo $output;
    }

    // ==========  ページネーション  ==========
    function show_pagination(){
        $pagination_args = array(
            'end_size' => 0,
            'mid_size' => 0,
            'prev_next' => true,
            'prev_text' => '<i class="fas fa-chevron-left"></i>',
		    'next_text' => '<i class="fas fa-chevron-right"></i>',
            'screen_reader_text' => ' '
        );
        the_posts_pagination($pagination_args);
    }
    
    // ==========  サイドバー表示用タグ取得  ==========
    function get_posts_categories(){
        $categories_array = get_categories();
        $output = '<nav>';
        foreach($categories_array as $category){
            $output .= '<li>'.$category -> name . '</li>';
        }
        echo $output . '</nav>';
    }

    function tgl_get_title($post_obj){
        echo '<h1>'.$post_obj ->post_title.'</h1>';
    }


    // =================  デバッグ用  =================
    function console($data){
        echo "<script>console.log(".json_encode($data).")</script>";
    }

    // =================  ワードプレス関数  =================
    add_theme_support('custom-logo',array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support( 'post-thumbnails' );
    
    add_filter('wp_footer',function(){
        wp_enqueue_script( 'pickup_slide', esc_url(home_url('/')).'/wp-content/themes/TGLTheme/assets/js/category_fade.js', array(), NULL, true);
        //wp_deregister_script('jquery');
    });
    
    remove_action('wp_head','wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'feed_links_extra', 3);
