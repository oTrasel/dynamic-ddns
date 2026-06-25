<?php

require __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

use App\Services\GetDDNS;
use App\Services\UpdateDDNS;
use App\Services\VerifyIp;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$verificaIp = new VerifyIp();
$verificaIp->verificaIp();
$isNovoIp = $verificaIp->isNovoIp();
echo '[' . date('d/m/Y H:i:s') . '] INICIANDO VERIFICACAO' . PHP_EOL;
if ($isNovoIp) {
    $apiKey = $_ENV['API_KEY'];

    $ddns = new GetDDNS($apiKey);
    $ddns->request();

    $updateDns = new UpdateDDNS($ddns);
    $novoIp = $verificaIp->getIpv4Address();
    $updateDns->setIpv4Address($novoIp);
    $updateDns->update();
    echo '[' . date('d/m/Y H:i:s') . '] IP ATUALIZADO' . PHP_EOL;
    exit;
    
}else{
    echo '[' . date('d/m/Y H:i:s') . '] SEM ALTERACAO NO IP'. PHP_EOL;
    exit;
}
