###################
Answer for interview question part B, to answer this questions, i used Code Igniter Framework
###################

Please Run this in your localserver AND install the database scheme

1.  Clone the codes and paste it in the htdocs inside Xampp
2. 	I don't create the registration function on web server but i create an API for that.
3.  browse POSTMAN GOOGLE TOOLS to  https://localhost/ci/index.php/api/users/register?email=<email>&password=<password>&type=<type>
4.  You can now login using the 1st User
5.  to login by session, browse to https://localhost/ci/index.php/user/login
6.  to login by json/client, browse using POSTMAN GOOGLE TOOLS to https://localhost/ci/index.php/api/users/login?email=<email>&password <password>
