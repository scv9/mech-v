<?php echo $header; ?>
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
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
        <?php if(isset($action_delete)){ ?>
        <a onclick="location = '<?php echo $action_delete; ?>';" class="button"><?php echo $button_delete; ?></a>
        <?php } ?>
        <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $discount_name; ?></td>
              <td><input type="text" name="name" value="<?php echo $name; ?>" maxlength="255" size="100" />
                <?php if ($error_name) { ?>
                <span class="error"><?php echo $error_name; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $discount_size; ?></td>
              <td><input type="text" name="discount" value="<?php echo $discount; ?>" maxlength="255" size="100" />
                <?php if ($error_discount) { ?>
                <span class="error"><?php echo $error_discount; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $discount_type; ?></td>
              <td><select name="type">
                  <?php if ($type == 'P') { ?>
                  <option value="P" selected="selected"><?php echo $discount_type_p; ?></option>
                  <option value="F"><?php echo $discount_type_f; ?></option>
                  <?php } else { ?>
                  <option value="P"><?php echo $discount_type_p; ?></option>
                  <option value="F" selected="selected"><?php echo $discount_type_f; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $discount_customer_group; ?></td>
              <td><select name="customer_group">
                  <?php foreach($customer_groups as $group){ ?>
                    <?php if ($group['customer_group_id'] == $customer_group) { ?>
                    <option value="<?php echo $group['customer_group_id'] ?>" selected="selected"><?php echo $group['name'] ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $group['customer_group_id'] ?>"><?php echo $group['name'] ?></option>
                    <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $discount_date_start; ?></td>
              <td><input type="text" name="date_start" value="<?php echo $date_start ?>" size="20" class="date_start" /></td>
            </tr>
            <tr>
              <td><?php echo $discount_date_end; ?></td>
              <td><input type="text" name="date_end" value="<?php echo $date_end ?>" size="20" class="date_end" /></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $discount_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>

          </table>
        </div>
      </form>
    </div>
  </div>
</div>
 
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date_start, .date_end').datetimepicker({
    	dateFormat: 'yy-mm-dd',
    	timeFormat: 'hh:mm:ss'
    });
});
//--></script> 
<?php echo $footer; ?>