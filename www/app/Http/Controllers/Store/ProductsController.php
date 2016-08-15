<?php

namespace App\Http\Controllers\Store;


use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Product
};

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
//        $products = Product::all(); // Lazy Loading of related Category and User objects. Results in more queries in this particular case.
        $products = Product::with('category','user')
            ->orderBy('created_at', 'DESC')
            ->get(); // Eager Loading of related Category and User objects.

        \Debugbar::info($products);

        $data = [
            'products' => $products,
        ];

        return view('store.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        $categories = Category::pluck('name', 'id');
        $product = new Product();

        $data = [
            'categories' => $categories,
            'product' => $product,
        ];

        return view('store.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->input());
        $rules = [
            'title' => 'required|min:2|max:255',
            'content' => 'required',
            'category.id' => 'integer|exists:categories,id',
            // 'pictures' => 'required|file',
            'pictures' => 'required',
            'price' => 'required',
            'btw' => 'required',
            'sale' => 'required',
            'stock' => 'required',
        ];

        $this->validate($request, $rules);

        $category = Category::find($request->get('category'));
        $post = new Product($request->only(['title', 'content','pictures', 'price', 'btw', 'sale', 'stock']));
        $post->category()->associate($category);
        $post->user()->associate($request->user());
        $post->save();


        return redirect()->route('store.products.index'); // $ artisan route:list
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id) : View
    {
        $product = Product::find($id);

        $data = [
            'product' => $product,
        ];

        return view('store.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $id
     * @return View
     */
    public function edit($id) : View
    {
        $categories = Category::pluck('name', 'id');
        $product = Product::find($id);

        $data = [
            'categories' => $categories,
            'product' => $product,
        ];

        return view('store.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|min:2|max:255',
            'content' => 'required',
            'category.id' => 'integer|exists:categories,id',
            // 'pictures' => 'required|file',
            'pictures' => 'required',
            'btw' => 'required',
            'sale' => 'required',
            'stock' => 'required',
        ];

        $this->validate($request, $rules);

        $product = Product::find($id);

        $product->title = $request->get('title');
        $product->content = $request->get('content');
        $product->pictures = $request->get('pictures');
        $product->price = $request->get('price');
        $product->btw = $request->get('btw');
        $product->sale = $request->get('sale');
        $product->stock = $request->get('stock');
        $product->category()->associate(Category::find($request->get('category')));
        $product->save();

        return redirect()->route('store.products.index'); // $ artisan route:list
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) : Response
    {
        Product::find($id)->delete();

        return response(Response::HTTP_OK);
    }
}
