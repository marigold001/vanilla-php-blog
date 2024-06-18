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
                            <h4 class="card-title d-inline">Create Tag</h4>
                            <blockquote class="float-end">
                                "Presence is more than just being there." - Malcolm S. Forbes
                            </blockquote>
                            <div class="clear-fix"></div>
                            <form id="post-create-form" class="forms-sample"
                                  action="/admin/tags/store" method="post">

                                <div class="form-group">
                                    <label for="t_name">Tag Name</label>
                                    <input type="text" class="form-control" id="t_name" name="t_name" placeholder="Tag Name"
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


