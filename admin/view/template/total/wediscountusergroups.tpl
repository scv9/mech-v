<?php echo $header; ?>
<style type="text/css">
<!--
.list tbody tr.off td {
    color: dimGray;
}
-->
</style>

<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/total.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="wediscountusergroups_status">
                <?php if ($wediscountusergroups_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="wediscountusergroups_sort_order" value="<?php echo $wediscountusergroups_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
      
      <table class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $discount_name ?></td>
              <td class="left"><?php echo $discount_size ?></td>
              <td class="left"><?php echo $discount_type ?></td>
              <td class="left"><?php echo $discount_customer_group ?></td>
              <td class="left"><?php echo $discount_date_start ?></td>
              <td class="left"><?php echo $discount_date_end ?></td>
              <td class="left"><?php echo $discount_status ?></td>
              <td class="left"></td>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($discounts)) { ?>
            <?php foreach ($discounts as $discount) { ?>
            <tr class="<?php echo !!$discount['status'] ? 'on' : 'off'; ?>">
              <td class="left"><?php echo $discount['name'] ?></td>
              <td class="left"><?php echo $discount['discount'] ?></td>
              <td class="left">
                <?php echo $discount['type'] == 'P' ? $discount_type_p : $discount_type_f; ?>
              </td>
              <td class="left"><?php echo $discount['customer_group_name'] ?></td>
              <td class="left">
                <?php echo $discount['date_start']; ?>
              </td>
              <td class="left">
                <?php echo $discount['date_end']; ?>
              </td>
              <td class="left">
                <?php echo !!$discount['status'] ? $discount_status_yes : $discount_status_no; ?>
              </td>
              <td class="left"><?php foreach ($discount['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="buttons"><a onclick="location = '<?php echo $insert; ?>';" class="button"><?php echo $button_insert ?></a></div>
    </div>
  </div>
</div>
<?php echo $footer; ?>