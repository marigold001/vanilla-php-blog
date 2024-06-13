<!-- ======= Header partial ======= -->
<?php echo $header ?>

<!-- ======= Header ======= -->
<?php echo $navbar ?>


<main id="main">
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-9" data-aos="fade-up">
                    <?php
                    // Initialize an array to track displayed post IDs
                    $displayedPosts = [];

                    // Initialize an array to track categories with posts
                    $tagsWithPosts = [];

                    // Iterate over each category
                    foreach ($tags as $tag) :
                        // Check if there are posts for the current category
                        $tagsHasPosts = false;

                        // Iterate over each post
                        foreach ($posts as $post) :
                            // Check if the post belongs to the current category
                            $postBelongsToTag = false;
                            foreach ($post->tags as $postTag) {
                                if ($postTag->name == $tag->name) {
                                    $postBelongsToTag = true;
                                    break; // Exit loop once category match is found
                                }
                            }

                            // If the post belongs to the current category, mark it as having posts
                            if ($postBelongsToTag) {
                                $tagHasPosts = true;
                                // Mark the post as displayed
                                $displayedPosts[] = $post->id;
                            }
                        endforeach; // End posts loop

                        // Display the category name only if it has posts
                        if ($tagHasPosts) {
                            $tagsWithPosts[] = $tag;
                            ?>
                            <h3 class="category-title">Tag: <?= $tag->name ?></h3>

                            <?php
                            // Iterate over each post again to display them
                            foreach ($posts as $post) :
                                // Check if the post belongs to the current category
                                $postBelongsToTag = false;
                                foreach ($post->tags as $postTag) {
                                    if ($postTag->name == $tag->name) {
                                        $postBelongsToTag = true;
                                        break; // Exit loop once category match is found
                                    }
                                }

                                // Display the post only if it belongs to the current category and hasn't been displayed yet
                                if ($postBelongsToTag && in_array($post->id, $displayedPosts)) :
                                    ?>
                                    <div class="d-md-flex post-entry-2 half">
                                        <a href="/post/<?= $post->id ?>" class="me-4 thumbnail">
                                            <img src="/uploads/<?= $post->image ?>" alt="<?= $post->title ?>" class="img-fluid">
                                        </a>
                                        <div>
                                            <div class="post-meta"><span class="date"><?php foreach ($post->tags as $postTagName) {
                                                        if ($tag->name == $postTagName->name) {
                                                            echo "<a href='/tags/{$postTagName->id}'>{$postTagName->name}</a>";
                                                        }
                                                    } ?></span> <span class="mx-1">&bullet;</span> <span><?php $date = strtotime($post->created_at);
                                                    echo date('Y M', $date); ?></span></div>
                                            <h3><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h3>
                                            <p><?= $post->summary ?></p>
                                            <?php if (false) : ?>
                                                <div class="d-flex align-items-center author">
                                                    <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                                                    <div class="name">
                                                        <h3 class="m-0 p-0"><?= $post->author ?></h3>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php
                                endif;
                            endforeach; // End posts loop
                        }
                    endforeach; // End tags loop
                    ?>

                    <?php if (empty($tagsWithPosts)) : ?>
                        <p>No tags with posts found.</p>
                    <?php endif; ?>
                </div>




                <div class="col-md-3">
                    <!-- ======= Sidebar partial ======= -->
                    <?php echo $aside_block; ?>

                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<!--  Footer partial -->
<?php echo $footer ?>