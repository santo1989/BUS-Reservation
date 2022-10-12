<?php

namespace App\Http\Controllers;

use App\Models\ContractMessage;
use Illuminate\Http\Request;

class ContractMessageController extends Controller
{
    public function index()
    {
        $contractMessages = ContractMessage::all()->sortByDesc('created_at');
        return view('backend.contract-message.index', [
            'contract_messages' => $contractMessages
        ]);

    }

    public function create()
    {
        return view('backend.contract-message.create', [
            'contract_message' => new ContractMessage()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        ContractMessage::create($request->
        only('name', 'email', 'message'));

        // return redirect()->route('backend.contract-message.index')
        //     ->with('success', 'Message sent successfully.');
        return redirect()->back()
            ->withMessage( 'Message sent successfully.');
    }

    public function show($id)
    {
        $contractMessage = ContractMessage::findOrFail($id);
        return view('backend.contract-message.show', ['show_contract_message' => $contractMessage]);
    }

    public function edit($id)
    {
        $contractMessage = ContractMessage::findOrFail($id);
        return view('backend.contract-message.edit', compact('contractMessage'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contractMessage = ContractMessage::findOrFail($id);
        $contractMessage->update($request->only('name', 'email', 'message'));

        return redirect()->route('contract_message.index')
            ->withMessage('Message updated successfully');
    }

    public function destroy($id)
    {
        $contractMessage = ContractMessage::findOrFail($id);
        $contractMessage->delete();
        return redirect()->route('contract_message.index')
            ->withMessage('Message deleted successfully');
    }


}
