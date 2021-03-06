<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\UserGroup;
use App\Repositories\UserGroupRepository;
use App\Validators\UserGroupsValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserGroupsController extends Controller
{
  protected $repository;
  protected $validator;

  public function __construct(UserGroupRepository $repository, UserGroupsValidator $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }


  public function index()
  {
    return $this->repository->with('user')->with('group')->with('role')->get();
  }


  public function store(Request $request)
  {
    try {
      $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

      $userGroup = $this->repository->create($request->all());
      $response = [
        'message' => 'Resource created succesfully',
        'data' => $userGroup
      ];
      return response()->json($response, 201);

    } catch (ValidatorException $e) {
      return response()->json([
        'error'   => true,
        'message' => $e->getMessageBag()
      ]);
    }
  }


  public function show($id)
  {
    return $this->repository->with('user')->with('group')->with('role')->get()->where('id','=',$id)->first();
  }


  public function update(Request $request, $id)
  {
    try {
      $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

      $userGroup = $this->repository->editUserGroup($request->all(), $id);
      $response = [
        'message' => 'Resource updated succesfully',
        'data' => $userGroup
      ];

      return response()->json($response);

    } catch (ValidatorException $e) {
      return response()->json([
        'error'   => true,
        'message' => $e->getMessageBag()
      ]);
    }
  }


  public function destroy($id)
  {
    $deleted = $this->repository->delete($id);
    return response()->json([
      'message' => 'User removed from group succesfully',
      'deleted' => $deleted,
    ]);
  }
}
