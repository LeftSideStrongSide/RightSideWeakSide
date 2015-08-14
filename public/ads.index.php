<?php 

  require '../bootstrap.php';
  $offset = Input::get('pageNum');
  $offset = ($offset - 1) * 6;
  if(!empty(Input::get('search'))){
    $allAds = [];
    if(!empty(Ads::search(Input::get('search'))->attributes)){
      $allAds = Ads::search(Input::get('search'))->attributes;
    }
  }else{
    $allAds = [];
    if(!empty(Ads::paginate($offset))){
      $allAds = Ads::paginate($offset);
    }
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
      <div id="picture_holder">
        <img class="img-responsive img-thumbnail" src="<?= $ad['image_url'] ?>" alt="ad image">
      </div>
      <h2><?= $ad['item_name']; ?></h2>
      <p>$<?= $ad['price']; ?></p>
      <p><a class="btn btn-default" href="ads.show.php?details=<?= $ad['id'] ?>" role="button">View details &raquo;</a></p>
    </div><!--/.col-xs-6.col-lg-4-->
  <?php endforeach;?>
</div><!--/row-->