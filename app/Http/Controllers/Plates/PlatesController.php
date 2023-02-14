<?php

namespace App\Http\Controllers\Plates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plates;

class PlatesController extends Controller
{
    public function index(){
        $plates = array();

        $plates = Plates::all();

        return view('admin.plates.index' ,compact('plates'));
    }

    public function menu(){
        $plates = array();

        $plates = Plates::all();

        return view('viewer.menu' ,compact('plates'));

    }

    public function create(){
        return view('admin.plates.create');
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png|max:5000',
            'name' => 'required|unique:plates|string',
            'price' => 'required|string',
            'description' => 'required|min:15'
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        $plate = new Plates;

        $plate->image = $imageName;
        $plate->name = $request->name;
        $plate->price = $request->price;
        $plate->description = $request->description;

        $store = $plate->save();   

        if($store){
            return redirect('/plates')->with('success', 'Your plates has been added');
        }else {
            return back()->with('fail', 'Something went wrong, try again!');
        }
    }

    public function destroy($id){
        $plate = Plates::find($id);

        $path = public_path('images/'. $plate->image);

        if(file_exists($path) && $plate->images != null){
            unlink($path);
        }

        $plate->delete();

        return back()->with('success', 'Deleted successfully');
    }

    public function edit($id){
        $plate = Plates::find($id);
        return view('admin.plates.edit', compact('plate'));
    }

    public function update(Request $request){
        $request->validate([
            'image' => 'image|mimes:jpeg,png|max:5000',
            'name' => 'required|string',
            'price' => 'required|string',
            'description' => 'required|min:15'
        ]);

        $id = $request->id;      

        $plate = Plates::find($id);
    
        if($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);

            $plate->image = $imageName;
        }

        $plate->name = $request->name;
        $plate->price = $request->price;
        $plate->description = $request->description;

        $store = $plate->save();   

        if($store){
            return redirect('/plates')->with('success', 'Your plates has been modified');
        }else {
            return back()->with('fail', 'Something went wrong, try again!');
        }
    }
}
