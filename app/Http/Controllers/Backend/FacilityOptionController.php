<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityOption;

class FacilityOptionController extends Controller
{
    public function AllFacilityOptions()
    {
        $options = FacilityOption::orderBy('sort_order')->get();
        return view('backend.facility_options.all', compact('options'));
    }

    public function AddFacilityOption()
    {
        return view('backend.facility_options.add');
    }

    public function StoreFacilityOption(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        FacilityOption::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('all.facility.options')->with([
            'message' => 'Facility Option Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditFacilityOption($id)
    {
        $option = FacilityOption::findOrFail($id);
        return view('backend.facility_options.edit', compact('option'));
    }

    public function UpdateFacilityOption(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        FacilityOption::findOrFail($request->id)->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('all.facility.options')->with([
            'message' => 'Facility Option Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteFacilityOption($id)
    {
        FacilityOption::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Facility Option Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
