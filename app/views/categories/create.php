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
                            <h4 class="card-title">Create Category</h4>
                            <p class="card-description">
                            <blockquote>
                                "Regret for the things we did can be tempered by time; it is regret for the things we did not do that is inconsolable." – Sydney J. Harris
                            </blockquote>
                            </p>
                            <form id="post-create-form" class="forms-sample"
                                  action="/admin/categories/store" method="post">

                                <div class="form-group">
                                    <label for="c_name">Category Name</label>
                                    <input type="text" class="form-control" id="c_name" name="c_name" placeholder="Category Name"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
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


