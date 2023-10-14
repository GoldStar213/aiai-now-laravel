<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

use App\Imports\ServiceImport;
use App\Models\Category;
use App\Models\Region;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Service::with('category', 'region')->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $service = new Service();

        $categories = Category::all();
        $regions = Region::all();

        return view('admin.services.create', compact('service', 'categories', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        $service = Service::Create([
            'title'         => $req->title, 
            'url'           => $req->url, 
            'youtube_url'   => $req->youtube_url, 
            'category_id'   => $req->category, 
            'region_id'     => $req->region, 
            'content'       => $req->content, 
            'price'         => $req->price, 
            'type'          => $req->type, 
            'published'     => $req->published, 
        ]);

        if ($req->hasFile('image') && $req->file('image')->isValid()) {
            $service->clearMediaCollection();
            $service->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect(route('admin.services.edit', $service->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $service = Service::findOrFail($id);

        $categories = Category::all();
        $regions = Region::all();

        $mediaItem = $service->getFirstMedia('images');
        $file_name = !empty($mediaItem) ? $mediaItem->file_name : '';

        $comments = $service->comments;

        return view('admin.services.edit', compact('service', 'categories', 'regions', 'file_name', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $service = Service::findOrFail($id);

        $service->title         = $req->title;
        $service->url           = $req->url;
        $service->youtube_url   = $req->youtube_url;
        $service->category_id   = $req->category;
        $service->region_id     = $req->region;
        $service->content       = $req->content;
        $service->price         = $req->price;
        $service->type          = $req->type;
        $service->published     = $req->published;
        $service->save();

        if ($req->hasFile('image') && $req->file('image')->isValid()) {
            $service->clearMediaCollection();
            $service->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect(route('admin.services.edit', $service->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import()
    {
        $services = Service::all();

        $none_img_service_count = 0;
        foreach ($services as $item) {
            if (empty($item->getFirstMediaUrl('images'))) {
                $none_img_service_count++;
            }
        }

        return view('admin.services.import.index', compact('none_img_service_count'));
    }

    public function import_excel(Request $req)
    {
        if (empty($req->file('excel'))) {
            return back()->withErrors([ 'import_excel_none' => 'ファイルを選択してください' ]);
        }

        $excel_file = $req->file('excel');
        Excel::import(new ServiceImport, $excel_file);
        // return view('admin.services.import.index');

        return redirect(route('admin.services.index'));
    }

    public function image(Request $req)
    {
        $service = Service::findOrFail($req->target);
        if (empty($service)) {
            return back()->withErrors([ 'image_service_none' => 'サービスはありません' ]);
        }

        if (empty($service->url)) {
            return back()->withErrors([ 'image_service_url_none' => 'サービスのURLは未設定です' ]);            
        }

        $url = str_replace("https://", "", $service->url);
        $url = str_replace("http://", "", $url);
        $url = rtrim($url, '/');
        $url = str_replace("?", "_", $url);
        $url = str_replace("/", "_", $url);
        $url = str_replace("%2F", "_", $url);

        $img_path = public_path() . '/tmp/' . $url . '.jpg';

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && 'on' != $req->skip_download) {
            Browsershot::url($service->url)
                // ->setNodeBinary(env('BIN_PATH_NODE'))
                // ->setNpmBinary(env('BIN_PATH_NPM'))
                ->setOption('landscape', true)
                ->setScreenshotType('jpeg')
                ->timeout(300)
                ->noSandbox()
                ->windowSize(1920, 1080)
                ->waitUntilNetworkIdle()
                ->save($img_path);
        }

        if (!file_exists($img_path)) {
            return back()->withErrors([ 'image_service_img_none' => 'サービスの画像はありません' ]);            
        }

        $service->clearMediaCollection();
        $service->addMedia($img_path) //starting method
            ->withCustomProperties(['mime-type' => 'image/jpeg']) //middle method
            ->preservingOriginal() //middle method
            ->toMediaCollection('images');

        return back()->withErrors([ 'image_service_success' => 'サービスの画像設定は成功です' ]);
    }

    public function image_batch(Request $req)
    {
        $services = Service::all();
        foreach ($services as $service) {
            if (!empty($service->getFirstMediaUrl('images')) && empty($req->is_upgrade)) {
                continue;
            }

            $url = str_replace("https://", "", $service->url);
            $url = str_replace("http://", "", $url);
            $url = rtrim($url, '/');
            $url = str_replace("?", "_", $url);
            $url = str_replace("/", "_", $url);
            $url = str_replace("%2F", "_", $url);

            $img_path = public_path() . '/tmp/' . $url . '.jpg';

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && 'on' != $req->skip_download) {
                Browsershot::url($service->url)
                    // ->setNodeBinary(env('BIN_PATH_NODE'))
                    // ->setNpmBinary(env('BIN_PATH_NPM'))
                    ->setOption('landscape', true)
                    ->setScreenshotType('jpeg')
                    ->timeout(300)
                    ->noSandbox()
                    ->windowSize(1920, 1080)
                    ->waitUntilNetworkIdle()
                    ->save($img_path);
            }

            if (file_exists($img_path)) {
                $service->clearMediaCollection();
                $service->addMedia($img_path) //starting method
                    ->withCustomProperties(['mime-type' => 'image/jpeg']) //middle method
                    ->preservingOriginal() //middle method
                    ->toMediaCollection('images');
            }
        }

        return redirect(route('admin.services.index'));
    }

    public function publish(Request $req)
    {
        foreach ($req->publish_id as $k => $item) {
            $service = Service::findOrFail($req->publish_id[$k]);
            $service->published = $req->status[$k];
            $service->save();
        }

        return redirect(route('admin.services.index'));
    }
}