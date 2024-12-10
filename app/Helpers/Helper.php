<?php

use App\Enums\API\ResponseMethodEnum;

function generalApiResponse(
        ResponseMethodEnum $method,
                       $resource = null,
                       $data_passed = null,
                       $custom_message = null,
                       $custom_status_msg = 'success',
                       $custom_status = 200,
                       $additional_data = null
) {
    return match ($method) {
        ResponseMethodEnum::CUSTOM_SINGLE =>
            !is_null($additional_data) ?
            $resource::make($data_passed)->additional(['status' => $custom_status_msg, 'message' => $custom_message, 'additional_data' => $additional_data],
                $custom_status) :
            $resource::make($data_passed)->additional(['status' => $custom_status_msg, 'message' => $custom_message],
                $custom_status),

        ResponseMethodEnum::CUSTOM_COLLECTION =>
            !is_null($additional_data) ?
            $resource::collection($data_passed)->additional(['status' => $custom_status_msg, 'message' => $custom_message, 'additional_data' => $additional_data],
                $custom_status)
            : $resource::collection($data_passed)->additional(['status' => $custom_status_msg, 'message' => $custom_message],
                $custom_status),

        ResponseMethodEnum::CUSTOM =>
        !is_null($additional_data) ?
            response()->json([
                'status' => $custom_status_msg,
                'data' => $data_passed,
                'message' => $custom_message,
                'additional_data' => $additional_data
            ], $custom_status) :
            response()->json([
                'status' => $custom_status_msg,
                'data' => $data_passed,
                'message' => $custom_message
            ], $custom_status),

        default => throw new InvalidArgumentException('Invalid response method'),
    };
}
