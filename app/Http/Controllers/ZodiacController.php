<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZodiacRequest;
use Exception;
use Illuminate\Http\Request;

class ZodiacController extends Controller
{
    public function zodiacPredictor(ZodiacRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $name = $validatedData['name'];
            $lastName = $validatedData['lastName'];
            $birthDate = $validatedData['birthDate'];
            $wish = $validatedData['wish'];

            list($year, $month, $day) = explode('-', $birthDate);

            if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
                $zodiacSign = 'Aries';
            } elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
                $zodiacSign = 'Tauro';
            } elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
                $zodiacSign = 'Géminis';
            } elseif (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) {
                $zodiacSign = 'Cáncer';
            } elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
                $zodiacSign = 'Leo';
            } elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
                $zodiacSign = 'Virgo';
            } elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
                $zodiacSign = 'Libra';
            } elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
                $zodiacSign = 'Escorpio';
            } elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
                $zodiacSign = 'Sagitario';
            } elseif (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
                $zodiacSign = 'Capricornio';
            } elseif (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
                $zodiacSign = 'Acuario';
            } elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
                $zodiacSign = 'Piscis';
            }

            if (strlen($zodiacSign) > 5) {
                $prediction = 'Tu deseo se cumplirá.';
            }

            return response()->json([
                'success' => true,
                'message' => 'Your zodiac sign has been calculated successfully',
                'data' => ['Name' => $name, 'Last name' => $lastName, 'Date of birth:' => $birthDate, 'Zodiac Sign' => $zodiacSign, 'Wish' => $prediction],
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
