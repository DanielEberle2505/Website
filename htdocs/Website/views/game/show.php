
<!-- Dies ist die view von show,
    hier werden die informationen (name, image und description)
     angezeigt-->
    <br/>
    <br/>

  <style><?php include "style1.css"?></style>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <?php ?>
    <div class="panel panel-default" style="width:100%; border-radius: 20px ;margin-left: 3%">
        <div class="panel-heading" style="border-radius: 20px">
            <script src="./game.js"></script>
            <h3 class="panel-title"><b id="showTitle"><?php echo $game['name']; ?></b></br></h3>

        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <a href="/Website/public/index.php/edit?id=<?php echo $_GET['id'] ?>" id="editLink">
                    <button id="editButton" class="btn btn-info btn-lg" >Edit</button>
                </a>
                <a href="/Website/public/index.php/deleteGame?id=<?php echo $_GET['id'] ?>" id="delete">
                    <button id="delete" class="btn btn-info btn-lg" >Delete</button>
                </a>

            </div>
            <div class="col-sm-4"> <?php echo
                    ' <img id=ImgGame src= "data: img;base64 ,' . base64_encode($game ['image']) . ' " class=media-object style=width:100%  id=showImg> ' ?> </br>
            </div>
            <div class="col-sm-5" style="padding-bottom:5%"><?php echo nl2br($game['description']); ?>
            </div>
            <div class="col-sm-3" >
                <form method="post" enctype="multipart/form-data">
                    <button name="shop" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                    </button>
                </form>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <form method="post" style=" margin-top: 5%">

                  <textarea name="comment" placeholder="Add your Comment here..." class="form-control" style="resize:none;style="margin-top: 10%""></textarea>
                  <div class="stars">
                      <input class="star star-5" id="star-5" type="radio" name="star" />
                      <label class="star star-5" for="star-5"></label>
                      <input class="star star-4" id="star-4" type="radio" name="star" />
                      <label class="star star-4" for="star-4"></label>
                      <input class="star star-3" id="star-3" type="radio" name="star" />
                      <label class="star star-3" for="star-3"></label>
                      <input class="star star-2" id="star-2" type="radio" name="star" />
                      <label class="star star-2" for="star-2"></label>
                      <input class="star star-1" id="star-1" type="radio" name="star" />
                      <label class="star star-1" for="star-1"></label>

                  </div>
                    <input type="text" id="rating1" name="rating" style="display:none">


                  </br><button  class="btn btn-info" name="commentButton" id="commentButton" >Submit</button>
                </form>
              </div>
            </div>

            <div class="col-sm-12 col-lg-12" id="comments">
                <p> Comments:</p>
                <ul class="list-group" >
                <?php foreach($comments as $comment):?>
                  <div class="">
                  <li style=" list-style-type:none;" class="list-group-item" style="display:flex">

                    <?php echo $comment['comment']; ?>

                    <div class="" style="display:flex;justify-content:center;transform:translateY(20%); float:right">
                    <?php for($i=0;$i<$comment['stars'];$i++):?>
                      <span class="glyphicon glyphicon-star" style="color:orange"></span>
                  <?php endfor;?>

                  </li>
                  </div>

                <?php endforeach;?>
        </div>
    </div>
  </div></div>

    <script>
      const output = document.getElementById('rating');
      const radioButtons = document.querySelectorAll('input[name="star"]');
      for(const radioButton of radioButtons) {
                  radioButton.addEventListener('change', showSelected);
              }
              function showSelected(e) {
              
              if (this.checked) {
                  document.querySelector('#rating1').value = this.id.slice(5);
              }
          }

    </script>


<?php include __DIR__ . "/../layout/footer.php"; ?>
