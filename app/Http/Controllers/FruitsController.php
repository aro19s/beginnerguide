<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fruits\supplyFruitRequest;
use App\Http\Requests\Fruits\BuyFruitRequest;
use App\Http\Requests\Fruits\CreateFruitRequest;
use App\Http\Requests\Fruits\FilterRequest;
use App\Http\Requests\Fruits\UpdateFruitRequest;
use App\Models\Fruits;
use Illuminate\Http\Request;

class FruitsController extends Controller
{
    public function showAll(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $fruit = Fruits::paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Fruits retrieved successfully',
                'data' => $fruit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function create(CreateFruitRequest $request)
    {
        try {
            $fruit = Fruits::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Fruit created successfully',
                'data' => $fruit
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $fruit = Fruits::find($id);

            if (!$fruit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fruit not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Fruit retrieved successfully',
                'data' => $fruit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function update(UpdateFruitRequest $request, $id)
    {
        try {
            $fruit = Fruits::find($id);

            if (!$fruit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fruit not found',
                    'data' => null
                ], 404);
            }

            $fruit->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Fruit updated successfully',
                'data' => $fruit
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $fruit = Fruits::find($id);

            if (!$fruit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fruit not found',
                    'data' => null
                ], 404);
            }

            $fruit->delete();
            return response()->json([
                'success' => true,
                'message' => 'Fruit deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function buyFruit(BuyFruitRequest $request, $id)
    {
        try {
            $fruit = Fruits::find($id);

            if (!$fruit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fruit not found',
                    'data' => null
                ], 404);
            }

            $validatedData = $request->validated();
            $amountToBuy = $validatedData['amount'];
            $existantAmount = $fruit->amount;

            if ($amountToBuy > $existantAmount){
                return response()->json([
                    'success' => false,
                    'message' => 'The fruit cannot be sold.',
                    'data' => null
                ], 500);
            } else {
                $totalAmount = $existantAmount - $amountToBuy;
                $fruit->amount = $totalAmount;
                $fruit->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Fruit sold successfully',
                    'data' => $fruit
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function supplyFruit(SupplyFruitRequest $request, $id)
    {
        try {
            $fruit = Fruits::find($id);

            if (!$fruit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fruit not found',
                    'data' => null
                ], 404);
            }

            $validatedData = $request->validated();
            $amountToSupply = $validatedData['amount'];
            $existantAmount = $fruit->amount;

            $totalAmount = $existantAmount + $amountToSupply;
            $fruit->amount = $totalAmount;
            $fruit->save();
            return response()->json([
                'success' => true,
                'message' => 'Fruit added successfully',
                'data' => $fruit
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function missingFruits()
    {
        try {
            $missingFruit = Fruits::where('amount', '<=', 5)->get();
            if (!$missingFruit->isEmpty()){
                return response()->json([
                    'success' => true,
                    'message' => 'Fruits to order:',
                    'data' => $missingFruit
                ], 200);
            } else{
                return response()->json([
                    'success' => true,
                    'message' => 'No fruits to order.',
                    'data' => null
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function vegetables()
    {
        try {
            $moreThanThree = Fruits::where(function ($query) {
                $query->where('type', 'vegetable')
                ->where('amount', '>', 3);
            })->get();
            return response()->json([
                'success' => true,
                'message' => 'Vegetables with more than 3 units in stock:',
                'data' => $moreThanThree
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function applesExistance()
    {
        try {
            $noApples = Fruits::where(function ($query) {
                $query->where('name', 'apple')
                ->where('amount', '=', 0);
            })->get();

            if ($noApples->isEmpty()){
                return response()->json([
                    'success' => true,
                    'message' => 'No',
                    'data' => null
                ], 200);
            } else{
                return response()->json([
                    'success' => true,
                    'message' => 'Yes',
                    'data' => null
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function productsFilter(FilterRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $amount = $validatedData['amount'];
            $perPage = 1;

            if ($amount == '1'){
                $lessThanThree = Fruits::where(function ($query) use ($validatedData){
                    $query->where('type', $validatedData['type'])
                    ->where('amount', '<=', 3);
                })->paginate($perPage);
                if ($lessThanThree->isEmpty()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'There are no less than 3 in stock.',
                        'data' => null
                    ], 200);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Less than 3 in stock:',
                    'data' => $lessThanThree
                ], 200);
            } elseif($amount == '2'){
                $moreThanTen = Fruits::where(function ($query) use ($validatedData){
                    $query->where('type', $validatedData['type'])
                    ->where('amount', '>=', 10);
                })->paginate($perPage);
                if ($moreThanTen->isEmpty()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'There are no more than 10 in stock.',
                        'data' => null
                    ], 200);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'More than 10 in stock:',
                    'data' => $moreThanTen
                ], 200);
            } else{
                $middleExistance = Fruits::where(function ($query) use ($validatedData){
                    $query->where('type', $validatedData['type'])
                    ->where('amount', '>', 3)
                    ->where('amount', '<', 10);
                })->paginate($perPage);
                if ($middleExistance->isEmpty()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'There are no more than three and less than 10 in stock.',
                        'data' => null
                    ], 200);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'More than three and less than 10 in stock:',
                    'data' => $middleExistance
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
