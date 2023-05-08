<?php include "../Layout/header.php"; ?>

    <!-- Dies ist die view vom index, hier werden alle Namen,
    der "Games" als Links in einer ungeordneten Liste angezeigt-->
<?php session_start();
if($_SERVER['PATH_INFO']=='/index' && !isset($_SESSION['id'])) {
  header('location:login');
}
?>
<div class="container-fluid">
    <div class="panel-group" style="height: 100%">
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-5 col-5"></div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="panel-heading" id="indexHeading"><h1>Welcome to my Gameshop</h1></div>
          </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>
        </div>

        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-5 col-5"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="panel-body" style="margin-left:2%  width:100%; display:flex">
            <input type="search" placeholder="Search for a Game..." id="gameSearch"
                   style="width: 45%;padding:11px 10px 11px 10px">
            <button id="searchBtn" class="btn btn-default" style=" padding: 12px 15px; "><span
                        class="glyphicon glyphicon-search"></span></button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-5 col-5"></div>
      <div class="col-lg-7 col-md-7 col-sm-7 col-7">
        <div class="panel-body" style="border: 1px solid;display:none; resize: none;background-color:white;width:45%;"
             id="searchPanel">
            <?php foreach ($games
            as $game): ?>
            <p class="pp">
                <a href="game?id=<?php echo $game->id; ?>">
                    <?php echo $game->name; ?>
                </a>
                <?php endforeach; ?></p>
        </div>
      </div>
      </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-3"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
        <div class="panel panel-default" style="display:none; border:none;box-shadow: 0px 20px 20px;height:100%; margin-top:10%" id="gameList">
            <ul class=list-inline style="list-style-type: none;height:100%">
                <?php foreach ($games as $game): ?>
                <div class="" style="height:180 px">
                <div class="panel-body" style="border-radius: 20px; height:10%;" id="listBody">
                    <li id="links">
                        <a href="game?id=<?php echo $game->id; ?>" id="<?php $gameid=$game->id; echo $gameid?>"
                           style="display: flex; align-items: center; text-decoration: none; color: black;border-radius: 20px; box-shadow: 0 10px 20px #1687d933"
                           class="gameLinks">
                            <div><?php echo '<img id=ImgGame src= "data: img;base64 ,' . base64_encode($game ['image']) . ' " class=media-object
                                  style=height:100px; width:100px  id=showImg>'?></div>
                            <div style="padding-left: 20px" id="gameText">
                                <div><?php echo $game->name; ?></div>
                                <?php echo $game->price. " €";?>
                            </div>
                        </a>
                    </li>
                </div>
        </div>
        <?php endforeach;?>
        </ul>
    </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-3"></div>

</div>
</div>
<script>



    $("#gameSearch").mousedown(function () {
        $("#gameList").css("display", "none")
    });
    $("#searchBtn").mouseup(function () {
        $("#gameList").css("display", "block"),$("#searchPanel").css("display","none")
    });

    $(".pp").mouseup(function () {
        $("#searchPanel").css("visibility", "hidden")
    });
    $(document).ready(function () {
        $("#gameSearch").keyup(function () {
            $("#searchPanel").css("display", "block")
            // Retrieve the input field text
            var filter = $(this).val();


            // Loop through the comment list
            $("div div p a").each(function () {

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $("#listBody").css("box-shadow","none");
                    $(this).fadeOut();

                    // Show the list item if the phrase matches
                }else {
                    $(this).show();

                }


            });


        });
    });
    $(document).ready(function () {
        $("#gameSearch").keyup(function () {
            $("#searchPanel").css("display", "block")
            // Retrieve the input field text
            var filter = $(this).val();


            // Loop through the comment list
            $("div div ul div div li a ").each(function () {

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {

                    $(this).fadeOut();

                    // Show the list item if the phrase matches
                } else {
                    $(this).show();

                }


            });


        });
    })
    if ($("gameSearch").val() == "") {
        $("#gameList").css("visibility", "hidden");
    }
</script>

<?php include "../Layout/footer.php"; ?>
