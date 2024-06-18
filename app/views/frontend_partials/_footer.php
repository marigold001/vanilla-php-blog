
<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">About ZenBlog</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem
                        deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis
                        qui aliquid blanditiis omnis quae. Explicabo?</p>
                    <p><a href="mailto:neven.jo22@gmail.com" class="footer-link-more">Email me</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="/admin/posts">Admin panel</a></li>
                        <li><a href="/posts">Posts</a></li>
                        <li><a href="/categories">Categories</a></li>
                        <li><a href="/about">About us</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Categories</h3>
                    <ul class="footer-links list-unstyled">
                        <?php $count1 = 0; ?>
                        <?php foreach ($categories as $cat) : ?>
                            <?php if ($cat->status !== "draft" && $count1 < 4) : ?>
                                <li><a href="/categories/<?= $cat->id ?>"><?= $cat->name ?></a></li>
                                <?php $count1++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Recent Posts</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        <?php $count = 0; ?>
                        <?php foreach ($posts as $post) : ?>
                            <?php if ($post->status !== "draft" && $count < 4) : ?>
                                <li>
                                    <a href="/post/<?= $post->id ?>" class="d-flex align-items-center">
                                        <img src="/uploads/<?= $post->image ?>" alt="<?= $post->title ?>"
                                             class="img-fluid me-3">
                                        <div>
                                            <div class="post-meta d-block"><span class="date">
                                                <?php if (isset($post->categories)): ?>
                                                        <?= $post->categories[0]->name ?>
                                                <?php endif; ?>
                                                </span> <span
                                                        class="mx-1">&bullet;</span>
                                                <span><?php $date = strtotime($post->created_at);
                                                    echo date('Y M', $date); ?></span></div>
                                            <span><?= $post->title ?></span>
                                        </div>
                                    </a>
                                </li>
                                <?php $count++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>

                </div>
                <?php if(false) :?>
                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>

                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>

</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/assets/js/main.js"></script>

</body>

</html>