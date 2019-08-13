<?php

class ZealousWeb_BulkCategoryAssign_Model_System_Config_Source_Multiple_Values
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '1',
                'label' => 'Assign Categories',
            ),
            array(
                'value' => '2',
                'label' => 'Remove Categories',
            ),
        );
    }
}