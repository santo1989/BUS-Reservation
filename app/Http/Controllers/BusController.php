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
}
