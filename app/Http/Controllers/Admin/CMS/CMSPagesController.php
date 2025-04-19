<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
// use App\Models\User;

use App\Models\pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;


class CMSPagesController extends Controller
{
    public function index()
    {
        $pages = Pages::all();
        return view('admin.cms.index', compact('pages'));
    }

    

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|string',
        ]);

        $page = new Pages($request->only([
            'title', 'summary', 'description', 'meta_title', 'meta_keyword',
            'meta_description', 'og_title', 'og_description', 'status'
        ]));

        if ($request->hasFile('image')) {
            $page->image = $this->uploadFile($request->file('image'));
        }

        if ($request->hasFile('og_img')) {
            $page->og_img = $this->uploadFile($request->file('og_img'));
        }
        
        $page->slug = Str::slug($page->title);
        $page->save();
        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }
    public function show($id)
    {
        $page = Pages::findOrFail($id); 
        return view('admin.cms.show', compact('page'));
    }
    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        return view('admin.cms.edit', compact('page'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|string',
        ]);
        

        $page = Pages::findOrFail($id);
        $page->fill($request->only([
            'title', 'summary', 'description', 'meta_title', 'meta_keyword',
            'meta_description', 'og_title', 'og_description', 'status'
        ]));

        if ($request->hasFile('image')) {
            $page->image = $this->uploadFile($request->file('image'));
        }

        if ($request->hasFile('og_img')) {
            $page->og_img = $this->uploadFile($request->file('og_img'));
        }
        // $page->slug = Str::slug($page->title);

        $input = $request->all();
        $input['slug'] = Str::slug($input['title']);
        $page->update($input);

        $page->save();
        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

//     public function show($slug)
// {
//     $page = Pages::where('slug', $slug)->where('status', 'active')->firstOrFail();
//     // return view('frontend.menus.terms', compact('page'));
//     return view('admin.cms.terms', compact('page'));

// }

    
    public function destroy($id): RedirectResponse
    {
        $page = Pages::findOrFail($id);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }

    private function uploadFile($file)
    {
        $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/pages'), $filename);
        return $filename;
    }
    
}
