<?php if (count($languages) > 1) { ?>
<div class="pull-left">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language" style="float: left;">
  <div class="btn-group">
    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
    <?php foreach ($languages as $language) { ?>
    <?php if ($language['code'] == $code) { ?>
    <img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
    <?php } ?>
    <?php } ?>
    <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_language; ?></span> <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
      <?php foreach ($languages as $language) { ?>
      <li><a href="<?php echo $language['code']; ?>"><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
<div id="logo">
          <a href="/" style="float:left; margin-right: -120px;"><img src="../image/catalog/logo.png" title="Мехатроник-Волга" alt="Мехатроник-Волга" class="img-responsive" style="width: 49%;"/></a>
		  <a href="http://mechatronics.by/" style="float:right; margin-right: -170px; padding-top:5px;" ><img src="../image/catalog/logoby.png" title="Мехатроника" alt="Мехатроника" class="img-responsive" style="width:43%;"/></a>
        </div>
</div>
<?php } ?>
