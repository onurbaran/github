<?php

/**
 * 
 *
 * @author onur
 */
class Github
{
    const appUrl = 'https://api.github.com'; 
    public $username;
    
    public function __construct($username)
    {
        $this->username = $username;
    }
    /**
     * Github API ye curl aracılığı ile istek gönderiliyor 
     */
    private function requestApi($requestUrl)
    {
        $c = curl_init();
	curl_setopt($c, CURLOPT_URL, $requestUrl);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_USERAGENT, "yiiext.components.github-api (v 0.5dev)");
	curl_setopt($c, CURLOPT_TIMEOUT, 30);
	curl_setopt($c, CURLOPT_HEADER, true); 
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_HTTPGET, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST,  2);
	$response = curl_exec($c);
	curl_close($c);
	return $response;
    }
    /**
     * API den dönen json değerini parse ediyoruz
     */
    private function getResults($requestType)
    {
        $header = true;
        $requestUrl = self::appUrl.$requestType;
        $result = $this->requestApi($requestUrl);
        foreach(explode("\r\n", $result) as $line)
		{
			if ($line == '') {
				$header = false;
			}
			else if ($header) {
				$line = explode(': ', $line);
				switch($line[0]) {
//		case 'Content-Type': // application/json; charset=utf-8
//		break;
		case 'Status': $status = substr($line[1], 0, 3); break;
		case 'X-RateLimit-Limit': $this->_rateLimit = intval($line[1]); break;
		case 'X-RateLimit-Remaining': $this->_rateLimitRemaining = intval($line[1]); break;
		}
                    } 
                    else
                    {
			$content[] = $line;
                    }
		}

		return array($status, json_decode(implode("\n", $content)));
    }
    /**
     * Kullanıcının bilgileri ve repo bilgileri çekiliyor
     * 
     */
    public function getUserInfo()
    {
        $requestUrl = sprintf('/users/%s', $this->username);
        return $this->getResults($requestUrl);
    }
    public function getUserRepos()
    {
        $requestUrl = sprintf('/users/%s/repos', $this->username);
        return $this->getResults($requestUrl);
    }
    public function getUserRepoCommits($repoName)
    {
        $requestUrl = sprintf('/repos/%s/%s/commits', $this->username,$repoName);
        return $this->getResults($requestUrl);
    }
    
}

?>
