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
                            <h4 class="card-title">Edit Post</h4>
                            <p class="card-description">
                            <blockquote>
                                "The act of writing is the act of discovering what you believe." – David Hare
                            </blockquote>
                            </p>
                            <form id="post-edit-form" class="forms-sample"
                                  action="/admin/posts/update/<?php echo $post->id; ?>" method="post"
                                  enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                           value="<?php echo htmlspecialchars($post->title); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea id="editor"><?php echo htmlspecialchars($post->content); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                                    <div class="d-flex flex-row gap-4">
                                        <?php if ($post->image): ?>
                                            <div>
                                                <p>Current image:</p>
                                                <img src="/uploads/<?php echo $post->image; ?>" alt="Current Image" width="100" id="current-image">
                                                <input type="hidden" name="current_image" value="<?php echo $post->image; ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <p>New image preview:</p>
                                            <img id="image-preview" src="" alt="Image Preview" style="display: none;" width="100">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="draft" <?php echo $post->status == 'draft' ? 'selected' : ''; ?>>Draft</option>
                                        <option value="published" <?php echo $post->status == 'published' ? 'selected' : ''; ?>>Published</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="/admin/posts" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include BASE_PATH . '/templates/admin/partials/_footer.html'; ?>

<script>
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '/upload'  // Backend script to handle image uploads
            }
        }).then(newEditor => {
        editor = newEditor;
    })
        .catch(error => {
            console.error(error);
        });

    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('image-preview');
            output.src = dataURL;
            output.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }

    document.getElementById('post-edit-form').addEventListener('submit', function (event) {
        // Fetch data from ClassicEditor
        event.preventDefault();

        var title = document.getElementById('title').value;
        var status = document.getElementById('status').value;
        var editorData = editor.getData();
        var imageInput = document.getElementById('image');
        var image = imageInput.files[0]; // Assuming only one file is selected
        // Send AJAX POST request
        var formData = new FormData();
        formData.append('title', title);
        formData.append('status', status);
        formData.append('content', editorData);
        if (image) {
            formData.append('image', image);
        } else {
            formData.append('current_image', '<?php echo $post->image; ?>');
        }

        // Send AJAX POST request
        fetch('/admin/posts/<?php echo $post->id; ?>/update', {
            method: 'POST',
            body: formData,
        })
                .then(response => {
                if (response.ok) {
                    window.location.href = '/admin/posts?status=success';
                } else {
                    // Handle error
                }
            })
            .catch(error => {
                // Handle error
            });
    });
</script>
