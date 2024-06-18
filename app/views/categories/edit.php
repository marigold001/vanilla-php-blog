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
                            <h4 class="card-title d-inline">Edit Category</h4>
                            <blockquote class="float-end">
                                "Earth provides enough to satisfy every man's needs, but not every man's greed." – Mahatma Gandhi
                            </blockquote>
                            <div class="clear-fix"></div>
                            <form id="post-create-form" class="forms-sample"
                                  action="/admin/categories/<?= $category->id ?>/update" method="post">

                                <div class="form-group">
                                    <label for="c_name">Category Name</label>
                                    <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Category Name"
                                           value="<?= htmlspecialchars($category->name) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="draft" <?= $category->status === 'draft' ? 'selected' : '' ?>>Draft</option>
                                        <option value="published" <?= $category->status === 'published' ? 'selected' : '' ?>>Published</option>
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


