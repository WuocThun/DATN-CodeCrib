<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Findfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FindFeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $findfes = FindFe::all();
        $findfes = FindFe::orderBy('created_at', 'desc')->paginate(25);


        return view('admin_core.content.findfes.list',compact('findfes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_core.content.findfes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'title' => 'required|min:5',
        //     'description' => 'required|min:5',
        //     'price' => 'required|numeric',
        //     'area' => 'required|numeric',
        //     'contact_name' => 'required|min:5',
        //     'contact_phone' => 'required|numeric',
        //     'gender_rental' => 'required|numeric',
        //     // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     //  'image_path' => 'required',
        //     // 'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        // ]);


        // // if ($request->hasFile('avatar')) {
        // //     $image = $request->file('avatar');
        // //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        // //     $image->move(public_path('uploads/rooms/avatar'), $imageName);


        // // }


        // if($request->hasfile('image_path'))
        // {
        //     foreach($request->file('image_path') as $image)
        //     {
        //         $name = time() . '-' . $image->getClientOriginalName();
        //         $image->move(public_path('uploads/rooms'), $name); // Đường dẫn lưu trữ ảnh
        //     }
        // }





        // if($validator->passes()){

        //     $findfe = new Findfe();
        //     $findfe->title = $request->title;
        //     $findfe->contact_name = $request->contact_name;
        //     $findfe->contact_phone = $request->contact_phone;
        //     $findfe->description = $request->description;
        //     $findfe->price = $request->price;
        //     $findfe->area = $request->area;
        //     $findfe->gender_rental = $request->gender_rental;
        //     // $findfe->image_path = $request->image_path;
        //     // $findfe->avatar = $request->avatar;
        //     $findfe->save();

        //     return redirect()->route('findfes.index')->with('success','Findfe added successfully');
        // }else{
        //     return redirect()->route('findfes.create')->withInput()->withErrors($validator);
        // }


        $rules = [
                'title' => 'required|min:5',
                'description' => 'required|min:5',
                'price' => 'required|numeric',
                'area' => 'required|numeric',
                'contact_name' => 'required|min:5',
                'contact_phone' => 'required|numeric',
                'gender_rental' => 'required|numeric',

        ];



        if ($request->image != "") {
            $rules['image'] = 'image';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {

            return redirect()->route('findfes.create')->withInput()->withErrors($validator);
        }


        $findfe = new Findfe();
            $findfe->title = $request->title;
            $findfe->contact_name = $request->contact_name;
            $findfe->contact_phone = $request->contact_phone;
            $findfe->description = $request->description;
            $findfe->price = $request->price;
            $findfe->area = $request->area;
            $findfe->gender_rental = $request->gender_rental;
            $findfe->save();




            if ($request->image != "") {


                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;

                $image->move(public_path('uploads/rooms/avatar'), $imageName);

                $findfe->image = $imageName;
                $findfe->save();
            }

            return redirect()->route('findfes.index')->with('success', 'Findfe added successfully');




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
    public function edit($id)
    {
        $findfe = Findfe::findOrFail($id);
        return view('admin_core.content.findfes.edit',[
            'findfe' =>$findfe
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $findfe = Findfe::findOrFail($id);
        $rules = [
            'title' => 'required|min:5',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'area' => 'required|numeric',
            'contact_name' => 'required|min:5',
            'contact_phone' => 'required|numeric',
            'gender_rental' => 'required|numeric',

    ];



    if ($request->image != "") {
        $rules['image'] = 'image';
    }


    $validator = Validator::make($request->all(), $rules);


    if ($validator->fails()) {

        return redirect()->route('findfes.create')->withInput()->withErrors($validator);
    }



        $findfe->title = $request->title;
        $findfe->contact_name = $request->contact_name;
        $findfe->contact_phone = $request->contact_phone;
        $findfe->description = $request->description;
        $findfe->price = $request->price;
        $findfe->area = $request->area;
        $findfe->gender_rental = $request->gender_rental;
        $findfe->save();




        if ($request->image != "") {
            ///delete old img
            File::delete(public_path('uploads/rooms/avatar/'.$findfe->image));

            ////here we will strore img
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            ///save img
            $image->move(public_path('uploads/rooms/avatar'), $imageName);
            ///save img mane in database
            $findfe->image = $imageName;
            $findfe->save();
        }

        return redirect()->route('findfes.index')->with('success', 'Findfe updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $findfe = Findfe::findOrFail($id);
         ///delete img
         File::delete(public_path('uploads/rooms/avatar/'.$findfe->image));
         ////delete form database
         $findfe->delete();
         return redirect()->route('findfes.index')->with('success', 'Product deleted successfully');

    }
}
