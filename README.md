# Sistema de Verificação de BIN de Cartão

Este repositório contém um sistema em PHP para verificar informações de um BIN (Bank Identification Number) de cartão de crédito, como a bandeira, tipo, nível, banco emissor, país, entre outros. É importante ressaltar que este projeto é totalmente destinado a estudos e não deve ser utilizado para atividades ilegais ou antiéticas. Os autores deste projeto não se responsabilizam pelo uso indevido das informações ou funcionalidades aqui apresentadas.

## Tecnologias Utilizadas

- PHP
- HTML
- CSS
- cURL

## Como Funciona

O sistema utiliza a API Bincheck.io para obter informações sobre a BIN fornecida. O código PHP realiza uma requisição à API, fazendo uso da extensão cURL, e analisa a resposta para extrair os dados necessários sobre a BIN. O processo pode ser descrito em passos:

1. O usuário insere a BIN desejada no formulário.
2. O código PHP verifica se a BIN foi fornecida na URL ($_GET['bin']).
3. Se a BIN foi fornecida, o código PHP utiliza a função `getCardInfo($bin)` para obter as informações da BIN.
4. A função `getCardInfo($bin)` utiliza cURL para fazer uma requisição à URL da API Bincheck.io.
5. O código PHP analisa a resposta da API, extrai as informações relevantes e formata-as em um array associativo.
6. As informações são exibidas na página HTML, caso estejam disponíveis.

## Autores

- **yFxz** - [Perfil no GitHub](https://github.com/yfxzdevs)
- **LKDeveloper** - [Perfil no GitHub](https://github.com/lucasdeveloperx)

## Aviso Legal

Este projeto é fornecido apenas para fins educacionais e não deve ser usado para atividades ilegais ou antiéticas. Os autores deste projeto não se responsabilizam pelo uso indevido das informações ou funcionalidades aqui apresentadas. Use por sua própria conta e risco.

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para mais detalhes.

![Imagem](https://media.discordapp.net/attachments/1064561225473736859/1227732854893449326/image.png?ex=66297a52&is=66170552&hm=30e1a29bb2cde8748d038be8328311eb0114dd0001eb7390cd239f97a8c97310&=&format=webp&quality=lossless&width=1007&height=478)
