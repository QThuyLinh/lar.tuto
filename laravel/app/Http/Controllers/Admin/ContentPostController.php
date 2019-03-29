<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentCategoryModel;
use App\Model\Admin\ContentPostModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentPostController extends Controller
{
    //
    public function index(){
        //phân trang - mỗi trang 10 sp
        $items = DB::table('content_posts')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['posts'] = $items;

        return view('admin.content.content.post.index', $data);
    }

    /**
     * Phương thức tra về view để tạo mới 1 danh mục
     */
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $cats = ContentCategoryModel::all();
        $data['cats'] = $cats;


        return view('admin.content.content.post.submit', $data);

    }

    /**
     * Phương thức trả về view để sửa 1 danh mục
     */
    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ContentPostModel::find($id);
        $data['post'] = $item;

        $cats = ContentCategoryModel::all();
        $data['cats'] = $cats;

        return view('admin.content.content.post.edit', $data);
    }

    /**
     * Phương thức trả về view để xóa 1 danh mục
     */
    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = ContentPostModel::find($id);
        $data['post'] = $item;

        return view('admin.content.content.post.delete', $data);
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

        $item = new ContentPostModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->author_id = isset($input['author_id']) ? $input['author_id'] : 0;
        $item->view = isset($input['view']) ? $input['view'] : 0;
        $item->desc = $input['desc'];
        $item->cat_id = $input['cat_id'];
        $item->save();

        return redirect('/admin/content/post');

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

        $item = ContentPostModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->author_id = isset($input['author_id']) ? $input['author_id'] : 0;
        $item->view = isset($input['view']) ? $input['view'] : 0;
        $item->desc = $input['desc'];
        $item->cat_id = $input['cat_id'];
        $item->save();

        return redirect('/admin/content/post');
    }

    /**
     * Phương thức xóa 1 danh mục
     */
    public function destroy($id){
        $item = ContentPostModel::find($id);

        $item->delete();

        return redirect('/admin/content/post');
    }
}

