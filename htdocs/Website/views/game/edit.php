
<!-- Dies ist die view von edit,
    hier werden in den Inputfeldern die Informationen übergeben,
    damit diese vom Controller und Repository benutzt werden können -->
<div class="container" id="gameInputContainer" xmlns="http://www.w3.org/1999/html">

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <textarea name="name" class="form-control" rows="5" id="name" style="resize: none"><?php echo $game->name ?></textarea>
        </div>
        <div class="form-group">
            <label for="file">Image:</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5" id="description" style="resize: none"><?php echo $game->description ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price (in €): </label>
            <input type="text" class="form-control" name="price" value="<?php echo $game->price;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="updateButton" class="btn btn-info">Update</button><script src="/Website/views/game/games.js"></script>
        </div>
    </form>
</div>
