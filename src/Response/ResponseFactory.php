<?php
/**
 * This file is part of graze/gigya-client
 *
 * Copyright (c) 2016 Nature Delivered Ltd. <https://www.graze.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license https://github.com/graze/gigya-client/blob/master/LICENSE.md
 * @link    https://github.com/graze/gigya-client
 */

namespace Graze\Gigya\Response;

use GuzzleHttp\Message\ResponseInterface as GuzzleResponseInterface;

// use Psr\Http\Message\ResponseInterface; Guzzle v6

class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * Pass in json decoded response here.
     *
     * @param GuzzleResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function getResponse(GuzzleResponseInterface $response)
    {
        $body = $response->json();
        if (array_key_exists('results', $body)) {
            $result = new ResponseCollection($response);
        } else {
            $result = new Response($response);
        }

        return $result;
    }
}
