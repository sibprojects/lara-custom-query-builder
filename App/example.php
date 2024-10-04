<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $Products = Product::query()
            ->wherePublished()
            ->when($request->ownerId, fn($query) => $query->whereOwner(User::find($request->ownerId)))
            ->when($request->fromPrice, fn($query) => $query->wherePriceBetween($request->fromPrice, $request->toPrice))
            ->orderByRatings()
            ->get();

        return response()->json($Products);
    }

    public function popular(): JsonResponse
    {
        $Products = Product::mostPopular(5)->get();

        return response()->json($Products);
    }

    public function publish(Product $Product): JsonResponse
    {
        $Product->publish();

        return response()->json(['status' => 'success']);
    }
}
