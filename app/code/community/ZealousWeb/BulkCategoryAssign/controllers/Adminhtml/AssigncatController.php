<?php
/**
 * Adminhtml controller
 *
 * @package    ZealousWeb
 * @author     ZealousWeb
 */
class ZealousWeb_BulkCategoryAssign_Adminhtml_AssigncatController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    { 
        $this->loadLayout();
        $this->renderLayout();
    }
}