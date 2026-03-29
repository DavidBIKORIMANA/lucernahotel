<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Models\HeroStat;
use App\Models\AboutPillar;
use App\Models\Amenity;
use App\Models\DiningItem;
use App\Models\EventFeature;
use App\Models\HomeSection;
use Carbon\Carbon;

class HomepageController extends Controller
{
    // ═══════════════════════════════════════
    //  HOMEPAGE DASHBOARD
    // ═══════════════════════════════════════
    public function Index()
    {
        $hero_slides = HeroSlide::ordered()->get();
        $hero_stats = HeroStat::ordered()->get();
        $about_pillars = AboutPillar::ordered()->get();
        $amenities = Amenity::ordered()->get();
        $dining_items = DiningItem::ordered()->get();
        $event_features = EventFeature::ordered()->get();
        $sections = HomeSection::all()->keyBy('section_key');

        return view('backend.homepage.index', compact(
            'hero_slides', 'hero_stats', 'about_pillars',
            'amenities', 'dining_items', 'event_features', 'sections'
        ));
    }

    // ═══════════════════════════════════════
    //  HERO SLIDES
    // ═══════════════════════════════════════
    public function AllHeroSlides()
    {
        $slides = HeroSlide::ordered()->get();
        return view('backend.homepage.hero_slides.all', compact('slides'));
    }

    public function AddHeroSlide()
    {
        return view('backend.homepage.hero_slides.add');
    }

    public function StoreHeroSlide(Request $request)
    {
        $request->validate(['image' => 'required|image|max:4096']);

        $file = $request->file('image');
        $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/hero_slides'), $filename);

        HeroSlide::create([
            'image' => 'upload/hero_slides/' . $filename,
            'alt_text' => $request->alt_text,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('all.hero.slides')->with([
            'message' => 'Hero Slide Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditHeroSlide($id)
    {
        $slide = HeroSlide::findOrFail($id);
        return view('backend.homepage.hero_slides.edit', compact('slide'));
    }

    public function UpdateHeroSlide(Request $request)
    {
        $slide = HeroSlide::findOrFail($request->id);
        $data = [
            'alt_text' => $request->alt_text,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ];

        if ($request->file('image')) {
            $request->validate(['image' => 'image|max:4096']);
            if ($slide->image && file_exists(public_path($slide->image))) {
                @unlink(public_path($slide->image));
            }
            $file = $request->file('image');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/hero_slides'), $filename);
            $data['image'] = 'upload/hero_slides/' . $filename;
        }

        $slide->update($data);

        return redirect()->route('all.hero.slides')->with([
            'message' => 'Hero Slide Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteHeroSlide($id)
    {
        $slide = HeroSlide::findOrFail($id);
        if ($slide->image && file_exists(public_path($slide->image))) {
            @unlink(public_path($slide->image));
        }
        $slide->delete();

        return redirect()->back()->with([
            'message' => 'Hero Slide Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    // ═══════════════════════════════════════
    //  HERO STATS
    // ═══════════════════════════════════════
    public function AllHeroStats()
    {
        $stats = HeroStat::ordered()->get();
        return view('backend.homepage.hero_stats.all', compact('stats'));
    }

    public function AddHeroStat()
    {
        return view('backend.homepage.hero_stats.add');
    }

    public function StoreHeroStat(Request $request)
    {
        $request->validate(['counter_value' => 'required', 'counter_label' => 'required']);

        HeroStat::create([
            'counter_value' => $request->counter_value,
            'counter_label' => $request->counter_label,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.hero.stats')->with([
            'message' => 'Hero Stat Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditHeroStat($id)
    {
        $stat = HeroStat::findOrFail($id);
        return view('backend.homepage.hero_stats.edit', compact('stat'));
    }

    public function UpdateHeroStat(Request $request)
    {
        HeroStat::findOrFail($request->id)->update([
            'counter_value' => $request->counter_value,
            'counter_label' => $request->counter_label,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.hero.stats')->with([
            'message' => 'Hero Stat Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteHeroStat($id)
    {
        HeroStat::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Hero Stat Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    // ═══════════════════════════════════════
    //  ABOUT PILLARS
    // ═══════════════════════════════════════
    public function AllAboutPillars()
    {
        $pillars = AboutPillar::ordered()->get();
        return view('backend.homepage.about_pillars.all', compact('pillars'));
    }

    public function AddAboutPillar()
    {
        return view('backend.homepage.about_pillars.add');
    }

    public function StoreAboutPillar(Request $request)
    {
        $request->validate(['name' => 'required', 'description' => 'required']);

        AboutPillar::create([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.about.pillars')->with([
            'message' => 'About Pillar Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditAboutPillar($id)
    {
        $pillar = AboutPillar::findOrFail($id);
        return view('backend.homepage.about_pillars.edit', compact('pillar'));
    }

    public function UpdateAboutPillar(Request $request)
    {
        AboutPillar::findOrFail($request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.about.pillars')->with([
            'message' => 'About Pillar Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteAboutPillar($id)
    {
        AboutPillar::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'About Pillar Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    // ═══════════════════════════════════════
    //  AMENITIES
    // ═══════════════════════════════════════
    public function AllAmenities()
    {
        $amenities = Amenity::ordered()->get();
        return view('backend.homepage.amenities.all', compact('amenities'));
    }

    public function AddAmenity()
    {
        return view('backend.homepage.amenities.add');
    }

    public function StoreAmenity(Request $request)
    {
        $request->validate(['icon' => 'required', 'name' => 'required', 'description' => 'required']);

        Amenity::create([
            'icon' => $request->icon,
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('all.amenities')->with([
            'message' => 'Amenity Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditAmenity($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('backend.homepage.amenities.edit', compact('amenity'));
    }

    public function UpdateAmenity(Request $request)
    {
        Amenity::findOrFail($request->id)->update([
            'icon' => $request->icon,
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('all.amenities')->with([
            'message' => 'Amenity Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteAmenity($id)
    {
        Amenity::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Amenity Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    // ═══════════════════════════════════════
    //  DINING ITEMS
    // ═══════════════════════════════════════
    public function AllDiningItems()
    {
        $items = DiningItem::ordered()->get();
        return view('backend.homepage.dining_items.all', compact('items'));
    }

    public function AddDiningItem()
    {
        return view('backend.homepage.dining_items.add');
    }

    public function StoreDiningItem(Request $request)
    {
        $request->validate(['name' => 'required', 'time_text' => 'required']);

        DiningItem::create([
            'name' => $request->name,
            'time_text' => $request->time_text,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.dining.items')->with([
            'message' => 'Dining Item Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditDiningItem($id)
    {
        $item = DiningItem::findOrFail($id);
        return view('backend.homepage.dining_items.edit', compact('item'));
    }

    public function UpdateDiningItem(Request $request)
    {
        DiningItem::findOrFail($request->id)->update([
            'name' => $request->name,
            'time_text' => $request->time_text,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.dining.items')->with([
            'message' => 'Dining Item Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteDiningItem($id)
    {
        DiningItem::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Dining Item Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    // ═══════════════════════════════════════
    //  EVENT FEATURES
    // ═══════════════════════════════════════
    public function AllEventFeatures()
    {
        $features = EventFeature::ordered()->get();
        return view('backend.homepage.event_features.all', compact('features'));
    }

    public function AddEventFeature()
    {
        return view('backend.homepage.event_features.add');
    }

    public function StoreEventFeature(Request $request)
    {
        $request->validate(['name' => 'required', 'description' => 'required']);

        EventFeature::create([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.event.features')->with([
            'message' => 'Event Feature Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditEventFeature($id)
    {
        $feature = EventFeature::findOrFail($id);
        return view('backend.homepage.event_features.edit', compact('feature'));
    }

    public function UpdateEventFeature(Request $request)
    {
        EventFeature::findOrFail($request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('all.event.features')->with([
            'message' => 'Event Feature Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteEventFeature($id)
    {
        EventFeature::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Event Feature Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    // ═══════════════════════════════════════
    //  HOME SECTIONS (section-level content)
    // ═══════════════════════════════════════
    public function EditSections()
    {
        $sections = HomeSection::all()->keyBy('section_key');

        // Ensure all keys exist
        $keys = ['hero', 'about', 'rooms', 'amenities', 'dining', 'events', 'testimonials', 'contact'];
        foreach ($keys as $key) {
            if (!isset($sections[$key])) {
                $sections[$key] = HomeSection::create(['section_key' => $key]);
            }
        }

        return view('backend.homepage.sections.edit', compact('sections'));
    }

    public function UpdateSections(Request $request)
    {
        foreach ($request->sections as $key => $data) {
            $section = HomeSection::firstOrCreate(['section_key' => $key]);
            $updateData = [
                'eyebrow' => $data['eyebrow'] ?? null,
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null,
                'description_2' => $data['description_2'] ?? null,
                'badge_value' => $data['badge_value'] ?? null,
                'badge_label' => $data['badge_label'] ?? null,
                'button_text' => $data['button_text'] ?? null,
                'button_url' => $data['button_url'] ?? null,
            ];

            // Handle image upload per section
            if ($request->hasFile("sections.{$key}.image")) {
                $file = $request->file("sections.{$key}.image");
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/sections'), $filename);
                if ($section->image && file_exists(public_path($section->image))) {
                    @unlink(public_path($section->image));
                }
                $updateData['image'] = 'upload/sections/' . $filename;
            }

            $section->update($updateData);
        }

        return redirect()->back()->with([
            'message' => 'All Sections Updated Successfully',
            'alert-type' => 'success'
        ]);
    }
}
