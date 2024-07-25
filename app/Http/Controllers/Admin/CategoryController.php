<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\Traits\HasCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller{
    use HasCategory;

    /**
     * Show the categories page 
     *
     * @return void
     */
    public function index(){
        $categories = Category::paginate(10);

        return view('admin.frontend.categories.index' , compact('categories'));
    }
  
    /**
     * Add a new category
     *
     * @return void
     */
    public function storage(Request $request){
        $validator = $this->validateAddForm($request);
        
        $this->doStore($validator);

        return back()->with('simpleSuccessAlert' , 'New product added successfully');
    }

    /**
     * Show edit category form 
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function edit(Category $category){
        return view('admin.frontend.categories.edit' , compact('category'));
    }
    
    /**
     * Update a category 
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function update(Category $category , Request $request){
        $validator = $this->validateUpdateForm($request);

        $this->doUpdate($category , $validator);

        return redirect()->route('admin.categories.index')->with('simpleSuccessAlert' , 'Update category successfully');
    }

    /**
     * Destroy a category
     *
     * @return void
     */ 
    public function destroy(Category $category){
        $category->delete();

        return back()->with('simpleSuccessAlert' , 'Remove category successfully');
    }

    // public function index()
    // {
    //     if (request()->ajax()) {
    //         $categories = Category::query();
    //         return DataTables::of($categories)
    //             ->addColumn('action', function($row){
    //                 $deleteForm = '<form action="'.route('admin.categories.destroy', $row->id).'" method="POST" id="prepare-form" style="display:inline;">
    //                                 '.csrf_field().'
    //                                 '.method_field('DELETE').'
    //                                 <button type="submit" id="button-delete"><span class="ti-trash"></span></button>
    //                                </form>';
    //                 $editLink = '<a href="'.route('admin.categories.edit', $row->id).'" id="a-black"><span class="ti-pencil"></span></a>';
    //                 return $deleteForm . ' | ' . $editLink;
    //             })
    //             ->make(true);
    //     }

    //     // Load the view without data for non-AJAX requests
    //     return view('admin.frontend.categories.index');
    // }
}