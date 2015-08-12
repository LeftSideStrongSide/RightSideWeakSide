<?php 

require_once '../models/Ads.php';

$allAds = Ads::all()->attributes;

  //TODO: Grab ads from database to populate the columns as formatted below 
  // (foreach loop)
  
  //TODO: View details button takes to own page with full description
  //check out movies exercise for help with this

 ?>

<!-- TODO: include in index.php in main content container -->
<!-- TODO: add image with standard size -->

<div class="row">
  <?php foreach($allAds as $ad): ?>
    <div class="col-xs-6 col-lg-4">
      <img class="img-responsive" src="<?= $ad['image_url'] ?>" alt="ad image" width="100%" height="100%"> 
      <h2><?= $ad['item_name']; ?></h2>
      <p><?= $ad['description']; ?></p>
      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div><!--/.col-xs-6.col-lg-4-->
  <?php endforeach;?>
</div><!--/row-->