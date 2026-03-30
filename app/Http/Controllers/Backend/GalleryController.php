<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Contact;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class GalleryController extends Controller
{
    public function AllGallery(){

        $gallery = Gallery::latest()->get();
        return view('backend.gallery.all_gallery',compact('gallery'));

    } // End Method 

    public function AddGallery(){
        return view('backend.gallery.add_gallery');
    } // End Method 

    public function StoreGallery(Request $request){

        $images = $request->file('photo_name');
        
        foreach ($images as $img) {
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(550,550)->save('upload/gallery/'.$name_gen);
        $save_url = 'upload/gallery/'.$name_gen;
       
        Gallery::insert([
            'photo_name' => $save_url,
            'created_at' => Carbon::now(), 
        ]);
        } //  end foreach 

        $notification = array(
            'message' => 'Gallery Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.gallery')->with($notification);

    }// End Method 


    public function EditGallery($id){

        $gallery = Gallery::find($id);
        return view('backend.gallery.edit_gallery',compact('gallery'));

    }// End Method 

    public function UpdateGallery(Request $request){

        $gal_id = $request->id;
        $img = $request->file('photo_name');

        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(550,550)->save('upload/gallery/'.$name_gen);
        $save_url = 'upload/gallery/'.$name_gen;
       
        Gallery::find($gal_id)->update([
            'photo_name' => $save_url, 
        ]); 

        $notification = array(
            'message' => 'Gallery Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.gallery')->with($notification);  

    }// End Method 

    public function DeleteGallery($id){

        $item = Gallery::findOrFail($id);
        $img = $item->photo_name;
        unlink($img);

        Gallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Gallery Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


     }   // End Method 


     public function DeleteGalleryMultiple(Request $request){

        $selectedItems = $request->input('selectedItem', []);

        foreach ($selectedItems as $itemId) {
           $item = Gallery::find($itemId);
           $img = $item->photo_name;
           unlink($img);
           $item->delete();
        }

        $notification = array(
            'message' => 'Selected Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }// End Method 


     public function ShowGallery(){
        $gallery = Gallery::latest()->get();
        return view('frontend.gallery.show_gallery',compact('gallery'));
     }// End Method


     public function ContactUs(){

        return view('frontend.contact.contact_us');
     }// End Method


     public function StoreContactUs(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to($request->email)
                ->send(new \App\Mail\ContactConfirm($contact));
        } catch (\Exception $e) {
            // Log failure but don't block the user
            \Illuminate\Support\Facades\Log::error('Contact confirm email failed: '.$e->getMessage());
        }

        $notification = array(
            'message' => 'Your Message Sent Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

     }// End Method


     public function AdminContactMessage(){

        $contact = Contact::latest()->get();
        return view('backend.contact.contact_message',compact('contact'));

     }// End Method



}
