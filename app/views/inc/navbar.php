<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
  <a class="navbar-brand" href="<?=URLROOT?>"><?=SITENAME?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse text-center justify-content-between" id="navbarSupportedContent">
    <ul class="navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link" href="<?=URLROOT?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=URLROOT.'/pages/about'?>">About</a>
      </li>
    </ul>
     <ul class="navbar-nav">
     <?php if(isset($_SESSION['user_id'])):?> 
      <li class='nav-item'>
         <a class='nav-link' href='#'>  <?= $_SESSION['user_name']?></a>
      </li>
      <li class="nav-item ">
         <a class="nav-link" href="<?=URLROOT.'/users/logout'?>">Logout</a>
       </li>
      <?php else :?>
        <li class="nav-item ">
           <a class="nav-link" href="<?=URLROOT.'/users/register'?>">Rigester</a>
         </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=URLROOT.'/users/login'?>">Login</a>
      </li>
      <?php endif;?>
    </ul>
  </div>
  </div>
</nav>

