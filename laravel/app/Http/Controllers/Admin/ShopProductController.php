<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ShopCategoryModel;
use App\Model\Admin\ShopProductModel;
use App\Model\ShipperModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopProductController extends Controller
{
    //
    public function index(){
        //phân trang - mỗi trang 10 sp
        $items = DB::table('shop_products')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['products'] = $items;

        return view('admin.content.shop.product.index', $data);
    }

    /**
     * Phương thức tra về view để tạo mới 1 danh mục
     */
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $cats = ShopCategoryModel::all();
        $data['cats'] = $cats;


        return view('admin.content.shop.product.submit', $data);

    }

    /**
     * Phương thức trả về view để sửa 1 danh mục
     */
    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ShopProductModel::find($id);
        $data['product'] = $item;

        $cats = ShopCategoryModel::all();
        $data['cats'] = $cats;

        return view('admin.content.shop.product.edit', $data);
    }

    /**
     * Phương thức trả về view để xóa 1 danh mục
     */
    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ShopProductModel::find($id);
        $data['product'] = $item;

        return view('admin.content.shop.product.delete', $data);
    }

    /**
     * Phương thức lưu trữ dữ liệu khi tạo mới 1 danh mực
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'priceCore' => 'required|numeric',
            'priceSale' => 'required|numeric',
            'stock' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);
        $input = $request->all();

        $item = new ShopProductModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->priceCore = $input['priceCore'];
        $item->priceSale = $input['priceSale'];
        $item->stock = $input['stock'];
        $item->cat_id = $input['cat_id'];
        $item->save();

        return redirect('/admin/shop/product');

    }

    /**
     * Phương thức cập nhật dữ liệu khi sửa 1 danh mực
     */
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'priceCore' => 'required',
            'priceSale' => 'required',
            'stock' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input = $request->all();

        $item = ShopProductModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->priceCore = $input['priceCore'];
        $item->priceSale = $input['priceSale'];
        $item->stock = $input['stock'];
        $item->cat_id = $input['cat_id'];
        $item->save();

        return redirect('/admin/shop/product');
    }

    /**
     * Phương thức xóa 1 danh mục
     */
    public function destroy($id){
        $item = ShopProductModel::find($id);

        $item->delete();

        return redirect('/admin/shop/product');
    }
}
