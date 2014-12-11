
phpTransformer Version 1.5 :
--------------------------

English

1 - Make chure you have enabled mod rewrite in your apache web server by modifie httpd.conf :
    remove # before LoadModule rewrite_module modules/mod_rewrite.so
	remove # before LoadModule headers_module modules/mod_headers.so
    and the values after "Options Indexes FollowSymLinks Includes ExecCGI" must be :
    AllowOverride All

    Order allow,deny
    Allow from all

2 - Create new database in your MySQL Server with utf-8 collation.
3 - extrat and move phptransformer folder to your webfolder .
4 - goto setup url (ex: http://localhost/phptransformer/setup) and follow steps.

 Enjoy !

Mohsen mousawi
mhndm@phptransformer.com


--------------------------------------------------

اللغة العربية 

1 - قم بالتاكد من انك فعلت خاصية mod rewrite في سيرفر اباتشي
	انزع # قبل LoadModule rewrite_module modules/mod_rewrite.so
	انزع # قبل LoadModule headers_module modules/mod_headers.so
	و القيم بعد "Options Indexes FollowSymLinks Includes ExecCGI" يجب أن تكون :
    AllowOverride All

    Order allow,deny
    Allow from all

2 - قم بانشاء قاعدة بيانات جديد على سيرفر Mysql  الخاص بك .
3 - استخرج الملفات و انقلهم على مجلد الويب سيرفر الخاص بك؟
4 - اذهب الى رابط setup (مثال :  http://localhost/phptransformer/setup )و اتبع التعليمات.


	استمتع !
محسن الموسوي
mhndm@phptransformer.com

-------------------------------------------------