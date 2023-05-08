
<!--view vom addEntry-->
<div class="container" id="WikiInputContainer">

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Title:</label>
            <textarea name="title" class="form-control" rows="5" id="name" style="resize: none"></textarea>
        </div>
        <div class="form-group">
            <label for="content">Content: </label>
            <textarea name="content" class="form-control" rows="5" id="description" style="resize: none"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-info btn-lg" name="uploadButton">Upload</button>
        </div>

    </form>
</div>
