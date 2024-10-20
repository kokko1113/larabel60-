<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Relation;
use App\Models\Setmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetmenuController extends Controller
{
    public function index()
    {
        $items = Relation::query()->get();
        return view("setmenu.index", compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::get();
        return view("setmenu.create", compact("items"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "item_name" => "required",
            "name" => "required",
        ], [
            "item_name.required" => "エラーが発生しました",
            "name.required" => "エラーが発生しました",
        ]);
        $set_menu = Setmenu::query()->create([
            "shop_id" => Auth::id(),
            "name" => $request->name,
        ]);
        $item_id = [];
        foreach ($request->item_name as $name) {
            $item_id[] = Item::query()->where("name", $name)->first()->id;
        }
        foreach ($item_id as $id) {
            Relation::query()->create([
                "setmenu_id" => $set_menu->id,
                "item_id" => $id,
            ]);
        }
        return redirect(route("setmenu_create"))->with(["message" => "商品情報が登録されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $relation = Relation::query()->find($id);
        $items = Item::get();
        return view("setmenu.edit", compact("items", "relation"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "item_name" => "required",
            "name" => "required",
        ], [
            "item_name.required" => "エラーが発生しました",
            "name.required" => "エラーが発生しました",
        ]);
        $relation = Relation::query()->find($id);
        $prev_set=Setmenu::query()->find($relation->setmenu->id);
        $prev_sets=Setmenu::query()->where("name",$prev_set->name)->get();
        foreach($prev_sets as $set){//セットメニューの名称の更新
            $set->update([
                "name"=>$request->name,
            ]);
        }
        $item_id=Item::query()->where("name",$request->item_name)->first()->id;
        $relation->update([
           "item_id"=> $item_id,
        ]);
        return redirect(route("setmenu_edit", $relation->id))->with(["message" => "商品情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Relation::query()->find($id);
        $setmenu=Setmenu::query()->where("id",$item->setmenu->id)->first();
        $setmenu->delete();
        $item->delete();
        return redirect(route("setmenu_index"));
    }
}
