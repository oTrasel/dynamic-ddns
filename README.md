
# Dynimic DDNS

Projeto no qual conecta com o DYNU ( https://www.dynu.com ) Para configurar o ip do ddns dinamicamente.

Para isto, deverá ser configurado um CRON para rodar de tempos em tempos, aonde o mesmo verificará o IP externo atual, irá comparar com o Antigo, e devidamente realizará o update do ip no Serviço.

Exemplo de CRON:

0 1 * * * php index.php
