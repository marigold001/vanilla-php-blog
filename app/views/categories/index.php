<!--Header partial -->
<?php echo $header ?>

<!--  Navbar partial   -->
<?php echo $navbar ?>
<div class="container-fluid page-body-wrapper">
    <!--  Sidebar partial   -->
    <?php echo $sidebar ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <?php
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                $message = '';

                if ($status === 'success') {
                    $message = 'Tag updated successfully.';
                } elseif ($status === 'error') {
                    $message = 'Action failed. Please try again.';
                }
                ?>
                <?php if ($message): ?>
                    <div id="status-message"
                         class="alert alert-<?php echo $status === 'success' ? 'success' : 'danger'; ?>" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['message'])): ?>
                    <div id="alert-message"
                         class="alert alert-dismissible alert-<?php echo $_SESSION['success'] ? 'success' : 'danger'; ?>"
                         role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); // Clear session message ?>
                <?php endif; ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Categories Table</h4>
                            <p class="card-description">
                            <blockquote>"The best relationships are the ones you never saw coming." – Unknown
                            </blockquote>
                            </p>
                            <form action="/admin/categories/bulkDelete" method="post"
                                  onsubmit="return confirm('Are you sure you want to delete selected categories?');"
                                  class="mr-4">
                                <a class="btn btn-primary float-end" href="<?php echo 'categories/create'; ?>">Create New
                                    Category</a>
                                <button class="btn btn-danger mr-4 float-end" type="submit" name="delete">Delete
                                    Selected
                                </button>
                                <div class="clear-fix"></div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th style="width: 10%">Selected</th>
                                            <th style="width: 10%;">ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th style="width: 20%;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($categories)) : ?>


                                            <?php foreach ($categories as $cat) : ?>
                                                <tr>
                                                    <td><input type="checkbox" name="cat_ids[]"
                                                               value="<?php echo $cat->id; ?>"></td>
                                                    <td><?= $cat->id ?></td>
                                                    <td><?= $cat->name ?></td>
                                                    <td><?= $cat->status ?></td>
                                                    <td>
                                                        <a class="btn btn-primary px-4"
                                                           href="<?php echo 'categories/' . $cat->id . '/edit' ?>">Edit</a>
                                                        <a class="btn btn-warning px-4"
                                                           href="<?php echo 'categories/' . $cat->id . '/delete' ?>"
                                                           onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        <?php else : ?>
                                            <tr>
                                                <td>No categories available</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to hide the alert after a delay
    setTimeout(function () {
        var alertElement = document.getElementById('alert-message');
        alertElement.classList.add('fade-out');
    }, 3000); // Adjust the delay as needed (3000 milliseconds = 3 seconds)
</script>
<!--    Footer partial-->
<?php echo $footer ?>
