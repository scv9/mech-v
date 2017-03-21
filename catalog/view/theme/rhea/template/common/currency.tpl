<?php if (count($currencies) > 1) { ?>
<div>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="currency" class="langcur">
  <div class="btn-group">
    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <?php foreach ($currencies as $currency) { ?>
	    <?php if ($currency['code'] == $code) { ?>
	    <span class="currency-title"><?php echo $currency['title']; ?></span>
	    <?php } ?>
    <?php } ?>
    <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
			<span></span>
      <?php foreach ($currencies as $currency) { ?>
      <?php if ($currency['code']) { ?>
      <li><button class="currency-select btn btn-link btn-block" type="button" name="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></button></li>
      <?php } ?>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
