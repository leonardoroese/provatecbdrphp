# provatecbdrphp
Prova técnica aplicação PHP BDR

Este projeto é um teste para aplicação para vaga de desenvolvedor PHP SR.

As questões estão respondidas nos arquivos ex1.php, ex2.php, ex3.php e ex4.php e podem ser visualizadas através do acesso a aplicação na sua página principal index.html que contém os links para as respostas.

A aplicação WEB foi desenvolvida totalmente IN-HOUSE, sem utilização de Frameworks, usando o formato RESTFull Application para processamento dos dados referentes a tarefas (exercício 4)

Foi desenvolvido:

- Classe extensível para comunicação com Banco de Dados
- Listener para direcionamento de fluxo de requisições
- Interface WEB HTML4+CSS+Javascript

Requisitos:

- JQuery 1.11 (incluído)




-------------------------------------
TESTE

Essa aplicação foi desenvolvida e testada na seguinte configuração

OS: Debian 8 (Jessie) - LINUX
WebServer: Apache 2.4 + PHP 5.3
Banco: MYSQL 5.5+




-------------------------------------
CONFIG

Habilitar modulo MOD_REWRITE no Apache.

Ao configurar um diretório virtual deve levar em conta:

<b>Permissões de diretório apache2.conf</b>
<pre>
    Options Indexes MultiViews FollowSymlinks
    AllowOverride All
    Require all granted
</pre>

Habilitar <b>RewriteEngine On</b> no VirtualHost (para apache 2.4+) 

A configuração consiste em informar os dados de conexão com o banco utilizado.

O arquivo de configuração está no diretório <b>config/Application.config</b>.

Todo conteúdo do diretório provatecbdr deve estar na Raiz da aplicação WEB.


-------------------------------------
TABELA BD

Foi criada apenas uma tabela para este exemplo.

Script:
<pre>
CREATE TABLE `bdrtest`.`Task` (

  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  
  `title` varchar(200) DEFAULT NULL,
  
  `descr` text,
  
  `ord` int(11) DEFAULT NULL,
  
  `dtreg` datetime DEFAULT NULL,
  
  PRIMARY KEY (`id`)
  
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
</pre>

O backup do banco está incluído no diretório config, arquivo bkp.sql pode ser restaurado em uma nova instalação de MYSQL.

