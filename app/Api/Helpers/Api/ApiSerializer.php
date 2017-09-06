<?php
namespace App\Api\Helpers\Api;


use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\ResourceInterface;

class ApiSerializer extends SerializerAbstract
{
    public function collection($resourceKey, array $data,$appendData = true)
    {
        if ($resourceKey == true){
            return $data;
        }

        return [
            'code' => 1,
            'data' => ['list'=>$data ]
        ];

    }

    public function item($resourceKey, array $data)
    {
        return $data;
    }
    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null()
    {
        return [];
    }
    /**
     * Serialize the included data.
     *
     * @param ResourceInterface $resource
     * @param array             $data
     *
     * @return array
     */
    public function includedData(ResourceInterface $resource, array $data)
    {
        return $data;
    }
    /**
     * Serialize the meta.
     *
     * @param array $meta
     *
     * @return array
     */
    public function meta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }
        return $meta;
    }
    /**
     * Serialize the paginator.
     *
     * @param PaginatorInterface $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int) $paginator->getCurrentPage();
        $lastPage = (int) $paginator->getLastPage();
        $pagination = [
            'total' => (int) $paginator->getTotal(),
            'count' => (int) $paginator->getCount(),
            'perPage' => (int) $paginator->getPerPage(),
            'currentPage' => $currentPage,
            'totalPages' => $lastPage,
        ];
        $pagination['links'] = [];
        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }
        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }
        return ['pagination' => $pagination];
    }
    /**
     * Serialize the cursor.
     *
     * @param CursorInterface $cursor
     *
     * @return array
     */
    public function cursor(CursorInterface $cursor)
    {
        $cursor = [
            'current' => $cursor->getCurrent(),
            'prev' => $cursor->getPrev(),
            'next' => $cursor->getNext(),
            'count' => (int) $cursor->getCount(),
        ];
        return ['cursor' => $cursor];
    }
}