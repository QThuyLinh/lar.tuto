<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentCategoryController extends Controller
{
    //
    public function index(){

        //phân trang - mỗi trang 10 sp
        $items = DB::table('content_category')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['cats'] = $items;

        return view('admin.content.content.category.index', $data);
    }

    /**
     * Phương thức tra về view để tạo mới 1 danh mục
     */
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        return view('admin.content.content.category.submit', $data);
    }

    /**
     * Phương thức lưu trữ dữ liệu khi tạo mới 1 danh mực
     */
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input = $request->all();

        $item = new ContentCategoryModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();

        return redirect('/admin/content/category');

    }

    /**
     * Phương thức trả về view để sửa 1 danh mục
     */
    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ContentCategoryModel::find($id);
        $data['cat'] = $item;

        return view('admin.content.content.category.edit', $data);
    }

    /**
     * Phương thức cập nhật dữ liệu khi sửa 1 danh mực
     */
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input = $request->all();

        $item = ContentCategoryModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();

        return redirect('/admin/content/category');
    }

    /**
     * Phương thức trả về view để xóa 1 danh mục
     */
    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ContentCategoryModel::find($id);
        $data['cat'] = $item;

        return view('admin.content.content.category.delete', $data);
    }

    /**
     * Phương thức xóa 1 danh mục
     */
    public function destroy($id){
        $item = ContentCategoryModel::find($id);

        $item->delete();

        return redirect('/admin/content/category');
    }


}
