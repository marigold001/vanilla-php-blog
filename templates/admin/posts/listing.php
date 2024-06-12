<!-- posts/index.php -->
<?php require __DIR__ . '/../partials/_header.html'; ?>
<?php exit(); ?>

<?php require __DIR__ . '/../partials/_navbar.php'; ?>
<div class="container-fluid page-body-wrapper">

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card my-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Blog Posts</h4>
                            <a href="<?php echo 'posts/create'; ?>">Create New Post</a>
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
                                            <td><?php echo $post->created_at ?? ''; ?></td>
                                            <td><?php echo $post->status ?? ''; ?></td>
                                            <td>
                                                <a href="<?php echo 'posts/edit/'.$post->id; ?>">Edit</a>
                                                <a href="<?php echo 'posts/delete/'.$post->id; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
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





<?php require __DIR__ . '/../partials/_footer.php'; ?>
