<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    // Create Token Start ********************************
    public static function createToken($userEmail, $userId, $userRole): string
    {
        try {
            $key = env('JWT_KEY');
            $payload = [
                'iss' => 'Laravel Token',
                'iat' => time(),
                'exp' => time() + 24 * 60 * 60, // 1-day expiration
                'email' => $userEmail,
                'role' => $userRole,
                'id' => $userId,
            ];

            return JWT::encode($payload, $key, 'HS256'); // Return only the token string
        } catch (Exception $e) {
            return ''; // Return an empty string in case of an error
        }
    }

    // Create Token End ********************************

    // Verify Token Start ********************************
    public static function verifyToken($token): string|object
    {
        try {
            if ($token == null) {
                return 'unauthorized';
            }
            $key = env('JWT_KEY');

            return JWT::decode($token, new Key($key, 'HS256'));
        } catch (Exception) {
            return 'unauthorized';
        }
    }
    // Verify Token End ********************************
}
