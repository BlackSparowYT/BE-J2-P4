<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Item;

class ItemController extends Controller
{

    /* public function create() {
        return view('pages.account.menu-edit', ['mode' => 'add']);
    }

    public function edit(Item $item) {
        return view('pages.account.menu-edit', ['mode' => 'edit', 'item' => $item]);
    }

    public function trash(Item $item) {
        return view('pages.account.menu-edit', ['mode' => 'delete', 'item' => $item]);
    }


    public function add(Request $request) {

        // Validate the request
        try {
            $validated = $request->validate([
                'title' => 'required',
                'slug' => 'required',
                'category' => 'required',
                'content' => 'required',
                'excerpt' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'A field did not meet the requirements')->withInput();
        }

        // Clear any previous errors
        $request->session()->forget(['errors', 'success', 'info', 'warning']);

        // Create the item
        $item = Item::create([
            'title' => $validated['title'],
            'slug' => vel_slugify($validated['slug']),
            'category_id' => $validated['category'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard.menu')->with('success', 'Item has been added');

    }

    public function update(Request $request, Item $item) {

        // Validate the request
        try {
            $validated = $request->validate([
                'title' => 'required',
                'slug' => 'required',
                'category' => 'required',
                'content' => 'required',
                'excerpt' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'A field did not meet the requirements')->withInput();
        }

        // Clear any previous errors
        $request->session()->forget(['errors', 'success', 'info', 'warning']);

        // Update the item
        $item->update([
            'title' => $validated['title'],
            'slug' => vel_slugify($validated['slug']),
            'category_id' => $validated['category'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard.menu')->with('success', 'Item has been updated');

    }

    public function delete(Item $item) {

        $item->clearMediaCollection('media');
        $item->delete();

        return redirect()->route('dashboard.menu')->with('success', 'Item has been deleted');

    } */

}
