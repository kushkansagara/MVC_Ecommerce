<?php

class Ticket_Model_Resource_Ticket extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('ticket', 'ticket_id');
    }
}
?>