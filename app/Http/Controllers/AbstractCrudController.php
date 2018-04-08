<?php

namespace App\Http\Controllers;

use App\Core\ParamsValidator;
use App\Core\Responder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

/**
 * Class AbstractCrudController.
 *
 * @package App\Http\Controllers
 * @author Henry Harris <henry@104101110114121.com>
 */
class AbstractCrudController extends Controller
{
    /** @var Request $request */
    protected $request;

    /** @var Responder $responder */
    protected $responder;

    /** @var  ParamsValidator $validator */
    protected $validator;

    /** @var array $creationValidation */
    protected $creationValidation;

    /** @var Model $model */
    protected $model;

    /**
     * AbstractCrudController constructor.
     *
     * @param Request $request
     * @param Responder $responder
     * @param ParamsValidator $validator
     */
    public function __construct(
        Request $request,
        Responder $responder,
        ParamsValidator $validator
    ) {
        $this->request = $request;
        $this->responder = $responder;
        $this->validator = $validator;
    }

    /**
     * GET
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function read($id)
    {
        try {
            $result = $this->model::findOrFail($id);
        } catch (ModelNotFoundException $mnfe) {
            return $this->responder->notFoundResponse('No such item found');
        }

        return $this->responder->successResponse($result, 'read');
    }

    /**
     * POST
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Prepare options for creating item
        $params = $this->getParams(
            array_keys($this->validator)
        );

        $creationValidator = $this->validate($params, $this->creationValidation);

        if (!($creationValidator->passes() && $metadataValidator->passes())) {
            return $this->responder->badRequestResponse(
                'validations failed',
                array_merge(
                    $creationValidator->errors()->messages(),
                    $metadataValidator->errors()->messages()
                )
            );
        }

        $params['metadata'] = $metaData;

        try {
            $model = $this->model;
            /** @var StripeModel $result */
            $result = $model::create($params);
        } catch (Exception $e) {
            return $this->responder->badRequestResponse(
                'Unable to create item',
                [$e->getMessage()]
            );
        }

        return $this->responder->itemCreatedResponse($result, 'create');
    }

    /**
     * DELETE
     * Remove the specified resource from storage.
     *
     * @param  string $id
     *
     * @return Response
     */
    public function destroy(string $id)
    {
        try {
            $model = $this->model;
            $item = $model::findOrFail($id);
            $item->delete();
        } catch (ModelNotFoundException $mnfe) {
            return $this->responder->badRequestResponse(
                'No such item found'
            );
        }

        return $this->responder->successResponse($id, 'deleted');
    }
    
    /**
     * Validate a request
     *
     * @param Request $request
     * @param array $validation
     *
     * @return Response|null
     */
    public function validateRequest($request, $validation) {
        $validator = $this->validator->validateParams(
            $request->toArray(),
            $validation
        );

        if (!$validator->passes()) {
            $errors = $validator->errors()->messages();

            return $this->responder->badRequestResponse(
                'validation failed',
                [
                    'errors' => $errors,
                    'messages' => implode(
                        "\n",
                        array_map('array_pop', $errors)
                    ),
                ]
            );
        }

        return null;
    }

    /**
     * @param array $keys
     * @return array
     */
    protected function getParams($keys = []) {
        $get = [];

        foreach ($keys as $key) {
            if ($this->request->exists($key)) {
                $get[$key] = $this->request->get($key);
            }
        }

        return $get;
    }
}
