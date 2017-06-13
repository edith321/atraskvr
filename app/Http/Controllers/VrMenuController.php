<?php

namespace App\Http\Controllers;




class VrMenuController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrmenu
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */


    public function store()
    {

    }

    /**
     * Display the specified resource.
     * GET /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrmenu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * PUT /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

    }
    /**
     * G
     * @return mixed
     */
    public function getFormData() {

        $config['title'] = trans('app.adminMenuCategories');
        $config['back'] = route('app.categories.index');
        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguages(),
            "label" => trans('app.adminLanguages')
        ];
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "name",
            "label" => trans('app.adminName')
        ];
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "url",
            "label" => trans('app.adminName')
        ];
        $config['fields'][] = [
            "type" => "checkbox",
            "key" => "new_window",
            "label" => trans('app.adminName'),
            "options" => [
                "value" => "label"
            ],
        ];
        return $config;
    }
}