<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\HizbResource;
use App\Models\Hizb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class HizbController extends Controller
{

    /**
     * get all hizb.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Hizb::class)
            ->allowedIncludes(['channels'])
            ->allowedFilters([
                AllowedFilter::scope('by_search'),
                'name',
                'type'
            ])
            ->defaultSort('-created_at')
            ->allowedSorts('name', 'created_at', 'id')
            ->paginate($request->get('per_page', 30));

        return HizbResource::collection($data);
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

        $hizb = new Hizb;
        $hizb->name = $request->name;
        $hizb->icon = $request->icon;
        $hizb->save();
        
        return new HizbResource($hizb);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hizb $hizb)
    {
        return new HizbResource($hizb);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hizb $hizb)
    {
        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $hizb->name = $request->name;
        $hizb->icon = $request->icon;
        $hizb->save();
        
        return new HizbResource($hizb);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hizb $hizb)
    {
        $hizb->delete();
        return response(['status' => 'hizb deleted']);
    }

}