<?php

namespace App\Http\Controllers;

use App\Models\VRResources;
use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;


class VRResourcesController extends Controller {

    use ValidatesRequests;
	/**
	 * Display a listing of the resource.
	 * GET /resources
	 *
	 * @return mixed
	 */
	public function adminIndex()
	{
        $resources = VRResources::paginate(4);
        return view('admin.adminResourcesList')->with('vr_resources', $resources);
	}
    /**
     * Show the form for creating a new resource.
     * GET /resources/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        return view('admin.adminUpload');
    }

        /**
         * Uploads file data
         * Creates generates file path
         *
         * @param UploadedFile $file
         * @return mixed
         */
        public function adminUpload(UploadedFile $file)
    {
        $data = [
            "size" => $file->getSize(),
            "mime_type" => $file->getMimeType(),
        ];
        $path = 'upload/' . date("Y/m/d") . '/';
        $fileName = Carbon::now()->timestamp . '_' .$file->getClientOriginalName();

        $file->move(public_path($path), $fileName);
        $data['path'] = $path . $fileName;


        return VRResources::create($data);

    }
    /**
     * Store a newly created resource in storage.
     * POST /resources
     *
     * @return mixed
     */
    protected function adminStore()
    {
//        $this->validate(request(), [
//            'mime_type' => 'required'
//        ]);
        $vr_resources = request()->file('image');

//        $validation = $vr_resources;
//        if ($validation->fails()) {
//            return redirect()->back()->withInput()
//                ->with('errors', $validation->errors());
//        }
        $this->adminUpload($vr_resources);
        return redirect('/admin/upload/')->with('message', 'Failas sėkmingai įkeltas!');
   }

	/**
	 * Display the specified resource.
	 * GET /resources/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminShow($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /resources/{id}
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function adminDestroy($id)
	{
        VRResources::destroy($id);
        return redirect('/admin/upload/')->with('message','Įrašas buvo ištrintas!');
	}
}