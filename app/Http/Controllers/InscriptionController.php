<?php

namespace App\Http\Controllers;

use App\Inscription;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inscriptions.create',[
            'inscriptions'=>Inscription::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      //  request()->validate([
        //    'name'=>['required'],
          //  'email'=>['required','email','unique:users'],
          //  'password'=>['required'],
           // 'adresse'=>['required'],
            //'image'=>['required']
           
        //]);
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required','email','unique:users',
            'password'=>'required',
            'adresse'=>'required',
            'image'=>'required'
        ]);

          // Handle File Upload
          if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/covers_images', $fileNameToStore);
		
	    // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/covers_images/'.$thumbStore);
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

    
        $inscription = new Inscription();
        $inscription->name=request('name');
        $inscription->email=request('email');
        $inscription->adresse=request('adresse');
        $inscription->image= $fileNameToStore;
        $inscription->password=request('password');
        $inscription->save();


        return redirect()->route('inscription.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
