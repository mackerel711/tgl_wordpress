<?php get_header(); ?>

<div id="contentArea">
    <h1>Sorry, the page not found</h1>
</div>
<!-- ========== カテゴリ取得 ========== -->
<div class="row" id="categories">
    <nav>
        <ul>
            <li class="parent_cat"><a href="https://yunofficial.info/helloworld/">about</a></li>
            <?php get_all_categories(); ?>
        </ul>
    </nav>
</div>

</div> <!-- End of container -->
<?php get_footer(); ?>


