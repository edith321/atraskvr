<?php

namespace App\Http\Controllers;




use App\Models\VrMenu;
use App\Models\VrMenuTranslations;

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
        $config['list'] = VrMenu::get()->toArray();
        $config['title'] = trans('app.adminMenuMenus');
        $config['no_data'] = trans('app.adminNoData');
        $config['new'] = route('app.menu.create');
        $config['edit'] = 'app.menu.edit';
        $config['delete'] = 'app.menu.destroy';
        return view('admin.adminList', $config);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function create()
    {
        $config = $this->getFormData();
        $config['submit'] = route('app.menu.create');
        $config['title_name'] = trans('app.adminCreate');
        return view('admin.adminForm', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */


    public function store()
    {

        $data = request()->all();
        $record = VrMenu::create($data);
        $data['record_id'] = $record->id;
        VrMenuTranslations::create($data);

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

        $lang = request('language_code');

        if($lang == null) {
            $lang = app()->getLocale();
        }

        $config['title'] = trans('app.adminMenuMenus');
        $config['back'] = route('app.menu.index');
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
            "label" => trans('app.adminURL')
        ];
        $config['fields'][] = [
            "type" => "checkbox",
            "key" => "new_window",
            "label" => trans('app.adminNewWindow') . '?',
            "options" => [
                [
                    "name" => "new_window",
                    "value" => 1,
                    "title" => trans('app.adminYes'),
                ],
            ],
        $config['fields'][] = [
            "type" => "single_line",
            "key" => "sequence",
            "label" => trans('app.adminSequence')
        ],

        $config['fields'][] = [
            "type" => "drop_down",
            "key" => "parent_id",
            "label" => trans('app.adminParent'),
            "options" => VrMenuTranslations::where('language_code', $lang)->pluck('name', 'record_id'),
            ],
        ];
        return $config;
    }
}