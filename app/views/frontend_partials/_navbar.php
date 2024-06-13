<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="/assets/img/logo.png" alt=""> -->
            <h1>ZenBlog</h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="/admin/posts">Admin Panel</a></li>
                <li class="dropdown"><a href="/categories"><span>Categories</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>

                        <?php $count = 0; ?>
                        <?php foreach ($categories as $cat) : ?>
                            <?php if ($cat->status !== "draft" && $count < 5) : ?>
                                <li><a href="/category/<?= $cat->id ?>"><?= $cat->name ?></a></li>
                                <?php $count++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="dropdown"><a href="/tags"><span>Tags</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <?php $count1 = 0; ?>
                        <?php foreach ($tags as $tag) : ?>
                            <?php if ($tag->status !== "draft" && $count1 < 5) : ?>
                                <li><a href="/tag/<?= $tag->id ?>"><?= $tag->name ?></a></li>
                            <?php $count1++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->
        <?php if(false) : ?>
        <div class="position-relative">
            <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
            <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
            <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- End Search Form -->

        </div>
        <?php endif; ?>
    </div>

</header><!-- End Header -->