<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Exports\MembersExport;
use App\Imports\MembersImport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index(Request $request): View
    {
        $query = Member::query();

        // Apply filters
        // First filter: DOB
        if ($request->filled('dob')) {
            $query->whereDate('dob', $request->dob);
        }

        // Second filter: Name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Third filter: Area Number
        if ($request->filled('area_number')) {
            $query->where('area_number', 'like', '%' . $request->area_number . '%');
        }

        // Fourth filter: Word
        if ($request->filled('word')) {
            $query->where('word', 'like', '%' . $request->word . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('zila')) {
            $query->where('zila', $request->zila);
        }

        if ($request->filled('upazila')) {
            $query->where('upazila', $request->upazila);
        }

        if ($request->filled('city_corporation')) {
            $query->where('city_corporation', $request->city_corporation);
        }

        if ($request->filled('occupation')) {
            $query->where('occupation', 'like', '%' . $request->occupation . '%');
        }

        // Paginate results for better performance with large datasets
        $members = $query->orderBy('id', 'desc')->paginate(50);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create(): View
    {
        return view('members.create');
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ashon' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'nid' => 'required|string|max:255|unique:members,nid',
            'gender' => 'nullable|in:male,female,hijra,other',
            'fother' => 'nullable|string|max:255',
            'mother' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'zila' => 'nullable|string|max:255',
            'upazila' => 'nullable|string|max:255',
            'city_corporation' => 'nullable|string|max:255',
            'word' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'area_number' => 'nullable|string|max:255',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified member.
     */
    public function show(Member $member): View
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member): View
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member): RedirectResponse
    {
        $validated = $request->validate([
            'ashon' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'nid' => 'required|string|max:255|unique:members,nid,' . $member->id,
            'gender' => 'nullable|in:male,female,hijra,other',
            'fother' => 'nullable|string|max:255',
            'mother' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'zila' => 'nullable|string|max:255',
            'upazila' => 'nullable|string|max:255',
            'city_corporation' => 'nullable|string|max:255',
            'word' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'area_number' => 'nullable|string|max:255',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully.');
    }

    /**
     * Export members to Excel with headers.
     */
    public function export()
    {
        try {
            $filename = 'members_export_' . date('Y-m-d_His') . '.xlsx';
            
            // Check if there are any members
            $memberCount = Member::count();
            if ($memberCount === 0) {
                return redirect()->route('members.index')
                    ->with('error', 'No members to export.');
            }
            
            // Try multiple methods to get Excel instance
            $excel = null;
            
            // Method 1: Try service container binding
            try {
                $excel = app('excel');
            } catch (\Exception $e1) {
                // Method 2: Try ExcelManager class
                try {
                    $excel = app(\Maatwebsite\Excel\ExcelManager::class);
                } catch (\Exception $e2) {
                    // Method 3: Try facade with full namespace
                    $excel = \Maatwebsite\Excel\Facades\Excel::getFacadeRoot();
                }
            }
            
            return $excel->download(new MembersExport, $filename);
        } catch (\Exception $e) {
            Log::error('Export failed: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return redirect()->route('members.index')
                ->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    /**
     * Show the import form.
     */
    public function showImport(): View
    {
        return view('members.import');
    }

    /**
     * Import members from Excel file.
     */
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB max
        ]);

        try {
            $updateExisting = $request->has('update_existing');
            $import = new MembersImport($updateExisting);
            
            // Try multiple methods to get Excel instance
            $excel = null;
            
            // Method 1: Try service container binding
            try {
                $excel = app('excel');
            } catch (\Exception $e1) {
                // Method 2: Try ExcelManager class
                try {
                    $excel = app(\Maatwebsite\Excel\ExcelManager::class);
                } catch (\Exception $e2) {
                    // Method 3: Try facade with full namespace
                    $excel = \Maatwebsite\Excel\Facades\Excel::getFacadeRoot();
                }
            }
            
            $excel->import($import, $request->file('file'));
            
            $failures = $import->failures();
            $imported = $import->imported;
            $skipped = $import->skipped;
            
            $message = "Import completed! Imported: {$imported}, Skipped: {$skipped}";
            
            if ($failures->count() > 0) {
                $errorMessages = [];
                foreach ($failures as $failure) {
                    $row = $failure->row();
                    $errors = implode(', ', $failure->errors());
                    $errorMessages[] = "Row {$row}: {$errors}";
                }
                
                if (count($errorMessages) <= 10) {
                    $message .= "\nErrors: " . implode(', ', $errorMessages);
                } else {
                    $message .= "\n" . count($errorMessages) . " errors occurred. First 10: " . implode(', ', array_slice($errorMessages, 0, 10));
                }
            }
            
            return redirect()->route('members.index')
                ->with('success', $message);
                
        } catch (\Exception $e) {
            return redirect()->route('members.import')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Delete all members from storage.
     */
    public function deleteAll(): RedirectResponse
    {
        $count = Member::count();
        
        if ($count > 0) {
            Member::truncate();
            
            return redirect()->route('members.index')
                ->with('success', "সব সদস্য ({$count} টি) সফলভাবে মুছে ফেলা হয়েছে।");
        }
        
        return redirect()->route('members.index')
            ->with('info', 'মুছে ফেলার জন্য কোন সদস্য নেই।');
    }

    /**
     * Search members via AJAX for modal display.
     */
    public function search(Request $request)
    {
        $query = Member::query();

        // Apply filters
        if ($request->filled('dob')) {
            $query->whereDate('dob', $request->dob);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Get results (limit to 100 for modal display)
        // $members = $query->orderBy('id', 'desc')->limit(100)->get();
        $members = $query->orderBy('id', 'desc')->get();

        // Format data for display
        $formattedMembers = $members->map(function ($member) {
            return [
                'id' => $member->id,
                'ashon' => $member->ashon ?? 'N/A',
                'name' => $member->name,
                'dob' => $member->dob ? $member->dob->format('Y-m-d') : 'N/A',
                'nid' => $member->nid,
                'gender' => $member->gender == 'male' ? 'পুরুষ' : ($member->gender == 'female' ? 'মহিলা' : ($member->gender == 'hijra' ? 'হিজরা' : ($member->gender ?? 'N/A'))),
                'fother' => $member->fother ?? 'N/A',
                'mother' => $member->mother ?? 'N/A',
                'occupation' => $member->occupation ?? 'N/A',
                'address' => $member->address ?? 'N/A',
                'zila' => $member->zila ?? 'N/A',
                'upazila' => $member->upazila ?? 'N/A',
                'city_corporation' => $member->city_corporation ?? 'N/A',
                'word' => $member->word ?? 'N/A',
                'area' => $member->area ?? 'N/A',
                'area_number' => $member->area_number ?? 'N/A',
            ];
        });

        return response()->json([
            'success' => true,
            'members' => $formattedMembers,
            'count' => $formattedMembers->count()
        ]);
    }
}

