<?php 
namespace App\Http\Controllers\Admin;

use App\Models\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index() {
        $websites = Website::all();
        return view('admin.index', compact('websites'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
        $request->validate([
            'domain' => 'required',
            'path' => 'required',
            'content' => 'required'
        ]);

        Website::create($request->all());

        return redirect()->route('admin.websites.index');
    }

    public function edit($id) {
        $website = Website::findOrFail($id);
        return view('admin.websites.edit', compact('website'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'domain' => 'required',
            'path' => 'required',
            'content' => 'required'
        ]);

        $website = Website::findOrFail($id);
        $website->update($request->all());

        return redirect()->route('admin.websites.index');
    }

    public function destroy($id) {
        $website = Website::findOrFail($id);
        $website->delete();

        return redirect()->route('admin.websites.index');
    }
   
}
