
<!-- Dies ist die view von addGame,
    hier werden in den Inputfeldern die Informationen übergeben,
    damit diese vom Controller und Repository benutzt werden können -->

<div class="container" id="gameInputContainer">

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <textarea name="name" class="form-control" rows="5" id="name" style="resize: none"></textarea>
        </div>
        <label for="image">Image: </label>
        <div class="form-group"><input type="file" class="form-control" name="file"></div>
        <div class="form-group">
            <label for="description">Description: </label>
            <textarea name="description" class="form-control" rows="5" id="description" style="resize: none"></textarea>
        </div>
        <div class="form-group">
            <label for="price"> Price (in €): </label>
            <input type="text" class="form-control" name="price">
        </div>
        <div class="form-group">
            <button type="submit" class="btn-info btn-lg" name="uploadButton">Upload</button><script src="/Website/views/game/games.js"></script>
        </div>

    </form>
</div>

