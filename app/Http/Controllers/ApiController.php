<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Setmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ApiController extends Controller
{
    public function getItem(Request $request)
    {
        $shop_id = $request->shop_id;
        $price = $request->price;
        $title = $request->title;
        $items = Item::get();
        $results = [];
        foreach ($items as $item) {
            $query = Item::query();
            if (isset($shop_id)) {
                $query->where("shop_id", $shop_id);
            }
            if (isset($price)) {
                $query->where("price", $price);
            }
            if (isset($title)) {
                $query->where("name", "Like", "%" . $title . "%");
            }
            $aaa = $query->find($item->id);
            if ($aaa != null) {
                $results[] = $aaa;
            }
        }
        if (empty($results)) {
            return response()->json(["error" => "エラーが発生しました"], 404);
        }
        return response()->json($results);
    }
    public function getSet(Request $request)
    {
        $shop_id = $request->shop_id;
        $setmenus = Setmenu::get();
        $results = [];
        foreach ($setmenus as $set) {
            $query = Setmenu::query();
            if (isset($shop_id)) {
                $query->where("shop_id", $shop_id);
            }
            $aaa = $query->find($set->id);
            if ($aaa != null) {
                $results[] = $aaa;
            }
        }
        if (empty($results)) {
            return response()->json(["error" => "エラーが発生しました"], 404);
        }
        return response()->json($results);
    }
    public function postOrder(Request $request)
    {
        if (isset($request->address)) {
            $address = $request->address;
            $item_id = $request->item_id;
            $sets_id = $request->sets_id;
            if (isset($request->item_id) && isset($request->sets_id)) {
                $item = Item::query()->find($item_id)->id;
                $sets = Setmenu::query()->find($sets_id)->id;
                Order::query()->create([
                    "item_id" => $item,
                    "sets_id" =>  $sets,
                    "address" => $address,
                ]);
                return response()->json(["message" => "登録されました"], 201);
            } else if (isset($request->item_id)) {
                $item = Item::query()->find($item_id)->id;
                Order::query()->create([
                    "item_id" => $item,
                    "sets_id" =>  null,
                    "address" => $address,
                ]);
                return response()->json(["message" => "登録されました"], 201);
            }else if (isset($request->sets_id)) {
                $sets = Setmenu::query()->find($sets_id)->id;
                Order::query()->create([
                    "item_id" => null,
                    "sets_id" =>  $sets,
                    "address" => $address,
                ]);
                return response()->json(["message" => "登録されました"], 201);
            }
            return response()->json(["error" => "エラーが発生しました"], 404);
        }
        return response()->json(["error" => "エラーが発生しました"], 404);
    }
}
