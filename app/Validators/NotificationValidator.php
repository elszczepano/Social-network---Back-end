<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class NotificationValidator.
 *
 * @package namespace App\Validators;
 */
class NotificationValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
          'content' => 'required',
          'user_id' => 'required|exists:users,id|integer'
        ],
        ValidatorInterface::RULE_UPDATE => [
          'user_id' => 'exists:users,id|integer'
        ],
    ];
}
