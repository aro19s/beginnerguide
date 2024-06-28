<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumbersRequest;
use Exception;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function numberComparator(NumbersRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $number1 = $validatedData['number1'];
            $number2 = $validatedData['number2'];
            if ($number1>$number2) {
                $result = $number1;
            } else {
                $result = $number2;
            }

            return response()->json([
                'success' => true,
                'message' => 'Greater number calculated successfully',
                'data' => ['greaterNumber' => $result],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
