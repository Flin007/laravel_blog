<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            //В дату где приходит изображение перезаписываем путь то картинки, которую отправили в Storage
            $data['preview_image'] = Storage::disk('public')->put('/images',$data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images',$data['main_image']);

            //Получаем тэги и сразу их уничтожааем из даты, т.к. сохраняются они отдельной моделью
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
            //Записываем наш пост в переменную, чтобы потом связать с ним id тэгов
            $post = Post::firstOrcreate($data);
            $post->tags()->attach($tagIds);
        }catch (\Exception $e){
            dd($e);
        }

        return redirect()->route('admin.post.index');
    }
}
