<!-- 
    ========== 固定ページ表示用php ========== 
    テーマのカスタマイズ　→　ホームページの設定　→　ホームページの表示　→　「固定ページ」
-->

<?php get_header(); ?>
<!-- ========== ピックアップ投稿実装 ========== -->
<!--
<div class="row">
    <div id="pickup" class="col-xs-12"><?php //get_pickup_posts();?></div>
</div>
-->
<div class="row">
<!-- ========== サイドバー実装 ========== -->
<!--
    <div id="sidebar" class="col-md-2"><?php get_posts_categories();?></div>
-->
    <div class="col-md-12">
        <?php get_all_posts(); ?>
    </div>
</div>
<!-- ========== ページネーション実装 ========== -->
<!--
<div id="paginationArea">
    <?php show_pagination(); ?>
</div>
-->

</div>
<?php get_footer(); ?>


