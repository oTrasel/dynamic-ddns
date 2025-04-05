<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class GetDDNS extends DDNS
{

    /**
     * Construtor da classe.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->setApiKey($apiKey);
    }

    /**
     * Realiza a requisição à API e preenche os dados do domínio.
     *
     * @throws Exception
     * @return void
     */
    public function request(): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.dynu.com/v2/dns');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'API-Key: ' . $this->getApiKey(),
        ]);
        $response = curl_exec($ch);
        if($response == false) {
            throw new Exception(curl_error($ch));
        }
        $response = json_decode($response);
        curl_close($ch);

        if (!isset($response->statusCode) || $response->statusCode !== 200) {
            throw new Exception('Erro ao verificar ID');
        }

        $domain = $response->domains[0] ?? null;

        if (!$domain || !isset($domain->id)) {
            throw new Exception('Nenhum domínio encontrado ou ID ausente');
        }

        $this->setId($domain->id);
        $this->setName($domain->name);
        $this->setGroup($domain->group);
        $this->setIpv4Address($domain->ipv4Address);
        $this->setipv6Address($domain->ipv6Address);
        $this->setTtl($domain->ttl);
        $this->setipv4($domain->ipv4);
        $this->setipv6($domain->ipv6);
        $this->setipv4WildcardAlias($domain->ipv4WildcardAlias);
        $this->setipv6WildcardAlias($domain->ipv6WildcardAlias);
        $this->setallowZoneTransfer($domain->allowZoneTransfer);
        $this->setdnssec($domain->dnssec);
    }
}
