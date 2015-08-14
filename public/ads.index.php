<?php 

require_once '../bootstrap.php';
$allAds = [];
if(!empty(Ads::all()->attributes)){
  $allAds = Ads::all()->attributes;
}

  //TODO: Grab ads from database to populate the columns as formatted below 
  // (foreach loop)
  
  //TODO: View details button takes to own page with full description
  //check out movies exercise for help with this

 ?>

<!-- TODO: include in index.php in main content container -->
<!-- TODO: add image with standard size -->

<div class="row">
  <?php foreach($allAds as $ad): ?>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <img class="img-responsive img-thumbnail " src="<?= $ad['image_url'] ?>" alt="ad image">
      <h2><?= $ad['item_name']; ?></h2>
      <p><?= $ad['description']; ?></p>
      <p>$<?= $ad['price']; ?></p>
      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div><!--/.col-xs-6.col-lg-4-->
  <?php endforeach;?>
</div><!--/row-->