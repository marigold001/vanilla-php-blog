<div class="aside-block">

    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-popular" type="button" role="tab"
                    aria-controls="pills-popular" aria-selected="true">Popular
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-trending" type="button" role="tab"
                    aria-controls="pills-trending" aria-selected="false">Trending
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-latest" type="button" role="tab"
                    aria-controls="pills-latest" aria-selected="false">Latest
            </button>
        </li>
    </ul>
    <!--                         Partial for tab content on the sidebar for popular tags  -->
    <div class="tab-content" id="pills-tabContent">

        <!-- Popular -->
        <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
             aria-labelledby="pills-popular-tab">
            <?php
            // Example array of popular tags (you should replace this with your logic to determine popular tags)
            $popularTags = ['Popular'];

            // Iterate over each popular tag
            foreach ($popularTags as $popularTag) :
                ?>

                <?php
                // Iterate over each post to find posts with the current popular tag
                foreach ($posts as $post) :
                    $postHasPopularTag = false;

                    // Check if the post has the current popular tag
                    foreach ($post->tags as $tag) {
                        if ($tag->name == $popularTag) {
                            $postHasPopularTag = true;
                            break; // Exit loop once match is found
                        }
                    }

                    // Display the post if it has the current popular tag
                    if ($postHasPopularTag) :
                        ?>
                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date"><?php foreach ($post->tags as $tag) {
                                        if ($tag->name == $popularTag) {
                                            echo "<a href='/tags/{$tag->id}'>{$tag->name}</a>";
                                        }
                                    } ?></span> <span class="mx-1">&bullet;</span> <span><?php $date = strtotime($post->created_at);
                                    echo date('Y M', $date); ?></span></div>
                            <h2 class="mb-2"><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h2>
                            <?php if(false) :?>
                                <span class="author mb-3 d-block"><?= $post->author ?></span>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                endforeach; // End posts loop
            endforeach; // End popular tags loop
            ?>

        </div> <!-- End Popular -->

        <!-- Trending -->
        <div class="tab-pane fade" id="pills-trending" role="tabpanel"
             aria-labelledby="pills-trending-tab">
            <?php
            // Example array of popular tags (you should replace this with your logic to determine popular tags)
            $popularTags = ['Trending'];

            // Iterate over each popular tag
            foreach ($popularTags as $popularTag) :
                ?>

                <?php
                // Iterate over each post to find posts with the current popular tag
                foreach ($posts as $post) :
                    $postHasPopularTag = false;

                    // Check if the post has the current popular tag
                    foreach ($post->tags as $tag) {
                        if ($tag->name == $popularTag) {
                            $postHasPopularTag = true;
                            break; // Exit loop once match is found
                        }
                    }

                    // Display the post if it has the current popular tag
                    if ($postHasPopularTag) :
                        ?>
                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date"><?php foreach ($post->tags as $tag) {
                                        if ($tag->name == $popularTag) {
                                            echo "<a href='/tags/{$tag->id}'>{$tag->name}</a>";
                                        }
                                    } ?></span> <span class="mx-1">&bullet;</span> <span><?php $date = strtotime($post->created_at);
                                    echo date('Y M', $date); ?></span></div>
                            <h2 class="mb-2"><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h2>
                            <?php if(false) :?>
                                <span class="author mb-3 d-block"><?= $post->author ?></span>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                endforeach; // End posts loop
            endforeach; // End popular tags loop
            ?>
        </div> <!-- End Trending -->

        <!-- Latest -->
        <div class="tab-pane fade" id="pills-latest" role="tabpanel"
             aria-labelledby="pills-latest-tab">
            <?php
            // Example array of popular tags (you should replace this with your logic to determine popular tags)
            $popularTags = ['Latest'];

            // Iterate over each popular tag
            foreach ($popularTags as $popularTag) :
                ?>

                <?php
                // Iterate over each post to find posts with the current popular tag
                foreach ($posts as $post) :
                    $postHasPopularTag = false;

                    // Check if the post has the current popular tag
                    foreach ($post->tags as $tag) {
                        if ($tag->name == $popularTag) {
                            $postHasPopularTag = true;
                            break; // Exit loop once match is found
                        }
                    }

                    // Display the post if it has the current popular tag
                    if ($postHasPopularTag) :
                        ?>
                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date"><?php foreach ($post->tags as $tag) {
                                        if ($tag->name == $popularTag) {
                                            echo "<a href='/tags/{$tag->id}'>{$tag->name}</a>";
                                        }
                                    } ?></span> <span class="mx-1">&bullet;</span> <span><?php $date = strtotime($post->created_at);
                                    echo date('Y M', $date); ?></span></div>
                            <h2 class="mb-2"><a href="/post/<?= $post->id ?>"><?= $post->title ?></a></h2>
                            <?php if(false) :?>
                                <span class="author mb-3 d-block"><?= $post->author ?></span>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                endforeach; // End posts loop
            endforeach; // End popular tags loop
            ?>

        </div> <!-- End Latest -->

    </div>
</div>

<div class="aside-block">
    <h3 class="aside-title">Video</h3>
    <div class="video-post">
        <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
            <span class="bi-play-fill"></span>
            <img src="/assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
        </a>
    </div>
</div><!-- End Video -->

<div class="aside-block">
    <h3 class="aside-title">Categories</h3>
    <ul class="aside-links list-unstyled">
        <?php foreach ($categories as $cat) : ?>
            <?php if ($cat->status !== "draft") : ?>
                <li><a href="/categories/<?= $cat->id ?>"><?= $cat->name ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div><!-- End Categories -->

<div class="aside-block">
    <h3 class="aside-title">Tags</h3>
    <ul class="aside-tags list-unstyled">
        <li><a href="category.html">Business</a></li>
        <?php foreach ($tags as $tag) : ?>
            <?php if ($tag->status !== "draft") : ?>
                <li><a href="/tags/<?= $tag->id ?>"><?= $tag->name ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div><!-- End Tags -->