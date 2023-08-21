<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Http\Resources\WishlistCollection;
use App\Http\Controllers\Api\BaseController as BaseController;

class WishlistController  extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $wishlists = Wishlist::with('seller')->paginate(config('app.paginate'));
    
        return $this->sendResponse(new WishlistCollection($wishlists), '');
    }

    public function show(Request $request, $id): JsonResponse
    {
        $wishlist = Wishlist::with('seller')->firstOrFail();
     
        return $this->sendResponse(new WishlistResource($wishlist), '');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'price' => 'required|numeric',
            'seller_id' => 'required|exists:sellers,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);       
        }
   
        $data = $request->all();
 
        $wishlist = Wishlist::create($data);

        return $this->sendResponse(new WishlistResource($wishlist), 'wishlist created successfully.');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'price' => 'required|numeric',
            'seller_id' => 'required|exists:sellers,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);       
        }
   
        $data = $request->all();
 
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->update($data);

        return $this->sendResponse(new WishlistResource($wishlist), 'wishlist updated successfully.');
    }

    public function totalPriceItems(Request $request): JsonResponse
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $total_price = Wishlist::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->sum('price');

        return $this->sendResponse(['total_price' => $total_price], '');
    }

    public function averagePriceItems(Request $request): JsonResponse
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $total_price = Wishlist::sum('price');
        $count_items = Wishlist::count();

        $average_price = $count_items ? round($total_price / $count_items, 2) : 0;


        return $this->sendResponse(
            ['total_price' => $total_price, 'count_items' => $count_items, 'average_price' => $average_price],
        '');
    }
}

