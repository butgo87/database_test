### PHP를 이용한 데이터베이스 CURD 테스트 코드
#### 개발환경
    os: windows 11
    php: PHP 8.4.3

#### php.ini 파일수정
    php --ini: php.ini 파일검색
    주석제거
        extension_dir = "ext"
        extension=zip
        extension=sqlite3

#### 라이브러리 설치
    dotenv 설치
        composer require vlucas/phpdotenv
    로깅라이브러리 설치
        composer require monolog/monolog

#### 실행
    명령 프롬프트에서 실행
        php sqlite.php
    웹서버실행
        php -S localhost:3000
