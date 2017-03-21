<?php
class ModelTotalWediscountusergroups extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
	   
        $this->load->model('checkout/wediscountusergroups');
        
        $discount_info = $this->model_checkout_wediscountusergroups->getDiscountByCustomerGroupId($this->customer->getCustomerGroupId());
        
        if(is_array($discount_info) && !empty($discount_info)){
            
            $sub_total = $this->cart->getSubTotal();
            
            if($discount_info['type'] == 'P'){
                $discount_total = $sub_total / 100 * $discount_info['discount'];
            }else{
                $discount_total = $discount_info['discount'];
            }
            
            $discount_total = min($discount_total, $sub_total);
            
    		$total_data[] = array(
    			'code'       => 'wediscountusergroups',
    			'title'      => $discount_info['name'],
    			'text'       => $this->currency->format(-$discount_total),
    			'value'      => -$discount_total,
    			'sort_order' => $this->config->get('wediscountusergroups_sort_order')
    		);
            
            $total -= $discount_total;
        
        }
        
	}
	
	public function confirm($order_info, $order_total) {
					
	}
}
?>