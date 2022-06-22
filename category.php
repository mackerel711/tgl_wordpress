<?php get_header(); ?>

<!-- ========== PCカテゴリ取得 ========== -->
<div class="row" id="categories">
    <nav>
        <ul>
            <li class="parent_cat"><a href="https://yunofficial.info/helloworld/">about</a></li>
            <?php get_all_categories(); ?>
            <li class="parent_cat"><a href="https://portfolio.yunofficial.info/">portfolio</a></li>
        </ul>
    </nav>
</div>

<div class="row">
    <p class="currentCat"><?php single_cat_title();?></p>
</div>

<div class="row">
    <div class="col-12 col-md-12">
        <?php get_cat_posts(); ?>
    </div>
</div>

<!-- ========== ページネーション実装 ========== -->
<!--
<div id="paginationArea">
    <?php show_pagination(); ?>
</div>
-->

</div> <!-- End of container -->
<?php get_footer(); ?>


