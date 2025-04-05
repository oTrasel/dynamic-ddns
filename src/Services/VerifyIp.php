<?php

namespace App\Services;

use Exception;

class VerifyIp{

    /**
     * O endereço IPv4 configurado no DNS.
     *
     * @var string
     */
    private string $ipv4Address;

    /**
     * NovoIp ?;
     *
     * @var bool
     */
    private string $novoIp;

    /**
     * Verifia situacao dos ips e retorna o ip e status
     *
     * @throws Exception
     * @return void
     */
    public function verificaIp(): void{
        $file = "ip.json";
        $this->requestIpAtual();
        if(!file_exists($file)){
            $data = [
                "ip" => $this->getIpv4Address(),
            ];
            file_put_contents($file, json_encode($data));
            $this->setNovoIp(true);
        }else{
            $ipAntigo = json_decode(file_get_contents($file))->ip;
            $ipAtual = $this->getIpv4Address();
            if($ipAtual == $ipAntigo){
                $this->setNovoIp(false);
                return;
            }
            $this->setNovoIp(true);
            unlink($file);
            $data = [
                "ip" => $this->getIpv4Address(),
            ];
            file_put_contents($file, json_encode($data));
            return;
        }
    }



    /**
     * Realiza a requisição à API e verifica o IP atual
     *
     * @throws Exception
     * @return void
     */
    private function requestIpAtual(): void
    {
        $urls = [
            'https://api.ipify.org',
            'https://ip.informatche.com.br',
        ];
    
        foreach ($urls as $url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); // timeout de segurança
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: application/json, text/plain'
            ]);
    
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
    
            if ($response !== false && $httpCode === 200 && filter_var($response, FILTER_VALIDATE_IP)) {
                $this->setIpv4Address($response);
                break;
            }
        }
    }


    /** @return string */
    public function getIpv4Address(): string{
            if ($this->ipv4Address === null) {
        throw new Exception("O IP ainda não foi definido.");
    }
        return $this->ipv4Address;
    }

    /** @param string $ipv4Address */
    public function setIpv4Address(string $ipv4Address): void{
        $this->ipv4Address = $ipv4Address;
    }

    /** @return bool */
    public function isNovoIp(): bool{
        return $this->novoIp;
    }

    /** @param bool $novoIp */
    public function setNovoIp(bool $novoIp): void{
        $this->novoIp = $novoIp;
    }
}