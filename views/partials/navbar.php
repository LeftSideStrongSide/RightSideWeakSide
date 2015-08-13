<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Adlister</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse Ads<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Furniture</a></li>
            <li><a href="#">Appliances</a></li>
            <li><a href="#">Entertainment</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">All Ads</li>
            <li><a href="#">Most Recent</a></li>
            <li><a href="#">Free</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/ads.create.php">Create Ad</a></li>
        <li><a href="/users.show.php">Profile</a></li>
        <li><a href="/auth.logout.php">Logout</a></li>

      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
