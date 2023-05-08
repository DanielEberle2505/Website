

<!-- view von der Wiki-->
  <a href="addEntry" style=" text-decoration:none; color:black"><button style="margin-left: 5%" class="btn btn-info">add Entry</button></a>
  <ul class="list-group">
    <?php foreach ($wikiEntries as $wikiEntry):?>

    <div class="panel-body">
        <li class="list-group-item" style="background-color: Gainsboro"><a href='showEntry?id=<?php echo $wikiEntry->id?>'><?php echo$wikiEntry->title?></li>
    </div>
</div>
<?php endforeach;?>
</ul>
