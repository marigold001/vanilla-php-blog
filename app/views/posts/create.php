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
                            <h4 class="card-title">Create Post</h4>
                            <p class="card-description">
                            <blockquote>
                                "The act of writing is the act of discovering what you believe." – David Hare
                            </blockquote>
                            </p>
                            <form id="post-create-form" class="forms-sample"
                                  action="/admin/posts/store" method="post"
                                  enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <div id="editor"></div>

                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
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

    document.getElementById('post-create-form').addEventListener('submit', function (event) {
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
        formData.append('image', image);

        // Send AJAX POST request
        fetch('/admin/posts/store', {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if(response.ok) {
                    window.location.href = '/admin/posts';
                } else {

                }
            })
            .catch(error => {
            });

        // event.target.submit();
    });



</script>

