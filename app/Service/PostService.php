<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            //В дату где приходит изображение перезаписываем путь то картинки, которую отправили в Storage
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

            //Получаем тэги и сразу их уничтожааем из даты, т.к. сохраняются они отдельной моделью
            if (isset($data['tag_ids'])){
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            //Записываем наш пост в переменную, чтобы потом связать с ним id тэгов
            $post = Post::firstOrcreate($data);
            if (isset($tagIds)){
                $post->tags()->attach($tagIds);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }


    public function update($data, $post)
    {
        try {
            DB::beginTransaction();

            //В дату где приходит изображение перезаписываем путь то картинки, которую отправили в Storage
            if (isset($data['preview_image'])){
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if (isset($data['main_image'])){
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            //Получаем тэги и сразу их уничтожааем из даты, т.к. сохраняются они отдельной моделью
            if (isset($data['tag_ids'])){
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            //Записываем наш пост в переменную, чтобы потом связать с ним id тэгов
            $post->update($data);
            if ($tagIds){
                $post->tags()->sync($tagIds);
            }

            DB::commit();

            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
