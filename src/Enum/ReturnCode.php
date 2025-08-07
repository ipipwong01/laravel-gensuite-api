<?php
namespace Genusis\GenSuite\Enums;

enum ReturnCode: string
{
    case SUCCESS = 'success';
    case ACCOUNT_DISABLED = 'account_disabled';
    case ACCOUNT_EXPIRED = 'account_expired';
    case BAD_SENDERID = 'bad_senderid';
    case INSUFFICIENT_BALANCE = 'insufficient_balance';
    case INVALID_ACCOUNT = 'invalid_account';
    case INVALID_ACTION = 'invalid_action';
    case INVALID_APITYPE = 'invalid_apitype';
    case INVALID_AUTH = 'invalid_auth';
    case INVALID_DATESCHEDULE = 'invalid_dateschedule';
    case INVALID_DOMAIN = 'invalid_domain';
    case INVALID_FREQUENCY = 'invalid_frequency';
    case INVALID_KEY = 'invalid_key';
    case INVALID_LENGTH = 'invalid_length';
    case INVALID_MEDIA = 'invalid_media';
    case MEDIA_EXCEEDED = 'media_exceeded';
    case MONTHLY_LIMIT_EXCEEDED = 'monthly_limit_exceeded';
    case NO_CREDIT = 'no_credit';
    case NO_RECIPIENT = 'no_recipient';
    case NO_PRICETAG = 'no_pricetag';
    case NO_PRIVILEGE = 'no_privilege';
    case POSTPAID_LIMIT_EXCEEDED = 'postpaid_limit_exceeded';
    case RECIPIENT_EXCEEDED = 'recipient_exceeded';
    case RECORD_NOT_FOUND = 'record_not_found';
    case WEEKLY_LIMIT_EXCEEDED = 'weekly_limit_exceeded';
    case WRONG_NUMBER = 'wrong_number';
    case FAILED = 'failed';
}
