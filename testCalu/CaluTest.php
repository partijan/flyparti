<?php
class CaluTest extends SebastianBergmann\PHPUnit{
    private $calu;
    
    protected function setUp(){
        $this->calu = new Calu();    
    }
    public function testNasobeni(){
        $this->assertEquals(16,  $this->calu->nasobeni(4, 4),"Spatne nauc se nasobit :o)");
    }
    public function testDeleni() {
        $this->assertEquals(4, $this->calu->deleni(16, 4),"Chyba vrat se zpatky do prvni tridy :o)");
    }
}

