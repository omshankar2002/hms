<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null) 
    {
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];        

        // Get total products count for 'All Products'
        $totalProducts = Product::where('status',1)->count();

        $categories = Category::orderBy('name','ASC')
    ->with(['sub_category'])
    ->withCount('products')  // This will add a products_count column
    ->where('status',1)
    ->get();

        $brands = Brand::orderBy('name','ASC')->where('status',1)->get();

        $products = Product::where('status',1);

    // Apply Filters - कैटेगरी के लिए अपडेटेड लॉजिक
    if (!empty($categorySlug)) {
        $category = Category::where('slug', $categorySlug)->first();
        
        // मुख्य कैटेगरी और सब-कैटेगरी के प्रोडक्ट्स फ़िल्टर करें
        $subCategoryIds = $category->sub_category->pluck('id')->toArray();
        $products = $products->where(function($query) use ($category, $subCategoryIds) {
            $query->where('category_id', $category->id)
                  ->orWhereIn('sub_category_id', $subCategoryIds);
        });
        
        $categorySelected = $category->id;
    }

    // सब-कैटेगरी फ़िल्टर (पहले जैसा)
    if (!empty($subCategorySlug)) {
        $subCategory = SubCategory::where('slug',$subCategorySlug)->first();
        $products = $products->where('sub_category_id',$subCategory->id);
        $subCategorySelected = $subCategory->id;
    }

    // सॉर्टिंग लॉजिक में गलती सुधारें
    $sort = $request->get('sort', 'latest');
    
    switch ($sort) {
        case 'price_asc':
            $products->orderBy('price','ASC');
            break;
        case 'price_desc':
            $products->orderBy('price','DESC');
            break;
        case 'a_to_z':
            $products->orderBy('title','ASC');
            break;
        case 'z_to_a':
            $products->orderBy('title','DESC');
            break;
        default:
            $products->orderBy('id','DESC');
            break;
    }
        $products = $products->paginate(9);

        return view('front.products', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'totalProducts' => $totalProducts,
            'categorySelected' => $categorySelected,
            'subCategorySelected' => $subCategorySelected,
            'brandsArray' => $brandsArray,
            'priceMax' => intval($request->get('price_max')) ?: 1000,
            'priceMin' => intval($request->get('price_min')) ?: 0,
            'sort' => $sort
        ]);
    }

    public function product($slug){
        $product = Product::where('slug',$slug)->with('product_images')->first();
        if ($product == null) {
            abort(404);
        }

        $relatedProducts = [];
        // fetch related products
        if ($product->related_products != '') {
            $productArray = explode(',',$product->related_products);
            $relatedProducts = Product::whereIn('id',$productArray)->where('status',1)->get();
        }

        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;
        return view('front.product',$data);
    }
}
