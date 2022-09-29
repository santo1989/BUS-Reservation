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
            unset($data['_token']);
            $bus = Bus::create($data);

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
            $bus->update($data);

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
