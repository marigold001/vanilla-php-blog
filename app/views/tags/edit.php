<!--  Header partial   -->
<?php echo $header ?>

<!--  Navbar partial   -->
<?php echo $navbar ?>
<div class="container-fluid page-body-wrapper">
    <!--  Sidebar partial   -->
    <?php echo $sidebar ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card my-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Tag</h4>
                            <p class="card-description">
                            <blockquote>
                                "Presence is more than just being there." - Malcolm S. Forbes
                            </blockquote>
                            </p>
                            <form id="post-create-form" class="forms-sample"
                                  action="/admin/tags/<?= $tag->id ?>/update" method="post">

                                <div class="form-group">
                                    <label for="t_name">Tag Name</label>
                                    <input type="text" class="form-control" id="t_name" name="t_name" placeholder="Tag Name"
                                           value="<?= $tag->name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="draft" <?= $tag->status === 'draft' ? 'selected' : '' ?>>Draft</option>
                                        <option value="published" <?= $tag->status === 'published' ? 'selected' : '' ?>>Published</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="/admin/tags" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Footer partial   -->
<?php echo $footer ?>


