<!DOCTYPE html>
<html class="no-js" lang="en-us">
  <head>
    <meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]-->
    <title> | Lorenzo Wood Music</title>
    <meta name="description" content="BLAH BLAH BLAH BLAH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="stylesheet" href="/css/main.04132019.css">
  </head>
  <body><!--[if lt IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
      <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p><![endif]-->
    <header id="main-header">
      <h1 class="ir">Lorenzo Wood Music</h1>
      <div class="logo">
        <div style="width:100%; height:4em; background-color:black"></div>
        <input id="navigation" type="checkbox">
        <label class="hamburger" for="navigation">
          <div class="spinner diagonal part-1"></div>
          <div class="spinner horizontal"></div>
          <div class="spinner diagonal part-2"></div>
        </label>
        <nav class="page-menu">
          <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/photos/">Photos</a></li>
                    <li><a href="/videos/">Videos</a></li>
                    <li><a href="/booking/">Booking</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <main>
      <div>
        <?php
        require_once('../classes.php');
        $db = new DowncodeDB();
        $slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
        // Figure out something clever to display if no album specified; show all. maybe in columns?
        $albums = Array();
        if (empty($slug)) {
        	$albums = $db->allAlbums();
        } else {
        	$albums[] = $db->albumForSlug($slug);
        }
        foreach ($albums as $album) {
        ?>
        <div class="album">album</div><?php
        }
        ?>
      </div>
    </main>
    <?php
    $db->close();
    ?>
  </body>
</html>