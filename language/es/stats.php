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
 */

/** General **/
$LNG->STATS_DEBATE_CONTRIBUTION_HELP = 'Este semáforo indica cómo equilibrada los tipos de contribuciones son para el debate. Si uno de los tipos ('.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.', '.$LNG->CON_NAME.', or Votes) es la cebada representado ( por debajo del 10 % ) se mostrará un semáforo en rojo. Si uno de los tipos es subrepresentadas ( menos del 20% ) entonces se muestra un semáforo amarillo. De lo contrario, los tipos están en equilibrio y se mostrará un semáforo en verde.';
$LNG->STATS_DEBATE_VIEWING_HELP = 'Este indicador representa el porcentaje de miembros de este grupo que vieron este asunto. Si el 50 % o más miembros de este grupo vieron este tema a continuación se mostrará un semáforo en verde . Si el 20 % y el 49 % considera que a continuación se mostrará un semáforo amarillo. Si menos del 20% considera este tema se mostrará un semáforo en rojo.';
$LNG->STATS_HELP_HINT = "Haga clic para mostrar / ocultar la descripción de visualización.";
$LNG->STATS_VIS_ERROR_BIASSPACE = 'Lo sentimos, pero sus datos no pudieron aún ser visualizados como la métrica subyacente necesita más datos';
$LNG->STATS_VIS_ERROR_TOPICSPACE = 'Lo sentimos, pero sus datos no pudieron aún ser visualizados como la métrica subyacente necesita más datos';

/** Vis Names/Dashboard Tabs **/
$LNG->STATS_TAB_HOME = "Home";
$LNG->STATS_VIS_TITLE_NETWORK = $LNG->DEBATE_NAME.' La Red';
$LNG->STATS_VIS_TITLE_SOCIAL = 'Red social';
$LNG->STATS_VIS_TITLE_SUNBURST = 'Gente y Anillo Edición';
$LNG->STATS_VIS_TITLE_STACKEDAREA = 'Contribución Río';
$LNG->STATS_VIS_TITLE_TOPICSPACE = 'Actividad Sesgo';
$LNG->STATS_VIS_TITLE_BIASSPACE = "Sesgo de Calificación";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING = $LNG->DEBATE_NAME.' Anidación';
$LNG->STATS_VIS_TITLE_ACTIVITY= 'Análisis de la Actividad';
$LNG->STATS_VIS_TITLE_USER_ACTIVITY = "Análisis de la Actividad del Usuario";
$LNG->STATS_VIS_TITLE_STREAM_GRAPH= "Corriente Contribución";
$LNG->STATS_VIS_TITLE_OVERVIEW= "Descripción Rápida";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING_ATTENTION = "Atención Mapa";
$LNG->STATS_VIS_TITLE_EDGESENSE_HISTORY = "Sentido Edge Red Social";
$LNG->STATS_VIS_TITLE_INTEREST_NETWORK = "Red de Interés Comunitario";
$LNG->STATS_VIS_TITLE_COMMUNITIES_NETWORK = "Sub-Red de Comunidades";
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK = $LNG->DEBATE_NAME.' El resplandor solar - Red por Tipo';
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK_BRANCH = $LNG->DEBATE_NAME.' El resplandor solar - Red por la Sección';
$LNG->STATS_VIS_TITLE_TREEMAP = $LNG->DEBATE_NAME.' Mapa del árbol';
$LNG->STATS_VIS_TITLE_TREEMAP_BY_TYPE = $LNG->DEBATE_NAME.' Mapa del árbol por Tipo';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN = $LNG->DEBATE_NAME.' Mapa del árbol - De arriba hacia abajo';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN_BY_TYPE = $LNG->DEBATE_NAME.' Mapa del árbol - De arriba hacia abajo por Tipo';
$LNG->STATS_VIS_TITLE_TREE = "Árbol Plegable";
$LNG->STATS_VIS_TITLE_TREE_BY_POSTS = "Árbol Plegable por Mensajes";

/** Vis help texts **/
$LNG->STATS_HELP_HINT = "Haga clic para mostrar/ocultar la descripción visualización.";
$LNG->STATS_VIS_HELP_NETWORK = 'Esta visualización muestra una red de la '.$LNG->DEBATE_NAME.' contribuciones. Hay controles de zoom y orientación disponibles a continuación y también se puede utilizar la rueda del ratón para acercar y alejar.';
$LNG->STATS_VIS_HELP_SOCIAL = 'Esta visualización muestra una red de usuarios que participan en el '.$LNG->DEBATE_NAME.'. Hay controles de zoom y orientación disponibles a continuación y también se puede utilizar la rueda del ratón para acercar y alejar. Las conexiones entre los usuarios pueden ser o verdes (conexiones sobre todo de apoyo), rojo (conexiones mayoría de contador ) y gris (sin tipo de conexión dominante).';
$LNG->STATS_VIS_HELP_SUNBURST = 'Esta visualización muestra los usuarios y sus conexiones con '.$LNG->ISSUES_NAME.'. Las conexiones entre los usuarios y '.$LNG->ISSUES_NAME.' puede ser verde (en su mayoría '.$LNG->PROS_NAME.'), rojo (en su mayoría '.$LNG->CONS_NAME.'), y gris (sin tipo de contribución dominante ). Haga clic en un segmento de la visualización ver más información sobre ese miembro o '.$LNG->ISSUE_NAME.' en el panel de detalles zona.';
$LNG->STATS_VIS_HELP_STACKEDAREA = 'Esta visualización muestra los tipos de contribuciones a través del tiempo. Dese la vuelta la visualización para ver las estadísticas individuales para cada tipo para cada fecha. Haga clic en la visualización para filtrar por tipo. Haga clic derecho sobre la visualización o pulse el "Eliminar filtro " para eliminar el filtro de la visualización.';

$LNG->STATS_VIS_HELP_TOPICSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">A seguinte visualização mostra contribuições para uma '.$LNG->DEBATE_NAME.' dispuestos en una xy trama. Utilice esta visualización para encontrar clúster/agrupaciones de contribuciones. Un clúster de contribuciones representa contribuciones similares basados ??en la actividad de los usuarios con ellos (visualización, edición, actualización de las contribuciones, etc.).</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">El ejemplo de la parte superior derecha muestra dos grupos (dos grupos distintos de las contribuciones con cada uno que tiene un patrón de actividad distinta). El ejemplo en la parte inferior derecha muestra un solo clúster. A menudo no hay grupos distintos.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Utilice esta visualizaciones de detectar clusters. Si la visualización muestra más de un grupo, entonces esto es un indicador de la '.$LNG->DEBATE_NAME.' siendo sesgados con respecto a las personas de interés muestran interactuando con el '.$LNG->DEBATE_NAME.'. Si sólo hay un clúster o no clúster, entonces esto es un indicador de que la '.$LNG->DEBATE_NAME.' es imparcial.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Pase el ratón sobre un punto contribución para ver más información en la "Zona Detalle".</div></div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Dos clusters<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">Uno cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';

$LNG->STATS_VIS_HELP_BIASSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">La siguiente visualización muestra las contribuciones a un '.$LNG->DEBATE_NAME.' dispuestos en una xy trama. Utilice esta visualización para encontrar clúster/agrupaciones de contribuciones. Un clúster de contribuciones representa contribuciones similares .</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">El ejemplo de la parte superior derecha muestra dos clusters (dos grupos distintos de las contribuciones con cada uno que tiene un patrón de votación distinto). El ejemplo en la parte inferior derecha muestra un solo clúster. A menudo no hay grupos distintos.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Utilice esta visualizaciones de detectar clusters. Si la visualización muestra más de un grupo, entonces esto es un indicador de la '.$LNG->DEBATE_NAME.' parcialidad con respecto a la conducta de voto de la gente. Si sólo hay un clúster o no clúster, entonces esto es un indicador de que la '.$LNG->DEBATE_NAME.' es imparcial.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Pase el ratón sobre un punto contribución para ver más información en la "Zona Detalle".</div></div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Dos clusters<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">Uno cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';

$LNG->STATS_VIS_HELP_CIRCLEPACKING = 'La siguiente visualización proporciona una visión general de todo el '.$LNG->DEBATE_NAME.' como círculos anidados de contribuciones. Los colores indican los tipos de nodos, como se muestra en la clave. Haga clic en un círculo para hacer un zoom, haga clic fuera de un círculo para alejar. Pasar por encima de cirlce para ver el título del artículo como ayuda.';
$LNG->STATS_VIS_HELP_ACTIVITY = 'La siguiente visualización muestra la actividad de una '.$LNG->DEBATE_NAME.' a través del tiempo. Haga clic en la línea de tiempo para cubrir un período de tiempo (hacer clic y arrastrar). Las visualizaciones de abajo cambiarán y se mostrará la frecuencia de la actividad por día, el tipo de contribución ('.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.' y '.$LNG->CON_NAME.'), el tipo de actividad (visualizar, añadir, o la edición), y en la tabla de abajo se pueden ver los datos subyacentes las visualizaciones. Allí también se puede restablecer la visualización a su estado original. Puede hacer clic en las barras de las visualizaciones para filtrar para un tipo específico. También puede seleccionar varios tipos haciendo clic en varios bares. Haga clic en por ejemplo en el '.$LNG->ISSUE_NAME.' y '.$LNG->SOLUTION_NAME.' bar y en la barra de visualización para filtrar por todas vistos '.$LNG->ISSUES_NAME.' y '.$LNG->SOLUTIONS_NAME.'.';
$LNG->STATS_VIS_HELP_USER_ACTIVITY = 'La visualización muestra la creación de la contribución y la votación por los usuarios en este '.$LNG->DEBATE_NAME.'. Haga clic en " Usuarios" tabla para filtrar por usuario. Haga clic en "Acciones del usuario" carta para filtrar la página por acción. En tanto, puede seleccionar más de uno. Puede restablecer la página haciendo clic en "Reiniciar todo".';
$LNG->STATS_VIS_HELP_STREAM_GRAPH = 'Esta visualización muestra los tipos de contribuciones a través del tiempo. Pase el cursor sobre la visualización para ver las estadísticas individuales para cada tipo para cada fecha. Elija entre una apilada, arroyo y vista ampliada de inspeccionar las contribuciones a través del tiempo.';
$LNG->STATS_VIS_HELP_OVERVIEW = 'Este visualizaciones proporciona una visión general de los aspectos importantes de un '.$LNG->DEBATE_NAME.'. Contiene tres '.$LNG->DEBATE_NAME.' indicadores de salud (se ciernen sobre el signo de interrogación al lado de cada semáforo para más información) y varias visualizaciones de información general.';

$LNG->STATS_VIS_HELP_CIRCLEPACKING_ATTENTION = 'La siguiente visualización proporciona una visión general de todo el '.$LNG->DEBATE_NAME.' como círculos anidados de contribuciones. Los colores de las bolas representan la desigualdad. Esta medidas a lo que se aplica el interés de la comunidad medida desigual a los hijos de cada contribución , donde 0 = totalmente iguales, 1 = toda discusión está en un solo niño. El tamaño de la bola en el nivel más profundo mide el grado de interés de la comunidad para esas contribuciones, donde el interés por un puesto incluye el interés en todos los puestos de la rama debajo de ella. Cada bola en todos los niveles también muestra su calificación Intereses de vuelco. Haga clic en un círculo para hacer un zoom, haga clic fuera de un círculo para alejar. Pasar por encima de cirlce para ver el título del artículo como ayuda.';
$LNG->STATS_VIS_HELP_EDGESENSE_HISTORY = 'Esta visualización muestra una red social basada en los datos suministrados conversación.';
$LNG->STATS_VIS_HELP_INTEREST_NETWORK = 'Esta visualización muestra una red de la '.$LNG->DEBATE_NAME.' conexiones posteriores . El tamaño y el color de las bolas que representan los mensajes están determinadas por su puntuación de interés de la comunidad. <br>Puntajes nivel de interés se calculan de la siguiente manera : se ve = 1 ; votada = 2 ; comentado o conectado a = 3 ; editado = 4.<br>Hay controles de zoom y orientación disponibles a continuación y también se puede utilizar la rueda del ratón para acercar y alejar.';
$LNG->STATS_VIS_HELP_COMMUNITIES_NETWORK = 'Esta visualización muestra una red de la '.$LNG->DEBATE_NAME.' conexiones posteriores. La forma y el color de los nodos que representan los mensajes son determinadas por el grupo de sub-comunidad. Sub-comunidades de mensajes son mensajes que tienden a ser analizados en conjunto. <br>Hay controles de zoom y orientación disponibles a continuación y también se puede utilizar la rueda del ratón para acercar y alejar.';
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK = "Esta visualización muestra un gráfico de la red de los puestos conectados en el ".$LNG->DEBATE_NAME." como rayos de sol en capas de colores según el tipo de puesto. Haga clic en segmentos de reorientar la gráfica.";
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK_BRANCH = "Esta visualización muestra un gráfico de la red de los puestos conectados en el ".$LNG->DEBATE_NAME." como rayos de sol en capas. Los colores muestran las diferentes ramas de la ".$LNG->DEBATE_NAME.". Haga clic en segmentos de reorientar la gráfica.";
$LNG->STATS_VIS_HELP_TREEMAP = "Esta visualización muestra un mapa de árbol de la ".$LNG->DEBATE_NAME.". Los bloques de colores representan las hojas del árbol . Los colores de las hojas cambian para representar grupos de hojas de hermanos. Amplía.";
$LNG->STATS_VIS_HELP_TREEMAP_BY_TYPE = "Esta visualización muestra un mapa de árbol de la ".$LNG->DEBATE_NAME.". Los bloques de colores representan las hojas del árbol. Los colores de las hojas cambian para representar tipos de correos. Amplía.";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN = "Esta visualización muestra un mapa de árbol de la ".$LNG->DEBATE_NAME.". Los dos primeros niveles del árbol están expuestos al principio y luego se profundiza haciendo clic en las casillas marcadas.";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN_BY_TYPE = "Esta visualización muestra un mapa de árbol de la ".$LNG->DEBATE_NAME.". Los dos primeros niveles del árbol están expuestos al principio y luego se profundiza haciendo clic en las casillas marcadas. Los colores de la caja muestran el tipo de mensaje.";
$LNG->STATS_VIS_HELP_TREE = "Esta visualización muestra un árbol de la ".$LNG->DEBATE_NAME.". Los tamaños de círculo y de enlace están determinadas por el número de niños menores de un nodo dado. Haga clic en los círculos de ampliar los niveles / contrato. Pase el cursor sobre los círculos para obtener más información.";
$LNG->STATS_VIS_HELP_TREE_BY_POSTS = "Esta visualización muestra un árbol de la ".$LNG->DEBATE_NAME.". Los tamaños de círculo y de enlace están determinadas por el número de puestos por debajo de un determinado nodo. Mensajes que no se muestran en el árbol. Haga clic en los círculos de ampliar los niveles/contrato. Pase el cursor sobre los círculos para obtener más información.";

/** Mini vis word counts **/
$LNG->MINI_WORD_STATS_XAXIS_LABEL = 'Palabra total cuenta por usuario';
$LNG->MINI_WORD_STATS_WORDS_MIN = 'Contribución única mínima:';
$LNG->MINI_WORD_STATS_WORDS_MAX = 'Contribución individual máxima:';
$LNG->MINI_WORD_STATS_AVERAGE = 'Contribución promedio por usuario:';

/** Mini vis user contributions **/
$LNG->MINI_USER_CONTRIBUTIONS_XAXIS_LABEL = 'Contribución cuenta por Tipo';

/** Mini vis user viewing activity **/
$LNG->MINI_USER_VIEWING_HIGHEST = 'La mayoría de los puntos de vista: ';
$LNG->MINI_USER_VIEWING_LOWEST = 'Menos vistas: ';
$LNG->MINI_USER_VIEWING_LAST = 'Vistas últimamente: ';
$LNG->MINI_USER_VIEWING_VIEWS = 'Vistas';
$LNG->MINI_USER_VIEWING_ON = 'en el';
$LNG->MINI_USER_VIEWING_XAXIS_LABEL = 'Ver cuenta por fecha';

/** Attention Map **/
$LNG->ATTENTION_MAP_KEY_NAME = 'Desigualdad Clasificación';
$LNG->ATTENTION_MAP_INTEREST = 'Interés Clasificación';
$LNG->ATTENTION_MAP_INEQULAITY = 'Desigualdad Clasificación';

/** Overview visulaisation **/
$LNG->STATS_OVERVIEW_MAIN_TITLE='Información general';
$LNG->STATS_OVERVIEW_WORDS_MESSAGE = 'Estadísticas Número de palabras:';
$LNG->STATS_OVERVIEW_CONTRIBUTION_MESSAGE = 'contribuciones del Usuario';
$LNG->STATS_OVERVIEW_VIEWING_MESSAGE = "La actividad de visualización del usuario";
$LNG->STATS_OVERVIEW_HEALTH_TITLE = $LNG->DEBATE_NAME.' Indicadores de salud';
$LNG->STATS_OVERVIEW_HEALTH_PROBLEM = 'Hay un problema.';
$LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM = 'No parece haber ningún problema.';
$LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM = 'Puede haber un problema.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_TITLE = 'Indicador Contribución Actividad';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_TITLE = 'Viendo el Indicador de actividad';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_TITLE = 'Indicador de Participación';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTORS = 'participado en este '.$LNG->DEBATE_NAME.".";
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS = '';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2 = 'visto este '.$LNG->DEBATE_NAME;
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_RED = ' en los últimos últimos 14 días';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_ORANGE = ' hace entre 6 y 14 días';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_GREEN = ' en los últimos 5 días';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION = ' contribuido';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_RED = ' en los últimos últimos 14 días';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_ORANGE = ' hace entre 6 y 14 días';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_GREEN = ' en los últimos 5 días';
$LNG->STATS_OVERVIEW_LOADING_MESSAGE = '(Cargando Resumen Estadísticas . Estos puede tardar un rato para calcular en función del tamaño de los datos del discurso...)';
$LNG->STATS_OVERVIEW_TOP_THREE_VOTES_MESSAGE = 'Los más votados en las entradas:';
$LNG->STATS_OVERVIEW_RECENT_NODES_MESSAGE = 'Recientemente añadido:';
$LNG->STATS_OVERVIEW_RECENT_VOTES_MESSAGE = 'Más recientemente votada:';
$LNG->STATS_OVERVIEW_DATE = 'Fecha:';
$LNG->STATS_OVERVIEW_VOTES = 'Votos:';
$LNG->STATS_OVERVIEW_TIME = 'hora';
$LNG->STATS_OVERVIEW_TIMES = 'veces';
$LNG->STATS_OVERVIEW_PERSON = 'la persona';
$LNG->STATS_OVERVIEW_PEOPLE = 'gente';
$LNG->STATS_OVERVIEW_WORDS_AVERAGE = 'Contribución media:';
$LNG->STATS_OVERVIEW_WORDS = 'palabras';
$LNG->STATS_OVERVIEW_WORDS_MIN = 'mínimo:';
$LNG->STATS_OVERVIEW_WORDS_MAX = 'máximo:';
$LNG->STATS_OVERVIEW_VIEWING_HIGHEST = 'Más alto de visión era';
$LNG->STATS_OVERVIEW_VIEWING_LOWEST = 'Bajo recuento de visión era';
$LNG->STATS_OVERVIEW_VIEWING_LAST = 'Última recuento de visión era';
$LNG->STATS_OVERVIEW_VIEWING_VIEWS = 'vistas';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_HINT = 'Si hay menos de 3 personas han participado en esta '.$LNG->DEBATE_NAME.' entonces esto va a mostrar un semáforo en rojo . Si entre 3 y 5 personas han participado en esta '.$LNG->DEBATE_NAME.' entonces esto va a mostrar un semáforo naranja. Si hay más de 5 personas han participado en esta '.$LNG->DEBATE_NAME.' entonces esto va a mostrar un semáforo en verde.';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_HINT = 'Si no hay personas han viewied este '.$LNG->DEBATE_NAME.' durante más de 14 días, esto mostrará una luz roja del semáforo. Si las personas han visto este '.$LNG->DEBATE_NAME.' hace entre 6 y 14 días que se muestre en un semáforo naranja. Si las personas han visto este '.$LNG->DEBATE_NAME.' en los últimos 5 días que se muestre en un semáforo en verde.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_HINT = 'Si la gente no ha añadido una nueva entrada a esta '.$LNG->DEBATE_NAME.' durante más de 14 días, esto mostrará una luz roja del semáforo. Si la gente ha añadido una nueva entrada a esta '.$LNG->DEBATE_NAME.' hace entre 6 y 14 días que se muestre en un semáforo naranja. Si la gente ha añadido una nueva entrada a esta '.$LNG->DEBATE_NAME.' en los últimos 5 días que se muestre en un semáforo en verde.';

/** Activity graphs **/
$LNG->STATS_ACTIVITY_COLUMN_DATE = 'Fecha';
$LNG->STATS_ACTIVITY_COLUMN_TITLE = 'Título';
$LNG->STATS_ACTIVITY_COLUMN_ITEM_TYPE = 'Tipo de Contribución';
$LNG->STATS_ACTIVITY_COLUMN_TYPE = 'Tipo de Actividad';
$LNG->STATS_ACTIVITY_COLUMN_ACTION = 'Acción del Usuario';
$LNG->STATS_ACTIVITY_FILTER_DATE_TITLE = 'Fecha';
$LNG->STATS_ACTIVITY_FILTER_DAYS_TITLE = 'Días de la semana';
$LNG->STATS_ACTIVITY_FILTER_ITEM_TYPES_TITLE = 'Tipos de Contribución';
$LNG->STATS_ACTIVITY_FILTER_TYPES_TITLE = 'Tipos de Actividad';
$LNG->STATS_ACTIVITY_FILTER_USERS_TITLE = 'Usuarios';
$LNG->STATS_ACTIVITY_FILTER_ACTION_TITLE = 'Acciones del Usuario';
$LNG->STATS_ACTIVITY_USER_ANONYMOUS = "u";

$LNG->STATS_ACTIVITY_CREATE = 'Crear';
$LNG->STATS_ACTIVITY_UPDATE = 'Actualizar';
$LNG->STATS_ACTIVITY_DELETE = 'Borrar';
$LNG->STATS_ACTIVITY_VIEW = 'Ver';
$LNG->STATS_ACTIVITY_VOTE = 'Votar';
$LNG->STATS_ACTIVITY_VOTED_FOR = 'Votado Por';
$LNG->STATS_ACTIVITY_VOTED_AGAINST = 'Votó en Contra';

$LNG->STATS_ACTIVITY_SUNDAY = 'Domingo';
$LNG->STATS_ACTIVITY_MONDAY = 'Lunes';
$LNG->STATS_ACTIVITY_TUESDAY = 'Martes';
$LNG->STATS_ACTIVITY_WEDNESDAY = 'Miércoles';
$LNG->STATS_ACTIVITY_THURSDAY = 'Jueves';
$LNG->STATS_ACTIVITY_FRIDAY = 'Viernes';
$LNG->STATS_ACTIVITY_SATURDAY = 'Sábado';

$LNG->STATS_ACTIVITY_JAN = 'Enero';
$LNG->STATS_ACTIVITY_FEB = 'Febrero';
$LNG->STATS_ACTIVITY_MAR = 'Marcha';
$LNG->STATS_ACTIVITY_APR = 'Abril';
$LNG->STATS_ACTIVITY_MAY = 'Mayo';
$LNG->STATS_ACTIVITY_JUN = 'Junio';
$LNG->STATS_ACTIVITY_JUL = 'Julio';
$LNG->STATS_ACTIVITY_AUG = 'Agosto';
$LNG->STATS_ACTIVITY_SEP = 'Septiembre';
$LNG->STATS_ACTIVITY_OCT = 'Octubre';
$LNG->STATS_ACTIVITY_NOV = 'Noviembre';
$LNG->STATS_ACTIVITY_DEC = 'Diciembre';

$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART1 = 'seleccionado de';
$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART2 = 'archivos';
$LNG->STATS_ACTIVITY_RESET_ALL_BUTTON = 'Reiniciar todo';

$LNG->STATS_ACTIVITY_ADDED = 'Adicional';

/** Scatterplots **/
$LNG->STATS_SCATTERPLOT_DETAILS_COUNT = "Entradas:";
$LNG->STATS_SCATTERPLOT_DETAILS = "Detalles de la zona";
$LNG->STATS_SCATTERPLOT_DETAILS_CLICK = "Pase el ratón sobre el punto contribución para ver los detalles.";

/** Contribution River **/
$LNG->STATS_GROUP_STACKEDAREA_TITLE = 'Llave';
$LNG->STATS_GROUP_STACKEDAREA_HELP = 'Pase el ratón sobre un área de color en un momento dado para mostrar un recuento de la contribución para ese tipo de elemento para esa fecha.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Haga clic izquierdo en un área coloreada para filtrar diagrama en ese tipo de elemento.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Haga clic para eliminar el filtro (o haga clic en el botón de abajo).<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_RESTORE_BUTTON = 'Quitar filtro';

/** People and Issue Ring **/
$LNG->STATS_GROUP_SUNBURST_PERSON = 'Miembro';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_DEBATE = 'fue contribuida por:';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_USER = 'y está conectado a:';
$LNG->STATS_GROUP_SUNBURST_WITH = 'con:';
$LNG->STATS_GROUP_SUNBURST_CREATED = 'creado:';
$LNG->STATS_GROUP_SUNBURST_DETAILS = "Detalles de la zona";
$LNG->STATS_GROUP_SUNBURST_DETAILS_CLICK = "Haga clic en la sección para ver más detalles";

/** Network graphs **/
$LNG->GRAPH_PRINT_HINT = "Imprimir este gráfico de la red";
$LNG->GRAPH_ZOOM_FIT_HINT = "Escala gráfica abajo si es necesario y se mueven para hacer que todo cabe en el área visible";
$LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT = "Zoom este gráfico de la red al 100%";
$LNG->GRAPH_ZOOM_IN_HINT = "Dar un golpe de zoom";
$LNG->GRAPH_ZOOM_OUT_HINT = "Disminuir el zoom";
$LNG->GRAPH_CONNECTION_COUNT_LABEL = 'Conexiones:';
$LNG->GRAPH_NOT_SUPPORTED = 'Tu navegador actual no soporta HTML5 Canvas.<br><br>Por favor, actualice a una nueva versión si desea ver esta visualización: IE 9.0+; Firefox 23.0+; Chrome 29.0+; Opera 17.0+; Safari 5.1+';

$LNG->NETWORKMAPS_RESIZE_MAP_HINT = 'Cambiar el tamaño del mapa';
$LNG->NETWORKMAPS_ENLARGE_MAP_LINK = 'Ampliar Mapa';
$LNG->NETWORKMAPS_REDUCE_MAP_LINK = 'Reducir el mapa';
$LNG->NETWORKMAPS_EXPLORE_ITEM_LINK = 'Explora elemento seleccionado';
$LNG->NETWORKMAPS_EXPLORE_ITEM_HINT = 'Abra la página completa los detalles del elemento seleccionado actualmente';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_LINK = 'Explora Autor del elemento seleccionado';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT = 'Abra la página Autor hogar para el elemento seleccionado';
$LNG->NETWORKMAPS_SELECTED_NODEID_ERROR = 'Por favor, asegúrese de que ha hecho una selección en el mapa.';
$LNG->NETWORKMAPS_LOADING_MESSAGE = 'Recuperacion de datos...';
$LNG->NETWORKMAPS_NO_RESULTS_MESSAGE = 'No se han encontrado resultados.';
$LNG->NETWORKMAPS_KEY_SELECTED_ITEM = 'Elemento seleccionado';
$LNG->NETWORKMAPS_KEY_FOCAL_ITEM = 'Punto focal';
$LNG->NETWORKMAPS_KEY_NEIGHBOUR_ITEM = 'Elemento vecino';
$LNG->NETWORKMAPS_KEY_SOCIAL_MODERATELY = 'Conectada moderadamente';
$LNG->NETWORKMAPS_KEY_SOCIAL_HIGHLY = 'Muy conectado';
$LNG->NETWORKMAPS_KEY_SOCIAL_SLIGHTLY = 'Ligeramente conectado';
$LNG->NETWORKMAPS_KEY_SOCIAL_MOST = 'El más conectados';
$LNG->NETWORKMAPS_PERCENTAGE_MESSAGE = '% de diseño computarizada...';
$LNG->NETWORKMAPS_SCALING_MESSAGE = 'Escalar para encajar la página...';

$LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT = 'Mostrar todas las conexiones para el enlace seleccionado';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_LINK = 'Explora Enlace seleccionada';
$LNG->NETWORKMAPS_SOCIAL_LOADING_MESSAGE = '(Cargando Red Social View. Esto puede tardar algunos minutos para calcular en función del tamaño del Hub...)';
$LNG->NETWORKMAPS_SOCIAL_CONNECTIONS = 'Conexiones';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION = 'Conexión';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_MESSAGE = 'Haga clic en los enlaces de conexión de abajo para ver los detalles';

/** INTEREST HEAT NETWORK **/
$LNG->INTEREST_NETWORK_COUNT = 'puntuación de interés';
$LNG->INTEREST_NETWORK_CONNECTIONS = 'conexiones';
$LNG->INTEREST_NETWORK_CALCULATION_KEY = 'Llave';

/** COLLAPSIBLE TREE **/
$LNG->TREE_COLLAPSE_ALL = 'Desplegar todo';
$LNG->TREE_EXPAND_ALL = 'Expandir todo';
$LNG->TREE_HOMEPAGE_TEXT = 'Ir a la página de inicio';
$LNG->TREE_HOMEPAGE_HINT = 'Haga clic para ir a ver la página de este artículo';
$LNG->TREE_COMMENT_COUNT = $LNG->COMMENT_NAME.' Contar:';
$LNG->TREE_CHILD_COUNT = 'Niño contarán:';

/** LOADING MESSAGES **/
$LNG->LOADING_DATA = '(Cargando datos...)';
$LNG->LOADING_MESSAGE = 'Cargando...';

// ODD BITS
$LNG->NODE_EXPLORE_BUTTON_TEXT = 'Explorar >>';
$LNG->NODE_EXPLORE_BUTTON_HINT = 'Haz click para ver más información';
$LNG->USER_EXPLORE_BUTTON_HINT = 'Haz click para ver más información sobre esta persona';
$LNG->NODE_TYPE_ICON_HINT = 'Ver imagen original';
$LNG->SOCIAL_MULTI_CONNECTIONS_ERROR = 'Datos Insuficientes suministrados para obtener Conexiones';

// ALERT MESSAGES
$LNG->ALERTS_BOX_TITLE = 'Alertas';
$LNG->ALERT_SHOW_ALL = 'Mostrar todo...';
$LNG->ALERT_SHOW_LESS = 'Muestra menos...';

//RETURNS POSTS / PEOPLE BASED
$LNG->ALERT_UNSEEN_BY_ME = "Invisible por mí";
$LNG->ALERT_HINT_UNSEEN_BY_ME = "No he visto este post todavía.";

$LNG->ALERT_RESPONSE_TO_ME = "Respuesta a mi mensaje";
$LNG->ALERT_HINT_RESPONSE_TO_ME = "Este mensaje es una respuesta a un post de mi autoría.";

$LNG->ALERT_UNRATED_BY_ME = "No votado por mí";
$LNG->ALERT_HINT_UNRATED_BY_ME = "Todavía no he votado en esta entrada.";

$LNG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME = "Visto por personas similares a mí";
$LNG->ALERT_HINT_INTERESTING_TO_PEOPLE_LIKE_ME = "Este post fue visto por personas con intereses similares a mí (basado en el análisis de los patrones de actividad SVD).";

$LNG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Votado por personas similares a mí";
$LNG->ALERT_HINT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Este post fue votado altamente por la gente cuyas opiniones son similares a la mía (basado en el análisis de los patrones de calificación SVD).";

$LNG->ALERT_INTERESTING_TO_ME = 'Interesante para mí';
$LNG->ALERT_HINT_INTERESTING_TO_ME = 'Ver los mensajes que debe interesar al usuario, teniendo en cuenta sus intereses anteriores. Esta alerta estima el usuario(s) intereses en cada puesto según la cantidad de atención que él/ella se lo dio o que vecinos más cercanos en el pasado. A continuación, identifica los mensajes cuyos puntajes de "interés" se encuentran en la parte superior del 50%.';


//RETURNS PEOPLE / PEOPLE BASED
$LNG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "La gente como yo - por intereses";
$LNG->ALERT_HINT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "Las personas que tienen intereses similares a mí, con base en los patrones de actividad.";

$LNG->ALERT_PEOPLE_WHO_AGREE_WITH_ME = "La gente como yo - por votar";
$LNG->ALERT_HINT_PEOPLE_WHO_AGREE_WITH_ME = "Las personas que tienen opiniones similares a las mías, con base en los patrones de calificación.";

$LNG->ALERT_LURKING_USER = 'Usuario que está al acecho';
$LNG->ALERT_HINT_LURKING_USER = 'El usuario no ha editado o creado ninguna mensajes';

$LNG->ALERT_INACTIVE_USER = 'Usuario Inactivo';
$LNG->ALERT_HINT_INACTIVE_USER = 'Encuentra los usuarios que lo han hecho nada de nada';


//RETURNS POSTS / MAP BASED
$LNG->ALERT_HOT_POST = "Post caliente";
$LNG->ALERT_HINT_HOT_POST = "Este post ha recibido una gran cantidad de interés en general.";

$LNG->ALERT_ORPHANED_IDEA = "Idea Huérfano";
$LNG->ALERT_HINT_ORPHANED_IDEA = "Este post idea está recibiendo mucha menos atención que sus hermanos.";

$LNG->ALERT_EMERGING_WINNER = "Idea dominante";
$LNG->ALERT_HINT_EMERGING_WINNER = "Una idea tiene predominio de apoyo de la comunidad (por un tema determinado).";

$LNG->ALERT_CONTENTIOUS_ISSUE = "Tema polémico";
$LNG->ALERT_HINT_CONTENTIOUS_ISSUE = "Un problema con las ideas que la comunidad está fuertemente dividido sobre : la balcanización , la polarización.";

$LNG->ALERT_INCONSISTENT_SUPPORT = "Idea , de forma incompatible con el apoyo";
$LNG->ALERT_HINT_INCONSISTENT_SUPPORT = "Una idea que mi apoyo a la idea y los argumentos se subyacentes son inconsistentes.";

$LNG->ALERT_MATURE_ISSUE = 'Tema maduro';
$LNG->ALERT_HINT_MATURE_ISSUE = 'Asunto tiene  >= 3 ideas con al menos un argumento cada';

$LNG->ALERT_IGNORED_POST = 'Publicar ignorado';
$LNG->ALERT_HINT_IGNORED_POST = 'El artículo no ha sido visto por nadie más que autor original';

$LNG->ALERT_USER_GONE_INACTIVE = 'Usuarios ido inactivo';
$LNG->ALERT_HINT_USER_GONE_INACTIVE = 'Los usuarios que se encontraban inicialmente activa, pero se detuvo';

$LNG->ALERT_CONTROVERSIAL_IDEA = 'Idea polémica';
$LNG->ALERT_HINT_CONTROVERSIAL_IDEA = 'La comunidad tiene opiniones muy divergentes (como se refleja en su voto) de si una idea es buena o no.';

$LNG->ALERT_IMMATURE_ISSUE = "Tema Inmaduro";
$LNG->ALERT_HINT_IMMATURE_ISSUE = 'Asunto tiene &lt; 3 ideas sin argumentos';

$LNG->ALERT_WELL_EVALUATED_IDEA = "Idea bien evaluados";
$LNG->ALERT_HINT_WELL_EVALUATED_IDEA = "Idea tiene varias ventajas y desventajas , incluyendo algunas refutaciones";

$LNG->ALERT_POORLY_EVALUATED_IDEA = "Idea mal evaluados";
$LNG->ALERT_HINT_POORLY_EVALUATED_IDEA = "Idea tiene algunos pros y contras, y no hay refutaciones";
?>