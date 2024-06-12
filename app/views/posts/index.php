<!-- posts/index.php -->
<?php require BASE_PATH . '/templates/admin/partials/_header.html'; ?>
<?php require BASE_PATH . '/templates/admin/partials/_navbar.php'; ?>
<div class="container-fluid page-body-wrapper">
    <?php require BASE_PATH . '/templates/admin/partials/_sidebar.html'; ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <?php
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                $message = '';

                if ($status === 'success') {
                    $message = 'Post updated successfully.';
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

                <div class="col-lg-12 grid-margin stretch-card my-4">

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title d-inline mr-4">Posts</h4>

                            <form action="/admin/posts/bulkDelete" method="post"
                                  onsubmit="return confirm('Are you sure you want to delete selected posts?');"
                                  class="mr-4">
                                <a class="btn btn-primary float-end" href="<?php echo 'posts/create'; ?>">Create New
                                    Post</a>
                                <button class="btn btn-danger mr-4 float-end" type="submit" name="delete">Delete
                                    Selected
                                </button>
                                <!-- Rest of your table -->
                                <div class="clear-fix" style="clear: both"></div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($posts as $post): ?>
                                            <tr>
                                                <td><input type="checkbox" name="post_ids[]"
                                                           value="<?php echo $post->id; ?>"></td>
                                                <td><img src="<?php echo getImagePath($post->image) ?? ''; ?>"
                                                         class="img-thumbnail" alt="<?php echo $post->title; ?>"></td>
                                                <td><?php echo $post->title; ?></td>
                                                <?php $date = strtotime($post->created_at); ?>
                                                <td><?php echo date('Y', $date) ?? ''; ?></td>
                                                <td><?php echo $post->status ?? ''; ?></td>
                                                <td>
                                                    <a class="btn btn-primary px-4"
                                                       href="<?php echo 'posts/' . $post->id . '/edit' ?>">Edit</a>
                                                    <a class="btn btn-warning px-4"
                                                       href="<?php echo 'posts/' . $post->id . '/delete' ?>"
                                                       onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
    setTimeout(function () {
        var alertElement = document.getElementById('status-message');
        alertElement.classList.add('fade-out');
        // Remove status parameter from URL after 3 seconds
        var urlWithoutParams = window.location.href.split('?')[0];
        history.replaceState(null, null, urlWithoutParams);
    }, 3000);
</script>

<?php include BASE_PATH . '/templates/admin/partials/_footer.html'; ?> <!-- Include footer -->