<?php

use PHPUnit\Framework\TestCase;
use function Ntuple\FPL\tryCatch;
use function Ntuple\FPL\identity;
use function Ntuple\FPL\truth;


class ToolsTest extends TestCase
{
   public function test_simple_success()
   {
      $values = tryCatch( function (){ return 'ok';} );
      $this->assertEquals( [true, 'ok'], $values);
   }

    public function test_simple_failure()
    {
        $values = tryCatch( function (){ throw new Exception('failed');} );
        $this->assertEquals( false, $values[0]);
        $this->assertEquals( true, $values[1] instanceof Exception);
    }

    public function test_simple_failure_with_default_value()
    {
        $values = tryCatch( function (){ throw new Exception('failed');}, 0);
        $this->assertEquals( false, $values[0]);
        $this->assertEquals( 0, $values[1]);
    }

    public function test_identity()
    {
        $this->assertEquals( 0, identity(0) );
        $this->assertEquals( 'a', identity('a') );
        $this->assertEquals( NULL, identity(NULL) );
        $this->assertEquals( '', identity('') );
        $this->assertEquals( [], identity([]) );
    }

    public function test_truth()
    {
        $this->assertEquals( true, truth(1) );
        $this->assertEquals( false, truth([]) );
        $this->assertEquals( false, truth(null) );
        $this->assertEquals( false, identity('') );
    }
}