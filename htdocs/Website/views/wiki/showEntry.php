
<!-- view vom showEntry-->
<div class="panel panel-default" style="width:80%; border-radius: 20px ;margin-left: 10%">
    <div class="panel-heading" style="border-radius: 20px">
        <script src="./game.js"></script>
        <h3 class="panel-title"><b id="showTitle"><?php echo $wikiEntry['title']; ?></b></br></h3>

    </div>
    <div class="panel-body">
        <div class="col-sm-10">
            <a href="/Website/public/index.php/editEntry?id=<?php echo $_GET['id'] ?>" id="editLink">
                <button id="editButton" class="btn btn-info btn-lg" >Edit</button><script src="/Website/views/game/games.js"></script>
            </a>
        </div>
        <div class="col-sm-2">
            <a href="/Website/public/index.php/delete?id=<?php echo $_GET['id'] ?>" id="deleteLink">
                <button id="editButton" class="btn btn-info btn-lg" >Delete</button><script src="/Website/views/game/games.js"></script>
            </a>
        </div>
        <div class="col-sm-12">
        </div>
        <div class="col-sm-8"><?php echo nl2br($wikiEntry['content']); ?>
        </div>
        </div>
    </div>
</div>
