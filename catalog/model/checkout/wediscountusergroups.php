<?php

class ModelCheckoutWediscountusergroups extends Model {
    
    public function getDiscountByCustomerGroupId($customer_group_id){
        $query = $this->db->query("SELECT
                                    	d.*
                                    FROM
                                    	" . DB_PREFIX . "wediscountusergroups AS d
                                    WHERE
                                    	d.`status` = 1
                                    AND(
                                    	(
                                    		'0000-00-00 00:00:00' = d.date_start
                                    		OR d.date_start < NOW()
                                    	)
                                    	AND(
                                    		d.date_end = '0000-00-00 00:00:00'
                                    		OR d.date_end > NOW()
                                    	)
                                    )
                                    AND d.customer_group = '".(int)$customer_group_id."'
                                    ORDER BY
                                    	d.id DESC
                                    LIMIT 1");
        return $query->row;
    }
    
}

?>