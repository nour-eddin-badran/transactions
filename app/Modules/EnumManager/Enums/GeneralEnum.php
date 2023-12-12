<?php

namespace App\Modules\EnumManager\Enums;

use App\Modules\EnumManager\EnumTrait;

class GeneralEnum
{
    use EnumTrait;

    const PAYMENT_METHOD_KEY = 'X-PAYMENT-METHOD';

    const SUCCESS = 'success';
    const FAILED = 'failed';
    const INTERNAL_ERROR = 'internal_error';
    const VALIDATION = 'validation';
    const UNAUTHORIZED = 'unauthorized';
    const INVALID_CREDENTIALS = 'invalid_credentials';
    const INCORRECT_PASSWORD = 'incorrect';
    const NOT_VERIFIED = 'not_verified';
    const BLOCKED = 'blocked';
    const NOT_FOUND = 'not_found';
    const NOT_EXISTED = 'not_existed';
    const NOT_REGISTERED = 'not_registered';
    const NOT_ALLOWED = 'not_allowed';
    const ALREADY_VERIFIED = 'already_verified';
    const ALREADY_REGISTERED = 'already_registered';
    const ALREADY_BOOKED = 'already_booked';
    const ALREADY_ACTIVATED = 'already_activated';
    const ALREADY_PAID = 'already_paid';
    const ALREADY_REFERRED = 'already_referred';
    const INVALID_VERIFICATION_CODE = 'invalid_verification_code';
    const SESSION_COLLISION = 'session_collision';
    const CANT_BE_RATED = "can't be rated";
    const UNEXPECTED_ERROR = 'unexpected_error';
    const DECLINED_TRANSACTION = 'declined_transaction';
    const PENDING_TRANSACTION = 'pending_transaction';
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    const NOT_PARTICIPANT = 'not_participant';
    const ENTITY_COMPLETED = 'completed';
    const ENTITY_CANCELED = 'canceled';
    const ENTITY_NOT_STARTED = 'not_started';
    const ENTITY_WAITING_ROOM = 'waiting_room';
    const ENTITY_CANNOT_BE_STARTED = 'cannot_be_started';
    const ENTITY_EXPIRED = 'expired';

    const ALREADY_APPROVED = 'already_approved';
    const INVALID_COUPON = 'invalid_coupon';
    const ALREADY_COMPLETED = 'already_completed';
    const ALREADY_DEACTIVATED = 'already_deactivated';
    const SUSPENDED = 'suspended';
    const DEACTIVATED = 'deactivated';
}
