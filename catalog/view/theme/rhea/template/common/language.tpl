<?php if (count($languages) > 1) { ?>
<div class="pull-left">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language" class="langcur">
  <div class="btn-group">
    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <?php foreach ($languages as $language) { ?>
      <?php if ($language['code'] == $code) { ?>
      <span class="language-name"><?php echo $language['name']; ?></span>
      <?php } ?>
    <?php } ?>
    <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
      <span></span>
      <?php foreach ($languages as $language) { ?>
      <li><a href="<?php echo $language['code']; ?>" class="currency-select btn btn-link btn-block"><?php echo $language['name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
