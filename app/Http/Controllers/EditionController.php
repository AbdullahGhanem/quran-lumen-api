<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\EditionResource;
use App\Models\Edition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EditionController extends Controller
{

    /**
     * get all edition.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Edition::class)
            ->allowedIncludes(['ayahs'])
            ->allowedFilters([
                AllowedFilter::scope('by_search'),
                'name',
                'name_en',
                'format',
                'type',
                'identifier',
                'language',
            ])
            ->defaultSort('name')
            ->allowedSorts('name', 'format', 'type', 'language')
            ->paginate($request->get('per_page', 30));

        return EditionResource::collection($data);
    }    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $edition = new Edition;
        $edition->name = $request->name;
        $edition->icon = $request->icon;
        $edition->save();
        
        return new EditionResource($edition);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Edition $edition)
    {
        return new EditionResource($edition->load(['ayahs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Edition $edition)
    {
        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $edition->name = $request->name;
        $edition->icon = $request->icon;
        $edition->save();
        
        return new EditionResource($edition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Edition $edition)
    {
        $edition->delete();
        return response(['status' => 'edition deleted']);
    }

}