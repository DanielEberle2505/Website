
<h1>Welcome to the Dashboard</h1>
<div class="container-fluid" style="height:75% margin-top:10%">
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height:100%">

<ol class="carousel-indicators">

<li data-target="#myCarousel" data-slide-to=<?php echo $games[1]->id;?> class="active">
<?php foreach($games as $game):
if($game->id==$games[1]['id']){

}else{?>
<li data-target="#myCarousel" data-slide-to=<?php echo $game->id;?> > <?php
}?>
</li>


<?php endforeach;?>

</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner" style="height:100%">
<div class="item active" style="height:50%;justify-content:center">
  <?php echo "<a href=game?id=".$games[1]['id'].">";?><div class="col-sm-5 col-5 col-md-5 col-lg-5"></div>
<div class="col-sm-7 col-7 col-md-7 col-lg-7" style=""><h1><?php echo $games[1]['name'];?></h1></div>
  <div class="images"> <?php echo' <img id=ImgGame src= "data: img;base64 ,' . base64_encode($games[1]['image']) . ' " class=img style=width:40% id=showImg> ' ?></div></a>
</div>



<?php foreach($games as $game):
if($game->id==$games[1]['id']) {

}else {?>

<div class="item" style="height:50%">
  <?php echo "<a href=game?id=".$game->id.">";?><div class="col-sm-5 col-5 col-md-5 col-lg-5"></div>
<div class="col-sm-7 col-7 col-md-7 col-lg-7" style=""><h1><?php echo $game['name'];?></h1></div>
  <div class="images"> <?php echo' <img id=ImgGame src= "data: img;base64 ,' . base64_encode($game['image']) . ' " class=img  style=width:40% id=showImg> ' ?></div>
</div><?php }?>
<?php endforeach;?>

</div>

<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
<span class="sr-only">Next</span>
</a>
</div>
<p id="width1"></p>



<script>

window.addEventListener("resize", function() {
  if (window.matchMedia("(min-width: 800px)").matches) {
    $(".img").css("width", "60%")
  }

  else {

$(".img").css("width", "100%")
  }
});
</script>
