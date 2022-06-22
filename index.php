<?php get_header(); ?>
<h1 class="abouttgl">
    Hello World!<br>
    GEN of THE GEN LABORATORY uses the character “源” in Japanese. This character, which means Minamoto / Power, is our concept, and we named it as it is read in Japanese. The idea is to pursue not only the upper side but also the source of things and deliver it as an article.
Isn’t it nice that people who have mastered something and who are working hard toward their goals have sparkling eyes? We want to be the same. LABORATORY means that it is a place for everyone. We wanna be a place where we can work hard on the same platform toward our goals.
</h1>

<div class="row" id="topPadding"></div>
<!-- ========== カテゴリ取得 ========== -->
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
    <?php get_all_posts();?>
</div>

</div> <!-- End of container -->
<?php get_footer(); ?>


