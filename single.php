<!-- 
    ========== 個別投稿表示用php ========== 
    テーマのカスタマイズ　→　ホームページの設定　→　ホームページの表示　→　「最新ページ」
-->

<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()):the_post(); ?>
    <div id="contentArea">
        <h1><?php the_title(); ?></h1>
        <!--
        <p><?php //echo esc_html(get_the_date()); ?></p>
        -->
        <p><?php the_content(); ?></p>
    </div>
    <?php get_related_post();?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>

