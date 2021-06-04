<?php
namespace App\Core\HttpResponse;

//use App\Controller\ErrorController;
use App\Core\ParameterBag\ParameterBag;
use App\Controller\ErrorController;

class HttpResponse{

    private $statusCode;

    private $statusText;

    private $headers;

    private $content;

    /**
     * Status Code from Symfony HttpFoundation Component
     * @link https://github.com/symfony/http-foundation/blob/8827b90cf8806e467124ad476acd15216c2fceb6/Response.php#136
     */
    public static $statusTexts = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',                                               // RFC2324
        421 => 'Misdirected Request',                                         // RFC7540
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Too Early',                                                   // RFC-ietf-httpbis-replay-04
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        451 => 'Unavailable For Legal Reasons',                               // RFC7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',                                     // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    ];

    public function __construct(string $content = "", int $code = 200, array $headers = []){
        $this->setContent($content);
        $this->setStatusCode($code);
        $this->headers = new ParameterBag($headers);        
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        $this->statusText = $this->statusTexts[$code] ?? 'unknown';

        return $this;
    }

    public function sendHeaders(): self
    {
        foreach($this->headers as $header => $value){
            header($header.': '.$value, true, $this->code);
        }

        header(sprintf('HTTP/%s %s %s', '1.1', $this->statusCode, $this->statusText), true, $this->statusCode);

        // As we use HTTP 1.1, we have to send a Host header. Here it is
        header('Host: '.gethostname());

        return $this;
    }

    public function sendContent(): self
    {
        echo $this->content;

        return $this;
    }

    public function send(): self
    {
        $this->sendHeaders();
        $this->sendContent();

        return $this;
    }

    public function toHttpError(int $http_code)
    {
        $this->setStatusCode($http_code);
        // Schlagos mais ça passe !
        return (new ErrorController())->error($http_code);
    }

}