<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategorieController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categorie::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        if(! Gate::allows('access-admin')){
            abort(403);
        } 

        return (view('pages.headerNotLoggedin') . view('pages.categorie'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'libelleCat' => 'required|string|unique:categories,libelleCat'
        ]);
        $categorie = Categorie::create($request->all());

        // dd($categorie);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie, int $id)
    {
        $categorie = Categorie::findOrfail($id);
        return $categorie;
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(int $id)
    {
        $categorie = Categorie::findOrfail($id);
        return (view('pages.categorie', [
            'cat' => $categorie
        ]));
    }

    public function update(Request $request, int $id)
    {
        $categorie = Categorie::find($id);

        $request->validate([
            'libelleCat' => 'required|string|unique:categories,libelleCat'
        ]);

        $categorie->update(['libelleCat' => 'WWWWWWWwwww']);
        return $categorie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return Categorie::destroy($id);
    }


    /**
     * Search for a name.
     */
    public function search(string $name)
    {
        return Categorie::where('libelleCat', 'like', '%'.$name.'%')->get();
    }

}
