<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelRequest $request)
    {
        Gate::authorize('create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelRequest $request, Label $label)
    {
        Gate::authorize('update', $label);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Label $label)
    {
        Gate::authorize('delete', $label);
    }
}
