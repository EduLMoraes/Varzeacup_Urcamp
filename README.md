# Teste de Varzeacup para vaga na Urcamp

# Como rodar o projeto
Primeiro é necessário que tenha instalado em sua máquina o *Docker* e o *docker-compose*

Se já possuir ambos, rode este comando:
```bash
docker-compose up --build
```

### Requisitos:
● Ter telas para listagem, cadastro, edição e exclusão de times e partidas. Deve conter regras de validação para campos que forem requeridos. 

● Ter uma tela que mostra a classificação atual do campeonato. Onde deve constar a posição do time, nome do time, pontuação, quantidade de partidas jogadas, quantidade de vitórias, empates e derrotas. 

● A classificação deve ser ordenada pela maior pontuação, seguido da quantidade de partidas jogadas, suas vitórias, empates e derrotas. Tente utilizar a montagem da mesma utilizando apenas SQL. Observação: Vitória vale 3 pontos, empate 1 e derrota 0. 

● A partida deve constar a data e hora que ocorrerá e qual é a rodada da partida.

● Os campeonatos são anuais. A aplicação deve manter todos os campeonatos com suas
partidas salvos para futura recuperação dessas informações se assim for necessário. O
campeonato deve ter jogos de ida e volta.

● O layout da aplicação deve ser feito com HTML e CSS. Não deve ser utilizado frameworks de css (ex.: bootstrap) e/ou pré-processadores como o sass. De preferência por um layout minimalista. 

● A aplicação deve ser desenvolvida no PHP 8.3 com o framework Laravel 11.

● Os dados do campeonato devem ser armazenados em um banco relacional como o MySQL e/ou PostgreSQL.

● Adicionar tela para listagem, criação, edição e exclusão de usuários.

● Criar uma tela de login para autenticação, e, as rotas da aplicação liberar apenas para usuários logados. 

● A tela de classificação é a única que deve ser sempre pública (para logados e não logados). A mesma deve ter um link na tela de login para usuários não logados terem acesso. 



### Diferenciais 

● Desenvolver a aplicação separando o backend como sendo uma API utilizando o framework Laravel. E no frontend utilizar React/Vue e consumir a API com alguma library (ex.: axios)

● Criar uma API (backend) da aplicação.
● Criar frontend utilizando o Vue/React consumindo a API (backend) criado.0

