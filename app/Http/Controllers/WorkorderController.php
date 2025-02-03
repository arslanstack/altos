<?php

namespace App\Http\Controllers;

use App\Models\Workorder;
use App\Http\Requests\StoreworkorderRequest;
use App\Http\Requests\UpdateworkorderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (Auth::user()->hasRole('admin')) {
            $workorders = Workorder::all();
            return view('workorders.index', compact('workorders'));
        } else {
            $workorders = Workorder::where('user_id', auth()->id())->get();
            return view('workorders.index', compact('workorders'));
        }

        /*$workorders =Workorder::where('user_id', auth()->id())->get();
        return view('workorders.index', compact('workorders'));*/
        //->with(
        //    'workorders', $workorders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workorders.create');
    }
'url' => 'https://altosprintandcopy.com/public/' . ('storage/uploads/' . $workorder->user->name . '_' . $workorder->user->id . '/' . $workorder->jobname . '_' . $workorder->id . '/' . $workfiles[0]),
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreworkorderRequest $request)
    {
        $workorder = Workorder::create(['user_id' => auth()->id()] + $request->all());;
        $folder = 'public/uploads/' . Auth::user()->name . '_' . Auth::user()->id . '/' . $workorder->id;
        Storage::makeDirectory($folder);
        return redirect()->route('upload-files', $workorder->id);
        // return back()->with('success', 'Workorder Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $workorder = Workorder::with('user')->findOrFail($id);
        if ($workorder->files != null || $workorder->files != '') {

            $workfiles = json_decode($workorder->files, true);
            $file = [
                'title' => $workfiles[0],
                'url' => '',
            ];
        } else {
            $file = [
                'title' => 'No file uploaded',
                'url' => '',
            ];
        }

        return view('workorders.show', compact(['workorder', 'file']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(workorder $workorder)
    {
        $workorders = Workorder::where('user_id', auth()->id())->get();
        $workorder = Workorder::where('id', $workorder->id)->first();
        if ($workorder->files != null || $workorder->files != '') {
            $workfiles = json_decode($workorder->files, true);
            $file = [
                'title' => $workfiles[0],
                'url' => '',
            ];
        } else {
            $file = [
                'title' => 'No file uploaded',
                'url' => '',
            ];
        }

        if (Auth::user()->hasRole('admin')) {
            return view('workorders.edit', compact(['workorder', 'file']));
        } elseif (Auth::user()->hasRole('user')) {
            return view('workorders.edit', compact(['workorders', 'file']));
        }


        /*if(auth() ->id() == $workorder->user_id){
            return view('workorders.edit',compact('workorder'));
        }else{
            return redirect()->route('workorders.index')->withErrors(['msg'=>'Youy are not allowed']);
        }*/
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateworkorderRequest $request, workorder $workorder)
    {
        if (Auth::user()->hasRole('admin')) {
            $workorder->update($request->all());
            return redirect()->route('workorders.index');
        } elseif (Auth::user()->hasRole('user')) {
            $workorder->update($request->all());
            return redirect()->route('workorders.index');
        } else {
            return redirect()->route('workorders.index')->withErrors(['msg' => 'Youy are not allowed']);
        }

        /*if(auth() ->id() == $workorder->user_id){
            $workorder->update($request->all());
            return redirect()->route('workorders.index');
        }else{
            return redirect()->route('workorders.index')->withErrors(['msg'=>'Youy are not allowed']);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(workorder $workorder)
    {
        $workorder->delete();
        return back()->with('success', 'Workorder Deleted Successfully');
    }

    public function download($id)
    {
        $authUser = Auth::user();
        $workorder = Workorder::where('id', $id)->first();
            if (!$workorder) {
                return back()->withErrors(['msg' => 'Workorder not found']);
            }
        if ($authUser->hasRole('admin') || $authUser->id == $workorder->user_id) {
            
            $workfiles = json_decode($workorder->files, true);
            $file = $workfiles[0];
            $path = storage_path('app/public/uploads/' . $workorder->user->name . '_' . $workorder->user->id . '/' . $workorder->jobname . '_' . $workorder->id . '/'  . $file);
            return response()->download($path);
        } else {
            return redirect()->route('workorders.index')->withErrors(['msg' => 'You are not allowed']);
        }
    }
}
