<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    /**
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categories = Categorie::where('user_id', auth()->id())
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return response()->json(['categories' => $categories]);
    }

    /**
     * @return JsonResponse
     */
    public function getProducts(): JsonResponse
    {
        $products = Product::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return response()->json(['products' => $products]);
    }

    /**
     * @return JsonResponse
     */
    public function getCategoryList(): JsonResponse
    {
        $categoryList = Categorie::where('user_id', auth()->id())->get();
        return response()->json(['category_list' => $categoryList]);
    }

    public function addCategorie (CategoryRequest $request)
    {
        $categore = Categorie::create(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => auth()->id(),
                'status' => '0'
            ]
        );
        return response()->json([
            'status' =>'success',
            'categore'   => $categore,
        ]);
    }

    public function addProduct(ProductRequest $request)
    {
        $product =  Product::create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
        ]);
        $product = Product::where('id', $product->id)->with('category')->first();
        return response()->json([
            'status' =>'success',
            'product'   => $product,
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->input('id');
        Product::find($id)->delete();
        $product = Product::orderBy('id', 'desc')->with('category')->skip($request->input('current_page') * 5 - 1)->first();
        return response()->json(['message' => 'Product deleted!', 'product' => $product]);
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->input('id');
        Categorie::find($id)->delete();
        Product::where('category_id', $id)->delete();
        $category = Categorie::orderBy('id', 'desc')->skip($request->input('current_page') * 5 - 1)->first();
        return response()->json(['message' => 'Categore deleted!', 'category' => $category]);

    }

    public function updateCategory(CategoryRequest $request)
    {
        $categore = Categorie::find($request->input('id'));
        $categore->update($request->all());

        return response()->json([
            'status' => 'success',
            'post'   => $categore
        ]);
    }

    public function updateProduct(ProductRequest $request)
    {
        $id = $request->input('id');
        $product = Product::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id')
            ]
        );
        $product = Product::where('id', $id)->with('category')->first();
        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);
    }
}
