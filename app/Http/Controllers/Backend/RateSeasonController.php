<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateSeason;
use App\Models\Room;
use App\Models\RoomRateOverride;
use Illuminate\Support\Facades\DB;

class RateSeasonController extends Controller
{
    public function AllSeasons()
    {
        $seasons = RateSeason::orderBy('start_date', 'desc')->get();
        return view('backend.allroom.seasons.view_seasons', compact('seasons'));
    }

    public function AddSeason()
    {
        return view('backend.allroom.seasons.add_season');
    }

    public function StoreSeason(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price_multiplier' => 'required|numeric|min:0.01|max:99.99',
        ]);

        RateSeason::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price_multiplier' => $request->price_multiplier,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('all.seasons')->with([
            'message' => 'Rate Season Created Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function EditSeason($id)
    {
        $season = RateSeason::findOrFail($id);
        $rooms = Room::with('type')->where('status', 1)->get();
        $overrides = RoomRateOverride::where('rate_season_id', $id)->get();
        return view('backend.allroom.seasons.edit_season', compact('season', 'rooms', 'overrides'));
    }

    public function UpdateSeason(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price_multiplier' => 'required|numeric|min:0.01|max:99.99',
        ]);

        $season = RateSeason::findOrFail($id);

        DB::beginTransaction();
        try {
        $season->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'price_multiplier' => $request->price_multiplier,
            'is_active' => $request->has('is_active'),
        ]);

        // Handle room rate overrides
        if ($request->has('override_room_id')) {
            RoomRateOverride::where('rate_season_id', $id)->delete();
            $roomIds = $request->override_room_id;
            $prices = $request->override_price;

            for ($i = 0; $i < count($roomIds); $i++) {
                if (!empty($roomIds[$i]) && !empty($prices[$i])) {
                    RoomRateOverride::create([
                        'room_id' => $roomIds[$i],
                        'rate_season_id' => $id,
                        'price' => $prices[$i],
                    ]);
                }
            }
        }

        DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Rate season update failed: '.$e->getMessage());
            return redirect()->back()->withInput()->with(['message' => 'Failed to update rate season.', 'alert-type' => 'error']);
        }

        return redirect()->route('all.seasons')->with([
            'message' => 'Rate Season Updated Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function DeleteSeason($id)
    {
        RateSeason::findOrFail($id)->delete();

        return redirect()->route('all.seasons')->with([
            'message' => 'Rate Season Deleted Successfully',
            'alert-type' => 'success',
        ]);
    }
}
