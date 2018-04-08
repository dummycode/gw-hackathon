<?php

namespace App\Core\Interfaces;

/**
 * Interface ResponderInterface
 * 
 * @package App\Core\Interfaces
 */
interface ResponderInterface
{
    public function notLoggedResponse();

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function errorResponse($message = '');

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function badRequestResponse($message = '');

    /**
     * @param int $data
     * @param string $message
     * @param int $page
     * @param int $limit
     * @param int $totalPages
     *
     * @return mixed
     */
    public function successResponse(
        $data = 0,
        $message = '',
        $page = 0,
        $limit = 0,
        $totalPages = 0,
        $total = 0
    );

    public function emptySetResponse();

    /**
     * @param int $data
     * @param string $message
     *
     * @return mixed
     */
    public function itemUpdatedResponse($data = 0, $message = '');

    /**
     * @param int $data
     * @param string $message
     *
     * @return mixed
     */
    public function itemCreatedResponse($data = 0, $message = '');

    /**
     * @param $data
     * @param $filename
     * @param $contentType
     *
     * @return mixed
     */
    public function fileDownloadResponse($data, $filename, $contentType);
}
