<?php

namespace App\Http\Controllers;

use App\Room;
use DateTime;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create',[
            'rooms'=>Room::all()
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
            $path = $request->file('image')->storeAs('public/cover_images', $fileNameToStore);
		
	    // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/cover_images/'.$thumbStore);
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        }










        $room = new Room();
        $room->name=request('name');
        $room->price=request('price');
        $room->adresse=request('adresse');
        $room->capacity=request('capacity');
        $room->description=request('description');
        $room->comment=request('comment');
        $room->image= $fileNameToStore;
       // $room->date_pub = (new DateTime())
       //  ->setTimestamp(request('date_pub')('created'))
       //  ->format('Y-m-d H:i:s');
     // $room= $path=$request->file('image')->store('avatars');


   //$request->validate([
    //'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
 // ]);

 

 // if ($request->file('file')) {
  //  $imagePath = $request->file('file');
   // $imageName = $imagePath->getClientOriginalName();

   // $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
 //}

//  $room->name = $imageName;
 //$room->path = '/storage/'.$path;
  

 
    
        
        $room->save();


        return redirect()->route('rooms.create');
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
    public function scopeGetProductImage(){
        return "storage/" . $this->image;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
   
}
