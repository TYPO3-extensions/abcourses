<?php
$LOCAL_LANG = Array(
                       'default' => Array(
                                       '.description' => 'Ein Termin beschreibt in dieser Seminardatenbank immer den Zeitpunkt wann ein Kurs stattfindet.',
                                       '.details' => 'Hier sind anzugeben: Der Ort der Durchführung, welcher Kurs und weitere Einzelheiten. U.a auch welcher Trainer diesen Kurs durchführt.',
                                       '.syntax' => 'Syntax',
                                       '.image' => 'EXT:abcourses/doc/csh/images/events.jpg',
		                         'hidden.description' => 'Wenn Sie dies markieren, wird der Termin nicht angezeigt.',
		                         'hidden.details' => 'Die Optionen \'verstecken\', \'Start\' und \'Stop\' dienen der Zugriffsbeschränkung auf den Termin und sind daher verwandt. Ist der Termin auf Grund einer dieser Optionen nicht sichtbar, so wird er im Frontend nicht angezeigt. Wenn Sie als Backend-Benutzer angemeldet sind, können Sie den versteckten Termin betrachten. Mit \'Start\' und \'Stop\' ist die Sichtbarkeit terminierbar.',
                                       'hidden.image' => 'EXT:abcourses/doc/csh/images/icon_tx_abcourses_event__h.gif',
		                         'event.description' => 'Eine eindeutige Terminbezeichnung hilft, den Termin in langen Auflistungen leicht wiederzufinden.',
		                         'event.details' => 'Wenn Sie ein Schema bei der Namensvergabe beibehalten hilft Ihnen dies beim Auffinden des Termins in der Übersicht. Z.B. KURS_YY_MM_DD_ORT.',
                                       'event.image' => 'EXT:abcourses/doc/csh/images/event.jpg',
		                         'course.description' => 'Wählen Sie hier den Kurs, zu dem dieser Termin gehören soll.',
		                         'course.details' => 'Es kann an dieser Stelle nur "EIN" Kurs über den Objekt-Browser ausgewählt werden. Finden zur gleichen Zeit weitere Kurse statt, muss hier für jeden Kurs ein neuer Termin erstellt werden.',
                                       'course.image' => 'EXT:abcourses/doc/csh/images/course.jpg',
                                       'course.seeAlso' => 'tx_abcourses_event:event',
		                         'location.description' => 'Wählen Sie hier einen Schulungsort an dem dieser Termin durchgeführt werden soll.',
		                         'location.details' => 'Es kann an dieser Stelle nur "EIN" Schulungsort über den Objekt-Browser aus gewählt werden. Finden zur gleichen Zeit an verschiedenen Schulungsorten weitere Kurse statt, muss hier für jeden Kurs/Schulungsort ein neuer Termin erstellt werden.',
                                       'location.image' => 'EXT:abcourses/doc/csh/images/event_location.jpg',
                                       'location.seeAlso' => 'tx_abcourses_event:event',
		                         'lastminute.description' => 'Hier kann der Termin besonders gekenzeichnet werden.',
		                         'lastminute.details' => 'Die Auswirkungen dieser Kennzeichnung können Sie in der Extension-Konfiguration anpassen. Auch können bestimmte Ansichtsarten der Extension automatisch Termine mit dieser Kennzeichnung ziehen.',
                                       'lastminute.image' => 'EXT:abcourses/doc/csh/images/lastminuteflag.jpg',
		                         'coursestart.description' => 'Definieren Sie hier den ersten Tag des Termins.',
		                         'coursestart.details' => 'Sie können zusätzlich über die Optionspalette die Startzeit bzw. Endzeit des ersten Tages festlegen.',
                                       'coursestart.image' => 'EXT:abcourses/doc/csh/images/event_start.jpg,EXT:abcourses/doc/csh/images/datepicker.jpg',
                                       'coursestart.seeAlso' => 'tx_abcourses_event:courseend',
		                         'coursestart.syntax' => 'Wenn Sie den Mauscursor in ein Datumsfeld stellen, bekommen Sie einen komfortablen Auswahldialog gezeigt, der Sie bei der Eingabe unterstützt.',
		                         'courseend.description' => 'Definieren Sie hier den letzten Tag des Termins.',
		                         'courseend.details' => 'Sie können zusätzlich über die Optionspalette die Startzeit bzw. Endzeit des letzten Tages festlegen.',
                                       'courseend.syntax' => 'Wenn Sie den Mauscursor in ein Zeitfeld stellen, bekommen Sie einen komfortablen Auswahldialog gezeigt, der Sie bei der Eingabe unterstützt.',
                                       'courseend.image' => 'EXT:abcourses/doc/csh/images/event_end.jpg,EXT:abcourses/doc/csh/images/timepicker.jpg',
                                       'courseend.seeAlso' => 'tx_abcourses_event:coursestart',
		                         'regstart.description' => 'Nur innerhalb des angegebenen Zeitraumes ist eine Anmeldung im Frontend möglich.',
		                         'regstart.details' => 'Aktivieren Sie keines der Felder ist keine Anmeldung möglich, der Termin aber trotzdem sichtbar.',
                                       'regstart.image' => 'EXT:abcourses/doc/csh/images/regstart.jpg',
		                         'trainer.description' => 'Wählen Sie hier einen Trainer der diesen Termin durchführen wird.',
		                         'trainer.details' => 'Es kann an dieser Stelle nur "EIN" Trainer über den Objekt-Browser aus gewählt werden. Finden zur gleichen Zeit weitere Kurse mit unterschiedlichen Trainern statt, muss hier für jeden Kurs/Trainer ein neuer Termin erstellt werden.',                                       'trainer.image' => 'EXT:abcourses/doc/csh/images/event_trainer.jpg',
                                       'trainer.image' => 'EXT:abcourses/doc/csh/images/event_trainer.jpg',
		                         'participants.description' => 'Dieses Feld hat aktuell noch KEINE Verwendung!',
		                         'participants.details' => 'Dieses Feld hat aktuell noch KEINE Verwendung!',
                                       'participants.image' => 'EXT:abcourses/doc/csh/images/event_participants.jpg',
		                         'contingent.description' => 'Wählen Sie hier eine Anzahl möglicher Teilnehmer für diesen Termin.',
		                         'contingent.details' => 'Ist die Kontingentverwaltung dieser Seminardatenbank angeschaltet, sind weitere Buchungen nur möglich, wenn noch ein Restkontingent verfügbar ist.',                                       
                                       'contingent.image' => 'EXT:abcourses/doc/csh/images/event_contingent.jpg',
		                         'discount.description' => 'Hier können Sie eine Abweichung des Preises zum Basispreis eingeben.',
		                         'discount.details' => 'Der Basispreis wird im Kurs festgelegt. Die Abweichung kann positiv sowie negativ sein.',
                                       'discount.syntax' => 'Als Abweichung notieren Sie bitte eine Fließkommazahl mit 2 Nachkommastellen.',
                                       'discount.image' => 'EXT:abcourses/doc/csh/images/event_discount.jpg',
		                         'accommodation.description' => 'Legen Sie hier fest, welche Unterbringungsmöglichkeiten reserivert werden können.',
		                         'accommodation.details' => 'In der Seminardatenbank können Sie Unterbringungen eintragen, wie z.B. ein Hotel. Zu einem Hotel wiederum können Sie Buchungsmöglichkeiten erfassen, die eine Bezeichnung sowie eine Kosteninfo erhalten. Diese können Sie dann hier mit einem Termin verknüpfen. Ist ihr Buchungsformular entsprechend eingerichtet, sind diese Buchungsoptionen dort dann verfügbar.',
                                       ),
                       'de' => Array(
                                       '.description' => 'Ein Termin beschreibt in dieser Seminardatenbank immer den Zeitpunkt wann ein Kurs stattfindet.',
                                       '.details' => 'Hier sind anzugeben: Der Ort der Durchführung, welcher Kurs und weitere Einzelheiten. U.a auch welcher Trainer diesen Kurs durchführt.',
                                       '.syntax' => 'Syntax',
                                       '.image' => 'EXT:abcourses/doc/csh/images/events.jpg',
		                         'hidden.description' => 'Wenn Sie dies markieren, wird der Termin nicht angezeigt.',
		                         'hidden.details' => 'Die Optionen \'verstecken\', \'Start\' und \'Stop\' dienen der Zugriffsbeschränkung auf den Termin und sind daher verwandt. Ist der Termin auf Grund einer dieser Optionen nicht sichtbar, so wird er im Frontend nicht angezeigt. Wenn Sie als Backend-Benutzer angemeldet sind, können Sie den versteckten Termin betrachten. Mit \'Start\' und \'Stop\' ist die Sichtbarkeit terminierbar.',
                                       'hidden.image' => 'EXT:abcourses/doc/csh/images/icon_tx_abcourses_event__h.gif',
		                         'event.description' => 'Eine eindeutige Terminbezeichnung hilft, den Termin in langen Auflistungen leicht wiederzufinden.',
		                         'event.details' => 'Wenn Sie ein Schema bei der Namensvergabe beibehalten hilft Ihnen dies beim Auffinden des Termins in der Übersicht. Z.B. KURS_YY_MM_DD_ORT.',
                                       'event.image' => 'EXT:abcourses/doc/csh/images/event.jpg',
		                         'course.description' => 'Wählen Sie hier den Kurs, zu dem dieser Termin gehören soll.',
		                         'course.details' => 'Es kann an dieser Stelle nur "EIN" Kurs über den Objekt-Browser ausgewählt werden. Finden zur gleichen Zeit weitere Kurse statt, muss hier für jeden Kurs ein neuer Termin erstellt werden.',
                                       'course.image' => 'EXT:abcourses/doc/csh/images/course.jpg',
                                       'course.seeAlso' => 'tx_abcourses_event:event',
		                         'location.description' => 'Wählen Sie hier einen Schulungsort an dem dieser Termin durchgeführt werden soll.',
		                         'location.details' => 'Es kann an dieser Stelle nur "EIN" Schulungsort über den Objekt-Browser aus gewählt werden. Finden zur gleichen Zeit an verschiedenen Schulungsorten weitere Kurse statt, muss hier für jeden Kurs/Schulungsort ein neuer Termin erstellt werden.',
                                       'location.image' => 'EXT:abcourses/doc/csh/images/event_location.jpg',
                                       'location.seeAlso' => 'tx_abcourses_event:event',
		                         'lastminute.description' => 'Hier kann der Termin besonders gekenzeichnet werden.',
		                         'lastminute.details' => 'Die Auswirkungen dieser Kennzeichnung können Sie in der Extension-Konfiguration anpassen. Auch können bestimmte Ansichtsarten der Extension automatisch Termine mit dieser Kennzeichnung ziehen.',
                                       'lastminute.image' => 'EXT:abcourses/doc/csh/images/lastminuteflag.jpg',
		                         'coursestart.description' => 'Definieren Sie hier den ersten Tag des Termins.',
		                         'coursestart.details' => 'Sie können zusätzlich über die Optionspalette die Startzeit bzw. Endzeit des ersten Tages festlegen.',
                                       'coursestart.image' => 'EXT:abcourses/doc/csh/images/event_start.jpg,EXT:abcourses/doc/csh/images/datepicker.jpg',
                                       'coursestart.seeAlso' => 'tx_abcourses_event:courseend',
		                         'coursestart.syntax' => 'Wenn Sie den Mauscursor in ein Datumsfeld stellen, bekommen Sie einen komfortablen Auswahldialog gezeigt, der Sie bei der Eingabe unterstützt.',
		                         'courseend.description' => 'Definieren Sie hier den letzten Tag des Termins.',
		                         'courseend.details' => 'Sie können zusätzlich über die Optionspalette die Startzeit bzw. Endzeit des letzten Tages festlegen.',
                                       'courseend.syntax' => 'Wenn Sie den Mauscursor in ein Zeitfeld stellen, bekommen Sie einen komfortablen Auswahldialog gezeigt, der Sie bei der Eingabe unterstützt.',
                                       'courseend.image' => 'EXT:abcourses/doc/csh/images/event_end.jpg,EXT:abcourses/doc/csh/images/timepicker.jpg',
                                       'courseend.seeAlso' => 'tx_abcourses_event:coursestart',
		                         'regstart.description' => 'Nur innerhalb des angegebenen Zeitraumes ist eine Anmeldung im Frontend möglich.',
		                         'regstart.details' => 'Aktivieren Sie keines der Felder ist keine Anmeldung möglich, der Termin aber trotzdem sichtbar.',
                                       'regstart.image' => 'EXT:abcourses/doc/csh/images/regstart.jpg',
		                         'trainer.description' => 'Wählen Sie hier einen Trainer der diesen Termin durchführen wird.',
		                         'trainer.details' => 'Es kann an dieser Stelle nur "EIN" Trainer über den Objekt-Browser aus gewählt werden. Finden zur gleichen Zeit weitere Kurse mit unterschiedlichen Trainern statt, muss hier für jeden Kurs/Trainer ein neuer Termin erstellt werden.',                                       'trainer.image' => 'EXT:abcourses/doc/csh/images/event_trainer.jpg',
                                       'trainer.image' => 'EXT:abcourses/doc/csh/images/event_trainer.jpg',
		                         'participants.description' => 'Dieses Feld hat aktuell noch KEINE Verwendung!',
		                         'participants.details' => 'Dieses Feld hat aktuell noch KEINE Verwendung!',
                                       'participants.image' => 'EXT:abcourses/doc/csh/images/event_participants.jpg',
		                         'contingent.description' => 'Wählen Sie hier eine Anzahl möglicher Teilnehmer für diesen Termin.',
		                         'contingent.details' => 'Ist die Kontingentverwaltung dieser Seminardatenbank angeschaltet, sind weitere Buchungen nur möglich, wenn noch ein Restkontingent verfügbar ist.',                                       
                                       'contingent.image' => 'EXT:abcourses/doc/csh/images/event_contingent.jpg',
		                         'discount.description' => 'Hier können Sie eine Abweichung des Preises zum Basispreis eingeben.',
		                         'discount.details' => 'Der Basispreis wird im Kurs festgelegt. Die Abweichung kann positiv sowie negativ sein.',
                                       'discount.syntax' => 'Als Abweichung notieren Sie bitte eine Fließkommazahl mit 2 Nachkommastellen.',
                                       'discount.image' => 'EXT:abcourses/doc/csh/images/event_discount.jpg',
   		                         'arrangement.description' => 'Legen Sie hier fest, welche Unterbringungsmöglichkeiten reserivert werden können.',
		                         'arrangement.details' => 'In der Seminardatenbank können Sie Unterbringungen eintragen, wie z.B. ein Hotel. Zu einem Hotel wiederum können Sie Buchungsmöglichkeiten erfassen, die eine Bezeichnung sowie eine Kosteninfo erhalten. Diese können Sie dann hier mit einem Termin verknüpfen. Ist ihr Buchungsformular entsprechend eingerichtet, sind diese Buchungsoptionen dort dann verfügbar.',
                                       ),
                       );
?>