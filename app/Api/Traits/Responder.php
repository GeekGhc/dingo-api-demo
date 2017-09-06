<?php

namespace App\Api\Traits;


use App\Api\Helpers\Api\ApiSerializer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

trait Responder{

    use Helpers;

    public function responseCollection(Collection $collection, TransformerAbstract $transformer)
    {
        return $this->response->collection($collection, $transformer, [], function ($resource, Manager $fractal) {
            $fractal->setSerializer(new ApiSerializer());
        });
    }

    public function responseItem($item, TransformerAbstract $transformer)
    {
        return $this->response->item($item, $transformer, [], function ($resource, Manager $fractal) {
            $fractal->setSerializer(new ApiSerializer());
        });
    }

    //分页
    public function responsePaginate(Paginator $paginator, TransformerAbstract $transformer)
    {
        return $this->response->paginator($paginator, $transformer, [], function ($resource, Manager $fractal) {
            $fractal->setSerializer(new ApiSerializer());
        });
    }

    public function responseData(array $data)
    {
        return Response::json([
            'code' => 1,
            'data' => $data
        ], 200);
    }

    public function responseSuccess($message='操作成功')
    {
        return Response::json([
            'msg' => $message,
            'code' => 1
        ], 200);
    }

    public function responseFailed($message='操作失败')
    {
        return Response::json([
            'msg' => $message,
            'code' => 0
        ], 400);
    }

    public function responseError($message='未知错误')
    {
        return Response::json([
            'msg' => $message,
            'code' => 0
        ], 500);
    }
}