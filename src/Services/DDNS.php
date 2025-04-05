<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class DDNS
{

    /**
     * A chave da API do serviço DNS.
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * O ID do domínio no serviço DNS.
     *
     * @var int
     */
    protected int $id;

    /**
     * O nome do domínio no serviço DNS.
     *
     * @var string
     */
    protected string $name;

    /**
     * O grupo do serviço DNS.
     *
     * @var string
     */
    protected string $group;

    /**
     * O endereço IPv4 configurado no DNS.
     *
     * @var string
     */
    protected string $ipv4Address;

    /**
     * O endereço IPv6 configurado no DNS (pode ser nulo).
     *
     * @var string|null
     */
    protected ?string $ipv6Address = null;

    /**
     * O TTL configurado no DNS.
     *
     * @var int
     */
    protected int $ttl;

    /**
     * Indica se o IPv4 está configurado no DNS.
     *
     * @var bool
     */
    protected bool $ipv4;

    /**
     * Indica se o IPv6 está configurado no DNS.
     *
     * @var bool
     */
    protected bool $ipv6;

    /**
     * Indica se há alias curinga para IPv4 no DNS.
     *
     * @var bool
     */
    protected bool $ipv4WildcardAlias;

    /**
     * Indica se há alias curinga para IPv6 no DNS.
     *
     * @var bool
     */
    protected bool $ipv6WildcardAlias;

    /**
     * Indica se transferência de zona é permitida.
     *
     * @var bool
     */
    protected bool $allowZoneTransfer;

    /**
     * Indica se o DNSSEC está ativado.
     *
     * @var bool
     */
    protected bool $dnssec;



    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    /** @param int $id */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /** @return string */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /** @param string $name */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @param string $name */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /** @return string */
    public function getGroup(): string
    {
        return $this->group;
    }

    /** @param string $group */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /** @return string */
    public function getIpv4Address(): string
    {
        return $this->ipv4Address;
    }

    /** @param string $ipv4Address */
    public function setIpv4Address(string $ipv4Address): void
    {
        $this->ipv4Address = $ipv4Address;
    }

    /** @return string|null */
    public function getIpv6Address(): ?string
    {
        return $this->ipv6Address;
    }

    /** @param string|null $ipv6Address */
    public function setIpv6Address(?string $ipv6Address): void
    {
        $this->ipv6Address = $ipv6Address;
    }

    /** @return int */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /** @param int $ttl */
    public function setTtl(int $ttl): void
    {
        $this->ttl = $ttl;
    }

    /** @return bool */
    public function isIpv4(): bool
    {
        return $this->ipv4;
    }

    /** @param bool $ipv4 */
    public function setIpv4(bool $ipv4): void
    {
        $this->ipv4 = $ipv4;
    }

    /** @return bool */
    public function isIpv6(): bool
    {
        return $this->ipv6;
    }

    /** @param bool $ipv6 */
    public function setIpv6(bool $ipv6): void
    {
        $this->ipv6 = $ipv6;
    }

    /** @return bool */
    public function isIpv4WildcardAlias(): bool
    {
        return $this->ipv4WildcardAlias;
    }

    /** @param bool $ipv4WildcardAlias */
    public function setIpv4WildcardAlias(bool $ipv4WildcardAlias): void
    {
        $this->ipv4WildcardAlias = $ipv4WildcardAlias;
    }

    /** @return bool */
    public function isIpv6WildcardAlias(): bool
    {
        return $this->ipv6WildcardAlias;
    }

    /** @param bool $ipv6WildcardAlias */
    public function setIpv6WildcardAlias(bool $ipv6WildcardAlias): void
    {
        $this->ipv6WildcardAlias = $ipv6WildcardAlias;
    }

    /** @return bool */
    public function isAllowZoneTransfer(): bool
    {
        return $this->allowZoneTransfer;
    }

    /** @param bool $allowZoneTransfer */
    public function setAllowZoneTransfer(bool $allowZoneTransfer): void
    {
        $this->allowZoneTransfer = $allowZoneTransfer;
    }

    /** @return bool */
    public function isDnssec(): bool
    {
        return $this->dnssec;
    }

    /** @param bool $dnssec */
    public function setDnssec(bool $dnssec): void
    {
        $this->dnssec = $dnssec;
    }
}
