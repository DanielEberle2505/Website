
<!-- View von der Userlist,
    dies ist eine Übersicht aller User und ihrer Rollen -->
    <div class="container" id="userlistContainer" style="">
    <div class="panel-group">
    <div class="panel-heading"><input class="form-control" id="myInput" type="text" placeholder="Search.."></div><script src="./user.js"></script>

    <form method="post"><div class="panel-body" style="border: 1px solid; visibility: hidden; resize: none; transform:translateY(-15%);background-color: white" id="liveSearch">
        <?php foreach ($users as $user): ?>
        <p class="pp">
                <a href="user?name=<?php echo $user['name']?>"><?php echo $user['name'] ?><a/>
                    <!--<td><//?php echo $user['userroleid'] ?></td>-->
            <?php endforeach; ?></p>
    </div>

    </div>
    <table class="table table-bordered" style="position: absolute; background-color: white; width:60%" id="table">
        <thead>
        <tr>
            <th>Name</th>
           <th>Role</th>
        </tr>
        </thead>
        <tbody id="myTable" >
        <?php foreach ($users as $user): ?>
            <tr>
                <td><a href="user?name=<?php echo $user['name']?>"><?php echo $user['name'] ?><a/></td>
                <td><?php
                if ($user->userroleid==0) {
                  echo "Admin";
                }
                if ($user->userroleid==1) {
                  echo "Mod";
                }
                if ($user->userroleid==2) {
                  echo "User";
                }

                   ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        <button type="submit" name="updateRole">Update roles</button>
</div>

    <script>
        $(".pp").mouseup (function() {
          $("#liveSearch").css("visibility","hidden") }
        );
        $(document).ready(function() {
            $("#myInput").keyup(function() {
                // Retrieve the input field text
                var filter = $(this).val() ; var count=0;

                // Loop through the comment list
                $("div table tbody tr").each(function() {

                    // If the list item does not contain the text phrase fade it out
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {

                        $(this).fadeOut();

                        // Show the list item if the phrase matches
                    } else {
                        $(this).show();
                        count+=1;

                    }
                });


            });
        });
        $(document).ready(function() {
            $("#myInput").keyup(function() {
                $("#liveSearch").css("visibility", "visible")
                // Retrieve the input field text
                var filter = $(this).val(); var count=0;

                // Loop through the comment list
                $("div p").each(function() {

                    // If the list item does not contain the text phrase fade it out
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $("#liveSearch").css("visibility", "hidden")
                        $(this).fadeOut();

                        // Show the list item if the phrase matches
                    } else {
                        $(this).show();

                        count+=1;

                    }
                });


            });
        });
</script>
