<?php

namespace Tests;

use App\ArrayRand;
use PHPUnit\Framework\TestCase;

class ArrayRandTest extends TestCase
{
    /** @test */
    public function it_gets()
    {
      $result =  (new ArrayRand())->get(1000);

      $this->assertCount(6, $result);
      $this->assertEquals(1000, array_sum($result));

      print_r($result);
    }
}
