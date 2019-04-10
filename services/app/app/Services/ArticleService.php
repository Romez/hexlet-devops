<?php
namespace App\Services;

use App\Article;
use App\Jobs\StoreCover;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use function Stringy\create as s;

class ArticleService
{
    public static function createArticle($data)
    {
        $article = new Article($data);
        $article->save();

        if ($article->transitionAllowed('save_image')) {
            StoreCover::dispatch($article);
        }

        return true;
    }

    public static function saveImage(ImageManager $imageManager, Article $article) {
        $imgUrl = $article->image;

        $image = $imageManager->make($imgUrl);

        $imageName = s(time())->append('.jpg');
        $imagePath = $article->imagePath->append($imageName);

        Storage::makeDirectory($article->imagePath);

        $image->save(Storage::path($imagePath));

        $article->image = $imageName;

        return true;
    }
}
