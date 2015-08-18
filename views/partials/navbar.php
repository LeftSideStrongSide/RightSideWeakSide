<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['PHP_SELF'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?><!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Adlister</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?=echoActiveClassIfRequestMatches("index")?> ><a href="index.php">Home</a></li>
        <li <?=echoActiveClassIfRequestMatches("about")?>><a href="about.php">About</a></li>
        <li <?=echoActiveClassIfRequestMatches("contact")?>><a href="contact.php">Contact</a></li>
        <!-- <li> -->

<!--        Search just aint workin'.
            <form action="index.php">
              <input style="margin-top: 12px" placeholder=" Search" name="search" type="text"><button style="height: 26px; width: 27px" class="glyphicon glyphicon-search" type="submit"></button>
            </form> -->
        <!-- </li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li <?=echoActiveClassIfRequestMatches("ads.create")?> ><a href="/ads.create.php">Create Ad</a></li>
        <li <?=echoActiveClassIfRequestMatches("users.show")?> ><a href="/users.show.php">Profile</a></li>
        <li><a href="/auth.logout.php">Logout</a></li>

      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
