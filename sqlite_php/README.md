개발환경
os: windows 11
php: PHP 8.4.3

1. php --ini  php.ini 검색
2. extension=zip : 주석제거
3. extension=sqlite3 : 주석제거
4. extension_dir = "ext" : 주석제거
5. phpdotenv 설치
    composer require vlucas/phpdotenv

6. php sqlite.php : php 실행
7. php -S localhost:3000 : 웹서버 실행