<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\ShopCategoryModel;
use Illuminate\Support\Facades\DB;

class ShopCategoryController extends Controller
{
    //
    public function index(){

        //phân trang - mỗi trang 10 sp
        $items = DB::table('shop_category')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['cats'] = $items;

        return view('admin.content.shop.category.index', $data);
    }

    /**
     * Phương thức tra về view để tạo mới 1 danh mục
     */
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        return view('admin.content.shop.category.submit', $data);
    }

    /**
     * Phương thức trả về view để sửa 1 danh mục
     */
    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ShopCategoryModel::find($id);
        $data['cat'] = $item;

        return view('admin.content.shop.category.edit', $data);
    }

    /**
     * Phương thức trả về view để xóa 1 danh mục
     */
    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ShopCategoryModel::find($id);
        $data['cat'] = $item;

        return view('admin.content.shop.category.delete', $data);
    }


    /**
     * Phương thức lưu trữ dữ liệu khi tạo mới 1 danh mực
     */
    public function store(Request $request){
        $input = $request->all();

        $item = new ShopCategoryModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();

        return redirect('/admin/shop/category');

    }

    /**
     * Phương thức cập nhật dữ liệu khi sửa 1 danh mực
     */
    public function update(Request $request, $id){
        $input = $request->all();

        $item = ShopCategoryModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();

        return redirect('/admin/shop/category');
    }

    /**
     * Phương thức xóa 1 danh mục
     */
    public function destroy($id){
        $item = ShopCategoryModel::find($id);

        $item->delete();

        return redirect('/admin/shop/category');
    }
}
