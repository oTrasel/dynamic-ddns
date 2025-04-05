<?php
declare(strict_types=1);

namespace App\Services;

use Exception;

class UpdateDDNS extends DDNS{

    /**
     * Construtor da classe que recebe uma instancia de DDNS.
     *
     * @param object $ddns
     */
    public function __construct(DDNS $ddns){
        $this->apiKey = $ddns->apiKey;
        $this->id = $ddns->getId();
        $this->name = $ddns->getName();
        $this->group = $ddns->getGroup();
        $this->ipv4Address = $ddns->getIpv4Address();
        $this->ipv6Address = $ddns->getIpv6Address();
        $this->ttl = $ddns->getTtl();
        $this->ipv4 = $ddns->isIpv4();
        $this->ipv6 = $ddns->isIpv6();
        $this->ipv4WildcardAlias = $ddns->isIpv4WildcardAlias();
        $this->ipv6WildcardAlias = $ddns->isIpv6WildcardAlias();
        $this->allowZoneTransfer = $ddns->isAllowZoneTransfer();
        $this->dnssec = $ddns->isDnssec();
    }

    /**
     * Realiza a requisição à API e atualiza os dados informados.
     *
     * @throws Exception
     * @return void
     */
    public function update(): void{
        $payload = $this->montaPayload();
        try{
            $ch = curl_init();
            $url = "https://api.dynu.com/v2/dns/" . $this->getId();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: application/json',
                'Content-Type: application/json',
                'API-Key: ' . $this->getApiKey()
            ]);
            $response = curl_exec($ch);
            curl_close($ch);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Monta payload para requisição
     *
     * @throws Exception
     * @return string
     */
    private function montaPayload(): string{
        $data = get_object_vars($this);
        unset($data['apiKey']);
        unset($data['id']);
        return json_encode($data);
    }
}