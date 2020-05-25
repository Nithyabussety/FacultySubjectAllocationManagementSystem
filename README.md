# FacultySubjectAllocationManagementSystem
 In Faculty Subject Allocation Management System we use PHP and Mysql database. 
 This is the project which keep records of Teachers where teachers can enter priority to the subjects they prefer to teach. This data is sent to the hod who allots subjects to the faculty. 
 Faculty Subject Allocation Management System has four module i.e. admin, faculty, hod and users.

Admin Module
1.	Dashboard: In this section admin can briefly view total number of subjects and total number of teachers.
2.	Subjects : In this section, admin can manage the Subjects (add/update).
3.	Teachers : In this section, admin can add new teachers and manage the details of old teachers.
4.	HOD : In this section, admin can add new HOD's and manage the details of old HOD's.
5.	Search: In this section, admin can search teachers by using teacher or HOD's name.
6.	Report: In this section, admin can view number of teachers or HOD's added  in particular periods.
7.	Profile: In this section admin can update his/her profile.
8.	Change Password: In this section admin can change his/her  own passwords
9.	Logout: Through this button admin can logout.
10.	Forgot Password : In this section, admin can receive his/her password by using registered email id and contact number.
Admin can also recover his/her password

Note: Only admin can add/delete faculty and Hod.They cannot register by themselves. 

Faculty Module
1.	Dashboard: In this section faculty can briefly view total number of subjects .
2.	Subjects : In this section, faculty can enter the priority (add/update) and can also view the alloted subjects.
3.	Profile: In this section faculty can update his/her profile.
4.	Change Password: In this section faculty can change his/her  own passwords
5.	Logout: Through this button faculty can logout.
6.	Forgot Password : In this section, faculty can receive his/her password by using registered email id and contact number.
Faculty can also recover his/her password.

HOD Module
1.	Dashboard: In this section faculty can briefly view total number of subjects .
2.	Subjects : In this section, Hod can enter the priority (add/update) and also can allot the subjects to the faculty.
4.	Profile: In this section HOD can update his/her profile.
5.	Change Password: In this section HOD can change his/her  own passwords
6.	Logout: Through this button HOD can logout.
7.	Forgot Password : In this section, HOD can receive his/her password by using registered email id and contact number.
HOD can also recover his/her password.

Note:  In this project MD5 encryption method used.

Users:
Users can search the teachers by entering the subject name.

For XAMPP server:
How to run the Faculty-Subject-Allocation-Management-System (TRMS) Project
1. Download the zip file
2. Extract the file and copy trms folder
3. Paste inside root directory(for xampp xampp/htdocs, for wamp wamp/www, for lamp var/www/html)
4. Open PHPMyAdmin (http://localhost/phpmyadmin)
5. Create a database with name trms
6. Import trms.sql file (given inside the zip package in SQL file folder)
7. Run the script http://localhost/trms (frontend)

Credential for admin panel :
Username: admin
Password: Test@123

Credentials for faculty and HOD panel : Will be known adding teacher or HOD by the admin.
