<?php

namespace App\Http\Controllers;

use App\Models\PlayerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerCategoriesController extends Controller
{
    public function index(){
        $playerCategory = PlayerCategory::all();
        $data = compact('playerCategory');
        return view('admin.playerCategory')->with($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);
        if($validator->fails()){
          return response()->json(['errors'=> $validator->messages()]);
        }else{
          $category = new PlayerCategory;
          $category->category_name = $request['category_name'];
          $category->save();
          return response()->json(['success'=> 'Added Successfully.']);
        }
    }

    public function edit(Request $request){
        $category_id = $request->category_id;
        $category = PlayerCategory::find($category_id);
        return response()->json([
          'category' => $category,
      ]);
    }

    public function update(Request $request){
        $id = $request['category_id'];
        // return response()->json([$request->all()]);
        $validator = Validator::make($request->all(), [
          'editCategory_name' => 'required',
      ]);
      if($validator->fails()){
        return response()->json(['errors'=> $validator->messages()]);
      }else{
         
        $category = PlayerCategory::find($id);
        $category->category_name = $request['editCategory_name'];
        $category->update();
        return response()->json(['success'=> 'Category Updated Successfully']);
      }
    }


    public function delete($id){
      $playerCategory = PlayerCategory::find($id);
      $playerCategory->delete();
      return redirect()->back();
    }
}
