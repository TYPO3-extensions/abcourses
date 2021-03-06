<?php
$LOCAL_LANG = Array(
                       'default' => Array(
                                       '.description' => 'Datensätze von diesem Typen dienen der inhaltlichen Beschreibung sowie zur Festlegung von Terminübergreifenden Angaben.',
                                       '.details' => 'Ein Kurs kann nach erfolgtem Speichern von einem Event bzw. einem Termin referenziert werden.',
                                       '.image' => 'EXT:abcourses/doc/csh/images/course.jpg',
                                       '.seeAlso' => 'tx_abcourses_event:',
		                         'hidden.description' => 'Wenn Sie dies markieren, wird der Kurs nicht angezeigt.',
		                         'hidden.details' => 'Ist der Kurs auf Grund dieser Optionen nicht sichtbar, so wird er im Frontend nicht angezeigt. Wenn Sie als Backend-Benutzer angemeldet sind, können Sie den versteckten Kurs betrachten.',
                                       'hidden.image' => 'EXT:abcourses/doc/csh/images/icon_tx_abcourses_course__h.gif',
		                         'number.description' => 'Eine eindeutige Kursnummer hilft, den Termin in langen Auflistungen leicht wiederzufinden.',
		                         'number.details' => 'Wenn Sie ein Schema bei der Namensvergabe beibehalten hilft Ihnen dies beim Auffinden des Kurses in der Übersicht. Z.B. KURS_YY_MM_DD_ORT.',
                                       'number.image' => 'EXT:abcourses/doc/csh/images/course_number.jpg',
		                         'title.description' => 'Vergeben Sie hier einen aussagekräftigen Titel um diesen Kurs in der Übersicht transparent zu machen.',
		                         'title.details' => 'Wenn Sie ein Schema bei der Namenvergabe verfolgen hilft dies den Kunden beim Auffinden des Kurses in der Übersicht. Eindeutige Bezeichnungen können auch wunderbar für Anfrageformulare o.ä. genutzt werden.',
                                       'title.image' => 'EXT:abcourses/doc/csh/images/course_title.jpg',
		                         'subtitle.description' => 'Vergeben Sie hier einen ausführlichen Untertitel.',
		                         'subtitle.details' => 'Der Untertitel hilft dem Kunden beim Auswählen des Kurses im Frontend.',
                                       'subtitle.image' => 'EXT:abcourses/doc/csh/images/course_subtitle.jpg',
		                         'categorie.description' => 'Zu welcher Kategorie soll dieser Kurs gehören?',
		                         'categorie.details' => 'Bislang kann ein Kurs nur einer einzigen Kategorie zugeordnet werden. Da die meisten Ansichtsarten dieser Erweiterung auf Kategorien aufsetzen, sollte diese Einstellung unbedingt vorgenommen werden.',
                                       'categorie.image' => 'EXT:abcourses/doc/csh/images/course.jpg',
                                       'categorie.seeAlso' => 'tx_abcourses_categorie:',
		                         'type.description' => 'Wählen Sie hier eine Kursart die diesem Kurs zugeordnet werden soll.',
		                         'type.details' => 'Was genau eine Kursart ausmacht liegt im Endeffekt an Ihnen. Gedacht ist die Kursart zur Gruppierung in beispielsweise Grundkurs, Aufbaukurs, Spezialseminar o.ä. ...',
                                       'type.image' => 'EXT:abcourses/doc/csh/images/course.jpg',
                                       'type.seeAlso' => 'tx_abcourses_type:',
                                 'keywords.description' => 'Geben Sie Keywords ein, die in den Metadaten erscheinen sollen.',
                                    'keywords.details' => 'Dies ist schlicht ein SEO Feature. Die Keywords werden sonst nirgends ausgespielt. Es ist Konfiguration notwendig, damit die Keywords auch ausgerendert werden.',
		                         'days.description' => 'Geben Sie hier die Dauer des Kurses an.',
		                         'days.details' => 'Die Angabe der Dauer sollte in Tagen erfolgen.',
                                       'days.image' => 'EXT:abcourses/doc/csh/images/course_days.jpg',
                                       'teaser.description' => 'Vergeben Sie hier eine Kurzbeschreibung für den Kurs.',
                                       'teaser.details' => 'Eine Angabe der Kurzbeschreibung sollte auf jeden Fall erfolgen.',
                                       'teaser.image' => 'EXT:abcourses/doc/csh/images/course_teaser.jpg',
                                       'description.description' => 'Vergeben Sie hier eine ausführliche Beschreibung für den Kurs.',
                                       'description.details' => 'Eine Angabe der ausführlichen Beschreibung sollte auf jeden Fall erfolgen.',
                                       'description.image' => 'EXT:abcourses/doc/csh/images/course_description.jpg',
                                       'pages.description' => 'Hier können Sie weitere Inhalte einbinden.',
                                       'pages.details' => 'Die Verknüpfung erfolgt in Form eines Verweises auf ein Seiten-Element. Nutzen Sie hierfür den Objekt-Browser.',
                                       'pages.image' => 'EXT:abcourses/doc/csh/images/course_pages.jpg',
                                       'trainers.description' => 'Hier können Sie Dozenten einbinden, die diesen Kurs durchführen können.',
                                       'trainers.details' => 'Ein Kurs kann mehrere Dozenten referenzieren.',
                                       'trainers.image' => 'EXT:abcourses/doc/csh/images/course_trainer.jpg',
                                       'trainers.seeAlso' => 'tt_address:',
                                       'cost.description' => 'Geben Sie hier die Kosten (den Basispreis) für den Kurs an.',
                                       'cost.details' => 'Die Kosten beschreiben den Betrag, den der Teilnehmer für den gesamten Kurs zahlen muss. Der Betrag kann ggf. über die Ermässigung eines Termins reduziert werden.',
                                       'cost.syntax' => 'Geben Sie hier eine positive Fliesskommazahl mit 2 Nachkommastellen ein.',
                                       'cost.image' => 'EXT:abcourses/doc/csh/images/course_cost.jpg',
                                       'cost.seeAlso' => 'tx_abcourses_event:discount',
                                       'skilllevel.description' => 'Vergeben Sie hier einen Skill-Level.',
                                       'skilllevel.details' => 'Hier können Sie Ihren Kursteilnehmern mit Hilfe einer kleinen Säulengrafik kenntlich machen, wie hoch die Anforderungen an den Teilnehmer für diesen Kurs sind. Der Eintrag "Keine Angabe" unterdrückt eine Ausgabe der Grafik im Frontend.',
                                       'skilllevel.image' => 'EXT:abcourses/doc/csh/images/course_skilllevel.jpg',
                                       'skilllevel.seeAlso' => 'tx_abcourses_event:skilllevel',
                                       'edupoints.description' => 'Vergeben Sie hier Fortbildungspunkte.',
                                       'edupoints.details' => 'Hier können Sie Ihren Kursteilnehmern Punkte für ein evtl. Punktekonto zuweisen.',
                                       'edupoints.image' => 'EXT:abcourses/doc/csh/images/course_edupoints.jpg',
                                       'edupoints.seeAlso' => 'tx_abcourses_event:edupoints',
                                       'conditions.description' => 'Geben Sie hier die Vorraussetzungen für den Kurs an.',
                                       'conditions.details' => 'Dieses Feld dient der Freitexteingabe. Angaben in diesem Feld sollten knapp gehalten werden.',
                                       'conditions.image' => 'EXT:abcourses/doc/csh/images/course_conditions.jpg',
                                       'conditions.seeAlso' => 'tx_abcourses_event:conditionsref',
                                       'conditionsref.description' => 'Referenzen auf Kurse die zuvor besucht werden sollten.',
                                       'conditionsref.details' => 'Es können an dieser Stelle mehrere Kurse ausgewählt werden. Tragen Sie hier Kurse ein, deren Inhalte als Wissensgrundlage für diesen Kurs gelten.',
                                       'conditionsref.image' => 'EXT:abcourses/doc/csh/images/course_conditionsref.jpg',
                                       'conditionsref.seeAlso' => 'tx_abcourses_event:conditions',
                                       ),
                       'de' => Array(
),
                       );
?>