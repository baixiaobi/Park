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
    ![image](https://github.com/baixiaobi/Park/blob/main/screenshot/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704104910.png)

2. **Navigate to the Report Section**  
   - Go to the "Report" section and select "Normal People Report."  
   - Choose any date range in the `fromdate` and `todate` input fields.
    ![image](https://github.com/baixiaobi/Park/blob/main/screenshot/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704104921.png)

3. **Confirm the Vulnerability**  
   - Forward the modified request and observe a 20-second delay in the response, confirming the time-based SQL injection.
   - - Capture the request and send it to Burp Suite Repeater.  
   - Inject the following payload into the `fromdate` parameter:  
     ```sql
     ' AND (SELECT 7005 FROM (SELECT(SLEEP(10)))JmJX)-- QyUxp
     ```
   - ![image](https://github.com/baixiaobi/Park/blob/main/screenshot/%E5%BE%AE%E4%BF%A1%E6%88%AA%E5%9B%BE_20250704105021.png)
    
  
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
