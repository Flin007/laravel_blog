<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class  UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post )
    {
        $data = $request->validated();
        //В дату где приходит изображение перезаписываем путь то картинки, которую отправили в Storage
        $data['preview_image'] = Storage::disk('public')->put('/images',$data['preview_image']);
        $data['main_image'] = Storage::disk('public')->put('/images',$data['main_image']);

        //Получаем тэги и сразу их уничтожааем из даты, т.к. сохраняются они отдельной моделью
        $tagIds = $data['tag_ids'];
        unset($data['tag_ids']);

        //Записываем наш пост в переменную, чтобы потом связать с ним id тэгов
        $post->update($data);
        $post->tags()->sync($tagIds);
        return view('admin.post.show', compact('post'));
    }
}
