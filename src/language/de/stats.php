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
$LNG->STATS_DEBATE_CONTRIBUTION_HELP = 'Diese Ampel zeigt an, wie ausgeglichen die Art der Beiträge der Debatte sind. Wenn einer der Typen ('.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.', '.$LNG->CON_NAME.', oder Stimmen) wenig vorhanden ist ( unter 10%) wird eine rote Ampel gezeigt. Wenn eine der Typen ist unterrepräsentiert (unter 20%), dann wird eine gelbe Ample gezeigt. Ansonsten sind die Typen ausgeglichen und es wird eine grüne Ampel gezeigt.';
$LNG->STATS_DEBATE_VIEWING_HELP = 'Dieser Indikator representiert den Prozentsatz der Mitglieder dieser Gruppe, die dieses Thema gesehen haben. Wenn 50% oder mehr Mitglieder dieser Gruppe die Beiträge gesehen haben, dann wird  eine grüne Ampel gezeigt. Wenn 20% bis 49% die Beiträge gesehen haben, dann wird eine gelbe Ampel gezeigt. Wenn weniger als 20% die Beiträge gesehen haben, dann wird eine rote Ampel gezeigt.';
$LNG->STATS_DASHBOARD_HELP_HINT = "Anzeigen / Verbergen der Beschreibung der Visualisierung.";
$LNG->STATS_HELP_HINT = "Anzeigen / Verbergen der Beschreibung der Visualisierung.";
$LNG->STATS_VIS_ERROR_BIASSPACE = 'Es tut uns leid, Ihre Daten konnten verarbeitet werden, da die zugrundeliegende Metrik mehr Daten benötigt.';
$LNG->STATS_VIS_ERROR_TOPICSPACE = 'Es tut uns leid, Ihre Daten konnten verarbeitet werden, da die zugrundeliegende Metrik mehr Daten benötigt.';

/** Vis Names/Dashboard Tabs **/
$LNG->STATS_TAB_HOME = "Startseite";
$LNG->STATS_VIS_TITLE_NETWORK = 'Diskussions-Netzwerk';
$LNG->STATS_VIS_TITLE_SOCIAL = 'Soziales Netzwerk';
$LNG->STATS_VIS_TITLE_SUNBURST = 'Menschen- & Karten-Ring';
$LNG->STATS_VIS_TITLE_STACKEDAREA = 'Beitragsverlauf';
$LNG->STATS_VIS_TITLE_TOPICSPACE = 'Themenspektrum';
$LNG->STATS_VIS_TITLE_BIASSPACE = "Rating Bias";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING = $LNG->DEBATE_NAME.' Schachtelung';
$LNG->STATS_VIS_TITLE_ACTIVITY= 'Aktivität Analysis';
$LNG->STATS_VIS_TITLE_USER_ACTIVITY = "Benutzer Aktivität Analysis";
$LNG->STATS_VIS_TITLE_STREAM_GRAPH= "Beitrags -Stream";
$LNG->STATS_VIS_TITLE_OVERVIEW= "Kurzübersicht";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING_ATTENTION = "Aufmerksamkeit Karte";
$LNG->STATS_VIS_TITLE_EDGESENSE_HISTORY = "Edgesense Soziales Netzwerk";
$LNG->STATS_VIS_TITLE_INTEREST_NETWORK = "Community Interest Netzwerk";
$LNG->STATS_VIS_TITLE_COMMUNITIES_NETWORK = "Sub-Communities Netzwerk";
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK = $LNG->DEBATE_NAME.' Suburst Netzwerk';
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK_BRANCH = $LNG->DEBATE_NAME.' Sunburst Netzwerk';
$LNG->STATS_VIS_TITLE_TREEMAP = $LNG->DEBATE_NAME.' Baumkarte';
$LNG->STATS_VIS_TITLE_TREEMAP_BY_TYPE = $LNG->DEBATE_NAME.' Baumkarte Nach Typ';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN = $LNG->DEBATE_NAME.' Baumkarte - von oben nach unten';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN_BY_TYPE = $LNG->DEBATE_NAME.' Baumkarte - von oben nach unten';


/** Vis help texts **/
$LNG->STATS_HELP_HINT = "Anzeigen / Verbergen der Beschreibung der Visualisierung.";
$LNG->STATS_VIS_HELP_NETWORK = 'Diese Darstellung zeigt ein Netzwerk zum Thema '.$LNG->DEBATE_NAME.'. Sie können zoomen und die Ausrichtung steuern und Sie können mit dem Mausrad die Darstellung vergrößern oder verkleinern.';
$LNG->STATS_VIS_HELP_SOCIAL = 'Diese Darstellung zeigt ein Netzwerk der teilnehmenden Benutzer zum Thema '.$LNG->DEBATE_NAME.'. Sie können zoomen und die Ausrichtung steuern und Sie können mit dem Mausrad die Darstellung vergrößern oder verkleinern. Die Verbindungen zwischen den Benutzern kann entweder grün (meistens unterstützende Verbindungen) rot (meist Gegenargumentverbindungen) grau (keine dominante Verbindungstyp) sein.';
$LNG->STATS_VIS_HELP_SUNBURST = 'Diese Visualisierung zeigt Benutzer und deren Verbindungen zu '.$LNG->ISSUES_NAME.'. Die Verbindungen zwischen Nutzern und '.$LNG->ISSUES_NAME.' kann entweder grün (meistens '.$LNG->PROS_NAME.'), rot (meistens '.$LNG->CONS_NAME.'), und grau (keine dominante Beitrag Typ). Klicken Sie auf ein Segment der Visualisierung finden Sie weitere Informationen zu dem Mitglied oder '.$LNG->ISSUE_NAME.' sehen Sie das Detailbereichpanel.';
$LNG->STATS_VIS_HELP_STACKEDAREA = 'Diese Visualisierung zeigt Arten von Beiträgen über die Zeit. Ein Rollover über der Visualisierung zeigt individuelle Statistiken für jeden Typ und für jedes Datum. Klicken Sie auf die Visualisierung von Typ filtern. Ein rechter Mausklick auf die Visualisierung wenn Sie "Filter entfernen" drücken entfernt den Filter.';

$LNG->STATS_VIS_HELP_TOPICSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">Die folgende Darstellung zeigt Beiträge zum Thema '.$LNG->DEBATE_NAME.' angeordnet auf einem xy - System. Verwenden Sie diese Visualisierung um Cluster / Gruppierungen von Beiträgen zu finden. Ein Cluster von Beiträgen stellt ähnliche Beiträge auf der Basis der Aktivität der Benutzer (Anzeigen, Editieren Aktualisierung von Beiträgen, etc.) dar.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Das Beispiel oben rechts zeigt zwei Cluster (zwei verschiedene Gruppen von Beiträgen mit jeweils einem deutlichen Muster). Das Beispiel unten rechts zeigt nur ein Cluster. Oft gibt es keine unterschiedliche Cluster.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Verwenden Sie diese Visualisierungen um Cluster zu finden. Wenn die Visualisierung mehr als ein Cluster zeigt, dann ist dies ein Indikator dass '.$LNG->DEBATE_NAME.' eine Verzerrung hat in Bezug wie Menschen mit den Themen interagiert haben. Wenn es nur ein Cluster oder keine Cluster zu finden ist, so ist dies ein Indiz dafür, dass die '.$LNG->DEBATE_NAME.' unvoreingenommenen ist.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Bewegen Sie den Mauszeiger über einen Beitrag, um weitere Informationen in dem "Detailbereich" zu sehen.</div></div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Zwei Clustern<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">Ein Cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';

$LNG->STATS_VIS_HELP_BIASSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">Die folgende Darstellung zeigt, Beiträge zu einem '.$LNG->DEBATE_NAME.' auf einem xy -Plot angeordnet. Verwenden Sie diese Visualisierung , Cluster / Gruppierungen von Beiträge zu finden. Ein Cluster von Beiträgen stellt ähnliche Beiträge auf der Grundlage des Abstimmungs von Nutzern.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Das Beispiel oben rechts zeigt zwei Cluster ( zwei verschiedene Gruppen von Beiträgen mit jeweils einen deutlichen Aktivitätsmusters ). Das Beispiel unten rechts zeigt nur einen Cluster. Oft gibt es keine unterschiedliche Cluster.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Verwenden Sie diese Visualisierungen, um Cluster zu finden. Wenn die Visualisierung mehr als ein Cluster zeigt, dann ist dies ein Indikator dafür, dass '.$LNG->DEBATE_NAME.' verzerrt ist im Bezug auf das Wahlverhalten der Menschen. Wenn es nur ein Cluster oder kein Cluster gibt, so ist dies ein Indiz dafür, dass die '.$LNG->DEBATE_NAME.' unvoreingenommenen ist.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Bewegen Sie den Mauszeiger über einen Beitrag, um weitere Informationen im "Detailbereich" zu sehen.</div></div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Zwei clustern<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">Ein Cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';

$LNG->STATS_VIS_HELP_CIRCLEPACKING = 'Die folgende Darstellung gibt einen Überblick über die gesamte '.$LNG->DEBATE_NAME.' als verschachtelte Kreise der Beiträge. Klicken Sie auf einen Kreis um ihn zu vergrößern. Klicken Sie außerhalb eines Kreises um diesen zu verkleinern. Klicken Sie auf einen Kreis, um den Titel als Tooltip zu sehen.';
$LNG->STATS_VIS_HELP_ACTIVITY = 'Die folgende Darstellung zeigt die Aktivität eines '.$LNG->DEBATE_NAME.' über einen Zeitraum. Klicken Sie auf die Zeitleiste, um eine Zeitspanne zu abzudecken (klicken und ziehen). Die Visualisierungen unter dieser Visualisierung wird sich ändern und wird die Häufigkeit der Bewegung pro Tag zeigen, die Art des Beitrages ('.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.' und '.$LNG->CON_NAME.'), die Art der Aktivität ( Anzeigen, Hinzufügen oder Bearbeiten ) , und in der folgenden Tabelle können Sie die zugrunde liegenden Daten der Visualisierung sehen. Dort können Sie auch die Visualisierung in den ursprünglichen Zustand zurückzusetzen. Sie können auf die Balken der Visualisierungen klicken, um nach einem bestimmten Typen zu filtern. Sie können auch mehrere Typen auswählen, indem Sie auf mehrere Balken klicken. Klicken Sie beispielsweise auf '.$LNG->ISSUE_NAME.' und '.$LNG->SOLUTION_NAME.' Balken und auf den Anzeigebalken  um einen Filter für '.$LNG->ISSUES_NAME.' und '.$LNG->SOLUTIONS_NAME.' zu setzen.';
$LNG->STATS_VIS_HELP_USER_ACTIVITY = 'Die Visualisierung zeigt Beitragserstellung und Abstimmungen der Benutzer in '.$LNG->DEBATE_NAME.' dar. Klicken Sie auf das "Benutzer" Diagramm, um nach Benutzer zu filtern. Klicken Sie auf "Benutzeraktionen" Diagramm, um die Seite nach Aktionen zu filtern. In beiden Fällen können Sie mehr als eine wählen. Sie können die Seite mit einem Klick auf "Alle zurücksetzen" zurücksetzten.';
$LNG->STATS_VIS_HELP_STREAM_GRAPH = 'Diese Visualisierung zeigt Arten von Beiträgen über einen Zeitraum. Ein Rollover über der Visualisierung zeigt individuelle Statistiken für jeden Typ und für jedes Datum. Wählen Sie zwischen einer gestapelten Ansicht, flussartigen Ansicht und erweiterter Ansicht um Beiträge im Laufe der Zeit zu untersuchen.';
$LNG->STATS_VIS_HELP_OVERVIEW = 'Diese Visualisierungen gibt einen Überblick über wichtige Aspekte zu '.$LNG->DEBATE_NAME.'. Es enthält drei '.$LNG->DEBATE_NAME.' Gesundheitsindikatoren (Fahren Sie mit dem Mauszeiger über das Fragezeichen neben jeder Ampel um weitere Informationen zu erhalten) und mehrere Übersichtsvisualisierungen.';
$LNG->STATS_VIS_HELP_CIRCLEPACKING_ATTENTION = 'Die folgende Darstellung gibt einen Überblick über '.$LNG->DEBATE_NAME.' als verschachtelte Kreise der Beiträge. Die Farben der Kugeln repräsentieren Ungleichheit. Ungleichheit hier bedeutet dass das Interesse der Gruppe ungleich verteilt war wobei 0 = völlig gleich, 1 = völlig ungleich bedeutet. Die Kugelgröße auf der tiefsten Ebene misst den Grad von gemeinschaftlichem Interesse für die Beiträge. Jede Kugel zeigt im Rollover mehr Information. Klicken Sie auf einen Kreis um es zu vergrößern, klicken Sie außerhalb eines Kreises um zu verkleinern. Klicken Sie auf einen Kreis, um ein Tooltip zu sehen.';
$LNG->STATS_VIS_HELP_EDGESENSE_HISTORY = 'Diese Visualisierung zeigt ein soziales Netzwerk.';
$LNG->STATS_VIS_HELP_INTEREST_NETWORK = 'Diese Visualisierung zeigt ein Netzwerk zu '.$LNG->DEBATE_NAME.'. Die Größe und Farbe der Knoten repräsentieren Beiträge und gemeinschaftliches Interesse. <br>Das Interesse wird wie folgt berechnet: angesehen = 1; abgestimmt = 2; kommentierte = 3; bearbeitet = 4.<br>Sie können zoomen und die Ausrichtung steuerern und Sie können mit dem Mausrad die Ansicht vergrößern oder verkleinern.';
$LNG->STATS_VIS_HELP_COMMUNITIES_NETWORK = 'Diese Visualisierung zeigt ein Netzwerk zu '.$LNG->DEBATE_NAME.'. Die Form und die Farbe der Knoten ist mit einem Gruppen Clustering Verfahren bestimmt worden. <br>Sie können zoomen und die Ausrichtung steuerern und Sie können mit dem Mausrad die Ansicht vergrößern oder verkleinern.';
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK = "Diese Visualisierung zeigt Beiträge zu ".$LNG->DEBATE_NAME." als Sunburstvisualisierung dar.  Klicken Sie auf die Segmente.";
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK_BRANCH = "Diese Visualisierung zeigt Beiträge zu".$LNG->DEBATE_NAME." als Sunburstvisualisierung. Die Farben zeigen die verschiedenen Zweige zu ".$LNG->DEBATE_NAME.". Klicken Sie auf einzelne Segmente.";
$LNG->STATS_VIS_HELP_TREEMAP = "Diese Visualisierung zeigt eine Baumkarte zu ".$LNG->DEBATE_NAME.". Die farbigen Blöcke stellen die Blätter des Baumes dar. Klicken Sie zum Vergrößern.";
$LNG->STATS_VIS_HELP_TREEMAP_BY_TYPE = "Diese Visualisierung zeigt eine Baumkarte zu ".$LNG->DEBATE_NAME.". Die Farben der Blöcke sind unterschiedlich je nach Beitragstyp. Klicken Sie zum Vergrößern.";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN = "Diese Visualisierung zeigt eine Baumkarte zu ".$LNG->DEBATE_NAME.".";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN_BY_TYPE = "Diese Visualisierung zeigt eine Baumkarte zu ".$LNG->DEBATE_NAME.". Die ersten beiden Ebenen des Baums werden zuerst gezeigt und Sie können dann durch Anklicken weitere Zweige erforschen. Die Farbe hängt vom Typ des Beitrages ab.";

/** Mini vis word counts **/
$LNG->MINI_WORD_STATS_XAXIS_LABEL = 'Insgesamt Wortzahl pro Benutzer';
$LNG->MINI_WORD_STATS_WORDS_MIN = 'Mindesteinzelbeitrag:';
$LNG->MINI_WORD_STATS_WORDS_MAX = 'Maximale Einzelbeitrag:';
$LNG->MINI_WORD_STATS_AVERAGE = 'Durchschnittliche Beitrag pro Benutzer:';

/** Mini vis user contributions **/
$LNG->MINI_USER_CONTRIBUTIONS_XAXIS_LABEL = 'Beitrag nach Typ';

/** Mini vis user viewing activity **/
$LNG->MINI_USER_VIEWING_HIGHEST = 'Die meisten Ansichten: ';
$LNG->MINI_USER_VIEWING_LOWEST = 'Die wenigsten Ansichten: ';
$LNG->MINI_USER_VIEWING_LAST = 'Letzter Aufruf: ';
$LNG->MINI_USER_VIEWING_VIEWS = 'Ansichten';
$LNG->MINI_USER_VIEWING_ON = 'am';
$LNG->MINI_USER_VIEWING_XAXIS_LABEL = 'Ansicht nach Datum';

/** Attention Map **/
$LNG->ATTENTION_MAP_KEY_NAME = 'Ungleichheitsbewertung';
$LNG->ATTENTION_MAP_INTEREST = 'Bewertung des Interesses';
$LNG->ATTENTION_MAP_INEQULAITY = 'Ungleichheitsbewertung';

/** Overview visulaisation **/
$LNG->STATS_OVERVIEW_MAIN_TITLE='Übersicht';
$LNG->STATS_OVERVIEW_WORDS_MESSAGE = 'Wortzahl -Statistiken:';
$LNG->STATS_OVERVIEW_CONTRIBUTION_MESSAGE = 'Benutzerbeiträge';
$LNG->STATS_OVERVIEW_VIEWING_MESSAGE = "Benutzerbetrachtungsaktivität";
$LNG->STATS_OVERVIEW_HEALTH_TITLE = $LNG->DEBATE_NAME.' Gesundheitsindikatoren';
$LNG->STATS_OVERVIEW_HEALTH_PROBLEM = 'Es gibt ein Problem.';
$LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM = 'Es scheint kein Problem zu geben.';
$LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM = 'Es könnte ein Problem bestehen.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_TITLE = 'Indikator Beitragsaktivität';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_TITLE = 'Anzeigen von Aktivität';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_TITLE = 'Teilnahmeindikator';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTORS = 'nahmen an diesem '.$LNG->DEBATE_NAME.".";
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS = '';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2 = 'betrachtet diese '.$LNG->DEBATE_NAME;
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_RED = ' in den letzten 14 Tage';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_ORANGE = ' zwischen 6 und 14 Tagen';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_GREEN = ' in den letzten 5 Tagen';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION = ' beigetragen';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_RED = ' in den letzten 14 Tage';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_ORANGE = ' zwischen 6 und 14 Tagen';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_GREEN = ' in den letzten 5 Tagen';
$LNG->STATS_OVERVIEW_LOADING_MESSAGE = '(Lädt Übersichtstatistiken . Diese kann einen Moment dauern ...)';
$LNG->STATS_OVERVIEW_TOP_THREE_VOTES_MESSAGE = 'Die meisten stimmten für Einträge:';
$LNG->STATS_OVERVIEW_RECENT_NODES_MESSAGE = 'Zuletzt hinzugefügt:';
$LNG->STATS_OVERVIEW_RECENT_VOTES_MESSAGE = 'Zuletzt abgestimmt:';
$LNG->STATS_OVERVIEW_DATE = 'Datum:';
$LNG->STATS_OVERVIEW_VOTES = 'Stimmen:';
$LNG->STATS_OVERVIEW_TIME = 'Zeit';
$LNG->STATS_OVERVIEW_TIMES = 'Zeiten';
$LNG->STATS_OVERVIEW_PERSON = 'Person';
$LNG->STATS_OVERVIEW_PEOPLE = 'Personen';
$LNG->STATS_OVERVIEW_WORDS_AVERAGE = 'Durchschnittliche Beiträge:';
$LNG->STATS_OVERVIEW_WORDS = 'Worte';
$LNG->STATS_OVERVIEW_WORDS_MIN = 'Minimum:';
$LNG->STATS_OVERVIEW_WORDS_MAX = 'Maximum:';
$LNG->STATS_OVERVIEW_VIEWING_HIGHEST = 'Höchste Anzahl an Ansichten war';
$LNG->STATS_OVERVIEW_VIEWING_LOWEST = 'Niedrigster Anzahl an Ansichten war';
$LNG->STATS_OVERVIEW_VIEWING_LAST = 'Letzte Ansicht war';
$LNG->STATS_OVERVIEW_VIEWING_VIEWS = 'Ansichten';
$LNG->STATS_OVERVIEW_VIEWING_ON = 'am';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_HINT = 'Wenn weniger als 3 Personen an '.$LNG->DEBATE_NAME.' teilgenommen haben, dann wird eine rote Ampel gezeigt. Wenn zwischen 3 und 5 Personen an '.$LNG->DEBATE_NAME.' teilgenommen haben, dann wird eine gelbe Ampel angezeigt. Wenn mehr als 5 Personen an '.$LNG->DEBATE_NAME.' teilgenommen haben, dann wird eine grüne Ampel angezeigt.';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_HINT = 'Wenn niemand '.$LNG->DEBATE_NAME.' für mehr als 14 Tage betrachtet hat, dann wird eine rote Ampel angezeigt. Wenn  '.$LNG->DEBATE_NAME.' zwischen 6 und 14 Tagen angesehen wurde dann wird eine gelbe Ampel gezeigt. Wenn '.$LNG->DEBATE_NAME.' in den letzten 5 Tagen angesehen wurde, dann wird eine grüne Ampel gezeigt.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_HINT = 'Wenn kein Eintrag zu '.$LNG->DEBATE_NAME.' für mehr als 14 Tage hinzugefügt wurde, dann wird eine rote Ampel gezeit. Wenn ein Beitrag zu '.$LNG->DEBATE_NAME.' zwischen 6 und 14 Tagen hinzugefügt wurde, dann wird eine gelbe Ampel gezeigt. Wenn ein Beitrag zu '.$LNG->DEBATE_NAME.' in den letzten 5 Tagen hinzugefügt wurde, dann wird eine grüne Ampel gezeigt.';

/** Activity graphs **/
$LNG->STATS_ACTIVITY_COLUMN_DATE = 'Datum';
$LNG->STATS_ACTIVITY_COLUMN_TITLE = 'Titel';
$LNG->STATS_ACTIVITY_COLUMN_ITEM_TYPE = 'Beitragstyp';
$LNG->STATS_ACTIVITY_COLUMN_TYPE = 'Leistungsart';
$LNG->STATS_ACTIVITY_COLUMN_ACTION = 'Benutzeraktion';
$LNG->STATS_ACTIVITY_FILTER_DATE_TITLE = 'Datum';
$LNG->STATS_ACTIVITY_FILTER_MONTH_TITLE = 'Monat';
$LNG->STATS_ACTIVITY_FILTER_DAYS_TITLE = 'Wochentage';
$LNG->STATS_ACTIVITY_FILTER_ITEM_TYPES_TITLE = 'Beitragstypen';
$LNG->STATS_ACTIVITY_FILTER_TYPES_TITLE = 'Leistungsarten';
$LNG->STATS_ACTIVITY_FILTER_USERS_TITLE = 'Benutzer';
$LNG->STATS_ACTIVITY_FILTER_ACTION_TITLE = 'Benutzeraktionen';
$LNG->STATS_ACTIVITY_USER_ANONYMOUS = "u";

$LNG->STATS_ACTIVITY_CREATE = 'Erstellen';
$LNG->STATS_ACTIVITY_UPDATE = 'Aktualisieren';
$LNG->STATS_ACTIVITY_DELETE = 'Löschen';
$LNG->STATS_ACTIVITY_VIEW = 'Anzeigen';
$LNG->STATS_ACTIVITY_VOTE = 'Stimme';
$LNG->STATS_ACTIVITY_VOTED_FOR = 'Stimmten für';
$LNG->STATS_ACTIVITY_VOTED_AGAINST = 'Stimmten dagegen';

$LNG->STATS_ACTIVITY_SUNDAY = 'So';
$LNG->STATS_ACTIVITY_MONDAY = 'Mo';
$LNG->STATS_ACTIVITY_TUESDAY = 'Di';
$LNG->STATS_ACTIVITY_WEDNESDAY = 'Mi';
$LNG->STATS_ACTIVITY_THURSDAY = 'Do';
$LNG->STATS_ACTIVITY_FRIDAY = 'Fr';
$LNG->STATS_ACTIVITY_SATURDAY = 'Sa';

$LNG->STATS_ACTIVITY_JAN = 'Januar';
$LNG->STATS_ACTIVITY_FEB = 'Februar';
$LNG->STATS_ACTIVITY_MAR = 'März';
$LNG->STATS_ACTIVITY_APR = 'April';
$LNG->STATS_ACTIVITY_MAY = 'Mai';
$LNG->STATS_ACTIVITY_JUN = 'Juni';
$LNG->STATS_ACTIVITY_JUL = 'Juli';
$LNG->STATS_ACTIVITY_AUG = 'August';
$LNG->STATS_ACTIVITY_SEP = 'September';
$LNG->STATS_ACTIVITY_OCT = 'Oktober';
$LNG->STATS_ACTIVITY_NOV = 'November';
$LNG->STATS_ACTIVITY_DEC = 'Dezember';

$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART1 = ' ausgewählt von';
$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART2 = 'Datensätze';
$LNG->STATS_ACTIVITY_RESET_ALL_BUTTON = 'Alles zurücksetzen';

$LNG->STATS_ACTIVITY_ADDED = 'Hinzugefügt';

/** Scatterplots **/
$LNG->STATS_SCATTERPLOT_DETAILS_COUNT = "Einträge:";
$LNG->STATS_SCATTERPLOT_DETAILS = "Details";
$LNG->STATS_SCATTERPLOT_DETAILS_CLICK = "Mauszeiger über Datenpunkt zeigt Details an.";

/** Contribution River **/
$LNG->STATS_GROUP_STACKEDAREA_TITLE = 'Schlüssel';
$LNG->STATS_GROUP_STACKEDAREA_HELP = 'Zeigen Sie auf eine farbige Fläche zu einem bestimmten Zeitpunkt, um die Anzahl der Beiträge für das entsprechende Datum angezeigt zu bekommen.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Linke Maustaste auf einen Farbbereich filtert das Diagramm.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Rechte Maustaste setzt diesen Filter zurück (Sie können auch auf den untenstehenden Button klicken).<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_RESTORE_BUTTON = 'Filter entfernen';
$LNG->STATS_GROUP_STACKEDAREA_ERROR = 'Derzeit liegen nicht genügend Daten vor, um die Visualisierung anzuzeigen.';

/** People and Issue Ring **/
$LNG->STATS_GROUP_SUNBURST_PERSON = 'Teilnehmer';
$LNG->STATS_GROUP_SUNBURST_DEBATE = $LNG->MAP_NAME;
$LNG->STATS_GROUP_SUNBURST_CONNECTED_DEBATE = 'wurde beitragen von:';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_USER = 'und verbunden mit:';
$LNG->STATS_GROUP_SUNBURST_WITH = 'mit:';
$LNG->STATS_GROUP_SUNBURST_CREATED = 'entwickelt:';
$LNG->STATS_GROUP_SUNBURST_DETAILS = "Detailbereich";
$LNG->STATS_GROUP_SUNBURST_DETAILS_CLICK = "Klicken Sie den Abschnitt an, um mehr Details zu sehen";
$LNG->STATS_GROUP_SUNBURST_DEBATE_CREATED = $LNG->ISSUES_NAME.":";
$LNG->STATS_GROUP_SUNBURST_DEBATE_OWNED = $LNG->ISSUES_NAME." Eigentümer";
$LNG->STATS_GROUP_OVERVIEW_USED_LINKS_LABEL = 'Häufigste gemeinsame '.$LNG->ISSUES_NAME.' Aktivität';
$LNG->STATS_GROUP_OVERVIEW_USED_IDEAS_LABEL = 'Häufigster gemeinsamer Beitragstyp';

/** Network graphs **/
$LNG->GRAPH_PRINT_HINT = "Drucken";
$LNG->GRAPH_ZOOM_FIT_HINT = "Skaliert den Graph";
$LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT = "Zoom auf 100%";
$LNG->GRAPH_ZOOM_IN_HINT = "Hineinzoomen";
$LNG->GRAPH_ZOOM_OUT_HINT = "Rauszoomen";
$LNG->GRAPH_CONNECTION_COUNT_LABEL = 'Anschlüsse:';
$LNG->GRAPH_NOT_SUPPORTED = 'Ihr Browser unterstützt kein HTML5.<br><br>Bitte aktualisieren Sie auf eine neuere Version, wenn Sie diese Visualisierung sehen möchten: IE 9.0+; Firefox 23.0+; Chrome 29.0+; Opera 17.0+; Safari 5.1+';

$LNG->NETWORKMAPS_RESIZE_MAP_HINT = 'Größe der Karte verändern';
$LNG->NETWORKMAPS_ENLARGE_MAP_LINK = 'Die Karte vergrößern';
$LNG->NETWORKMAPS_REDUCE_MAP_LINK = 'Die Karte verkleinern';
$LNG->NETWORKMAPS_EXPLORE_ITEM_LINK = 'Item entdecken';
$LNG->NETWORKMAPS_EXPLORE_ITEM_HINT = 'Die Seite mit allen Details zu diesem Item öffnen';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_LINK = 'Autor näher kennenlernen';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT = 'Zur Website des Item-Autors';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_CONNECTION_HINT = 'Gehen Sie auf die Website des Autors';
$LNG->NETWORKMAPS_SELECTED_NODEID_ERROR = 'Bitte stellen Sie sicher, dass Sie innerhalb der Karte eine Auswahl getroffen haben.';
$LNG->NETWORKMAPS_MAC_PAINT_ISSUE_WARNING = '(Diese Darstellung benötigt Java 7 auf MacOS X 10.7 onwards (Lion) um fehlerfrei zu arbeiten)';
$LNG->NETWORKMAPS_APPLET_NOT_RECOGNISED_ERROR = '(Ihr Browser erkennt das APPLET-Element, aber er erkennt das applet nicht.)';
$LNG->NETWORKMAPS_THEME_SELECTION_MESSAGE = 'Bitte wählen Sie oben etwas aus, um die Karte zu sehen';
$LNG->NETWORKMAPS_LOADING_MESSAGE = '(Karte wird geladen...)';
$LNG->NETWORKMAPS_APPLET_REF_BROKEN_ERROR = 'Referenz zur Karten Applet Map Applet unterbrochen. Bitte starten Sie Ihren Browser neu.';
$LNG->NETWORKMAPS_NO_RESULTS_THEME_MESSAGE = 'Es wurden keine Resultate gefunden. Bitte wählen Sie nochmals aus.';
$LNG->NETWORKMAPS_NO_RESULTS_MESSAGE = 'Es wurden keine Resultate gefunden.';
$LNG->NETWORKMAPS_OPTIONAL_TYPE = 'und optional ein Typ';
$LNG->NETWORKMAPS_KEY_SELECTED_ITEM = 'Ausgewähltes Item';
$LNG->NETWORKMAPS_KEY_FOCAL_ITEM = 'Zentrales Item';
$LNG->NETWORKMAPS_KEY_NEIGHBOUR_ITEM = 'Nachbaritem';
$LNG->NETWORKMAPS_KEY_SOCIAL_MODERATELY = 'moderat verbunden';
$LNG->NETWORKMAPS_KEY_SOCIAL_HIGHLY = 'stark verbunden';
$LNG->NETWORKMAPS_KEY_SOCIAL_SLIGHTLY = 'schwach verbunden';
$LNG->NETWORKMAPS_KEY_SOCIAL_MOST = 'am meisten verbunden';
$LNG->NETWORKMAPS_PERCENTAGE_MESSAGE = '% Des Layouts berechnet...';
$LNG->NETWORKMAPS_SCALING_MESSAGE = 'Skalierung auf Seite anpassen...';

$LNG->NETWORKMAPS_SOCIAL_ITEM_HINT = "Die Website der aktuell ausgewählten Person öffnen";
$LNG->NETWORKMAPS_SOCIAL_ITEM_LINK = 'Mehr über die ausgewählte Person erfahren';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT = 'Alle Verbindungen für den ausgewählten Link anzeigen';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_LINK = 'Mehr über den ausgewählten Link erfahren';
$LNG->NETWORKMAPS_SOCIAL_LOADING_MESSAGE = '(Soziales Netzwerk Ansicht wählen. Das Rechnen kann abhängig von dem Hub einige Minuten dauern ...)';
$LNG->NETWORKMAPS_SOCIAL_NO_RESULTS_MESSAGE = 'Keine Daten, um das Soziale Netzwerk zu berechnen.';
$LNG->NETWORKMAPS_SOCIAL_CONNECTIONS = 'Verbindungen';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION = 'Verbindung';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_MESSAGE = 'Klicken Sie auf Verbindung Links unten, um Details anzuzeigen';

/** INTEREST HEAT NETWORK **/
$LNG->INTEREST_NETWORK_COUNT = 'Interessepunktzahl';
$LNG->INTEREST_NETWORK_CONNECTIONS = 'Anschlüsse';
$LNG->INTEREST_NETWORK_CALCULATION_KEY = 'Schlüssel';


/** LOADING MESSAGES **/
$LNG->LOADING_ITEMS = 'Artikel werden geladen';
$LNG->LOADING_DATA = '(Daten werden geladen...)';
$LNG->LOADING_MESSAGE = 'Geladen...';

// ODD BITS
$LNG->NODE_EXPLORE_BUTTON_TEXT = 'Entdecken >>';
$LNG->NODE_EXPLORE_BUTTON_HINT = 'Klicken Sie hier um weitere Informationen zu sehen';
$LNG->USER_EXPLORE_BUTTON_HINT = 'Klicken Sie hier um weitere Informationen über diese Person zu sehen';
$LNG->NODE_TYPE_ICON_HINT = 'Originalbild anzeigen';
$LNG->ITEM_NOT_FOUND_ERROR = 'Artikel nicht gefunden';
$LNG->SOCIAL_MULTI_CONNECTIONS_ERROR = 'Nicht genügend Daten um die Verbindungen herzustellen';
$LNG->SOCIAL_MULTI_CONNECTIONS_NONE = 'Keine Verbindungen gefunden';

// ALERT MESSAGES
$LNG->ALERTS_BOX_TITLE = 'Benachrichtigungen';
$LNG->ALERT_NO_RESULTS = 'Es gibt keine Ergebnisse';
$LNG->ALERT_CLICK_HIGHLIGHT = 'Klicken Sie in der Karte markieren';
$LNG->ALERT_SHOW_ALL = 'zeige alles...';
$LNG->ALERT_SHOW_LESS = 'weniger anzeigen...';

//RETURNS POSTS / PEOPLE BASED
$LNG->ALERT_UNSEEN_BY_ME = "Nicht von mir gesehen";
$LNG->ALERT_HINT_UNSEEN_BY_ME = "Ich habe diesen Beitrag noch nicht gesehen.";

$LNG->ALERT_RESPONSE_TO_ME = "Antwort zu meinem Beitrag";
$LNG->ALERT_HINT_RESPONSE_TO_ME = "Dieser Beitrag ist eine Antwort auf einen Beitrag den ich verfasst habe.";

$LNG->ALERT_UNRATED_BY_ME = "Von mir nicht abgestimmt";
$LNG->ALERT_HINT_UNRATED_BY_ME = "Ich habe noch nicht zu diesem Beitrag abgestimmt.";

$LNG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME = "Von ähnlichen Leute wie ich angesehen";
$LNG->ALERT_HINT_INTERESTING_TO_PEOPLE_LIKE_ME = "Dieser Beitrag wurde von Menschen mit ähnlichen Interessen angesehen (basierend auf SVD Analyse der Aktivitätsmuster).";

$LNG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Bei ähnlichen Leuten abgestimmt";
$LNG->ALERT_HINT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Dieser Beitrag wurde bei Menschen deren Meinungen ähnlich zu mir sind abgestimmt (basierend auf SVD -Analyse von Mustern).";

$LNG->ALERT_INTERESTING_TO_ME = 'Interessant für mich';
$LNG->ALERT_HINT_INTERESTING_TO_ME = 'Finde die Beiträge , die einen Benutzer interessieren sollten, basierend auf früheren Interessen . Diese Warnung schätzt Interessen des Benutzers in jedem Beitrag im Hinblick auf Aufmerksamkeit. Es identifiziert dann die Einträge, deren "Interesse" Scores in den Top 50% sind.';

$LNG->ALERT_UNSEEN_COMPETITOR = 'Nicht gesehen Wettbewerber';
$LNG->ALERT_HINT_UNSEEN_COMPETITOR = 'Identifiziert Ideen von jemand anderem, der mit einer Idee, die ich verfasst konkurriert.';

$LNG->ALERT_UNSEEN_RESPONSE = 'Antworten nicht gesehen';
$LNG->ALERT_HINT_UNSEEN_RESPONSE = 'Identifiziert Antworten (von mir) nicht gesehen, die von jemand anderem zu einem Beitrag habe ich verfasst verfasst.';


//RETURNS PEOPLE / PEOPLE BASED
$LNG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "Leute wie mich - nach Interessen";
$LNG->ALERT_HINT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "Leute mit ähnlichen Interessen zu mir (basierend auf Aktivitätsmuster).";

$LNG->ALERT_PEOPLE_WHO_AGREE_WITH_ME = "Leute wie mich (basierend auf Abstimmungsverhalten)";
$LNG->ALERT_HINT_PEOPLE_WHO_AGREE_WITH_ME = "Leute mit ähnlichen Meinungen (basierend auf Abstimmungsverhalten).";

$LNG->ALERT_LURKING_USER = 'Benutzer, die stille Beobachter sind';
$LNG->ALERT_HINT_LURKING_USER = 'Benutzer hat nicht bearbeitet oder erstellt';

$LNG->ALERT_INACTIVE_USER = 'Inaktive Benutzer';
$LNG->ALERT_HINT_INACTIVE_USER = 'Findet Benutzer, die nichts getan haben';

$LNG->ALERT_USER_IGNORED_COMPETITORS = 'Mitglied ignoriert Wettbewerber';
$LNG->ALERT_HINT_USER_IGNORED_COMPETITORS = 'Identifiziert Benutzer, die Wettbewerber, ihre Ideen ignoriert. Für jeden Benutzer, listet es die Probleme der Benutzer angebotenen Ideen, gefolgt von den konkurrierenden Ideen, dass das Mitglied ignoriert (dh nicht zu sehen oder zu antworten).';

$LNG->ALERT_USER_IGNORED_ARGUMENTS = 'Mitglied ignoriert Argumente';
$LNG->ALERT_HINT_USER_IGNORED_ARGUMENTS = 'Identifiziert Benutzer, die zugrunde liegenden Argumente ignoriert, wenn ne Beiträge. Für jeden Benutzer, listet es die Beiträge bewertet, gefolgt von den Argumenten für jeden dieser Beiträge, die der Benutzer ignoriert (dh nicht zu sehen oder zu antworten).';

$LNG->ALERT_USER_IGNORED_RESPONSES = 'Mitglied ignoriert Antworten';
$LNG->ALERT_HINT_USER_IGNORED_RESPONSES = 'Identifiziert Benutzer, die Reaktionen von anderen Menschen auf ihre Posten ignoriert. Für jeden Benutzer, listet es die Nutzer verfassten Beiträge gefolgt Antworten auf jede dieser Beiträge, die der Benutzer ignoriert (dh nicht zu sehen oder zu antworten ).';


//RETURNS POSTS / MAP BASED
$LNG->ALERT_HOT_POST = "Heißer Beitrag";
$LNG->ALERT_HINT_HOT_POST = "Dieser Beitrag erziehlte ein großes Interesse.";

$LNG->ALERT_ORPHANED_IDEA = "Verwaiste Idee";
$LNG->ALERT_HINT_ORPHANED_IDEA = "Diese Idee Post erhält viel weniger Aufmerksamkeit als seine Geschwister.";

$LNG->ALERT_EMERGING_WINNER = "Dominant Idee";
$LNG->ALERT_HINT_EMERGING_WINNER = "Eine Idee erziehlte eine Vorherrschaft innerhalb der Gruppe.";

$LNG->ALERT_CONTENTIOUS_ISSUE = "Streitpunkt";
$LNG->ALERT_HINT_CONTENTIOUS_ISSUE = "Problem mit einer Ideen. Die Gemeinschaft ist stark zerteilt: Balkanisierung, Polarisation.";

$LNG->ALERT_INCONSISTENT_SUPPORT = "Unregelmäßig unterstützt Idee";
$LNG->ALERT_HINT_INCONSISTENT_SUPPORT = "Eine Idee, bei der meine Unterstützung für die Idee und die zugrunde liegenden Argumente inkonsistent sind.";

$LNG->ALERT_MATURE_ISSUE = 'Älteres Thema';
$LNG->ALERT_HINT_MATURE_ISSUE = 'Ausgabe hat > = 3 Ideen und jede Idee hat mindestens ein Argument';

$LNG->ALERT_IGNORED_POST = 'Ignorierter Beitrag';
$LNG->ALERT_HINT_IGNORED_POST = 'Beitrag wurde von niemandem ausser dem ursprüngliche Autor gesehen';

$LNG->ALERT_USER_GONE_INACTIVE = 'Benutzer inaktiv';
$LNG->ALERT_HINT_USER_GONE_INACTIVE = 'Benutzer war zunächst aktiv, dann aber inaktiv';

$LNG->ALERT_CONTROVERSIAL_IDEA = 'Umstrittene Idee';
$LNG->ALERT_HINT_CONTROVERSIAL_IDEA = 'Die Gemeinde hat sehr unterschiedlichen Meinungen (was durch ihr Abstimmungsverhalten gesehen werden kann), ob eine Idee gut ist oder nicht.';

$LNG->ALERT_IMMATURE_ISSUE = "unreife Thema";
$LNG->ALERT_HINT_IMMATURE_ISSUE = 'Problem hat 3 Ideen ohne Argumente';

$LNG->ALERT_WELL_EVALUATED_IDEA = "Gut evaluierte Idee";
$LNG->ALERT_HINT_WELL_EVALUATED_IDEA = "Idea hat einige Vor-und Nachteile, darunter auch einige Widerlegungen";

$LNG->ALERT_POORLY_EVALUATED_IDEA = "Schlecht bewertete Idee";
$LNG->ALERT_HINT_POORLY_EVALUATED_IDEA = "Idee hat einige Vor-und Nachteile, und keine Widerlegungen";

$LNG->ALERT_RATING_IGNORED_ARGUMENT = 'Bewertung ignoriert Argument';
$LNG->ALERT_HINT_RATING_IGNORED_ARGUMENT = 'Identifiziert relevanten Argumente, dass der Benutzer nicht vor dem ne einen Beitrag anzuzeigen.';
?>
