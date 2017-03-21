<?php
class ControllerAgooFormsForms extends Controller
{
	private $error = array();
	protected  $data;

	public function index($data)
	{
		$this->data = $data;
		$ver = VERSION;
 		if (!defined('SCP_VERSION')) define('SCP_VERSION', $ver[0]);
        $this->data['forms_template'] = 'agoo/treecomments/treecomments.tpl';
       	$this->language->load('agoo/forms/forms');


$anchor_tab_bootstrap=<<<EOF
if ($('a[href=\'#tab-review\']').closest('li').length) {
	$('a[href=\'#tab-review\']').closest('li').remove();
} else { $('a[href=\'#tab-review\']').remove(); }
$('#tab-review').remove();
$('#cmswidget-'+cmswidget).remove();
tabs = $('.nav-tabs').children().length;
data = $(data).html();
$('.nav-tabs').append('<li><a data-toggle=\'tab\' href=\'#tab-html-'+cmswidget+'\'>'+heading_title+'</a></li>');
$('.tab-content:first').append($(data).html());
if (tabs == 0 || $('.nav-tabs').children().filter('.active').length == 0) $('a[href$=\'#tab-html-'+cmswidget+'\']').click();
EOF;

$anchor_pills_bootstrap=<<<EOF
if ($('a[href=\'#tab-review\']').closest('li').length) {
	$('a[href=\'#tab-review\']').closest('li').remove();
} else { $('a[href=\'#tab-review\']').remove(); }
$('#tab-review').remove();
$('#cmswidget-'+cmswidget).remove();
tabs = $('.nav-pills').children().length;
data = $(data).html();
$('.nav-pills').append('<li><a data-toggle=\'tab\' href=\'#tab-html-'+cmswidget+'\'>'+heading_title+'</a></li>');
$('.tab-content:first').append($(data).html());
if (tabs == 0 || $('.nav-pills').children().filter('.active').length == 0) $('a[href$=\'#tab-html-'+cmswidget+'\']').click();
EOF;



$anchor_tab_default=<<<EOF
if ($('a[href=\'#tab-review\']').closest('li').length) {
	$('a[href=\'#tab-review\']').closest('li').remove();
} else { $('a[href=\'#tab-review\']').remove(); }
$('#tab-review').remove();
$('#cmswidget-'+cmswidget).remove();
tabs = $('#tabs').children().length;
data = $(data).html();
$('#tabs').append('<a data-toggle=\'tab\' href=\'#tab-html-'+cmswidget+'\'>'+heading_title+'</a>');
$('#tabs').after($(data).html());
$('#tabs a').each(function() {
   var obj = $(this);
   $(obj.attr('href')).hide();
   $(obj).unbind( 'click' );
});
$('#tabs a').tabs();
if (tabs == 0 || ($('.nav-tabs').children().filter('.active').length == 0 && $('#tabs').children().filter('.selected').length == 0)) {
setTimeout(function(){ $('a[href$=\'#tab-html-'+cmswidget+'\']').click();  }, 1000);
}
EOF;



if (SCP_VERSION > 1) {
	$anchor_tab = $anchor_tab_bootstrap;
} else {
	$anchor_tab = $anchor_tab_default;
}


if (SCP_VERSION > 1) {
$box_begin =<<<EOF
<div id="tab-html-{CMSWIDGET}" class="tab-pane">
	<div class="box" style="display: block">
		<div class="box-content bordernone">
EOF;
} else {
$box_begin =<<<EOF
<div id="tab-html-{CMSWIDGET}" class="tab-content tab-pane">
	<div class="box" style="display: block">
		<div class="box-content bordernone">
EOF;
}


$box_end =<<<EOF
		</div>
	</div>
</div>
EOF;

		if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['anchor'])) {
			$this->data['ascp_widgets'][$this->data['id']]['anchor'] = $anchor_tab;
			$this->data['ascp_widgets'][$this->data['id']]['box_begin'] = $box_begin;
			$this->data['ascp_widgets'][$this->data['id']]['box_end'] = $box_end;
		}

        if (!isset($this->data['id'])) {
         $this->data['id'] = false;
        }

		$this->data['ascp_settings'] = $this->config->get('ascp_settings');
		$this->data['config_language_id'] = $this->config->get('config_language_id');

		if (isset($this->data['ascp_settings']['comment_type'])) {
			$this->data['comment_type'] = $this->data['ascp_settings']['comment_type'];
		} else {
			$this->data['comment_type'] = array();
		}

		$this->data['comment_type'][0] = array(	'type_id' => '0',
					 							'title' => array ( $this->config->get('config_language_id') => $this->language->get('text_all_type_id'))
					 							);


		if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['anchor'])) {
			$this->data['ascp_widgets'][$this->data['id']]['anchor'] = $anchor_tab;
		}

		if (isset($this->data['id']) && !isset($this->data['ascp_widgets'][$this->data['id']]['name_status'])) {
			$this->data['ascp_widgets'][$this->data['id']]['name_status'] = true;
		}

$this->data['ascp_widgets'][$this->data['id']]['anchor_templates'] = array(

$this->language->get('entry_anchor_templates_tab') =>$anchor_tab,

$this->language->get('entry_anchor_templates_tab_bootstrap') =>$anchor_tab_bootstrap,

$this->language->get('entry_anchor_templates_pills_bootstrap') =>$anchor_pills_bootstrap,

$this->language->get('entry_anchor_templates_html') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').html(data);",

$this->language->get('entry_anchor_templates_prepend') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').prepend(data);",

$this->language->get('entry_anchor_templates_append') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').append(data);",

$this->language->get('entry_anchor_templates_before') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').before(data);",

$this->language->get('entry_anchor_templates_after') => "$('#cmswidget-'+cmswidget).remove();
data = $(data).html();
$('".$this->language->get('text_anchor_templates_selector')."').after(data);",

$this->language->get('entry_anchor_templates_clear') => ""
);

if (SCP_VERSION > 1) {
$this->data['ascp_widgets'][$this->data['id']]['box_begin_templates'] = array(

$this->language->get('entry_box_begin_templates_tab') => $box_begin,
$this->language->get('entry_box_begin_templates_empty') => '<div>',
$this->language->get('entry_anchor_templates_clear') => ""
);
} else {

$this->data['ascp_widgets'][$this->data['id']]['box_begin_templates'] = array(
$this->language->get('entry_box_begin_templates_tab') => $box_begin,
$this->language->get('entry_box_begin_templates_empty') => '<div>',
$this->language->get('entry_anchor_templates_clear') => ""
);

}


$this->data['ascp_widgets'][$this->data['id']]['box_end_templates'] = array(
$this->language->get('entry_box_end_templates_tab') => $box_end,
$this->language->get('entry_box_end_templates_empty') => '</div>',
$this->language->get('entry_anchor_templates_clear') => ""
);

        return $this->data;
	}
}
?>