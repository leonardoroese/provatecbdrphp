# provatecbdrphp
Prova técnica aplicação PHP BDR


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
