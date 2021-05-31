# PDSproject
Insurance website with backend as a part of Principles of Database System Course

### ENVIRONMENTS USED

**WAMP StackServer Configuration**:
* Apache Version:2.4.41
* Server Software:Apache/2.4.41 (Win64) PHP/7.3.12
* Port defined for Apache: 80
* PHP Version:7.3.12
* MySQL Version:8.0.18
* Port defined for MySQL: 3308

**Coding Environments Used:**
* HTML 5
* CSS
* JavaScript
* Bootstrap 
* ZingChart JavaScript charting library

**Code Editor Used:**
* Visual Studio Code

### FEATURES

**General**
1. Session variables are used to distinguish sessions of different users.
2. All the session variables are submitted by using POST/PUT and they are safely destroyed on closing the session.
3. Sensitive data such as passwords are encrypted before they are inserted into the database.
4. To  prevent threats  like  SQL  injection  all  the  MySQL  queries  are  performed  by using prepared statements.
5. Insurance data is auto indexed to speed up the queries and improve data indexing accuracy.
6. Graphs are visible to all the customersand admin to provide a graphical representation of their respective concerns.

**Admin**
1. Admin  can  view  graphs  detailing Total  Premium  Amount,  Premium  Amount  Per  User, Premium Amount Per Insurance.
2. Admin can view all the insurances and has the ability to delete insurances.
3. Admin can view all the houses, vehicles and customer information.
4. Admin can add Driver information, only the Drivers which are added by the admin are able to be employed by a customer.

**Customer** 
1. Customers can create their account and log in by using the account email ID and password.
2. Customers areable to add house insurance and automobile insurance which will calculate the premium amount automatically based on the information add by the user.
3. Customers are able to add multiple houses and automobiles to the same insurance which will change the premium amount accordingly.
4. Customers are able to view their current insurances and assets.
5. Customers are able to add and view the drivers on the automobiles that they have insured.
6. Customers can view each payment notice and a payment notice is posted every month from the insurance start date.
7. Customers   can view graphs detailing their total insurance expenditure,   and   their expenditures with respect to a particular insurance.
