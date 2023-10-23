# perfect pay test

Resolução do [teste técnico da perfect pay](https://github.com/perfectpay/perfect-test-backend) com objetivo de praticar desenvolvimenbto com escrita de testes automatizados e boas práticas de programação e aplicação de Design Patterns

### Pré-requisitos

* Docker
* Docker compose

### Instalação

Passo a passo para você rodar este projeto localmente:

* crie um fork e clone na sua máquina
* siga os comandos a baixo para subir a aplicação
```
$ cp .env.example .env
$ docker compose up -d
$ docker exec perfect-pay-app composer install
$ docker exec perfect-pay-app php artisan migrate:refresh --seed
$ docker exec perfect-pay-app php artisan migrate:refresh --seed --env=testing
```

Após isso a aplicação está disponível em [http://localhost:8989](http://localhost:8989)

## Endpoints

Veja a documentação completa aqui [https://documenter.getpostman.com/view/17234193/2s9YRCWAqR#2f6561ac-d92e-4d65-9a34-55bbe1f43a24](https://documenter.getpostman.com/view/17234193/2s9YRCWAqR#2f6561ac-d92e-4d65-9a34-55bbe1f43a24)