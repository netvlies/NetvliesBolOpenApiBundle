<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle;

use Buzz\Browser;
use Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse;
use Netvlies\Bundle\BolOpenApiBundle\Exception as BolException;

class BolOpenApi
{
    private $browser;
    private $accessKey;
   	private $secretAccessKey;
    private $sessionId;

    /**
     * Constructor: inject settings and dependencies
     * @param $accessKey
     * @param $secretAccessKey
     * @param \Buzz\Browser $browser
     */
    public function __construct($accessKey, $secretAccessKey, Browser $browser)
    {
        $this->accessKey = $accessKey;
        $this->secretAccessKey = $secretAccessKey;
        $this->browser = $browser;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param $term
     * @param array|null $options
     * @return Response\SearchResultsResponse
     */
    public function searchResults($term, array $options = null)
    {
        $path = '/openapi/services/rest/catalog/v3/searchresults';
        $default_options = array(
            'categoryIdAndRefinements' => null,
            'offset' => 0,
            'nrProducts' => 10,
            'sortingMethod' => 'price',
            'sortingAscending' => true,
            'includeProducts' => true,
            'includeCategories' => true,
            'includeRefinements' => true
        );
        $query_parameters = array_merge($this->merge_options($default_options, $options), array(
            'term' => $term
        ));
        $uri = $path . '?' . http_build_query($query_parameters);

        return new SearchResultsResponse($this->call($uri));
    }

    /**
     * @param string $type
     * @param string $categoryIdAndRefinements
     * @param array|null $options
     * @return Response\ListResultResponse
     */
    public function listResults($type, $categoryIdAndRefinements, array $options = null)
    {
        $path = '/openapi/services/rest/catalog/v3/listresults/' . $type . '/' . $categoryIdAndRefinements;
        $default_options = array(
            'offset' => null,
            'nrProducts' => 10,
            'sortingMethod' => null,
            'sortingAscending' => true,
            'includeProducts' => false,
            'includeCategories' => true,
            'includeRefinements' => true
        );
        $options = $this->merge_options($default_options, $options);

        $uri = $path . '?' . http_build_query($options);

        return new ListResultsResponse($this->call($uri));
    }

    /**
     * @param $productId
     * @return \Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse
     * @throws \InvalidArgumentException
     */
    public function products($productId)
    {
        if (is_float($productId)) {
            throw new \InvalidArgumentException('Given $productId as float, possible integer overflow. Try passing $productId as string')  ;
        }

        $url = '/openapi/services/rest/catalog/v3/products/' . $productId;

        return new ProductResponse($this->call($url));
    }

    /**
     * Prepare headers, compose url and make a call
     * @param $url
     * @return \SimpleXMLElement
     * @throws \Exception
     */
    protected function call($url)
    {
        $scheme = 'https://';
        $host = 'openapi.bol.com';
        $content = '';
        $today = gmdate('D, d F Y H:i:s \G\M\T');
        $contentType =	'application/xml';

        $headers = array(
            'Content-type: ' . $contentType,
            'Host: ' . $host,
            'Content-length: ' . strlen($content),
            'X-OpenAPI-Authorization: ' . $this->getSignature($today, 'GET', $url, $contentType),
            'X-OpenAPI-Date: ' . $today,
        );
        if(!is_null($this->sessionId)) {
            $headers[] = 'X-OpenAPI-Session-ID: ' . $this->sessionId;
        }

        $response = $this->browser->get($scheme.$host.$url, $headers);
        try{
            $xmlElement = new \SimpleXMLElement($response->getContent());
        } catch (\Exception $e) {
            throw new BolException('Error parsing the xml as SimpleXMLElement', null, $e);
        }
        if ($response->getStatusCode() !== 200) {
            throw new BolException($xmlElement->Status . ': ' . $xmlElement->Message, $response->getStatusCode());
        }
        if (!in_array($xmlElement->getName(), array(
            'ListResultResponse',
            'SearchResultsResponse',
            'ProductResponse'
        ))) {
            throw new BolException('Invalid Xml result');
        }

        return $xmlElement;
    }

    /**
     * Format a signature for the X-OpenAPI-Authorization header
     * @param string $date
     * @param string $httpMethod
     * @param string $url
     * @param string $contentType
     * @return string formatted signature
     */
    protected function getSignature($date, $httpMethod, $url, $contentType)
    {
        $parsedUrl = parse_url($url);

   		$signature = $httpMethod . "\n\n";
   		$signature .= $contentType . "\n";
   		$signature .= $date."\n";
   		$signature .= "x-openapi-date:" . $date . "\n";
   		if(!is_null($this->sessionId)) {
   			$signature .= "x-openapi-session-id:" . $this->sessionId . "\n";
   		}
   		$signature .= $parsedUrl['path']."\n";

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $parsedQuery);
            ksort($parsedQuery);
            $queryParamsCount = count($parsedQuery);
            $i = 0;
            foreach ($parsedQuery as $key => $value) {
                $signature .= '&' . $key . '=' . rawurlencode($value);
                if (++$i < $queryParamsCount) {
                    $signature .= "\n";
                }
            }
        }

   		return $this->accessKey . ':' . base64_encode(hash_hmac('SHA256', $signature, $this->secretAccessKey, true));
   	}

    /**
     * Merges user options with default options
     * Also casts boolean options to string ('true', 'false')
     * @param array $default_options
     * @param array $options
     * @return array merged options
     */
    protected function merge_options(array $default_options, array $options = null)
    {
        if (is_null($options)) {
            $options = $default_options;
        }

        foreach ($default_options as $key => $value) {
            if (!isset($options[$key])) {
                $options[$key] = $value;
            }
            if (is_bool($options[$key])) {
                $options[$key] = ($options[$key]) ? 'true' : 'false';
            }
        }

        return $options;
    }
}