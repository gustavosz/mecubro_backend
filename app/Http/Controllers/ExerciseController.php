<?php

namespace App\Http\Controllers;

use App\Repositories\ExerciseRepository;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    private $repository;

    public function __construct(ExerciseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $numbers = array();

        $number_x = 0;

        if (!empty($numbers) && !empty($number_x)) {

            $result = $this->repository->functionNumbers($numbers, $number_x);

            $statistics = $this->repository->getStatistics();

            return view('exercise', compact('numbers', 'number_x', 'result', 'statistics'));
        }
    }
}
