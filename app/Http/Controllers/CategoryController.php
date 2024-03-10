<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // if the request has data_count_shows
        if ($request->input('data_count_shows') != null) {
            $dataCountShows = $request->input('data_count_shows');
            $categories = BookCategory::where('user_id', Auth::id())->paginate($dataCountShows);
            return view('workspace.category.index', compact('categories'));
        }
        // if the request has search
        if ($request->input('search') != null) {
            $categories = BookCategory::where('user_id', Auth::id())->where('name', 'like', '%' . $request->search . '%')->paginate(5);
            return view('workspace.category.index', compact('categories'));
        }
        // get all the categories
        // default paginate is 5
        $categories = BookCategory::where('user_id', Auth::id())->paginate(5);
        return view('workspace.category.index', compact('categories'));
    }

    public function create()
    {
        // return the create view
        return view('workspace.category.create');
    }

    public function store(Request $request)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'category_name' => 'required'
        ]);

        // if the validation fails
        if ($validator->fails()) {
            Alert::error('Error', 'Please fill all the required fields.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // create a new category
        $category = new BookCategory();
        $category->name = $request->category_name;
        $category->user_id = Auth::id();
        $category->save();

        // return a success message
        Alert::success('Success', 'Category created successfully.');
        return redirect()->route('workspace.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        // get the category
        $category = BookCategory::find($id);
        return view('workspace.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'category_name' => 'required'
        ]);

        // if the validation fails
        if ($validator->fails()) {
            Alert::error('Error', 'Please fill all the required fields.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // update the category
        $category = BookCategory::find($id);
        $category->name = $request->category_name;
        $category->save();

        // return a success message
        Alert::success('Success', 'Category updated successfully.');
        return redirect()->route('workspace.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        // delete the category

        try {
            $category = BookCategory::find($id);
            $category->delete();
        } catch (\Throwable $th) {
            if($th->getCode() == 23000){
                Alert::error('Error', 'Category cannot be deleted because it is being used by a book.');
                return redirect()->route('workspace.category.index');
            }
        }

        // return a success message
        Alert::success('Success', 'Category deleted successfully.');
        return redirect()->route('workspace.category.index')->with('success', 'Category deleted successfully.');
    }


}
