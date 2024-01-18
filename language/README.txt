**************************
** CUSTOMIZING LANGUAGE **
**************************

The current language system allows you to add another language for two reasons:

1.	To add a new language that can be used for embedded visualisations to call.
2.	To add a new language for the CIDashboard interface to be seen in.

Basically the process for both is the same, but different language files are translated for each case.

If you want to add a new language set to CIDashboard you need to:

1. Create a new folder inside the 'language' folder whose name the two letter abbreviation 
for the language you are providing a translation for. These codes are specified by the ISO 639 standard 
(http://www.ics.uci.edu/pub/ietf/http/related/iso639.txt), 
e.g.:

Code	Language
----    --------
en	English
fr	French
it	Italian
de	German

2. Copy the language files from inside the default 'en' language folder into you new folder.
	For adding a new options only for embedded visualisations you need to translate:
		stats.php 
		languagecore.php
	For adding a new option for the CIDashboard interface you need to translate:
		All files EXCEPT stats.php.

3. Inside any given language file, each item is set up as a key/value pair, in the form key='value'.
You must translate/change only the values on the right hand side, NEVER change the key name on the left.

4.Change the language variables in the config file: $CFG->language = 'en' to reflect your new language of choice.
The $CFG->language setting must match the two letter folder name for your new language.

NB: Some HTML is mixed up in the language files especially in the language heavy areas like 
the About and the Help pages. The languagecore.php file contains the node and link names 
used by other language files. It will always be loaded first so that other language files
can reference it.