<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
use Datatables;
class CategoryController extends Controller
{
  public function getDataSelect($parent_id = 0, $char = '', $current_id = '',$kind='')
    {
        $category_data = Category::where('kind',$kind)->orderBy('id', 'asc')->get();
        $data_select = "";
        foreach ($category_data as $category_item)
        {
            if ($category_item['parent_id'] == $parent_id)
            {
                if ($current_id != "")
                {
                    if ($category_item['id'] == $current_id || $category_item['parent_id'] == $current_id)
                    {
                        $selected = "selected='selected'";
                    }
                    else
                    {
                        $selected = "";
                    }
                }
                else
                {
                    $selected = "";
                }
                $data_select .= '<option value="' . $category_item['id'] . '" ' . $selected . '>';
                $data_select .= $char . $category_item['name'];
                $data_select .= '</option>';
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $data_select .= $this->getDataSelect($category_item['id'], $char . "|---", $current_id,$kind);
            }
        }
        return $data_select;
    }
  public function index()
  {
    $categoryData = Category::with('categories')->orderBy('created_at','DESC')->get();
    $data_select = $this->getDataSelect(0,'','','san-pham');
    $data_send = [
      'data_select' =>  $data_select,
      'categoryData' =>  $categoryData,
    ];
    return view('backend.category.list')->with($data_send);
  }
  public function show(){
    $cate = Category::select(['id','name','parent_id','description', 'status'])->orderBy('parent_id','ASC');
    return Datatables::of($cate)->addIndexColumn()
    ->addColumn('action', function($cate){
    $action = '<a class="btn btn-warning btn-rounded edit" href="#" data-id='.$cate->id.' >Sửa</a>
    <a class="btn btn-danger btn-rounded delete"  href="#" data-id='.$cate->id.' >Xóa </a>
    <meta name="csrf-token" content="{{ csrf_token() }}">';
     return $action;
    })
    ->rawColumns(['action'])
    ->make(true);
 
  }
  public function add(Request $req)
  {
    $category = new Category();
    $category->name = $req->name;
    $slug = Str::slug($req->name, '-');
    $category->slug = $slug;
    $category->parent_id = $req->parent_id;
    $category->description = $req->description;
    $category->kind = $req->kind;
    $category->status = $req->input('status') ? '1' : '0';
    $query = $category->save();
    if (!$query || $query == false)
    {
        $msg = ['status' => '_error', 'msg' => 'Error !!!'];
        return response()->json($msg);
    }
    else
    {
        $msg = ['status' => '_success', 'msg' => 'Thêm danh mục thành công !'];
        return response()->json($msg);
    }
  }
  public function edit(Request $req)
  {
    $category = Category::where('id',$req->id)->first();
    $category->name = $req->name;
    $slug = Str::slug($req->name, '-');
    $category->slug = $slug;
    $category->parent_id = $req->parent_id;
    $category->description = $req->description;
    $category->kind = $req->kind;
    $category->status = $req->input('status') ? '1' : '0';
    $query = $category->save();
    if (!$query || $query == false)
    {
        $msg = ['status' => '_error', 'msg' => 'Error !!!'];
        return response()->json($msg);
    }
    else
    {
        $msg = ['status' => '_success', 'msg' => 'Thay đổi danh mục thành công !'];
        return response()->json($msg);
    }
  }
  public function delete(Request $req){
    $query = Category::destroy($req->id);
    if (!$query || $query == false)
    {
        $msg = ['status' => '_error', 'msg' => 'Error !!!'];
        return response()->json($msg);
    }
    else
    {
        $msg = ['status' => '_success', 'msg' => 'Xóa danh mục thành công !'];
        return response()->json($msg);
    }
  }
}
