<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

    public function create() {
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
                //'media' => 'required|file|mimes:jpeg,png,jpg,gif,svg' //|max:2048
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

        // Add the item to the media (WIP)
        //$item->addMediaFromRequest($request['media'])->toMediaCollection('media');

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
                //'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg'
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

        // Add the media to the item (WIP)
        /* if(isset($request['media'])) {
            $item->clearMediaCollection('media');
            $item->addMediaFromRequest($request['media'])->toMediaCollection('media');
            dd($item->getMedia());
        } */

        return redirect()->route('dashboard.menu')->with('success', 'Item has been updated');

    }

    public function delete(Item $item) {

        $item->clearMediaCollection('media');
        $item->delete();

        return redirect()->route('dashboard.menu')->with('success', 'Item has been deleted');

    }

}
