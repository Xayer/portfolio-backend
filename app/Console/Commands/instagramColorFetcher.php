<?php

namespace App\Console\Commands;

use App\Repositories\InstagramRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class instagramColorFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:colors:instagram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $repository = new InstagramRepository();
        collect($repository->getRecentPosts())->each(function ($post) {
            collect($post->images)->each(function ($image) {
                $colorPalette = Cache::rememberForever(sprintf('%s_colors', $image->url), function () use ($image) {
                    $colorPalette = Palette::fromFilename($image->url);
                    // an extractor is built from a palette
                    $extractor = new ColorExtractor($colorPalette);

                    // it defines an extract method which return the most “representative” colors
                    $colors = $extractor->extract(5);
                    return collect($colors)->transform(function ($color) {
                        return Color::fromIntToHex($color);
                    });
                });
                $this->line(sprintf('stored color palette %s for %s', json_encode($colorPalette), $image->url));
            });
        });
    }
}
