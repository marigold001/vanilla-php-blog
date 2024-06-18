<!-- ======= Header partial ======= -->
<?php echo $header ?>

<!-- ======= Header ======= -->
<?php echo $navbar ?>


<main id="main">
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-9 additional-padding" data-aos="fade-up">
                    <?php
                    foreach ($posts as $post) : ?>
                        <div class="d-md-flex post-entry-2 half">
                        <a href="/post/<?= $post->id ?>" class="me-4 thumbnail">
                            <img src="/uploads/<?= $post->image ?>" alt="<?= $post->title ?>" class="img-fluid">
                        </a>
                        <div>
                            <div class="post-meta all-posts"><span class="date"><div><?php $count=0; foreach ($post->categories as $postCategory) {
                                            if (isset($postCategory) && ($count < 3) && ($postCategory->status != "draft")) {
                                                echo "<a href='/categories/{$postCategory->id}'>{$postCategory->name}</a> <br>";
                                            }
                                            $count++;
                                        }
                                        ?>

                                </div></span> <span><?php $date = strtotime($post->created_at);
                                    echo date('Y M', $date); ?></span></div>
                            <h3><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h3>
                            <p><?= $post->summary ?></p>
                            <?php if (false) : ?>
                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="name">
                                        <h3 class="m-0 p-0"><?= $post->author ?></h3>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div><?php
                    endforeach; // End categories loop
                    ?>

                    <?php if (empty($posts)) : ?>
                        <h5>No posts found.</h5>
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