<?php

class ZealousWeb_BulkCategoryAssign_Model_System_Config_Source_Dropdown_Values
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '1',
                'label' => 'Yes',
            ),
            array(
                'value' => '0',
                'label' => 'No',
            ),
        );
    }
}