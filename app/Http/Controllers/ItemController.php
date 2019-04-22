<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use App\Item;
use App\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items')); //compactはこのviewで使えるようにするもの
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::listOfOptions();

        return view('items.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
//        Item::create([
//            'name' => $request->input('name'),
//        ]);

        $category = Category::find($request->input('category_id'));

        $category->items()->create([
            'name' => $request->input('name'),
        ]);


        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Item $item)
    {
        $categories = Category::listOfOptions();

        return view('items.edit', compact('item', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreRequest $request, Item $item)
        //requestは新たに送られてきたデータ（自分が今入力したもの）
        ////itemはidで取れるデータ全部 ex.id,name,created_at...etc
    {
//        $item->update([
//            'name' => $request->input('name'),
//        ]);


//        dd($item->name);
//        dd($request->input('name'));
        $request->validate([
            'name' => 'required|max:3', //ここでは入力必須、10文字以下と指定
        ]);

        $item->name = $request->input('name'); //送られてきたデータを$itemに上書きしてる

//        dd($item->name);

        $category = Category::find($request->input('category_id'));

//        dd($category);

        $category->items()->save($item); //ここはこうゆうものだと理解。 modelの所のfunction。


        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index');
    }
}
