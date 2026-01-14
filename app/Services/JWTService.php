<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{
    /**
     * Secret key untuk JWT (gunakan SHA-256)
     */
    private static function getSecretKey()
    {
        return hash('sha256', config('app.key'));
    }

    /**
     * Generate JWT Token dengan SHA-256
     * 
     * @param array $payload Data yang akan di-encode
     * @return string JWT token
     */
    public static function generateToken($payload)
    {
        // Secret key dengan SHA-256
        $secretKey = self::getSecretKey();
        
        // Default payload
        $defaultPayload = [
            'iss' => config('app.url'), // Issuer
            'iat' => time(), // Issued at
            'exp' => time() + (30 * 60), // Expire dalam 30 menit
            'nbf' => time(), // Not before
        ];
        
        // Merge dengan payload custom
        $payload = array_merge($defaultPayload, $payload);
        
        // Generate JWT dengan algorithm HS256 (HMAC SHA-256)
        return JWT::encode($payload, $secretKey, 'HS256');
    }

    /**
     * Decode JWT Token
     * 
     * @param string $token JWT token
     * @return object Decoded payload
     * @throws \Exception jika token invalid
     */
    public static function decodeToken($token)
    {
        try {
            $secretKey = self::getSecretKey();
            return JWT::decode($token, new Key($secretKey, 'HS256'));
        } catch (\Exception $e) {
            throw new \Exception('Invalid or expired token: ' . $e->getMessage());
        }
    }

    /**
     * Verify token validity
     * 
     * @param string $token JWT token
     * @return bool
     */
    public static function verifyToken($token)
    {
        try {
            self::decodeToken($token);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get remaining time until token expires
     * 
     * @param string $token JWT token
     * @return int seconds until expiration
     */
    public static function getTimeRemaining($token)
    {
        try {
            $decoded = self::decodeToken($token);
            return $decoded->exp - time();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Refresh token (generate new token with same payload)
     * 
     * @param string $token Old JWT token
     * @return string New JWT token
     */
    public static function refreshToken($token)
    {
        $decoded = self::decodeToken($token);
        
        // Remove timing claims
        unset($decoded->iat, $decoded->exp, $decoded->nbf);
        
        // Generate new token
        return self::generateToken((array) $decoded);
    }
}