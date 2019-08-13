<?php
/**
 * ChangeAttributeSet Controller
 *
 * @package    ZealousWeb
 * @author     ZealousWeb
 */
class ZealousWeb_BulkCategoryAssign_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Remove product(s) category action
     */
    public function massRemovecategoryAction()
    { 
        $productIds = explode(",",$this->getRequest()->getParam('product_ids'));
        $storeId    = (int)$this->getRequest()->getParam('store', 0);
        $assigncategory = (array)$this->getRequest()->getParam('cat_checkbox');
        
        if (!is_array($productIds)) {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        } else {
            if (!empty($productIds)) {
                try {
                    foreach ($productIds as $productId) {
                        $cats = array();
                        $cats = Mage::getModel('catalog/product')->load($productId)->getCategoryIds();
                        $cats = array_diff($cats, $assigncategory);
                        
                        # Check for categories exist, if exist then remove it.                  
                        $product = Mage::getModel('catalog/product')
                                ->setStoreId($storeId) //set store id
                                ->load($productId)
                                ->setCategoryIds(array($cats)) //remove product to categories
                                ->save();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Mage_Core_Model_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                } catch (Mage_Core_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                } catch (Exception $e) {
                    $this->_getSession()
                        ->addException($e, $this->__('An error occurred while removing the categories. Please try again.'));
                }
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Update product(s) category action
     *
     */
    public function massAssigncategoryAction()
    { 
        $productIds     = explode(",",$this->getRequest()->getParam('product_ids'));
        $storeId        = (int)$this->getRequest()->getParam('store', 0);
        $assigncategory = (array)$this->getRequest()->getParam('cat_checkbox');
        
        try {
            $product = Mage::getModel('catalog/product');
            foreach($productIds as $productId):
                $cats = array();
                $cats = Mage::getModel('catalog/product')->load($productId)->getCategoryIds();
                # Don't double categories
                if($cats[0]==1):
                    $allcats = $assigncategory;
                else:
                    $allcats = array_merge($cats, $assigncategory);
                endif;
                $product = Mage::getModel('catalog/product')
                            ->setStoreId($storeId) //set store id
                            ->load($productId)
                            ->setCategoryIds(array($allcats)) //assign product to categories
                            ->save();
            endforeach;
            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($productIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while assiging the categories. Please try again.'));
        }

        $this->_redirect('*/*/', array('store'=> $storeId));
    }
}
