<?php

namespace Netvlies\Bundle\BolOpenApiBundle;

use Buzz\Browser;
use Netvlies\Bundle\BolOpenApiBundle\Response\ListResultResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse;

// @todo product mapping with product type properties (for now only general values are implemented)
// @todo replace fromXml methods with dedicated mapper classes
// @todo method api now reflects the bol api, should we make this getProduct, getListResults, getSearchResults?
// @todo include license
// @todo NTH: refactor with custom Buzz Client and Message
// @todo implement and test session id (is always null for now)
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

    // @todo review number of parameters
    // @todo documentation states that term should be part of the uri path but it forces an error
    public function searchResults($term, $categoryIdAndRefinements = null, $offset = null, $nrProducts = null, $sortingMethod = 'price', $sortingAscending = true, $includeProducts = true, $includeCategories = true, $includeRefinements = true)
    {
        $path = '/openapi/services/rest/catalog/v3/searchresults';
        $query_parameters = array(
            'term' => $term,
            'categoryIdAndRefinements' => $categoryIdAndRefinements,
            'offset' => $offset,
            'nrProducts' => $nrProducts,
            'sortingMethod' => $sortingMethod,
            'sortingAscending' => (true === $sortingAscending) ? 'true' : 'false',
            'includeProducts' => (true === $includeProducts) ? 'true' : 'false',
            'includeCategories' => (true === $includeCategories) ? 'true' : 'false',
            'includeRefinements' => (true === $includeRefinements) ? 'true' : 'false'
        );
        $uri = $path . '?' . http_build_query($query_parameters);

        return new SearchResultsResponse($this->call($uri));
    }


    // @todo review number of parameters
    /**
     * @param string $type
     * @param string $categoryIdAndRefinements
     * @param int|null $offset
     * @param int|null $nrProducts
     * @param string|null $sortingMethod
     * @param bool $sortingAscending
     * @param bool $includeProducts
     * @param bool $includeCategories
     * @param bool $includeRefinements
     * @return Response\ListResultResponse
     */
    public function listResults($type, $categoryIdAndRefinements, $offset = null, $nrProducts = null, $sortingMethod = null, $sortingAscending = false, $includeProducts = false, $includeCategories = true, $includeRefinements = true)
    {
        $path = '/openapi/services/rest/catalog/v3/listresults/' . $type . '/' . $categoryIdAndRefinements;
        $query_parameters = array(
            'offset' => $offset,
            'nrProducts' => $nrProducts,
            'sortingMethod' => $sortingMethod,
            'sortingAscending' => (true === $sortingAscending) ? 'true' : 'false',
            'includeProducts' => (true === $includeProducts) ? 'true' : 'false',
            'includeCategories' => (true === $includeCategories) ? 'true' : 'false',
            'includeRefinements' => (true === $includeRefinements) ? 'true' : 'false'
        );
        $uri = $path . '?' . http_build_query($query_parameters);

        return new ListResultResponse($this->call($uri));
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
        $xmlElement = new \SimpleXMLElement($response->getContent());

        // @todo what if 404 (test with listResult('', ''))
        if ($response->getStatusCode() !== 200) {
            // @todo what if xml is empty/not valid?
            throw new \Exception($xmlElement->Status . ': ' . $xmlElement->Message, $response->getStatusCode());
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
}