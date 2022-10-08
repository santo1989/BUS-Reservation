<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('backend.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('backend.buses.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            // unset($data['_token']);
          $busdata =  Bus::create([
                'name' => $data['name'],
                'reg_number' => $data['reg_number'],
                'no_of_seat' => $data['no_of_seat'],
                'features_details' => $data['features_details'],
                'other_details' => $data['other_details'],
            ]);

            if ($request->images && count($request->images) > 0) {
                $images = [];
                for ($i = 0; $i < count($request->images); $i++) {
                    $image = $request->images[$i];
                    $filename = time() . $i . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/Buses/');
                    $image->move($location, $filename);
                    $images[$i] = $filename;
                    sleep(1);
                }
                $busdata->update([
                    'images' => json_encode($images),
                ]);
            }

            return redirect()->route('buses.index')->withMessage("Successfully created driver with user");
            
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function edit($id)
    {
        $single_buse = Bus::find($id);
        return view('backend.buses.edit', compact('single_buse'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $bus = Bus::find($id);
            $bus->update([
                'name' => $data['name'],
                'reg_number' => $data['reg_number'],
                'no_of_seat' => $data['no_of_seat'],
                'features_details' => $data['features_details'],
                'other_details' => $data['other_details'],
            ]);

            return redirect()->route('buses.index')->withMessage("Successfully updated bus");
            
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $bus = Bus::find($id);
            $bus->delete();
            foreach (json_decode($bus->images) as $image) {
                $location = public_path('images/Buses/' . $image);
                if (file_exists($location)) {
                    unlink($location);
                }
            }

            return redirect()->route('buses.index')->withMessage("Successfully deleted bus");
            
        } catch (QueryException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        $show_buse = Bus::find($id);
        return view('backend.buses.show', compact('show_buse'));
    }
}
