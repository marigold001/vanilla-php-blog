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
                                    <label for="summary">Summary</label>
                                    <input type="text" class="form-control" id="summary" name="summary" placeholder="Summary"
                                           >
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <div id="editor"></div>

                                </div>
                                <?php if(!empty($tags)) :?>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select multiple class="form-control" id="tags" name="tags[]">
                                        <?php foreach ($tags as $tag) : ?>
                                            <option value="<?php echo $tag->id; ?>"><?php echo $tag->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php else: ?>
                                <div class="form-group">
                                    <p>No Tags available</p>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($categories)) :?>
                                    <div class="form-group">
                                        <label for="tags">Categories</label>
                                        <select multiple class="form-control" id="categories" name="categories[]">
                                            <?php foreach ($categories as $cat) : ?>
                                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <div class="form-group">
                                        <p>No Tags available</p>
                                    </div>
                                <?php endif; ?>
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

<!--  Footer partial   -->
<?php echo $footer ?>

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
        var summary = document.getElementById('summary').value;
        var status = document.getElementById('status').value;
        var editorData = editor.getData();
        var imageInput = document.getElementById('image');
        var image = imageInput.files[0]; // Assuming only one file is selected
        var selectedTags = Array.from(document.querySelectorAll('#tags option:checked'))
            .map(option => option.value);
        var selectedCategories = Array.from(document.querySelectorAll('#categories option:checked'))
            .map(option => option.value);

        // Send AJAX POST request
        var formData = new FormData();
        formData.append('title', title);
        formData.append('summary', summary);
        formData.append('status', status);
        formData.append('content', editorData);
        formData.append('image', image);
        selectedTags.forEach(tagId => {
            formData.append('tags[]', tagId);
        });
        selectedCategories.forEach(catId => {
            formData.append('categories[]', catId);
        });

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

    $(document).ready(function() {
        $('#tags').select2();
    });

    $(document).ready(function() {
        $('#categories').select2();
    });

</script>



