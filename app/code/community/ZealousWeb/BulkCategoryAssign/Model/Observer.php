<?php
/**
 * Observer Model
 */
class ZealousWeb_BulkCategoryAssign_Model_Observer
{
	/**
	 * add Massaction Option to Productgrid
	 * 
	 * @param $observer Varien_Event
	 */
	public function addMassactionToProductGrid($observer)
	{
		$block = $observer->getBlock();
		if($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid){
			
			$sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
				->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
				->load()
				->toOptionHash();
                
            if(Mage::getStoreConfig('generaltab/general/dropdown')==1):
                $module_config = explode(",",Mage::getStoreConfig('generaltab/general/multiple'));
                /**
            	 * add assigncategory Option to Productgrid
            	 */
                 if((in_array(1, $module_config))):
                    $block->getMassactionBlock()->addItem('assigncategory', array(
                     'label'=> Mage::helper('catalog')->__('Assign Categories'),
                     'url'   => $block->getUrl('adminhtml/assigncat/index', array('_current'=>true,'act'=>'assign'))
                    ));
                 endif;           
                /**
            	 * add removecategory Option to Productgrid
            	 */
                 if((in_array(2, $module_config))):
                    $block->getMassactionBlock()->addItem('removecategory', array(
                         'label'=> Mage::helper('catalog')->__('Remove Categories'),
                         'url'   => $block->getUrl('adminhtml/assigncat/index', array('_current'=>true,'act'=>'remove'))
                    ));
                endif; 
            endif;                       		
		}
	}
	
}
