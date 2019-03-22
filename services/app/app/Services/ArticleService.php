<?php
namespace App\Services;

use App\Article;
use App\Jobs\StoreCover;
use Intervention\Image\ImageManager;
use function Stringy\create as s;

class ArticleService implements ArticleServiceInterface
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function createArticle($data)
    {
        $article = new Article($data);

        eval(\Psy\sh());

//        $article->name = $data['name'];
//        $article->body = $data['body'];
//        $article->image = $data['image'];
        $article->save();

        StoreCover::dispatch($article);
        return true;
    }

    public function saveImage(Article $article) {
        $imgUrl = $article->image;

        $image = $this->imageManager->make($imgUrl);

        $imageName = s(time())->append('.jpg');
        $imagePath = s(storage_path('app/public/articles/'))->append($imageName);

        $image->save($imagePath);
    }
}
