<?php
require_once 'core/init.php';//only needed here 
$user = new User();//User is created here because nav is used on every page. No need to create a user object for every page

if(!$user->isLoggedIn()){
   $message = "Please Log in First";
   echo "<script type='text/javascript'>alert('$message');</script>";


?>
<script>
 window.location='https://viaud-john-jviaud.c9users.io/Viaud_Project3/index.php';
</script>

<?php } 


?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="profile.php">Hello <?php echo $user->data()->username; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
   
    <ul class="navbar-nav">
      
      <li class="nav-item active">
        <a class="nav-link" href="leaderboard.php">Leaderboard<span class="sr-only">(current)</span></a>
      </li>
      
      
       <li class="nav-item active">
        <a class="nav-link" href="levels.php">Levels<span class="sr-only">(current)</span></a>
      </li>
    
    </ul>
  </div>
  <a class='btn btn-danger' href='scripts/logout.php'>Logout <i class="fas fa-sign-out-alt"></i></a>
 
</nav>