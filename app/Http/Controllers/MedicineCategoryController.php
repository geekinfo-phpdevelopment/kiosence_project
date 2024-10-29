<?php

namespace App\Http\Controllers;

use App\Models\MedicineCategory;
use Illuminate\Http\Request;

class MedicineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catories=MedicineCategory::all();

        return view('Category.list',['categories'=>$catories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new MedicineCategory();
        $category->name = $request->input('name');
        $category->save();
        return to_route('category.index')->with('message', 'Category Added Sucessfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = MedicineCategory::query()->get();
        $category = MedicineCategory::find($id);
        return view('Category.edit', ['categories' => $categories,'edit_category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category=MedicineCategory::find($id);
        $category->name = $request->input('category');
        $category->save();
        return to_route('category.index')->with('message', 'Category updated Sucessfully');
    }
    public function disable(string $id)
    {
        $category = MedicineCategory::find($id);
        $category->status = 0;
        $category->save();
        return to_route('category.index')->with('message', 'Category Disabled Sucessfully');
    }
    public function enable(string $id)
    {
        $category = MedicineCategory::find($id);
        $category->status = 1;
        $category->save();
        return to_route('category.index')->with('message', 'Category enabled Sucessfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=MedicineCategory::find($id);
        $category->delete();
        return to_route('category.index')->with('message', 'Category deleted Sucessfully');
    }
}
