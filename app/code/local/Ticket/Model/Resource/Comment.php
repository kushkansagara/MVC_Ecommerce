<?php

class Ticket_Model_Resource_Comment extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('ticket_comment', 'comment_id');
    }
}
?>