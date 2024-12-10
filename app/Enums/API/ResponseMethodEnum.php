<?php
namespace App\Enums\API;

enum ResponseMethodEnum: string
{
    case STORE              =   'store';
    case UPDATE             =   'update';
    case DESTROY            =   'destroy';
    case SERVER_ERROR       =   'server_error';
    case INDEX              =   'index';
    case SHOW               =   'show';
    case UNPROCESSABLE      =   'unprocessable';
    case CUSTOM_SINGLE      =   'custom_single';
    case CUSTOM_COLLECTION  =   'custom_collection';
    case CUSTOM             =   'custom';
}
