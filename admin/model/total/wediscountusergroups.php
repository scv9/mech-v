<?php

class ModelTotalWediscountusergroups extends Model {
    
    public function getDiscounts(){
        
        $discounts = array();
        
        $table_customer_group = $this->getCustomerGroupTableName();
        
        $query = $this->db->query("SELECT
                                    	d.*,
                                    	cg.`name` AS customer_group_name
                                    FROM
                                    	" . DB_PREFIX . "wediscountusergroups AS d
                                    LEFT JOIN " . DB_PREFIX . $table_customer_group . " AS cg ON d.customer_group = cg.customer_group_id
                                    ORDER BY
                                    	d.`status` DESC,
                                    	d.id DESC");
        
        if ($query->num_rows) {
            $discounts = $query->rows;
        }
        
        return $discounts;
        
    }
    
	public function editDiscount($discount_id, $data) {
		$this->db->query("UPDATE 
                            `" . DB_PREFIX . "wediscountusergroups` 
                          SET 
                            `name`='".$this->db->escape($data['name'])."',
                            `discount`='".$this->db->escape($data['discount'])."',
                            `type`='".$this->db->escape($data['type'])."',
                            `customer_group`='".$this->db->escape($data['customer_group'])."',
                            `date_start`='".$this->db->escape($data['date_start'])."',
                            `date_end`='".$this->db->escape($data['date_end'])."',
                            `status`='".$this->db->escape($data['status'])."'
                          WHERE (`id`='".(int)$discount_id."')");
        
    }
    
    
	public function addDiscount($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "wediscountusergroups`(
                        	`name`,
                        	`discount`,
                        	`type`,
                        	`customer_group`,
                        	`date_start`,
                        	`date_end`,
                        	`status`
                        )
                        VALUES(
                    		'".$this->db->escape($data['name'])."',
                    		'".$this->db->escape($data['discount'])."',
                    		'".$this->db->escape($data['type'])."',
                    		'".$this->db->escape($data['customer_group'])."',
                    		'".$this->db->escape($data['date_start'])."',
                    		'".$this->db->escape($data['date_end'])."',
                    		'".$this->db->escape($data['status'])."'
                       	)");
        
    }
    
	public function deleteDiscount($discount_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "wediscountusergroups WHERE id = '" . (int)$discount_id . "'");
    }
    
    public function getDiscount($discount_id){
        
        $table_customer_group = $this->getCustomerGroupTableName();
        
        $query = $this->db->query("SELECT
                                    	d.*,
                                    	cg.`name` AS customer_group_name
                                    FROM
                                    	" . DB_PREFIX . "wediscountusergroups AS d
                                    LEFT JOIN " . DB_PREFIX . $table_customer_group ." AS cg ON d.customer_group = cg.customer_group_id
                                    WHERE d.id = '".(int)$discount_id."'"); 
        return $query->row;                             
                                
    }
    
    private function getCustomerGroupTableName(){
        $query_customer_group = $this->db->query("SELECT
                                                    	1
                                                    FROM
                                                    	`information_schema`.`TABLES`
                                                    WHERE
                                                    	TABLE_SCHEMA = '" . DB_DATABASE . "'
                                                    AND TABLE_NAME = '" . DB_PREFIX . "customer_group_description'");
                                                    
        if($query_customer_group->num_rows){
            return "customer_group_description";
        }else{
            return "customer_group";
        }        
    }
    
}


?>