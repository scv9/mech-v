<?php
class ControllerTotalWediscountusergroups extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('total/wediscountusergroups');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		$this->load->model('setting/setting');
		$this->load->model('total/wediscountusergroups');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('wediscountusergroups', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        
		$this->data['discount_name'] = $this->language->get('discount_name');
		$this->data['discount_size'] = $this->language->get('discount_size');
		$this->data['discount_type'] = $this->language->get('discount_type');
		$this->data['discount_type_p'] = $this->language->get('discount_type_p');
		$this->data['discount_type_f'] = $this->language->get('discount_type_f');
		$this->data['discount_customer_group'] = $this->language->get('discount_customer_group');
		$this->data['discount_date_start'] = $this->language->get('discount_date_start');
		$this->data['discount_date_end'] = $this->language->get('discount_date_end');
		$this->data['discount_status'] = $this->language->get('discount_status');
		$this->data['discount_status_yes'] = $this->language->get('discount_status_yes');
		$this->data['discount_status_no'] = $this->language->get('discount_status_no');
					
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_total'),
			'href'      => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->data['insert'] = $this->url->link('total/wediscountusergroups/insert', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['wediscountusergroups_status'])) {
			$this->data['wediscountusergroups_status'] = $this->request->post['wediscountusergroups_status'];
		} else {
			$this->data['wediscountusergroups_status'] = $this->config->get('wediscountusergroups_status');
		}

		if (isset($this->request->post['wediscountusergroups_sort_order'])) {
			$this->data['wediscountusergroups_sort_order'] = $this->request->post['wediscountusergroups_sort_order'];
		} else {
			$this->data['wediscountusergroups_sort_order'] = $this->config->get('wediscountusergroups_sort_order');
		}
        
        $this->data['discounts'] = array();
        
        $results = $this->model_total_wediscountusergroups->getDiscounts();
        
        foreach($results as $row){
            
            $action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('total/wediscountusergroups/update', 'token=' . $this->session->data['token'] . '&discount_id=' . $row['id'], 'SSL')
			);
            
            $this->data['discounts'][] = $row + array(
                'action' => $action
            );
        }
        

		$this->template = 'total/wediscountusergroups.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
    
    public function update(){
		$this->load->language('total/wediscountusergroups');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('total/wediscountusergroups');
		$this->load->model('sale/customer_group');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_total_wediscountusergroups->editDiscount($this->request->get['discount_id'], $this->request->post);
			
			$this->redirect($this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();        
    }
    
    
    public function insert(){
		$this->load->language('total/wediscountusergroups');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('total/wediscountusergroups');
		$this->load->model('sale/customer_group');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_total_wediscountusergroups->addDiscount($this->request->post);
			
			$this->redirect($this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();        
    }
    
	public function delete() {
		$this->load->language('total/wediscountusergroups');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('total/wediscountusergroups');
		
		if ($this->validateDelete()) {
			$this->model_total_wediscountusergroups->deleteDiscount($this->request->get['discount_id']);
			
			$this->redirect($this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL'));
		}
          
	}
    
    private function getForm(){

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        
		$this->data['discount_name'] = $this->language->get('discount_name');
		$this->data['discount_size'] = $this->language->get('discount_size');
		$this->data['discount_type'] = $this->language->get('discount_type');
		$this->data['discount_type_p'] = $this->language->get('discount_type_p');
		$this->data['discount_type_f'] = $this->language->get('discount_type_f');
		$this->data['discount_customer_group'] = $this->language->get('discount_customer_group');
		$this->data['discount_date_start'] = $this->language->get('discount_date_start');
		$this->data['discount_date_end'] = $this->language->get('discount_date_end');
		$this->data['discount_status'] = $this->language->get('discount_status');
		$this->data['discount_status_yes'] = $this->language->get('discount_status_yes');
		$this->data['discount_status_no'] = $this->language->get('discount_status_no');
        
        $this->data['tab_general'] = $this->language->get('tab_general');
        
       	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_delete'] = $this->language->get('button_delete');

  		$this->data['token'] = $this->session->data['token'];
        
        
  		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

    	if (isset($this->request->get['discount_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$discount_info = $this->model_total_wediscountusergroups->getDiscount($this->request->get['discount_id']);
    	}

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
        
 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
        
 		if (isset($this->error['discount'])) {
			$this->data['error_discount'] = $this->error['discount'];
		} else {
			$this->data['error_discount'] = '';
		}
        
        
    	if (isset($this->request->post['name'])) {
      		$this->data['name'] = $this->request->post['name'];
    	} elseif (!empty($discount_info)) {
			$this->data['name'] = $discount_info['name'];
		} else {	
      		$this->data['name'] = '';
    	}
        
    	if (isset($this->request->post['discount'])) {
      		$this->data['discount'] = $this->request->post['discount'];
    	} elseif (!empty($discount_info)) {
			$this->data['discount'] = $discount_info['discount'];
		} else {	
      		$this->data['discount'] = '';
    	}
        
		if (isset($this->request->post['type'])) {
			$this->data['type'] = $this->request->post['type'];
		} elseif (!empty($discount_info)) {
			$this->data['type'] = $discount_info['type'];
		} else {
			$this->data['type'] = 'P';
		}
        
		if (isset($this->request->post['customer_group'])) {
			$this->data['customer_group'] = $this->request->post['customer_group'];
		} elseif (!empty($discount_info)) {
			$this->data['customer_group'] = $discount_info['customer_group'];
		} else {
			$this->data['customer_group'] = '';
		}

		if (isset($this->request->post['date_start'])) {
			$this->data['date_start'] = $this->request->post['date_start'];
		} elseif (!empty($discount_info)) {
			$this->data['date_start'] = $discount_info['date_start'];
		} else {
			$this->data['date_start'] = '';
		}
        
		if (isset($this->request->post['date_end'])) {
			$this->data['date_end'] = $this->request->post['date_end'];
		} elseif (!empty($discount_info)) {
			$this->data['date_end'] = $discount_info['date_end'];
		} else {
			$this->data['date_end'] = '';
		}
        
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($discount_info)) {
			$this->data['status'] = $discount_info['status'];
		} else {
			$this->data['status'] = 0;
		}
        
        
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_total'),
			'href'      => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
							
		if (!isset($this->request->get['discount_id'])) {
			$this->data['action'] = $this->url->link('total/wediscountusergroups/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('total/wediscountusergroups/update', 'token=' . $this->session->data['token'] . '&discount_id=' . $this->request->get['discount_id'], 'SSL');
            
			$this->data['action_delete'] = $this->url->link('total/wediscountusergroups/delete', 'token=' . $this->session->data['token'] . '&discount_id=' . $this->request->get['discount_id'], 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('total/wediscountusergroups', 'token=' . $this->session->data['token'], 'SSL');
        
        
		$this->template = 'total/wediscountusergroups_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
        
        
    }
    
	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'total/wediscountusergroups')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}
        
		if (!(intval($this->request->post['discount']))) {
			$this->error['discount'] = $this->language->get('error_discount');
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
    
	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'total/wediscountusergroups')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'total/wediscountusergroups')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
    
    public function install(){
        $this->db->query("CREATE TABLE `" . DB_PREFIX . "wediscountusergroups` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(255) NOT NULL,
                              `discount` decimal(15,4) NOT NULL,
                              `type` char(1) NOT NULL,
                              `customer_group` int(11) NOT NULL,
                              `date_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              `date_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                              `status` tinyint(1) NOT NULL DEFAULT '0',
                              PRIMARY KEY (`id`),
                              KEY `date_start` (`date_start`) USING BTREE,
                              KEY `date_end` (`date_end`) USING BTREE
                            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;");
    }
    
    public function unistall(){
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "wediscountusergroups`;");
    }
    
}
?>