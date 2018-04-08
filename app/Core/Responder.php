<?php

namespace App\Core;

use Illuminate\Http\Response;
use App\Core\Interfaces\ResponderInterface;

/**
 * Class Responder.
 *
 * @package App\Core
 * @author Henry Harris <henry@104101110114121.com>
 */
class Responder implements ResponderInterface
{
    const JSON_OPTIONS = JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE;

    /**
     * @param $code
     * @param string $message
     * @return Response
     */
    private function baseResponse($code, $message = '')
    {
        $content = [
            'code' => $code,
            'message' => $message,
        ];

        return response()->json($content, $code, [], static::JSON_OPTIONS);
    }

    private function baseErrorResponse($code, $message = '', $errors = [])
    {
        $content = [
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ];

        return response()->json($content, $code, [], static::JSON_OPTIONS);
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function unauthorizedContentResponse($message = 'unauthorized content')
    {
        return $this->baseResponse(405, $message);
    }

    /**
     * @return Response
     */
    public function notLoggedResponse()
    {
        return $this->baseResponse(401, 'need authorization');
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function errorResponse($message = '')
    {
        return $this->baseResponse(500, $message);
    }

    /**
     * @param string $message
     * @param array $errors
     *
     * @return Response
     */
    public function badRequestResponse($message = '', $errors = [])
    {
        return $this->baseErrorResponse(400, $message, $errors);
    }

    /**
     * Response for if their terms of service acceptance is out of date.
     *
     * @param string $message
     * @param array $errors
     *
     * @return Response
     */
    public function tosFailedResponse($message = '', $errors = [])
    {
        return $this->baseErrorResponse(401, $message, $errors);
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function forbiddenResponse($message = '', $errors = [])
    {
        return $this->baseErrorResponse(403, $message, $errors);
    }

    /**
     * @param string $message
     *
     * @return Response
     */
    public function notFoundResponse($message = '')
    {
        return $this->baseResponse(404, $message);
    }

    public function slapiMirrorResponse($response)
    {
        return response()->json($response, $response['code'], [], static::JSON_OPTIONS);
    }

    /**
     * @param int $data
     * @param string $message
     * @param int $page
     * @param int $limit
     * @param int $totalPages
     * @param int $total
     *
     * @return Response
     */
    public function successResponse(
        $data = 0,
        $message = '',
        $page = 0,
        $limit = 0,
        $totalPages = 0,
        $total = 0
    ) {
        $content = [
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ];

        if ($page > 0 && $limit > 0) {
            $content['page'] = $page;
            $content['limit'] = $limit;
            $content['totalPages'] = $totalPages;
            $content['total'] = $total;
        }

        return response()->json($content, 200, [], static::JSON_OPTIONS);
    }

    /**
     * @param int $file
     * @param int $model
     *
     * @return Response
     */
    public function successUploadResponse($file = 0, $model = 0)
    {
        $content = [
            'code' => 201,
            'data' => $model,
            'link' => $file,
        ];

        if (isset($model['fileName'])) {
            $content['filename'] = $model['fileName'];
        }

        return response()->json($content, 200, [], static::JSON_OPTIONS);
    }

    /**
     * @return Response
     */
    public function emptySetResponse()
    {
        $content = [
            'code' => 204,
            'message' => 'no data found',
            'data' => [],
        ];

        return response()->json($content, 204, [], static::JSON_OPTIONS);
    }

    /**
     * @param int $data
     * @param string $message
     *
     * @return Response
     */
    public function itemUpdatedResponse($data = 0, $message = '')
    {
        $content = [
            'code' => 202,
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($content, 202, [], static::JSON_OPTIONS);
    }

    /**
     * @param int $data
     * @param string $message
     *
     * @return Response
     */
    public function itemCreatedResponse($data = 0, $message = '')
    {
        $content = [
            'code' => 201,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($content, 201, [], static::JSON_OPTIONS);
    }

    /**
     * @param $data
     * @param $filename
     * @param $contentType
     *
     * @return Response
     */
    public function fileDownloadResponse($data, $filename, $contentType)
    {
        return response()->make(
            $data,
            200,
            [
                'Content-Type' => $contentType,
                'Content-Disposition' => "attachment;filename={$filename}",
            ]
        );
    }

    /**
     * @return Response
     */
    public function itemDeletedResponse()
    {
        return response()->json([], 204, [], static::JSON_OPTIONS);
    }
}
