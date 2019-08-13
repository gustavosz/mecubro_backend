<?php


namespace App\Repositories;


use App\Result;

class ExerciseRepository
{

    public function functionNumbers(array $numbers, int $number_x)
    {
        foreach ($numbers as $index => $number) {

            $numbers2 = $numbers;

            array_splice($numbers2, $index, 1);

            foreach ($numbers2 as $value) {

                if (($number + $value) === $number_x) {

                    $this->createResult2(1);

                    return [$number, $value];
                }
            }
        }
        $this->createResult2(0);

        return false;
    }

    public function getStatistics() : Result
    {
        return Result::selectRaw(
            'COUNT(id) AS total,
            SUM(CASE WHEN result = 1 THEN 1 ELSE 0 END) as total_positivos,
            SUM(CASE WHEN result = 1 THEN 1 ELSE 0 END) / COUNT(id) as ratio_positivos'
        )->first();
    }

    private function createResult2(int $result) : void
    {
        Result::create([
            'result' => $result
        ]);
    }
}
