<?php
  use core\helpers\session\FlashMessage;
  use core\helpers\session\Auth;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
  </head>

  <body>



    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
       <h5 class="font-weight-normal" id="headericon"><a href="/">My Blog</a></h5>
       <div class="navbar-nav-scroll my-0  mr-md-auto">
        <ul class="navbar-nav bd-navbar-nav flex-row">
          <?php if (Auth::isLogged()): ?>
            <li class="nav-item"><a href="/articles/create">Neuer Eintrag</a></li>
          <?php endif; ?>
          <li class="nav-item"><a href="/site/imprint">Impressum</a></li>
        </ul>
       </div>
       <?php if (Auth::isLogged()): ?>
          <b class="p-2 text-dark"><?=  Auth::user()['name']; ?></b>
          <a class="btn btn-outline-primary" href="/logout">logout</a>
       <?php else: ?>
         <a class="btn btn-outline-primary" href="/login">login</a>
       <?php endif; ?>
     </div>
     <div class="container">
        <?php 
          $flashMessages = FlashMessage::show();
          if($flashMessages):
            foreach ($flashMessages as $type => $flashMessage):
        ?>
            <div class="alert alert-<?php 
                                        if ($type == 'success')
                                          echo 'success'; 
                                        elseif($type == 'error')
                                          echo 'danger'; 
                                        else
                                          echo 'warning'; 
                                    ?>" role="alert">
                <?= $flashMessage ?>
            </div>
        <?php
            endforeach;
          endif;
        ?>
     </div>