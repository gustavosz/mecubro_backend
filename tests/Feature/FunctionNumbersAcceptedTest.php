<?php

namespace Tests\Feature;

use App\Result;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FunctionNumbersAcceptedTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testFunctionNumbersAccepted()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $numbers = array(13,3,1,9,5,22,12,-12);
        $number_x = 13;

        $this->assertIsArray($numbers);
        $this->assertNotNull($numbers);
        $this->assertNotNull($number_x);

        $this->assertIsArray($this->functionNumbers($numbers, $number_x));
        $this->assertDatabaseHas('results', [
            'result' => 1
        ]);
    }

    private function functionNumbers(array $numbers, int $number_x)
    {
        foreach ($numbers as $index => $number) {

            $numbers2 = $numbers;

            array_splice($numbers2, $index, 1);

            foreach ($numbers2 as $value) {

                if (($number + $value) === $number_x) {

                    $this->assertSame(($number + $value), $number_x);

                    $this->createResult2(1);

                    return [$number, $value];
                }
            }
        }
        $this->createResult2(0);

        return false;
    }

    private function createResult2(int $result) : void
    {
        $this->assertSame($result, 1);

        Result::create([
            'result' => $result
        ]);
    }
}
