<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2015 The Open University UK                                   *
 *                                                                              *
 *  This software is freely distributed in accordance with                      *
 *  the GNU Lesser General Public (LGPL) license, version 3 or later            *
 *  as published by the Free Software Foundation.                               *
 *  For details see LGPL: http://www.fsf.org/licensing/licenses/lgpl.html       *
 *               and GPL: http://www.fsf.org/licensing/licenses/gpl-3.0.html    *
 *                                                                              *
 *  This software is provided by the copyright holders and contributors "as is" *
 *  and any express or implied warranties, including, but not limited to, the   *
 *  implied warranties of merchantability and fitness for a particular purpose  *
 *  are disclaimed. In no event shall the copyright owner or contributors be    *
 *  liable for any direct, indirect, incidental, special, exemplary, or         *
 *  consequential damages (including, but not limited to, procurement of        *
 *  substitute goods or services; loss of use, data, or profits; or business    *
 *  interruption) however caused and on any theory of liability, whether in     *
 *  contract, strict liability, or tort (including negligence or otherwise)     *
 *  arising in any way out of the use of this software, even if advised of the  *
 *  possibility of such damage.                                                 *
 *                                                                              *
 ********************************************************************************/
/**
 * stats.php
 * This holds the language for the Visualisations.
 *
 * Author: Michelle Bachler, KMi, The Open University
 * Translation by: Alexandre Marino Costa
 */

/** General **/
$LNG->STATS_DEBATE_CONTRIBUTION_HELP = 'Este sinal indica como estão equilibrados os tipos de contribuições são para o debate. Se um dos tipos ('.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.', '.$LNG->CON_NAME.', or Votes) é representado pela cevada ( menos de 10% ) que irá mostrar um sinal de cor vermelho. Se um dos tipos é sub-representados (menos de 20 %), em seguida, ele mostra um sinal amarelo amarelo. Caso contrário, os tipos são equilibrados e ele vai mostrar um sinal verde.';
$LNG->STATS_DEBATE_VIEWING_HELP = 'Este indicador representa a porcentagem de membros deste grupo que viu essa questão . Se 50% ou mais membros deste grupo viu essa questão , em seguida, ele irá mostrar um sinal verde. Se 20% a 49% visto ele, então ele vai mostrar um sinal amarelo. Se menos de 20% viu essa questão ele vai mostrar um sinal vermelho.';
$LNG->STATS_HELP_HINT = "Clique para exibir/ocultar a descrição.";
$LNG->STATS_VIS_ERROR_BIASSPACE = 'Desculpe, seus dados ainda não podem ser visualizados pois a métrica subjacente precisa de mais dados.';
$LNG->STATS_VIS_ERROR_TOPICSPACE = 'Desculpe, seus dados ainda não podem ser visualizados pois a métrica subjacente precisa de mais dados';

/** Vis Names/Dashboard Tabs **/
$LNG->STATS_TAB_HOME = "Home";
$LNG->STATS_VIS_TITLE_NETWORK = $LNG->DEBATE_NAME.' Rede';
$LNG->STATS_VIS_TITLE_SOCIAL = 'Rede Social';
$LNG->STATS_VIS_TITLE_SUNBURST = 'Pessoas & círculos';
$LNG->STATS_VIS_TITLE_STACKEDAREA = 'Contribuição Rio ';
$LNG->STATS_VIS_TITLE_TOPICSPACE = 'Viés da atividade ';
$LNG->STATS_VIS_TITLE_BIASSPACE = "Classificação polarizada ";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING = $LNG->DEBATE_NAME.' Nidificação';
$LNG->STATS_VIS_TITLE_ACTIVITY= 'Análise de Atividades';
$LNG->STATS_VIS_TITLE_USER_ACTIVITY = "Análise de Atividades do Usuário";
$LNG->STATS_VIS_TITLE_STREAM_GRAPH= "Contribuição Corrente";
$LNG->STATS_VIS_TITLE_OVERVIEW= "Visão Geral";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING_ATTENTION = "Atenção Mapa";
$LNG->STATS_VIS_TITLE_EDGESENSE_HISTORY = "Edgesense Rede Social";
$LNG->STATS_VIS_TITLE_INTEREST_NETWORK = "Rede de Interesse Comunitário";
$LNG->STATS_VIS_TITLE_COMMUNITIES_NETWORK = "Sub-Rede de Comunidades";
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK = $LNG->DEBATE_NAME.' Sunburst Rede por Tipo';
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK_BRANCH = $LNG->DEBATE_NAME.' Sunburst Rede por Seção';
$LNG->STATS_VIS_TITLE_TREEMAP = $LNG->DEBATE_NAME.' Treemap';
$LNG->STATS_VIS_TITLE_TREEMAP_BY_TYPE = $LNG->DEBATE_NAME.' Treemap por Tipo';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN = $LNG->DEBATE_NAME.' Treemap - De cima para baixo';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN_BY_TYPE = $LNG->DEBATE_NAME.' Treemap - De cima para baixo por Tipo';
$LNG->STATS_VIS_TITLE_TREE = "Árvore Dobrável";
$LNG->STATS_VIS_TITLE_TREE_BY_POSTS = "Árvore Dobrável por Posts";

/** Vis help texts **/
$LNG->STATS_HELP_HINT = "Clique para exibir/ocultar a descrição.";
$LNG->STATS_VIS_HELP_NETWORK = 'Esta visualização mostra a rede de '.$LNG->DEBATE_NAME.' contribuições. Existem controles de zoom e orientação disponíveis abaixo, você também pode utilizar a roda do mouse para zoom in e out. ';
$LNG->STATS_VIS_HELP_SOCIAL = 'Esta visualização mostra uma rede de usuários que participam na '.$LNG->DEBATE_NAME.'. Existem controles de zoom e orientação disponíveis abaixo, você também pode utilizar a roda do mouse para zoom in e out. As conexões entre usuários podem ser tanto verde (conexões principalmente de apoio), vermelho (conexões na maior parte de contador) e cinza (sem tipo de conexão dominante).';
$LNG->STATS_VIS_HELP_SUNBURST = 'Esta visualização mostra os usuários e suas conexões com '.$LNG->ISSUES_NAME.'. As conexões entre usuários e '.$LNG->ISSUES_NAME.' pode ser tanto verde (principalmente '.$LNG->PROS_NAME.'), vermelho (principalmente '.$LNG->CONS_NAME.'), e cinza (nenhum tipo de contribuição dominante) . Clique em um segmento da visualização para ver mais informações sobre esse membro ou '.$LNG->ISSUE_NAME.' no painel na área de detalhes.';
$LNG->STATS_VIS_HELP_STACKEDAREA = 'Esta visualização mostra os tipos de contribuições ao longo do tempo. Role o mouse para visualizar as estatísticas individuais por tipo e data. Clique na visualização para filtrar por tipo. Clique a direita sobre a visualização ou pressione o botão "Remove Filter" para visualizar.';

$LNG->STATS_VIS_HELP_TOPICSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">A seguinte visualização mostra as contribuições para um '.$LNG->DEBATE_NAME.' dispostos em esquema de parcelas xy. Use esta visualização para encontrar aglomerados/agrupamentos de contribuições. Um conjunto de contribuições representa contribuições semelhantes com base na atividade dos usuários (visualização, edição, atualização das contribuições, etc.).</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">O exemplo na parte superior direita mostra dois clusters (dois grupos distintos de contribuições com cada um tendo um padrão de atividade distinta). O exemplo na parte inferior direita mostra apenas um cluster. Muitas vezes não há grupos distintos.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Utilize este item para detectar clusters. Se a visualização mostrar mais do que um agrupamento, então este é um indicador da '.$LNG->DEBATE_NAME.' ser tendencioso em relação às pessoas pois mostram interação com o '.$LNG->DEBATE_NAME.'. Se houver apenas um cluster ou nenhum cluster, então este é um indicador de que o '.$LNG->DEBATE_NAME.' é imparcial.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Passe o mouse sobre um ponto de contribuição para ver mais informações no "Detail area".</div></div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Two clusters<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">One cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';

$LNG->STATS_VIS_HELP_BIASSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">A seguinte visualização mostra as contribuições para um '.$LNG->DEBATE_NAME.' dispostos em esquema de parcelas xy. Use esta visualização para encontrar aglomerados/agrupamentos de contribuições. Um conjunto de contribuições representa contribuições semelhantes baseadas no voto por usuários.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">O exemplo na parte superior direita mostra dois clusters ( dois grupos distintos de contribuições com cada um tendo um padrão de votação distinta). O exemplo na parte inferior direita mostra apenas um cluster. Muitas vezes não há grupos distintos.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Utilize este item para detectar clusters. Se a visualização mostra mais do que um agrupamento, então este é um indicador da '.$LNG->DEBATE_NAME.' ser tendencioso em relação ao comportamento eleitoral das pessoas. Se houver apenas um cluster ou sem cluster, então este é um indicador de que o '.$LNG->DEBATE_NAME.' é imparcial.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Passe o mouse sobre um ponto de contribuição para ver mais informações no "Detail area".</div></div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Two clusters<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">One cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';
$LNG->STATS_VIS_HELP_CIRCLEPACKING = 'A seguinte visualização fornece uma visão geral de toda a '.$LNG->DEBATE_NAME.' como círculos aninhados de contribuições. As cores denotam os tipos de nó, como mostrado na chave. Clique em um círculo para aumentar o zoom, clique fora de um círculo para reduzir. Rolagem de um círculo para ver o título do item como uma dica.';
$LNG->STATS_VIS_HELP_ACTIVITY = 'O seguinte mostra a visualização da atividade de um '.$LNG->DEBATE_NAME.' ao longo do tempo. Clique na linha do tempo para destacar um período de tempo (clique e arraste). Os resultados ilustrados abaixo irão mudar e mostrarão a freqüência de atividade por dia, o tipo de contribuição ('.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.' e '.$LNG->CON_NAME.'), o tipo de atividade (visualização, adição ou edição ) e na tabela abaixo você pode ver os dados subjacentes às visualizações. Lá você também pode redefinir a visualização ao seu estado original. Você pode clicar nas barras das visualizações para filtrar para um tipo específico. Você também pode selecionar vários tipos clicando em vários bares. Por exemplo, clique no '.$LNG->ISSUE_NAME.' e '.$LNG->SOLUTION_NAME.' bar e na barra de visualização para filtrar para todos viram '.$LNG->ISSUES_NAME.' e '.$LNG->SOLUTIONS_NAME.'.';
$LNG->STATS_VIS_HELP_USER_ACTIVITY = 'A visualização mostra a criação de contribuição e voto por usuários neste '.$LNG->DEBATE_NAME.'. Clique em "Users" gráfico para filtrar por usuário. Clique no "User Actions" gráfico para filtrar a página com a Ação. Em ambos, você pode selecionar mais de um . Você pode redefinir a página clicando no "Reset All".';
$LNG->STATS_VIS_HELP_STREAM_GRAPH = 'Esta visualização mostra os tipos de contribuições ao longo do tempo. Role em visualização para ver estatísticas individuais para cada tipo e data. Escolha entre um agrupado, detalahdo, e visão expandida para inspecionar contribuições ao longo do tempo.';
$LNG->STATS_VIS_HELP_OVERVIEW = 'Esta visualização fornece uma visão geral dos aspectos importantes de um '.$LNG->DEBATE_NAME.'. Ele contém três '.$LNG->DEBATE_NAME.' indicadores (passe o mouse sobre o ponto de interrogação ao lado de cada sinal para mais informações) e várias visualizações.';
$LNG->STATS_VIS_HELP_CIRCLEPACKING_ATTENTION = 'A seguinte visualização fornece uma visão geral de toda a '.$LNG->DEBATE_NAME.' como círculos aninhados de contribuições. As cores das bolas representam desigualdade. Estas medidas para o interesse da comunidade foram aplicadas de forma desigual para os filhos de cada contribuição , em que 0 = totalmente igual , 1 = toda a discussão é sobre filho único. O tamanho bola no nível mais profundo mede o grau de interesse da comunidade para essas contribuições, onde o interesse em um post inclui as contribuições em todos os posts no ramo abaixo dela. Cada bola em todos os níveis também exibe sua classificação. Clique em um círculo para aumentar o zoom, clique fora de um círculo para reduzir. Rolagem de um circulo para ler o título do item como uma dica.';
$LNG->STATS_VIS_HELP_EDGESENSE_HISTORY = 'Esta visualização mostra uma rede social com base nos dados fornecidos pela conversação.';
$LNG->STATS_VIS_HELP_INTEREST_NETWORK = 'Esta visualização mostra uma rede do '.$LNG->DEBATE_NAME.' pós conexões. O tamanho e a cor das bolas que representam os postos são determinados pela sua pontuação de interesse da comunidade. <br>Pontuações nível de interesse são calculados como se segue: vitam = 1; votada = 2; comentou sobre ou ligado a = 3; editado = 4. <br> Há controles de zoom e de orientação disponíveis abaixo e você também pode usar a roda do mouse para zoom in e out.';
$LNG->STATS_VIS_HELP_COMMUNITIES_NETWORK = 'Esta visualização mostra uma rede do '.$LNG->DEBATE_NAME.' pós conexões. A forma e a cor dos nós que representam as mensagens são determinados pelo agrupamento de sub-comunidade. Sub-comunidades de posts são as mensagens que tendem a ser analisadas ??em conjunto. <br>There are zoom and orientation controls available below and you can also use your mouse wheel to zoom in and out.';
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK = "Esta visualização exibe um gráfico de rede dos postos ligados no ".$LNG->DEBATE_NAME." como um sunburst camadas colorido por tipo de post. Clique segmentos de reorientar o gráfico.";
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK_BRANCH = "Esta visualização exibe um gráfico de rede dos postos ligados no ".$LNG->DEBATE_NAME." como um sunburst em camadas. As cores mostram os diferentes ramos da ".$LNG->DEBATE_NAME.". Clique segmentos de reorientar o gráfico.";
$LNG->STATS_VIS_HELP_TREEMAP = "Esta visualização exibe um treemap do ".$LNG->DEBATE_NAME.". Os blocos coloridos representam as folhas da árvore . As cores das folhas mudam para representar grupos de folhas de irmãos . Clique para ampliar.";
$LNG->STATS_VIS_HELP_TREEMAP_BY_TYPE = "Esta visualização exibe um treemap do ".$LNG->DEBATE_NAME.". Os blocos coloridos representam as folhas da árvore. As cores das folhas mudam para representar tipos de post. Clique para ampliar";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN = "Esta visualização exibe um treemap do ".$LNG->DEBATE_NAME.". Os dois primeiros níveis da árvore são expostos inicialmente e então você drill down clicando nas caixas etiquetadas.";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN_BY_TYPE = "Esta visualização exibe um treemap do ".$LNG->DEBATE_NAME.". Os dois primeiros níveis da árvore são expostos inicialmente e então você drill down clicando nas caixas etiquetadas. As cores da caixa mostram o tipo de post.";
$LNG->STATS_VIS_HELP_TREE = "Esta visualização exibe um tree do ".$LNG->DEBATE_NAME.". Os tamanhos dos círculos e link são determinados pelo número de crianças abaixo de um determinado nó. Clique para expandir os níveis de círculos/contrato . Role os círculos para obter mais informações.";
$LNG->STATS_VIS_HELP_TREE_BY_POSTS = "Esta visualização exibe um treemap do ".$LNG->DEBATE_NAME.". Os tamanhos dos círculos e link são determinados pelo número de lugares abaixo de um determinado nó. As publicações não são mostrados na árvore. Clique para expandir os níveis de círculos/contrato . Role os círculos para obter mais informações.";

/** Mini vis word counts **/
$LNG->MINI_WORD_STATS_XAXIS_LABEL = 'Total de palavras por Usuário';
$LNG->MINI_WORD_STATS_WORDS_MIN = 'contribuição mínima:';
$LNG->MINI_WORD_STATS_WORDS_MAX = 'contribuição máxima:';
$LNG->MINI_WORD_STATS_AVERAGE = 'contribuição média por Usuário:';

/** Mini vis user contributions **/
$LNG->MINI_USER_CONTRIBUTIONS_XAXIS_LABEL = 'Contribuições por Tipo';

/** Mini vis user viewing activity **/
$LNG->MINI_USER_VIEWING_HIGHEST = 'Mais visualizados: ';
$LNG->MINI_USER_VIEWING_LOWEST = 'Menos visualizados: ';
$LNG->MINI_USER_VIEWING_LAST = 'Última visualização: ';
$LNG->MINI_USER_VIEWING_VIEWS = 'visualizações';
$LNG->MINI_USER_VIEWING_ON = 'no';
$LNG->MINI_USER_VIEWING_XAXIS_LABEL = 'Ver conta por Data';

/** Attention Map **/
$LNG->ATTENTION_MAP_KEY_NAME = 'Classificação Desigual';
$LNG->ATTENTION_MAP_INTEREST = 'Classificação de Interesse';
$LNG->ATTENTION_MAP_INEQULAITY = 'Classificação Desigual';

/** Overview visulaisation **/
$LNG->STATS_OVERVIEW_MAIN_TITLE='Visão Geral';
$LNG->STATS_OVERVIEW_WORDS_MESSAGE = 'Estatísticas Contagem de palavra:';
$LNG->STATS_OVERVIEW_CONTRIBUTION_MESSAGE = 'Contribuições do Usuário';
$LNG->STATS_OVERVIEW_VIEWING_MESSAGE = "Atividade de visualização do Usuário";
$LNG->STATS_OVERVIEW_HEALTH_TITLE = $LNG->DEBATE_NAME.' Indicadores de Saúde';
$LNG->STATS_OVERVIEW_HEALTH_PROBLEM = 'Há um problema.';
$LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM = 'There seems to be no problem.';
$LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM = 'Não parece haver nenhum problema.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_TITLE = 'Indicador contribuição Atividade';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_TITLE = 'Visualizando o Indicador de atividade';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_TITLE = 'Indicador de participação';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTORS = 'participaram deste '.$LNG->DEBATE_NAME.".";
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS = '';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2 = 'viram essa '.$LNG->DEBATE_NAME;
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_RED = ' nos últimos 14 dias';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_ORANGE = ' entre 6 e 14 dias atrás';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_GREEN = ' nos últimos 5 dias';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION = ' contribuiu';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_RED = ' nos últimos 14 dias';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_ORANGE = ' entre 6 e 14 dias atrás';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_GREEN = ' nos últimos 5 dias';
$LNG->STATS_OVERVIEW_LOADING_MESSAGE = '(Carregando quadro geral de Estatísticas. Este procedimento pode levar alguns tempo para calcular, dependendo do tamanho dos dados ...)';
$LNG->STATS_OVERVIEW_TOP_THREE_VOTES_MESSAGE = 'Mais votado em entradas:';
$LNG->STATS_OVERVIEW_RECENT_NODES_MESSAGE = 'Mais recentemente acrescentou:';
$LNG->STATS_OVERVIEW_RECENT_VOTES_MESSAGE = 'Mais recentemente votada:';
$LNG->STATS_OVERVIEW_DATE = 'Data:';
$LNG->STATS_OVERVIEW_VOTES = 'Votos:';
$LNG->STATS_OVERVIEW_TIME = 'tempo';
$LNG->STATS_OVERVIEW_TIMES = 'vezes';
$LNG->STATS_OVERVIEW_PERSON = 'pessoa';
$LNG->STATS_OVERVIEW_PEOPLE = 'pessoas';
$LNG->STATS_OVERVIEW_WORDS_AVERAGE = 'contribuição média:';
$LNG->STATS_OVERVIEW_WORDS = 'palavras';
$LNG->STATS_OVERVIEW_WORDS_MIN = 'mínimo:';
$LNG->STATS_OVERVIEW_WORDS_MAX = 'máximo:';
$LNG->STATS_OVERVIEW_VIEWING_HIGHEST = 'Contagem de visualização mais alto foi';
$LNG->STATS_OVERVIEW_VIEWING_LOWEST = 'Menor contagem de visualização fo';
$LNG->STATS_OVERVIEW_VIEWING_LAST = 'Última contagem de visualização foi';
$LNG->STATS_OVERVIEW_VIEWING_VIEWS = 'vizualizações';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_HINT = 'Se menos de 3 pessoas participaram neste '.$LNG->DEBATE_NAME.' então isso vai mostrar um sinal vermelho . Se entre 3 e 5 pessoas participaram neste '.$LNG->DEBATE_NAME.' então este irá mostrar um ícone de sinal amarelo. Se mais de 5 pessoas participaram neste '.$LNG->DEBATE_NAME.' então isso vai mostrar um sinal verde.';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_HINT = 'Se as pessoas não viram este '.$LNG->DEBATE_NAME.' por mais de 14 dias , isso vai mostrar um sinal vermelho. Se as pessoas viram este '.$LNG->DEBATE_NAME.' entre 6 e 14 dias atrás isso vai mostrar um sinal laranja. Se as pessoas viram este '.$LNG->DEBATE_NAME.' nos últimos 5 dias isso vai mostrar um sinal verde.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_HINT = 'Se as pessoas não adicionaram uma nova entrada para esta '.$LNG->DEBATE_NAME.' por mais de 14 dias, isso vai mostrar um sinal vermelho. Se as pessoas adicionaram uma nova entrada neste '.$LNG->DEBATE_NAME.' entre 6 e 14 dias atrás então este irá mostrar um sinal laranja. Se as pessoas adicionaram uma nova entrada neste '.$LNG->DEBATE_NAME.' nos últimos 5 dias isso irá mostrar um sinal verde.';

/** Activity graphs **/
$LNG->STATS_ACTIVITY_COLUMN_DATE = 'Data';
$LNG->STATS_ACTIVITY_COLUMN_TITLE = 'Título';
$LNG->STATS_ACTIVITY_COLUMN_ITEM_TYPE = 'Tipo de Contribuição';
$LNG->STATS_ACTIVITY_COLUMN_TYPE = 'Tipo de Atividade';
$LNG->STATS_ACTIVITY_COLUMN_ACTION = 'Ação do Usuário';
$LNG->STATS_ACTIVITY_FILTER_DATE_TITLE = 'Data';
$LNG->STATS_ACTIVITY_FILTER_DAYS_TITLE = 'Dias da semana';
$LNG->STATS_ACTIVITY_FILTER_ITEM_TYPES_TITLE = 'Tipo de Contribuição';
$LNG->STATS_ACTIVITY_FILTER_TYPES_TITLE = 'Tipo de Atividade';
$LNG->STATS_ACTIVITY_FILTER_USERS_TITLE = 'Usuários';
$LNG->STATS_ACTIVITY_FILTER_ACTION_TITLE = 'Ação do Usuário';
$LNG->STATS_ACTIVITY_USER_ANONYMOUS = "u";

$LNG->STATS_ACTIVITY_CREATE = 'Criar';
$LNG->STATS_ACTIVITY_UPDATE = 'Atualizar';
$LNG->STATS_ACTIVITY_DELETE = 'Deletar';
$LNG->STATS_ACTIVITY_VIEW = 'Visualizar';
$LNG->STATS_ACTIVITY_VOTE = 'Votar';
$LNG->STATS_ACTIVITY_VOTED_FOR = 'Votaram para';
$LNG->STATS_ACTIVITY_VOTED_AGAINST = 'votaram contra';

$LNG->STATS_ACTIVITY_SUNDAY = 'Dom.';
$LNG->STATS_ACTIVITY_MONDAY = 'Seg.';
$LNG->STATS_ACTIVITY_TUESDAY = 'Ter.';
$LNG->STATS_ACTIVITY_WEDNESDAY = 'Qua.';
$LNG->STATS_ACTIVITY_THURSDAY = 'Qui.';
$LNG->STATS_ACTIVITY_FRIDAY = 'Sex.';
$LNG->STATS_ACTIVITY_SATURDAY = 'Sáb.';

$LNG->STATS_ACTIVITY_JAN = 'Janeiro';
$LNG->STATS_ACTIVITY_FEB = 'Fevereiro';
$LNG->STATS_ACTIVITY_MAR = 'Março';
$LNG->STATS_ACTIVITY_APR = 'Abril';
$LNG->STATS_ACTIVITY_MAY = 'Maio';
$LNG->STATS_ACTIVITY_JUN = 'Junho';
$LNG->STATS_ACTIVITY_JUL = 'Julho';
$LNG->STATS_ACTIVITY_AUG = 'Agosto';
$LNG->STATS_ACTIVITY_SEP = 'Setembro';
$LNG->STATS_ACTIVITY_OCT = 'Outubro';
$LNG->STATS_ACTIVITY_NOV = 'Novembro';
$LNG->STATS_ACTIVITY_DEC = 'Dezembro';

$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART1 = 'selecionado de';
$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART2 = 'registros';
$LNG->STATS_ACTIVITY_RESET_ALL_BUTTON = 'Reiniciar tudo';

$LNG->STATS_ACTIVITY_ADDED = 'Adicionado';

/** Scatterplots **/
$LNG->STATS_SCATTERPLOT_DETAILS_COUNT = "Entradas:";
$LNG->STATS_SCATTERPLOT_DETAILS = "Detalhes da Área";
$LNG->STATS_SCATTERPLOT_DETAILS_CLICK = "Passe o mouse sobre o ponto de contribuição para visualizar detalhes.";

/** Contribution River **/
$LNG->STATS_GROUP_STACKEDAREA_TITLE = 'Chave';
$LNG->STATS_GROUP_STACKEDAREA_HELP = 'Passe o mouse sobre uma área colorida em um determinado momento para exibir uma contagem de contribuição para esse tipo de item para essa data.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'À esquerda, clique uma área colorida para filtrar diagrama em que tipo de item.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Botão direito do mouse para remover o filtro (ou clique no botão abaixo).<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_RESTORE_BUTTON = 'Retirar filtro';

/** People and Issue Ring **/
$LNG->STATS_GROUP_SUNBURST_PERSON = 'Membro';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_DEBATE = 'foi contribuída por:';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_USER = 'e está ligado aos:';
$LNG->STATS_GROUP_SUNBURST_WITH = 'com:';
$LNG->STATS_GROUP_SUNBURST_CREATED = 'criado:';
$LNG->STATS_GROUP_SUNBURST_DETAILS = "Detalhes da Área";
$LNG->STATS_GROUP_SUNBURST_DETAILS_CLICK = "Clique seção para ver mais detalhes";

/** Network graphs **/
$LNG->GRAPH_PRINT_HINT = "Imprima esta rede gráfico";
$LNG->GRAPH_ZOOM_FIT_HINT = "Gráfico escala para baixo, se necessário pode-se mover para fazer tudo caber na área visível";
$LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT = "Zoom neste gráfico de rede a 100%";
$LNG->GRAPH_ZOOM_IN_HINT = "Zoom dentro";
$LNG->GRAPH_ZOOM_OUT_HINT = "Zoom fora";
$LNG->GRAPH_CONNECTION_COUNT_LABEL = 'Conexões:';
$LNG->GRAPH_NOT_SUPPORTED = 'Seu navegador atual não suporta HTML5 Canvas. <br> Por favor, atualize para uma versão mais recente, se você quiser veja essa visualização: IE 9.0+; Firefox 23.0+; Chrome 29.0+; Opera 17.0+; Safari 5.1+';

$LNG->NETWORKMAPS_RESIZE_MAP_HINT = 'Redimensionar o Mapa';
$LNG->NETWORKMAPS_ENLARGE_MAP_LINK = 'Ampliar Mapa';
$LNG->NETWORKMAPS_REDUCE_MAP_LINK = 'Reduzir Mapa';
$LNG->NETWORKMAPS_EXPLORE_ITEM_LINK = 'Explorar item selecionado';
$LNG->NETWORKMAPS_EXPLORE_ITEM_HINT = 'Abra a página detalhes para o item selecionado no momento';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_LINK = 'Explore Autor de item selecionado';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT = 'Abra o Autor da home page para item selecionado no momento';
$LNG->NETWORKMAPS_SELECTED_NODEID_ERROR = 'Por favor, certifique-se de ter feito uma seleção no mapa.';
$LNG->NETWORKMAPS_LOADING_MESSAGE = 'Buscando dados...';
$LNG->NETWORKMAPS_NO_RESULTS_MESSAGE = 'Nenhum resultado encontrado.';
$LNG->NETWORKMAPS_KEY_SELECTED_ITEM = 'item selecionado';
$LNG->NETWORKMAPS_KEY_FOCAL_ITEM = 'item focal';
$LNG->NETWORKMAPS_KEY_NEIGHBOUR_ITEM = 'item vizinho';
$LNG->NETWORKMAPS_KEY_SOCIAL_MODERATELY = 'moderadamente conectado';
$LNG->NETWORKMAPS_KEY_SOCIAL_HIGHLY = 'altamente conectado';
$LNG->NETWORKMAPS_KEY_SOCIAL_SLIGHTLY = 'ligeiramente conectado';
$LNG->NETWORKMAPS_KEY_SOCIAL_MOST = 'O mais conectado';
$LNG->NETWORKMAPS_PERCENTAGE_MESSAGE = '% do layout computado...';
$LNG->NETWORKMAPS_SCALING_MESSAGE = 'Dimensionamento para caber página...';

$LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT = 'Mostrar todas as conexões para o link selecionado';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_LINK = 'Explorar link selecionado';
$LNG->NETWORKMAPS_SOCIAL_LOADING_MESSAGE = '(Carregando Rede Social View. Isso pode demorar alguns minutos para calcular, dependendo do tamanho do Hub ... )';
$LNG->NETWORKMAPS_SOCIAL_CONNECTIONS = 'Conexões';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION = 'Conexões';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_MESSAGE = 'Clique nos links de conexão abaixo para ver os detalhes';

/** INTEREST HEAT NETWORK **/
$LNG->INTEREST_NETWORK_COUNT = 'pontuação do interesse';
$LNG->INTEREST_NETWORK_CONNECTIONS = 'conexão';
$LNG->INTEREST_NETWORK_CALCULATION_KEY = 'chave';

/** COLLAPSIBLE TREE **/
$LNG->TREE_COLLAPSE_ALL = 'Recolher todos';
$LNG->TREE_EXPAND_ALL = 'Expandir todos';
$LNG->TREE_HOMEPAGE_TEXT = 'Vá para Homepage';
$LNG->TREE_HOMEPAGE_HINT = 'Clique para ir e ver a homepage deste item';
$LNG->TREE_COMMENT_COUNT = $LNG->COMMENT_NAME.' Contagem:';
$LNG->TREE_CHILD_COUNT = 'Contagem crinaça:';

/** LOADING MESSAGES **/
$LNG->LOADING_DATA = '(Carregando dados...)';
$LNG->LOADING_MESSAGE = 'Carregando...';

// ODD BITS
$LNG->NODE_EXPLORE_BUTTON_TEXT = 'Explorar >>';
$LNG->NODE_EXPLORE_BUTTON_HINT = 'Clique para ver mais informações';
$LNG->USER_EXPLORE_BUTTON_HINT = 'Clique para ver mais detalhes sobre esta pessoa';
$LNG->NODE_TYPE_ICON_HINT = 'Ver imagem original';
$LNG->SOCIAL_MULTI_CONNECTIONS_ERROR = 'Dados fornecidos insuficientes para obter Conexões';

// ALERT MESSAGES
$LNG->ALERTS_BOX_TITLE = 'Alertas';
$LNG->ALERT_SHOW_ALL = 'mostre tudo...';
$LNG->ALERT_SHOW_LESS = 'mostre menos...';

//RETURNS POSTS / PEOPLE BASED
$LNG->ALERT_UNSEEN_BY_ME = "Visto por mim";
$LNG->ALERT_HINT_UNSEEN_BY_ME = "Eu não vi esse post ainda.";

$LNG->ALERT_RESPONSE_TO_ME = "Resposta ao meu post";
$LNG->ALERT_HINT_RESPONSE_TO_ME = "Este post é uma resposta a um post de minha autoria.";

$LNG->ALERT_UNRATED_BY_ME = "Não votaram em mim por";
$LNG->ALERT_HINT_UNRATED_BY_ME = "Eu ainda não votei sobre este post.";

$LNG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME = "Visualizado por pessoas semelhantes a mim";
$LNG->ALERT_HINT_INTERESTING_TO_PEOPLE_LIKE_ME = "Este post foi visto por pessoas com interesses semelhantes a mim (com base na análise dos padrões de atividade SVD).";

$LNG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Votado por pessoas semelhantes a mim";
$LNG->ALERT_HINT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Este post foi muito bem votado por pessoas cujas opiniões são semelhantes a min (com base na análise de padrões de classificação SVD).";

$LNG->ALERT_INTERESTING_TO_ME = 'Interessante para mim';
$LNG->ALERT_HINT_INTERESTING_TO_ME = 'Encontrar mensagens que devem interessar um usuário, considerando os seus interesses anteriores. Este alerta estima o(s) usuário(s) interessados em cada post com base na atenção dada aos vizinhos mais próximos no passado. Em seguida, identifica as mensagens cujos escores de "interesse" estão no top 50%.';

$LNG->ALERT_UNSEEN_COMPETITOR = 'Competidor não visto';
$LNG->ALERT_HINT_USER_IGNORED_COMPETITORS = 'Identifica idéias de outra pessoa que concorre com uma idéia que eu autoria.';

$LNG->ALERT_UNSEEN_RESPONSE = 'Resposta não visto';
$LNG->ALERT_HINT_UNSEEN_RESPONSE = 'Identifica invisível (por mim) as respostas de autoria de alguém para um post que eu autoria.';


//RETURNS PEOPLE / PEOPLE BASED
$LNG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "Pessoas como eu - por interesses";
$LNG->ALERT_HINT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "As pessoas que têm interesses semelhantes para mim, com base em padrões de atividade.";

$LNG->ALERT_PEOPLE_WHO_AGREE_WITH_ME = "Pessoas como eu - por votação";
$LNG->ALERT_HINT_PEOPLE_WHO_AGREE_WITH_ME = "As pessoas que têm opiniões semelhantes a minha, com base em padrões de rating.";

$LNG->ALERT_LURKING_USER = 'Observando o Usuário';
$LNG->ALERT_HINT_LURKING_USER = 'O usuário não editou ou criou nenhum post';

$LNG->ALERT_INACTIVE_USER = 'Usuário inativo';
$LNG->ALERT_HINT_INACTIVE_USER = 'Encontra usuários que fizeram zilch';

$LNG->ALERT_USER_IGNORED_COMPETITORS = 'Concorrentes ignorado Usuário';
$LNG->ALERT_HINT_USER_IGNORED_COMPETITORS = 'Identifica os usuários que ignoraram concorrentes às suas idéias. Para cada usuário, ele lista os problemas que o usuário oferecidos ideias para , seguidos pelas idéias concorrentes que o usuário ignorado (ou seja, não ver ou responder a ).';

$LNG->ALERT_USER_IGNORED_ARGUMENTS = 'Argumentos ignorados Usuário';
$LNG->ALERT_HINT_USER_IGNORED_ARGUMENTS = 'Identifica os usuários que ignorou os argumentos subjacentes quando rating mensagens. Para cada usuário, ele lista os postos de classificação seguidos pelos argumentos para cada uma dessas mensagens que o usuário ignorado (ou seja, não ver ou responder a).';

$LNG->ALERT_USER_IGNORED_RESPONSES = 'Respostas ignoradas Usuário';
$LNG->ALERT_HINT_USER_IGNORED_RESPONSES = 'Identifica os usuários que ignoraram as respostas de outras pessoas a seus postos . Para cada usuário, ele lista os postos de autoria do usuário seguido respostas a cada uma dessas mensagens que o usuário ignorado (ou seja, não ver ou responder a).';


//RETURNS POSTS / MAP BASED
$LNG->ALERT_HOT_POST = "Hot post";
$LNG->ALERT_HINT_HOT_POST = "De forma geral, este post tem recebido um grande interesse.";

$LNG->ALERT_ORPHANED_IDEA = "Idéia Orfão";
$LNG->ALERT_HINT_ORPHANED_IDEA = "Esta idéia post está recebendo muito menos atenção do que os seus irmãos.";

$LNG->ALERT_EMERGING_WINNER = "Idéia Dominante";
$LNG->ALERT_HINT_EMERGING_WINNER = "Uma idéia tem predominância de apoio comunitário (para um determinado assunto).";

$LNG->ALERT_CONTENTIOUS_ISSUE = "questão controversa";
$LNG->ALERT_HINT_CONTENTIOUS_ISSUE = "Um problema com idéias que a comunidade está fortemente dividida sobre : balcanização , polarização.";

$LNG->ALERT_INCONSISTENT_SUPPORT = "Idéia apoiada inconsistentemente";
$LNG->ALERT_HINT_INCONSISTENT_SUPPORT = "Uma idéia de onde o meu apoio à ideia e argumentos é subjacentes são inconsistentes.";

$LNG->ALERT_MATURE_ISSUE = 'Questão Madura';
$LNG->ALERT_HINT_MATURE_ISSUE = 'Questão tem >= 3 idéias com pelo menos um argumento cada';

$LNG->ALERT_IGNORED_POST = 'Post Ignorado';
$LNG->ALERT_HINT_IGNORED_POST = 'Post não foi visto por ninguém, mas autor original';

$LNG->ALERT_USER_GONE_INACTIVE = 'Usuário Inativo';
$LNG->ALERT_HINT_USER_GONE_INACTIVE = 'Usuários que estavam inicialmente ativa, mas parou';

$LNG->ALERT_CONTROVERSIAL_IDEA = 'idéia controversa';
$LNG->ALERT_HINT_CONTROVERSIAL_IDEA = 'A comunidade tem opiniões amplamente divergentes (como refletido pela sua votação ) de saber se uma idéia é boa ou não.';

$LNG->ALERT_IMMATURE_ISSUE = "Questão Imatura";
$LNG->ALERT_HINT_IMMATURE_ISSUE = 'Edição de três idéias sem argumentos';

$LNG->ALERT_WELL_EVALUATED_IDEA = "Idéia bem avaliada";
$LNG->ALERT_HINT_WELL_EVALUATED_IDEA = "Idéia tem vários prós e contras, incluindo algumas refutações";

$LNG->ALERT_POORLY_EVALUATED_IDEA = "Idéia mal avaliada";
$LNG->ALERT_HINT_POORLY_EVALUATED_IDEA = "Idea tem alguns prós e contras, e não há refutações";

$LNG->ALERT_RATING_IGNORED_ARGUMENT = 'Classificação argumento ignorado';
$LNG->ALERT_HINT_RATING_IGNORED_ARGUMENT = 'Identifica argumentos relevantes que o usuário não ver antes de avaliar um post.';
?>
