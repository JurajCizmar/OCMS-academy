# REVIEW

## General
Tu ti spomeniem niektoré pripomienky čo mám, ale vyhľadaj si v projekte "REVIEW", tak nájdeš všetky moje komenty
Ak by ti niečo nedávalo zmysel alebo by si si to chcel bližšie prebrať, píš na slack
Ak opravíš / zmeníš niečo čo spomínam v "REVIEW" komente, tak rovno odstráň ten "REVIEW" koment aby sa ti netvoril neporiadok

## .gitignore
Prosím len odstráň "composer.lock", tento file je zodpovedný za určovanie verzií pre packages
A teda by bolo rozumné keby je to v gite, pretože chceš aby všetci ľudia čo robia na projekte mali tie isté verzie
Pre naše účely to nie je až také dôležité, len aby si vedel do budúcna že "composer.lock" by mali mať všetci rovnaký

## Controller-y
Existujú 2 typy controller-ov

1. HTTP Controller
Tento "Controller" je jednoducho file / class, ktorá obsahuje funkcie, ktoré sú zodpovedné za logiku HTTP endpointov
Čiže napr. v tvojom prípade by si mal mať "LoggerController.php", ktorý by obsahoval tvoje funkcie "getAllLogs", "createAttendance", ...
Toto je koncept, ktorý existuje mimo OCMS / Laravel, aj iné frameworky používajú tento koncept

2. OCMS Controller
Tento "Controller" je niečo čo zahŕňa viacero súborov a funkciou je kontrolovanie formu a listu v admin page
Tento Controller je zväčšiny vytvorený za teba pomocou commandu, vieš ho editovať aby si zmenil správanie listu a formu pre tvoj model
V tvojom prípade máš Controller "Attendance.php", kde sa definujú config súbory, permissions, url a pod.
Toto je koncept exkluzívny pre OCMS admin page a kľudne by sa to mohlo volať aj "Manager" a pod.

Problém je že sú to úplne iné veci ale volajú sa rovnako :D
Takže ich potrebujeme rozdeliť, aby bolo jasné čo je čo

Takže si potrebuješ vytvoriť HTTP Controller "LoggerController.php", do ktorého dáš všetky tie funkcie, ktoré máš teraz v "Attendance.php"
U nás sa to robí tak, že OCMS Controller-y ostanú tam kde sú vygenerované, čiže plugin/controllers, a HTTP Controller-y umiestnime do plugin/http/controllers
