<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\JuzResource;
use App\Models\Juz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class JuzController extends Controller
{

    /**
     * get all juz.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Juz::class)
            ->allowedIncludes(['channels'])
            ->allowedFilters([
                AllowedFilter::scope('by_search'),
                'name',
                'type'
            ])
            ->defaultSort('-created_at')
            ->allowedSorts('name', 'created_at', 'id')
            ->paginate($request->get('per_page', 30));

        return JuzResource::collection($data);
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

        $juz = new Juz;
        $juz->name = $request->name;
        $juz->icon = $request->icon;
        $juz->save();
        
        return new JuzResource($juz);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Juz $juz)
    {
        return new JuzResource($juz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Juz $juz)
    {
        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $juz->name = $request->name;
        $juz->icon = $request->icon;
        $juz->save();
        
        return new JuzResource($juz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Juz $juz)
    {
        $juz->delete();
        return response(['status' => 'juz deleted']);
    }

}