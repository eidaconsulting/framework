<?php
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase {

    public function testMyAll($options, $egalites, $orderBy){
        $this->assertIsArray($options);
    }
    
}
