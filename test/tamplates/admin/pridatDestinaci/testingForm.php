<?php

namespace SebastianBergmann\Money;

use PHPUnit\Framework\TestCase;

class testingForm extends \TestCase
{
    public function firsTest(){
        $name = new Name("Honza");
        $result = $name->name();
        $this->assertEquals("Honza",$result);
    }
}

