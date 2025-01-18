# Script para Obter Odds nas APIs do Sofascore

## Dependências
O script foi escrito na versão do **PHP 8.1.2.** É necessário instalar o pacote php8.1-curl:
```bash
sudo apt install php8.1-curl
```

## APIs Analisadas
- [Odds no Sofascore](https://www.sofascore.com/api/v1/sport/football/odds/1/2025-01-16)
- [Eventos ao Vivo](https://www.sofascore.com/api/v1/sport/football/events/live)
- [Evento Específico 13341576](https://www.sofascore.com/api/v1/event/13341576)
- [Incidentes do Evento 13341576](https://www.sofascore.com/api/v1/event/13341576/incidents)
- [Odds Destacados do Evento 13341576](https://www.sofascore.com/api/v1/event/13341576/odds/1/featured)
- [Todas as Odds do Evento 13341576](https://www.sofascore.com/api/v1/event/13341576/odds/1/all)

## Executando o Script
Para executar, use o comando: `php sofascore.php` ou `php sofascore.php debug <event_id>`. Exemplos:
- `php sofascore.php` para rodar o script geral.
- `php sofascore.php debug 13341576` para rodar apenas um evento específico.

