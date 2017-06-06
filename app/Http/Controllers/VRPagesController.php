<?php namespace App\Http\Controllers;

use App\Models\VRCategories;
use App\Models\VRLanguages;
use App\Models\VRPages;
use App\Models\VRPagesTranslations;
use App\Models\VRResources;
use Illuminate\Routing\Controller;

class VRPagesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrpages
     *
     * @return Response
     */
    public function adminIndex()
    {
        $config = $this->getRoutesData();
        $config['list'] = VRPages::with(['translationsInfo', 'coverImages'])->get()->toArray();
        $config['listName'] = 'Pages list';
        $config['ignore'] = ['resource_id','deleted_at'];
        $config['array_key'] = 'pivot';
        $config['url'] = url('admin/pages/create');
        $config['coverImage'] = VRResources::all()->pluck('path', 'id')->toArray();
        //$config['list']= VRPages::get()->toArray();

        return view('admin.adminList', $config);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrpages/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $config = [];
        $config['category'] = VRCategories::pluck('id', 'id')->toArray();
        $config['resource'] = VRResources::pluck('path', 'id')->toArray();
        $config['language'] = VRLanguages::pluck('name', 'id')->toArray();
//dd($config);
        return view('admin.adminPagesCreate', $config);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrpages
     *
     * @return Response
     */
    public function adminStore()
    {
        $data = request()->all();
        $record = VRPages::create(array(
            'category_id' => $data['category_id'],
        ));

        VRPagesTranslations::create(array(
            'page_id' => $record->id,
            'language_id' => $data['language_id'],
            'title' => $data['title'],
            'description_short' => $data['description_short'],
            'description_long' => $data['description_long'],
            'slug' => $data['slug']
        ));
        return redirect('/admin/pages/')->with('message', 'Puslapis sėkmingai sukurtas!');
    }

    /**
     * Display the specified resource.
     * GET /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminShow($id)
    {
        $configuration = $this->getRoutesData();
        $configuration['title'] = "Page with translations data";
        $configuration ['single'] = VRPages::with(['translations', 'coverImages'])->find($id)->toArray();

        return view('admin.adminPagesSingle', $configuration);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrpages/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
        $config = [];
        $config['single'] = VRPages::with(['translationsData'])->find($id)->toArray();
        $config['category'] = VRCategories::pluck('id', 'id')->toArray();
        $config['resource'] = VRResources::pluck('path', 'id')->toArray();
        $config['language'] = VRLanguages::pluck('name', 'id')->toArray();
        $config['languageCode'] = request()->segment(5);
        $config['sing'] = VRPages::find($id)->toArray();

        return view('admin.adminPagesEdit', $config);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminUpdate($id)
    {
        $data = request()->all();

        $record = VRPages::find($id);
        $record->update($data);

        $translation = VRPagesTranslations::where('page_id', $id)->get()
            ->where('language_id', $data['language_id'])
            ->first();
        if ($translation) {
            $translation->update($data);
        } else {
            $data['page_id'] = $record->id;
            VRPagesTranslations::create($data);
        }
        return redirect('/admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrpages/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminDestroy($id)
    {
        VRPagesTranslations::destroy(VRPagesTranslations::where('page_id', $id)->pluck('id')->toArray());
        VRPages::destroy($id);

        return json_encode(["success" => true, "id" => $id]);
    }

    public function getRoutesData()
    {
        $config = [];
        $config ['list'] = 'app.admin.pages.index';
        $config ['showDelete'] = 'app.admin.pages.showDelete';
        $config ['edit'] = 'app.admin.pages.edit';
//        $config['routeShowDelete'] = 'app.admin.pages.showDelete';
//        $config['routeEdit'] = 'app.admin.pages.edit';
        return $config;
    }


}

