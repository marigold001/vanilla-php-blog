<!-- posts/index.php -->
<?php require BASE_PATH . '/templates/admin/partials/_header.html'; ?>
<?php require BASE_PATH . '/templates/admin/partials/_navbar.php'; ?>
<div class="container-fluid page-body-wrapper">
    <?php require BASE_PATH . '/templates/admin/partials/_sidebar.html'; ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card my-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title d-inline mr-4">Posts</h4>
                            <a class="btn btn-primary float-end" href="<?php echo 'posts/create'; ?>">Create New Post</a>
                            <div class="clear-fix" style="clear: both"></div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
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
                                            <td><img src="<?php echo $post->image ?? ''; ?>" class="img-thumbnail" alt="<?php echo $post->title; ?>"></td>
                                            <td><?php echo $post->title; ?></td>
                                            <?php $date =  strtotime($post->created_at); ?>
                                            <td><?php echo date('Y', $date) ?? ''; ?></td>
                                            <td><?php echo $post->status ?? ''; ?></td>
                                            <td>
                                                <a class="btn btn-primary px-4" href="<?php echo 'posts/edit/'.$post->id; ?>">Edit</a>
                                                <a class="btn btn-warning px-4" href="<?php echo 'posts/delete/'.$post->id; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include BASE_PATH . '/templates/admin/partials/_footer.html'; ?> <!-- Include footer -->