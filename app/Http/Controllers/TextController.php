<?php

namespace App\Http\Controllers;

use App\Http\Requests\TextRequest;
use Exception;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function textComparator(TextRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $textA = $validatedData['textA'];
            $textB = $validatedData['textB'];
            if (strlen($textA) > strlen($textB)) {
                $largerText = 'El texto A es más largo';
            } elseif (strlen($textB) > strlen($textA)) {
                $largerText = 'El texto B es más largo';
            } elseif (strlen($textB) == strlen($textA)) {
                $largerText = 'Los textos son igual de largos.';
            }

            return response()->json([
                'success' => true,
                'message' => 'Larger text calculated successfully',
                'data' => ['Larger text' => $largerText],
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
