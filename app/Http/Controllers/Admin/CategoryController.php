<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            // $data=Category::orderBy('id','desc')->get();

            $search=$request->input('search.value');
            $columns=$request->input('columns');
            $pageSize=$request->input('length');
            $order=$request->input(['order'])[0];
            $orderColumnIndex=$order['column'];
            $orderBy=$order['dir'];
            $start=$request->input('start');

            $category=Category::query();
            $totalCategory=$category->count();

            $dataSearch=$category->when($search,function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            });

            $countSearch=$dataSearch->count();
            $categoryData=$dataSearch->orderBy($columns[$orderColumnIndex]['data'],$orderBy)
            ->offset($start)
            ->limit($pageSize);
            return DataTables::of($categoryData)
            ->addIndexColumn()
            ->addColumn('action',function($data){
                return view('Admin.Button.button',compact('data'));
            })
            ->addColumn('status', function ($status) {
                $checked = $status->status == 'Active' ? 'checked' : '';
                return '<div class="form-check form-switch">
                <input class="form-check-input statusIdData mx-auto" type="checkbox" data-id="'.$status->id.'" role="switch" id="flexSwitchCheckChecked" '.$checked.'>
                </div>';
            })
            ->with('recordsTotal',$totalCategory)
            ->with('recordsFiltered',$countSearch)
            ->rawColumns(['action','status'])
            ->make(true);
        }

        $extraJs=array_merge(
            config('js-map.admin.datatable.script'),
        );

        $extraCs=array_merge(
            config('js-map.admin.datatable.style'),
        );
        return view('Admin.pages.Category.category',['extraJs'=>$extraJs,'extraCs'=>$extraCs]);
    }
    public function getCategories(){
        $categories = Category::where('status','Active')->get();
        return response()->json(['success'=>true , 'message'=>$categories]);
    }


    public function store(CategoryRequest $request){
        DB::beginTransaction();
        try{
            Category::create($request->validated());
            DB::commit();
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function detailCategory($id){
        try{
            $data=Category::find($id);
            return response()->json(['success'=>true,'message'=>$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function update(CategoryRequest $request,$id){
        DB::beginTransaction();
        try{
            Category::find($id)->update($request->validated());
            DB::commit();
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function statusToggle($id){
        try{
            $data=Category::find($id);

            if($data->status === 'Active'){
                $data->status='Inactive';
            }else{
                $data->status='Active';
            }
            $data->save();
            return response()->json(['success'=>true,'message'=>'Status Changes'],200);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function destroy($id){
        try{
            Category::find($id)->delete();
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
}
