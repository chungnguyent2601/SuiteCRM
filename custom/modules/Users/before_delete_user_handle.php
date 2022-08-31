<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
class before_delete_user_handle
{
    public $module = 'Users';
    public function before_delete_user_handle($bean, $event, $arguments)
    {
        $id = $bean->id;
        $query_total_quantity_leads= "SELECT COUNT(*) AS total FROM quantity_leads WHERE user_id = '{$id}'";
        $result_total_quantity_leads = $GLOBALS['db']->query($query_total_quantity_leads);
        $total_quantity_leads = $GLOBALS['db']->fetchByAssoc($result_total_quantity_leads);
        if ($total_quantity_leads['total'] > 0){
            $query_quantity_leads = "DELETE FROM quantity_leads WHERE user_id = '{$id}'";
            $GLOBALS['db']->query($query_quantity_leads);
        }
    }
}