<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Item\StoreRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Item;

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
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $path = $request->image_url->store('public/storage'); //追加
        $category = Category::find($request->input('category_id'));
        $category->items()->create([
            'name' => $request->input('name'),
            'image_url' => $path,
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
        return view('items.show', compact('item'),['image_url'=> str_replace('public/', 'storage/', $item->image_url)
        ]);
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
        return view('items.edit', compact('item', 'categories'),['image_url'=> str_replace('public/', 'storage/', $item->image_url)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Item $item)
        //requestは新たに送られてきたデータ（自分が今入力したもの）
        ////itemはidで取れるデータ全部 ex.id,name,created_at...etc
    {
        $item->name = $request->input('name'); //送られてきたデータを$itemに上書きしてる
        $category = Category::find($request->input('category_id'));
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
