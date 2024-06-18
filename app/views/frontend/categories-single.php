<!-- ======= Header partial ======= -->
<?php echo $header ?>

<!-- ======= Header ======= -->
<?php echo $navbar ?>
<main id="main">
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-9 additional-padding" data-aos="fade-up">
                        <?php $hasPosts = false; ?>
                        <h3 class="category-title">Category: <?= $category->name ?></h3>
                        <?php foreach ($posts as $post) : ?>
                            <?php
                            // Check if the post belongs to the current category
                            $postBelongsToCategory = false;
                            foreach ($post->categories as $postCategory) {
                                if ($postCategory->name == $category->name) {
                                    $postBelongsToCategory = true;
                                    $hasPosts = true;
                                    break; // Exit loop once category match is found
                                }
                            }

                            // If post belongs to current category and hasn't been displayed yet
                            if ($postBelongsToCategory) {
                                // Add post ID to displayed posts array for this category
                                $categoryPosts[] = $post->id;

                                // Display post HTML here
                                ?>
                                <div class="d-md-flex post-entry-2 half">
                                    <a href="/post/<?= $post->id ?>" class="me-4 thumbnail">
                                        <img src="/uploads/<?= $post->image ?>" alt="<?= $post->title ?>"
                                             class="img-fluid">
                                    </a>
                                    <div>

                                        <div class="post-meta"><span
                                                class="date"><?php foreach ($post->categories as $postCategoryName) {
                                                    if ($category->name == $postCategoryName->name) {
                                                        echo "<span >{$postCategoryName->name}</span>";
                                                    }
                                                } ?></span>
                                            <span><?php $date = strtotime($post->created_at);
                                                echo date('Y M', $date); ?></span></div>
                                        <h3><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h3>
                                        <p><?= $post->summary ?></p>
                                        <?php if (false) : ?>
                                            <div class="d-flex align-items-center author">
                                                <div class="photo"><img src="assets/img/person-2.jpg" alt=""
                                                                        class="img-fluid"></div>
                                                <div class="name">
                                                    <h3 class="m-0 p-0"><?= $post->author ?></h3>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                    <?php endforeach; ?>
                    <?php if(!$hasPosts) :?>
                    <h2>This category has no posts</h2>
                    <?php endif; ?>
                </div>


                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->
                    <?php echo $aside_block; ?>

                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<!--  Footer partial -->
<?php echo $footer ?>