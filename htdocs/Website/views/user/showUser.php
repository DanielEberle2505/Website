<!-- die view vom showUser-->

<div class="panel-default" style>
  <div class="row justify-content-md-center">
    <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
        <?php echo $user->name;?>
    </div>
  </div>
    <form method="post">
      <div class="row justify-content-md-center">
        <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
          <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="roleButton">
      <?php
      if(isset($user->userroleid)) {
          if ($user->userroleid==0) {
            echo "Admin";
          }
          elseif ($user->userroleid==1) {
            echo "Mod";
          }
          elseif ($user->userroleid==2){
          echo "User";
        }
      }?>
    <span class="caret"></span></button>
    <ul class="dropdown-menu">

      <li><input type="radio" name="roles" value="Admin" id="Admin" style="display:none"><label for="Admin">Admin</label><br></li>

      <li><input type="radio" name="roles" value="Mod" id="Mod" style="display:none"><label for="Mod">Mod</label><br></li>

      <li><input type="radio" name="roles" value="User" id="User" style="display:none"><label for="User">User</label><br></li>

    </ul>

  </div>
    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
    <button class="btn btn-info" type="submit" name="changeRoleButton" style="margin-top:20%">Change Userrole</button>
  </form>
</div>
</div>



<script>
const output = document.getElementById('role');
const radioButtons = document.querySelectorAll('input[name="roles"]');
for(const radioButton of radioButtons){
            radioButton.addEventListener('change', showSelected);
        }
        function showSelected(e) {
        console.log(e);
        if (this.checked) {

            document.querySelector('#roleButton').innerHTML = this.id.concat("<span class='caret'></span>");
        }
    }
</script>
