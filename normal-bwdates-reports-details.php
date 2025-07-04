# SQL Injection Vulnerability in Park Ticketing Management System (Normal Reports)

## Overview
A SQL Injection vulnerability was discovered in the `normal-bwdates-reports-details.php` file of the **Park Ticketing Management System Project in PHP v2.0** by PHPGurukul. This vulnerability allows remote attackers to execute arbitrary SQL code via the `todate` parameter in a POST request.

### Affected Product Details

| **Field**               | **Details**                                                                 |
|-------------------------|----------------------------------------------------------------------------|
| Product Name            | Park Ticketing Management System Using PHP and MySQL                       |
| Vendor                  | PHPGurukul                                                                 |
| Affected Code File      | `normal-bwdates-reports-details.php`                                       |
| Affected Parameter      | `fromdate`                                                                   |
| Method                  | POST                                                                       |
| Type                    | Time-based blind SQL Injection                                             |
| Version                 | v2.0                                                                       |
| Official Website        | [PHPGurukul PTMS](https://phpgurukul.com/park-ticketing-management-system-using-php-and-mysql/) |

---

## Steps to Reproduce
1. **Log in to the Admin Panel**  
   - Access the admin login page and enter valid credentials.
    ![image](https://github.com/user-attachments/assets/ed978682-8b61-475f-aaad-ca85ef9ce952)

2. **Navigate to the Report Section**  
   - Go to the "Report" section and select "Normal People Report."  
   - Choose any date range in the `fromdate` and `todate` input fields.
    ![image](https://github.com/user-attachments/assets/23e87c1f-220b-4cc0-bea6-355f61cdf93b)
  
3. **Intercept the Request**  
   - Use Burp Suite to capture the request. Ensure the browser traffic is routed through Burp Suite.
    ![image](https://github.com/user-attachments/assets/b5eba1dd-26b1-4051-b7db-9a37dbdcd0c1)

4. **Modify the Request**  
   - Capture the request and send it to Burp Suite Repeater.  
   - Inject the following payload into the `todate` parameter:  
     ```sql
     '%2b(select*from(select(sleep(20)))a)%2b'
     ```
   - ![image](https://github.com/user-attachments/assets/8cb1cf0b-a177-43cf-bcf5-cf4a0e30c414)

5. **Confirm the Vulnerability**  
   - Forward the modified request and observe a 20-second delay in the response, confirming the time-based SQL injection.
     ![image](https://github.com/user-attachments/assets/4a76c5ca-c718-41be-8d2b-e1f1f7c2ebea)
  
---

## Impact
- **Data Theft**: Unauthorized access to sensitive database data.  
- **Data Manipulation**: Alteration or deletion of critical data.  
- **Reconnaissance**: Enumeration of database structures for further attacks.  
- **Financial Loss**: Potential service disruption leading to monetary losses.  
- **Reputation Damage**: Loss of user trust due to breaches or downtime.  

---

## Recommended Mitigations
1. **Input Validation**: Sanitize and validate all user inputs.  
2. **Prepared Statements**: Use parameterized queries to prevent SQL injection.  
3. **Output Encoding**: Encode data before rendering it in the application.  
4. **Content Security Policy (CSP)**: Implement CSP to mitigate HTML injection risks.  

For detailed guidance, refer to the [OWASP SQL Injection Prevention Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html).  
