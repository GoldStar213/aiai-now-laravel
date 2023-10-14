<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use App\Models\Category;
use App\Models\Region;
use App\Models\Service;

class ServiceImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $is_exist = false;

        if (empty($row[0])) {
            return null;
        }

        $services = Service::where('title', $row[0])->get();
        if (!empty($services) && $services->count() != 0) {
            $is_exist = true;
        }

        $reg_string = explode('/', $row[3]);
        if (count($reg_string) == 0 || $reg_string[0] == '記載されていない') {
            $reg_id  = 0;
        } else {
            $regions = Region::where('name', $reg_string[0])->get();
            if (!empty($regions) && $regions->count() > 0) {
                $reg_id = $regions[0]->id;
            } else {
                $region = Region::create([
                    'name' => $reg_string[0],
                    'code' => ''
                ]);

                $reg_id = $region->id;
            }
        }

        $cat_string = $row[8];
        if (empty($cat_string) || $cat_string == '記載されていない') {
            $category = Category::where('title', 'その他')->first();
            $cat_id = $category->id;
        } else {
            $category = Category::where('title', $cat_string)->get();
            if (!empty($category) && $category->count() > 0) {
                $cat_id = $category[0]->id;
            } else {
                $category = Category::where('title', 'その他')->first();
                $cat_id = $category->id;
            }
        }

        if (!$is_exist) {
            return new Service([
                //
                'title'         => $row[0], 
                'url'           => $row[1], 
                'youtube_url'   => $row[7], 
                'category_id'   => $cat_id, 
                'region_id'     => $reg_id, 
                'content'       => $row[4], 
                'price'         => $row[5], 
                'type'          => $row[6], 
                'published'     => true,

                'likes' => rand(0, 2000), 
                'rating' => rand(0, 1000), 
            ]);
        } else {
            $services[0]->title       = $row[0];
            $services[0]->url         = $row[1];
            $services[0]->youtube_url = $row[7];
            $services[0]->category_id = $reg_id;
            $services[0]->region_id   = $reg_id;
            $services[0]->content     = $row[4];
            $services[0]->price       = $row[5];
            $services[0]->type        = $row[6];
            $services[0]->save();

            return null;
        }
    }
    
    public function startRow(): int
    {
        return 2;
    }
}
