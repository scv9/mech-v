<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9 color-fix'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12 color-fix'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php if ($orders) { ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left"><?php echo $column_created_at; ?></td>
              <td class="text-right"><?php echo $column_vehicle_num; ?></td>
              <td class="text-center"><?php echo $column_photos; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order) { ?>
            <tr>
              <td class="text-left"><?php echo $order['created_at']; ?></td>
              <td class="text-right"><?php echo $order['vehicle_num']; ?></td>
              <td class="text-center">
                <?php foreach ($order['photos'] as $photo){ ?>
                  <a class="example-image-link" href="/image/uploads/photos/<?php echo $photo['photo']; ?>"
                     data-lightbox="example-set-<?php echo $order['created_at'] ?>-<?php echo $order['vehicle_num'] ?>"
                     data-title="<?php echo $photo['caption']; ?>">
                    <img height="75px" class="example-image" src="/image/uploads/photos/<?php echo $photo['photo']; ?>" alt=""/></a>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="text-right"><?php echo $pagination; ?></div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
  <script src="catalog/view/theme/default/js/lightbox.min.js"></script>
</div>
<?php echo $footer; ?>