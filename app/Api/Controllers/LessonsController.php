<?php

namespace App\Api\Controllers;

use App\Api\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();
//        return $this->collection($lessons,new LessonTransformer());

        return $this->responseCollection($lessons, new LessonTransformer());
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->response()->errorNotFound("Lesson nt found");
        }
        return $this->responseItem($lesson, new LessonTransformer());
    }
}
