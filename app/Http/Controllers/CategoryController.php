<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Category;

class CategoryController extends Controller
{

    /* public function create() {
        return view('pages.account.categories-edit', ['mode' => 'add']);
    }

    public function edit(Category $category) {
        return view('pages.account.categories-edit', ['mode' => 'edit', 'category' => $category]);
    }

    public function trash(Category $category) {
        return view('pages.account.categories-edit', ['mode' => 'delete', 'category' => $category]);
    }


    public function add(Request $request) {

        // Validate the request
        try {
            $validated = $request->validate([
                'title' => 'required',
                'slug' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'A field did not meet the requirements')->withInput();
        }

        // Clear any previous errors
        $request->session()->forget(['errors', 'success', 'info', 'warning']);

        // Create the cateogory
        $category = Category::create([
            'title' => $validated['title'],
            'slug' => vlx_slugify($validated['slug']),
        ]);

        return redirect()->route('dashboard.category')->with('success', 'Category has been added');

    }

    public function update(Request $request, Category $category) {

        // Validate the request
        try {
            $validated = $request->validate([
                'title' => 'required',
                'slug' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'A field did not meet the requirements')->withInput();
        }

        // Clear any previous errors
        $request->session()->forget(['errors', 'success', 'info', 'warning']);

        // Update the category
        $category->update([
            'title' => $validated['title'],
            'slug' => vlx_slugify($validated['slug']),
        ]);

        return redirect()->route('dashboard.category')->with('success', 'Category has been updated');

    }

    public function delete(Category $category) {

        $category->delete();

        return redirect()->route('dashboard.category')->with('success', 'Category has been deleted');

    } */

}
