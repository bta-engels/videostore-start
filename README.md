## laravel videostore

- erstelle eine MySQL Datenbank namens 'videostore'.

#### Folgendes per Konsole einzeln nacheinander ausführen:
- composer install
- npm install
- (für lokalen Gebrauch) .htaccess anlegen mit RedirectPermanent Anweisung:
 Verzeichnis im Webroot => VHost Adresse
 (zB: **RedirectPermanent /videostore-start http://videostore-start.loc**) 
- npm run dev
- .env.local kopieren nach .env und die darin enthaltenen Conf-Daten anpassen

#### Für Windows DNS in host Datei eintragen (C:\Windows\System32\drivers\etc\hosts)
#### Für Mac OSX, Linux DNS in host Datei eintragen (/etc/hosts)
nur für Mac OSX: versteckte Dateien/Verzeichnisse anzeige: In Terminal eingeben:
```
defaults write com.apple.finder AppleShowAllFiles true
killall Finder
```
- 127.0.0.1 videostore-start.loc
- 127.0.0.1 admin.videostore-start.loc
- 127.0.0.1 monitor.videostore-start.loc

#### Apache -> httpd-vhosts.conf
```
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "htdocs"
</VirtualHost>

<VirtualHost *:80>
  ServerName videostore-start.loc
  DocumentRoot "htdocs/videostore-start/public"
  ErrorLog "logs/videostore-start-error_log"
  CustomLog "logs/videostore-start-access_log" common
</VirtualHost>
```

#### Zum Testen der API-Requests kannst Du Googles Postman nutzen
https://www.getpostman.com/

Wenn installiert, dann kannst Du hier die zu testenden Requests anlegen und ausführen:
![Postman](https://raw.githubusercontent.com/berndengels/bta-videostore/master/public/assets/postman.jpg)

#### Fehlermeldungen per Email

Installations Schritte:
https://github.com/berndengels/laravel8-email-exceptions

Für Mailversand in der .env Datei gültige SMTP Werte eintragen. z.B:

```
MAIL_DRIVER=smtp
MAIL_HOST=goldenacker.de
MAIL_PORT=25
MAIL_USERNAME=kurs@goldenacker.de
MAIL_PASSWORD=...
MAIL_ENCRYPTION=null
TO_ERROR_MAIL=your@email.com
FROM_ERROR_MAIL=your@email.com
```
und in config/laravelEmailExceptions.php

unbedingt den Parameter 'toEmailAddress' setzen (Eure Email-Adresse):

```
    'toEmailAddress'    => env('TO_ERROR_MAIL'),
    'fromEmailAddress'  => env('FROM_ERROR_MAIL'),
    'emailSubject'      => 'Videostore Error'
```
MacOSX: Postfix als Sendmail-Server einrichten:
https://gist.github.com/loziju/66d3f024e102704ff5222e54a4bfd50e

extras:
- https://laravel.com/docs/8.x/valet
- https://forge.laravel.com
- https://www.digitalocean.com
