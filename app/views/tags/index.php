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
                            <h4 class="card-title">Tags Table</h4>
                            <p class="card-description">
                            <blockquote>"Honesty is the first chapter in the book of wisdom." - Thomas Jefferson
                            </blockquote>
                            </p>
                            <form action="/admin/tags/bulkDelete" method="post"
                                  onsubmit="return confirm('Are you sure you want to delete selected tags?');"
                                  class="mr-4">
                                <a class="btn btn-primary float-end" href="<?php echo 'tags/create'; ?>">Create New
                                    Tag</a>
                                <button class="btn btn-danger mr-4 float-end" type="submit" name="delete">Delete
                                    Selected
                                </button>
                                <div class="clear-fix"></div>
                                <div class="table-responsive mt-2">
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
                                        <?php if (!empty($tags)) : ?>


                                            <?php foreach ($tags as $tag) : ?>
                                                <tr>
                                                    <td><input type="checkbox" name="tag_ids[]"
                                                               value="<?php echo $tag->id; ?>"></td>
                                                    <td><?= $tag->id ?></td>
                                                    <td><?= $tag->name ?></td>
                                                    <td><?= $tag->status ?></td>
                                                    <td>
                                                        <a class="btn btn-primary px-4"
                                                           href="<?php echo 'tags/' . $tag->id . '/edit' ?>">Edit</a>
                                                        <a class="btn btn-warning px-4"
                                                           href="<?php echo 'tags/' . $tag->id . '/delete' ?>"
                                                           onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        <?php else : ?>
                                            <tr>
                                                <td>No tags available</td>
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

