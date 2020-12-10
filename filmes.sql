-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Dez-2020 às 17:27
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `filmes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `id_filme` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `sinopse` text DEFAULT NULL,
  `quantidade` smallint(6) DEFAULT 0,
  `idioma` varchar(30) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`id_filme`, `titulo`, `sinopse`, `quantidade`, `idioma`, `data_lancamento`) VALUES
(1, 'Men in Black', 'Depois que uma agência do governo faz o primeiro contato com alienígenas em 1961, refugiados estrangeiros habitam em segredo na Terra, em sua maioria disfarçados de humanos na Região Metropolitana de Nova Iorque. A MIB - Homens de Preto é uma agência ultra-secreta que monitora esses alienígenas, protege a Terra contra ameaças intergalácticas e usa neuralyzers (dispositivos) que apagam a memória para manter a atividade alienígena em segredo. Homens e agentes negros têm suas identidades anteriores apagadas e agentes aposentados são neuralizados, recebendo novas identidades. Após uma operação para prender um criminoso alienígena perto da fronteira mexicana pelos agentes K e D, D decide que ele já está muito velho para o seu trabalho. K (um dos fundadores da MIB) o neuraliza e começa a procurar por um novo parceiro.', 1, 'ingles', NULL),
(2, 'Karate Kid', 'Dre Parker (Jaden Smith) é um garoto de 12 anos que poderia ser o mais popular da cidade de Detroit, Estados Unidos, mas a carreira de sua mãe acaba os levando para a cidade de Pequim, na China.\r\n\r\nNo novo país, Dre se apaixona pela sua colega de classe Mei Ying, que torna-se sua amiga, mas as diferenças culturais tornam essa amizade impossível. Pior ainda, os sentimentos de Dre fazem com que o aluno mais brigão da sala e prodígio do Kung Fu, Cheng, torne-se seu inimigo, fazendo com que Dre sofra bullying nas mãos dos amigos de Cheng, sem poder reagir. Sem amigos na nova cidade, Dre não tem a quem recorrer exceto ao zelador do seu prédio Mr. Han (Jackie Chan), que é secretamente um mestre do Kung Fu.\r\n\r\nÀ medida em que Han ensina a Dre que o Kung Fu é muito mais que socos e habilidade, mas sim maturidade e calma, Dre percebe que encarar os brigões da turma será a aventura de uma vida. E os ensinamentos de seu mestre explicam o que é o verdadeiro Kung-Fu.', 1, 'ingels', NULL),
(3, 'Pirates of the Caribbean:\r\nThe Curse of the Black Pearl', 'Enquanto o Governador Weatherby Swann e sua filha de 12 anos, Elizabeth Swann, estão velejando para Port Royal, Jamaica, o navio deles encontra um naufrágio com um único sobrevivente, um jovem chamado Will Turner. Elizabeth esconde um medalhão de ouro que o inconsciente Will estava usando, com medo de que isso o identificasse como um pirata. Ela tem um vislumbre de um navio pirata misterioso, o Pérola Negra.\r\n\r\nOito anos depois, James Norrington da Marinha Real Britânica é promovido a Comodoro. Ele pede a mão de Elizabeth em casamento. Antes dela responder, seu espartilho super apertado a faz desmaiar e cair na baía, onde ela afunda. Quando o medalhão que ele está usando chega ao fundo, ele emite um pulso.\r\n\r\nO pirata, Capitão Jack Sparrow, chega a Port Royal para comandar um navio. Ele resgata Elizabeth, porém Norrington reconhece Jack como um pirata e o prende. Jack, por um breve período, toma Elizabeth como refém para poder escapar, se escondendo em uma oficina de ferreiro, encontrando Will, agora um aprendiz de ferreiro. Jack fica inconsciente após uma luta e é preso, sentenciado a forca no dia seguinte. Naquela noite, Port Royal é sitiada pelo Pérola Negra, respondendo ao pulso do medalhão. Elizabeth é capturada e invoca seu direito de falar com o capitão. Ela mente para o Capitão Hector Barbossa, dizendo que seu sobrenome era Turner. Ela negocia o cessar fogo a Port Royal em troca do medalhão.', 1, 'ingles', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id_filme`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
