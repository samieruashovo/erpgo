<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VendorClientController extends Controller
{
    public function vendorClientPage($id) {
        return view('clients.vendorClient', ['id' => $id]);
    }
    public function create()
    {
        return view('vendorClients.create');
    }
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'companyDetails' => 'required|string',
            'attrachment' => 'required|file|mimes:pdf,image',
            'totalPaid' => 'numeric|nullable',
            'totalDue' => 'numeric|nullable',
            // Add validation rules for other fields
        ]);

        // Handle file upload
        if ($request->hasFile('project_image')) {
            $file = $request->file('project_image');
            $path = $file->store('uploads', 'public'); // Adjust the storage path as needed
            $validatedData['project_image'] = $path;
        }

        // Create a new VendorClient instance and store the data
        DB::table('vendor_clients')->insert($validatedData);

        // Redirect back or to a specific page after creating the client
        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }
}
