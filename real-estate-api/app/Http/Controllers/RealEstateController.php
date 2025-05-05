<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealEstateCollection;
use App\Http\Resources\RealEstateResource;
use App\Models\RealEstate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RealEstateController extends Controller
{
    public function index(): RealEstateCollection
    {
        return new RealEstateCollection(RealEstate::query()
            ->select('id', 'name', 'real_state_type', 'city', 'country')
            ->get());
    }

    public function show(RealEstate $realEstate): JsonResponse
    {
        return response()->json(new RealEstateResource($realEstate));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'real_state_type' => ['required', 'string', Rule::in(['house', 'department', 'land', 'commercial_ground'])],
            'street' => ['required', 'string', 'max:128'],
            'external_number' => ['required', 'string', 'max:12', 'regex:/^[a-zA-Z0-9-]+$/'],
            'internal_number' => ['nullable', 'string', 'max:12', 'regex:/^[a-zA-Z0-9- ]+$/'],
            'neighborhood' => ['required', 'string', 'max:128'],
            'city' => ['required', 'string', 'max:64'],
            'country' => ['required', 'string', 'size:2'],
            'rooms' => ['required', 'integer'],
            'bathrooms' => ['required', 'numeric', 'min:0'],
            'comments' => ['nullable', 'string', 'max:128'],
        ]);

        if (!in_array($validated['real_state_type'], ['land', 'commercial_ground'])) {
            $validated['internal_number'] = $validated['internal_number'] ?? null;
        }

        $realEstate = RealEstate::create($validated);

        return response()->json(new RealEstateResource($realEstate), 201);
    }

    public function update(Request $request, RealEstate $realEstate): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:128'],
            'real_state_type' => ['nullable', 'string', Rule::in(['house', 'department', 'land', 'commercial_ground'])],
            'street' => ['nullable', 'string', 'max:128'],
            'external_number' => ['nullable', 'string', 'max:12', 'regex:/^[a-zA-Z0-9-]+$/'],
            'internal_number' => ['nullable', 'string', 'max:12', 'regex:/^[a-zA-Z0-9- ]+$/'],
            'neighborhood' => ['nullable', 'string', 'max:128'],
            'city' => ['nullable', 'string', 'max:64'],
            'country' => ['nullable', 'string', 'size:2'],
            'rooms' => ['nullable', 'integer'],
            'bathrooms' => ['nullable', 'numeric', 'min:0'],
            'comments' => ['nullable', 'string', 'max:128'],
        ]);

        $realEstate->update($validated);

        return response()->json(new RealEstateResource($realEstate));
    }

    public function destroy(RealEstate $realEstate): JsonResponse
    {
        $realEstate->delete();
        return response()->json(null, 204);
    }
}
