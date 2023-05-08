
<!-- view vom editEntry-->
<div class="container" id="gameInputContainer" xmlns="http://www.w3.org/1999/html">

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <textarea name="title" class="form-control" rows="5" id="name" style="resize: none"><?php echo $entry->title ?></textarea>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="5" id="description" style="resize: none"><?php echo $entry->content?></textarea>
        </div>

        <div class="form-group">
            <button type="submit" name="updateButton">Update</button><script src="/Website/views/game/games.js"></script>
        </div>
    </form>
</div>
