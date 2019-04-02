<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Statable;

class Article extends Model
{
    use Statable;

    const SM_CONFIG = 'article';

    protected $fillable = ['body', 'name', 'image'];

    public function updateArticle($data)
    {
        $article = $this->find($data['id']);
        $article->name = $data['name'];
        $article->body = $data['body'];
//        $article->image = $data['image'] ?? null;

        $article->save();

        return true;
    }

    public function setImageAttribute($image = null)
    {
        $this->image = $image;

        if (is_null($image)) {
            $this->state = 'img_default';
        } else {
            $this->state = 'img_not_saved';
        }
    }
}
