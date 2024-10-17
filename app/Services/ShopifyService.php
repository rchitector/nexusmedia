<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class ShopifyService
{
    public static function getUrl($type, $limit = 50): string
    {
        return implode('', [
            'https://',
            config('shopify.api_key'),
            ':',
            config('shopify.password'),
            '@',
            config('shopify.shop_name'),
            '/admin/api/',
            config('shopify.api_version'),
            '/',
            $type,
            '.json',
            '?limit=',
            $limit,
        ]);
    }


    public static function addUserInfoToUrl(string $url): string
    {
        $parts = parse_url($url);
        $parts['user'] = config('shopify.api_key');
        $parts['pass'] = config('shopify.password');
        return (isset($parts['scheme']) ? $parts['scheme'].'://' : '').
            (isset($parts['user']) ? $parts['user'].(isset($parts['pass']) ? ':'.$parts['pass'] : '').'@' : '').
            (isset($parts['host']) ? $parts['host'] : '').
            (isset($parts['port']) ? ':'.$parts['port'] : '').
            (isset($parts['path']) ? $parts['path'] : '').
            (isset($parts['query']) ? '?'.$parts['query'] : '').
            (isset($parts['fragment']) ? '#'.$parts['fragment'] : '');
    }

    public static function getHeaderLinks($headers): array
    {
        $parsedLinks = [];
        if (isset($headers['link']) && is_array($headers['link'])) {
            $links = explode(',', $headers['link'][0]);
            foreach ($links as $link) {
                if (preg_match('/<([^>]+)>; rel="([^"]+)"/', trim($link), $matches)) {
                    $parsedLinks[$matches[2]] = $matches[1];
                }
            }
        }
        return $parsedLinks;
    }

    public static function getPreviousLink($headers)
    {
        $parsedLinks = ShopifyService::getHeaderLinks($headers);
        if (isset($parsedLinks['previous'])) {
            return $parsedLinks['previous'];
        }
        return null;
    }

    public static function getNextLink($headers)
    {
        $parsedLinks = ShopifyService::getHeaderLinks($headers);
        if (isset($parsedLinks['next'])) {
            $parsedLinks['next'] = ShopifyService::addUserInfoToUrl($parsedLinks['next']);
            return $parsedLinks['next'];
        }
        return null;
    }

    public static function importCustomers($limit = 100): void
    {
        $nextLink = ShopifyService::getUrl('customers', $limit);

        while ($nextLink) {
            $response = Http::get($nextLink);

            $items = json_decode($response->body())->customers;
            $inserts = [];
            foreach ($items as $item) {
                $inserts[] = [
                    'id' => $item->id,
                    'first_name' => $item->first_name,
                    'last_name' => $item->last_name,
                    'email' => $item->email,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }
            Customer::insert($inserts);
            $nextLink = ShopifyService::getNextLink($response->headers());
        }
    }

    public static function importOrders($limit = 100): void
    {
        Order::truncate();
        $nextLink = ShopifyService::getUrl('orders', $limit);

        while ($nextLink) {
            $response = Http::get($nextLink);

            $items = json_decode($response->body())->orders;
            $inserts = [];
            foreach ($items as $item) {
                $inserts[] = [
                    'id' => $item?->id,
                    'customer_id' => $item?->customer?->id,
                    'total_price' => $item?->total_price,
                    'financial_status' => $item?->financial_status,
                    'fulfillment_status' => $item?->fulfillment_status,
                ];
            }
            Order::insert($inserts);
            $nextLink = ShopifyService::getNextLink($response->headers());
        }
    }

}
