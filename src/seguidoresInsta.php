<?php


function pegarInstagram($usuario)
{
  $ch = curl_init();

  $headers = array(
    'User-Agent: user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
    'Accept-Language: en-US,en;q=0.5',
    'Connection: keep-alive',
    'cache-control: no-cache',
    'pragma: no-cache',

    'authority: www.instagram.com',
    'upgrade-insecure-requests: 1',
    'Host: www.instagram.com',
    "Referer: https://www.instagram.com/$usuario/",
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-model: ""',
    'sec-ch-ua-platform: "Linux"',
    'sec-ch-ua-platform-version: "6.5.12"',
    'sec-fetch-dest: document',
    'sec-fetch-mode: navigate',
    'sec-fetch-site: same-origin',
    'sec-fetch-user: ?1',
    'sec-gpc: 1'
  );
  curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HEADER => FALSE,
    CURLOPT_NOBODY => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_USERAGENT => "user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36",
    CURLOPT_COOKIEJAR => "insta.txt",
    CURLOPT_COOKIEFILE => "insta.txt",

    CURLOPT_URL => "https://www.instagram.com/$usuario/",

  ));

  $data = curl_exec($ch);

  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close($ch);

  return $data;
}

function pegarSeguidores($pagina)
{
  $seguidores = explode('meta property="og:description" content="', $pagina);

  $seguidores = explode('Followers', $seguidores[1])[0];

  $seguidores = trim($seguidores);
  return $seguidores;
}

$usuario = "neymarjr";

$dados = pegarInstagram($usuario);
$seguidores = pegarSeguidores($dados);

echo "Parabéns $usuario, você tem $seguidores seguidores.";
