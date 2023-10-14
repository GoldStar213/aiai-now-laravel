<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use App\Models\Category;
use App\Models\Service;

class Command230719CategoryReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:category-reset-230719';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        error_log("START!");

        $cat_others = Category::updateOrCreate(
            [
                'title' => 'その他', 
            ],
            [
                'slug' => 'others', 
                'order' => 1, 
            ]
        );

        $cat_no_slugs = Category::where('slug', '')->get();
        foreach ($cat_no_slugs as $cat_src) {
            $services = Service::where('category_id', $cat_src->id)->get();

            foreach ($services as $item) {
                $item->category_id = $cat_others->id;
                $item->save();
            }

            $cat_src->delete();
        }

        error_log("OK!");

        return 0;
    }
}
